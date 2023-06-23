@extends('layout')

@section('title', 'Setup Profile')
@section('content')
    <div class="max-w-lg border mx-auto mt-6 p-6 rounded shadow-md">
        <h1 class="text-xl font-semibold">Setup Your Profile.</h1>
        <p class="p-2">User/Email : <span class="font-semibold">{{ auth()->user()->email }}</span></p>
        <form action="{{ route('profile.update') }}" method="POST" class="p-1 flex flex-col gap-2">
            @csrf
            @method('POST')
            <input class="p-2 rounded border border-black" type="text" name="name" id=""
                placeholder="{{ auth()->user()->name }}" value="{{ auth()->user()->name }}">
            <input class="p-2 rounded border border-black" type="number" name="age" id="age" placeholder="Age"
                value="{{ !$userProfile ? null : $userProfile->age }}">
            <select name="gender" id="" class="p-2 rounded border border-black">
                <option value="">Choose Gender</option>
                <option value="Female">Female</option>
                <option value="Male">Male</option>
            </select>
            <input class="p-2 rounded border border-black" type="text" name="address" id="address"
                placeholder="Address" value="{{ !$userProfile ? null : $userProfile->address }}">
            <input class="p-2 rounded border border-black" type="text" name="contact" id="contact"
                placeholder="Contact" value="{{ !$userProfile ? null : $userProfile->contact }}">
            <button class="my-3 w-fit self-end p-2 rounded bg-blue-600 text-white">Save</button>
        </form>
    </div>
@endsection
