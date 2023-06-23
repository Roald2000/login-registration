<header class="container mx-auto p-4 shadow flex flex-row justify-between items-center gap-2">
    @auth
        <div>
            <a class="text-xl" href="{{ route('home') }}">{{ config('app.name') }}</a>
        </div>
        <div>
            <a title="Your Profile Name" class=" font-bold hover:underline" href="{{ route('profile') }}">
                {{ auth()->user()->name }}</a>
            <a class="text-xl text-red-600" href="/logout">Logout</a>
        </div>
    @else
        <div class="">
            <a class="text-xl" href="/login">Login</a>
            <a class="text-xl" href="/registration">Register</a>
        </div>
    @endauth

</header>
