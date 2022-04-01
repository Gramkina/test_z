<?php

namespace App\Http\Controllers;

use App\Models\Statement;
use Exception;
use http\Client\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StatementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $statements = Auth::user()->getStatements()->previews()->get();
        return view('statement', compact('statements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'user-phone' => ['required', 'max:10', 'regex:/[0-9]{10}/'],
            'user-company' => ['required', 'max:255'],
            'statement-name' => ['required', 'max:255'],
            'statement-message' => ['required'],
        ]);

        $file = $request->file('statement-file');
        $fileData = [];
        if ($file) {
            $file = $request->file('statement-file');
            $fileData['tmp_name'] = $file->hashName();
            $fileData['name'] = $file->getClientOriginalName();
        }
        DB::transaction(function () use($request, $fileData, $file){
            Statement::create([
                'user' => Auth::user()->id,
                'phone' => $request['user-phone'],
                'company' => $request['user-company'],
                'name' => $request['statement-name'],
                'message' => $request['statement-message'],
                'file' => $fileData,
            ]);
            if ($file) {
                try {
                    Storage::disk('local')->put('files/', $file);
                } catch (Exception $exception) {
                    DB::rollBack();
                }
            }
        });

        return redirect()->route('statement.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Auth::user()->getStatements()->byId($id)->first();
    }

    public function downloadFile(Statement $statement, $fileName)
    {
        if ($statement->file['tmp_name'] == $fileName) {
            return Storage::disk('local')->download('files/'.$statement->file['tmp_name'], $statement->file['name']);
        } else {
            abort(403);
        }
    }
}
