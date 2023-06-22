@extends('layout')

@section('title', 'Profile')

@section('content')
    <div class="mx-auto max-w-lg mt-9 rounded-md border border-slate-200 shadow-md overflow-hidden">
        <div class="p-2 bg-red-600 flex items-center justify-between">
            <h1 class=" text-xl font-bold text-white">{{ $user->name }}</h1>
            <a class="text-white p-1 rounded bg-black" href="">Edit</a>
        </div>
        <div class="p-2">
            
        </div>
    </div>
@endsection
