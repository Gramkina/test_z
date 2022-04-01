<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'statements';

    protected $fillable = [
        'user',
        'phone',
        'company',
        'name',
        'message',
        'file',
    ];

    protected $casts = [
        'created_at' => 'datetime:d.m.Y H:m',
        'file' => 'array',
    ];

    protected $hidden = [
        'updated_at',
        'user',
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePreviews($query)
    {
        return $query->select('id', 'name', 'created_at');
    }

    public function scopeById($query, $id)
    {
        return $query->where('id', $id);
    }

}
