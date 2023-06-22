<header class="container mx-auto p-4 shadow flex flex-row-reverse justify-between items-center gap-2">
    @auth
        <div>
            <a class="text-xl" href="#">{{ config('app.name') }}</a>
            <a class="text-xl text-red-600" href="/logout">Logout</a>
        </div>
        <p>Welcome! {{ auth()->user()->name }}</p>
    @else
        <div>
            <a class="text-xl" href="/login">Login</a>
            <a class="text-xl" href="/registration">Register</a>
        </div>
    @endauth

</header>
