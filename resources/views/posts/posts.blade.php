@extends('layout')


@section('content')
    <div class="max-w-lg mt-6 mx-auto ">
        <h1 class="my-3 font-bold text-red-700 text-3xl p-2">Create Post</h1>
        <div class="p-2 rounded-md border border-red-600 shadow">
            <form action="{{ route('posts.create') }}" method="POST">
                @csrf
                <div class="flex flex-col gap-2">
                    <label for="" class="flex flex-col">
                        <span>Title</span>
                        <input class="p-2 rounded-md border border-red-600" type="text" name="title" id=""
                            value="{{ old('title') }}">
                    </label>
                    <label for="" class="flex flex-col">
                        <span>Decription</span>
                        <textarea class=" resize-none p-2 rounded-md border border-red-600" name="body" id="" cols="auto"
                            rows="5">{{ old('body') }}</textarea>
                    </label>
                    <select class="p-2 rounded-md border border-red-600" name="audience" id="">
                        <option value="Public">Public</option>
                        <option value="Private">Private</option>
                    </select>
                </div>
                <br>
                <button class="p-2 bg-red-600 text-white rounded-md " type="submit" class="">Post</button>
            </form>
            <ul class="w-full mx-auto mt-4">
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
        </div>
        <h1 class="my-3 font-bold text-red-700 text-3xl p-2">Posts</h1>
        @foreach ($posts as $item)
            {{-- //ToDO If the authenticated user is the author of the post with an audience set to private then include those to the users feed --}}
            @if ($item->audience == 'Public')
                <div class="p-2 rounded-md shadow mt-3 border-2 border-red-600">
                    <div class="flex items-start justify-between flex-col">
                        <div class="flex justify-between items-center w-full">
                            <a class="text-red-600 font-bold"
                                href="{{ route('profile.check', ['id' => $item->author]) }}">{{ $item->user->name }}</a>
                            @if (auth()->user()->id == $item->author)
                                <div>
                                    <a href="{{ route('posts.edit', ['id' => $item->id]) }}">Edit</a>
                                    <a href="{{ route('posts.delete', ['id' => $item->id]) }}">Delete</a>
                                </div>
                            @endif
                        </div>
                        <div class="">
                            <p class="inline text-end font-bold text-slate-600 text-xs">Created
                                {{ $item->created_at->diffForHumans(null, true) }} ago</p>
                            <p class="inline text-end font-bold text-slate-600 text-xs">Updated
                                {{ $item->updated_at->diffForHumans(null, true) }} ago</p>
                        </div>
                    </div>
                    <hr class="my-2 border-red-600">
                    <div>
                        <p class="px-2">{{ $item->title }}</p>
                        <p class="border-red-600 border rounded-md p-2">{{ $item->body }}</p>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endsection
