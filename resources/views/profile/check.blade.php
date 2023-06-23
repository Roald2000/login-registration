@extends('layout')

@section('title', 'Profile')

@section('content')
    <div class="mx-auto max-w-lg mt-9 rounded-md border border-slate-200 shadow-md overflow-hidden">
        <div class="p-2 bg-red-600 flex items-center justify-between">
            <div class=" ">
                <p class=" text-lg font-bold text-white">{{ $user->name }}</p>
                <p class=" text-xs font-bold text-white">{{ $user->email }}</p>
            </div>
            @if (auth()->user()->id == $user->id)
                <a class="text-white p-1 rounded bg-black" href="{{ route('profile.setup') }}">Edit</a>
            @endif
        </div>
        <div class="p-2">
            <ul>
                <li class=" flex flex-row gap-2">
                    <span class="font-semibold flex-grow-0 flex-shrink basis-[20%] text-end">Age</span>
                    <span class="flex-auto">{{ $userProfile->age }}</span>
                </li>
                <li class=" flex flex-row gap-2">
                    <span class="font-semibold flex-grow-0 flex-shrink basis-[20%] text-end">Gender</span>
                    <span class="flex-auto">{{ $userProfile->gender }}</span>
                </li>
                <li class=" flex flex-row gap-2">
                    <span class="font-semibold flex-grow-0 flex-shrink basis-[20%] text-end">Address</span>
                    <span class="flex-auto">{{ $userProfile->address }}</span>
                </li>
                <li class=" flex flex-row gap-2">
                    <span class="font-semibold flex-grow-0 flex-shrink basis-[20%] text-end">Contact</span>
                    <span class="flex-auto">{{ $userProfile->contact }}</span>
                </li>
                <li class=" flex flex-row gap-2">
                    <span class="font-semibold flex-grow-0 flex-shrink basis-[20%] text-end">Joined</span>
                    <span class="flex-auto">{{ $userProfile->created_at->diffForHumans() }} ago</span>
                </li>
            </ul>
        </div>
    </div>
@endsection
