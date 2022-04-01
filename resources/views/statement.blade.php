@section('title-page', 'Список заявок')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Список заявок') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div id="statements" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <statements :statements='@json($statements)' :showurl='"{{ route('statement.index') }}"'></statements>
        </div>
    </div>
</x-app-layout>
