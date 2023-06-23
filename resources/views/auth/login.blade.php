@extends('layout')

@section('title', 'Login')
@section('content')
    {{-- //!Login Form --}}
    <form action="{{ route('post.login') }}" method="POST"
        class="max-w-lg mx-auto mt-3 border border-slate-300 shadow-slate-300 shadow-md p-6 rounded">
        @csrf
        @method('POST')
        <h1 class="text-3xl font-bold">Login</h1>
        <hr class="mt-6 mb-8">
        <div class="flex flex-col gap-6 relative">
            <label for="" class="relative border rounded-md border-slate-300">
                <input class="peer w-full p-2  border" type="text" name="email" value="{{ old('email') }}"
                    id="" required>
                <span
                    class="peer-focus:-top-1/3 peer-focus:text-xs peer-valid:text-xs peer-valid:-top-1/3 duration-200  absolute font-thin  pointer-events-none top-1/2 -translate-y-1/2 left-2">Email</span>
            </label>
            <label for="" class="relative  border rounded-md border-slate-300">
                <input class="peer w-full p-2 " type="password" name="password" id="password" required>
                <span
                    class="peer-focus:-top-1/3 peer-focus:text-xs peer-valid:text-xs peer-valid:-top-1/3 duration-200  absolute font-thin  pointer-events-none top-1/2 -translate-y-1/2 left-2">Password</span>
            </label>
            <div class="flex flex-row items-center flex-wrap gap-2 justify-between">
                <label class="p-2 w-fit cursor-pointer flex items-center gap-3" for="togglecheckbox">
                    <input class="cursor-pointer" type="checkbox" name="" id="togglecheckbox">
                    <span class="cursor-pointer text-xs font-semibold">Show Password</span>
                </label>
                {{-- <a class="text-red-600 text-xs font-semibold" href="{{ route('auth.forgot') }}">Forgot Password</a> --}}
            </div>
        </div>
        <br>
        <button class="p-2 rounded bg-blue-500 hover:bg-blue-400 text-white" type="submit">Login</button>
    </form>
    <ul class="max-w-lg mx-auto mt-4">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <li class="list-item list-inside list-disc text-xs mt-3  rounded-md text-red-900 bg-red-300 p-2">
                    {{ $error }}
                </li>
            @endforeach
        @endif
        @if (session()->has('error'))
            <li class="list-item list-inside list-disc text-xs mt-3  rounded-md text-red-900 bg-red-300 p-2">
                {{ session('error') }}
            </li>
        @endif
        @if (session()->has('success'))
            <li class="list-item list-inside list-disc text-xs mt-3  rounded-md text-red-900 bg-red-300 p-2">
                {{ session('success') }}
            </li>
        @endif
    </ul>
    <script>
        document.getElementById("togglecheckbox").addEventListener('change', (e) => {
            const password = document.getElementById('password');
            if (password.type == 'text') {
                password.type = 'password';
            } else {
                password.type = 'text';
            }
        });
    </script>
@endsection
