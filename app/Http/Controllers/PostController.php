<?php

namespace App\Http\Controllers;

use App\Models\UserPosts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{



    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'audience' => 'required'
        ]);

        $data = [
            'title' => strip_tags($request->title),
            'body' => strip_tags($request->body),
            'audience' => strip_tags($request->audience),
            'author' => auth()->user()->id
        ];


        UserPosts::create($data);


        return redirect(route('home'));
    }

    public function edit($id)
    {
        $post = UserPosts::findOrFail($id); // Find the post by its ID
        return view('posts.edit', compact('post'));
    }

    public function delete($id)
    {
        if (Auth::check()) {
            $data = UserPosts::findOrFail($id);
            if ($data->author == auth()->user()->id) {
                $data->delete();
                return redirect(route('home'));
            }
            return redirect(route('home'));
        } else {
            return redirect(route('home'));
        }
    }


    public function update(Request $request, $id)
    {
        // Find the post
        $post = UserPosts::findOrFail($id);

        // Check if the authenticated user is the author of the post
        if ($post->author !== auth()->user->id) {
            // If the user is not the author, redirect or show an error message
            return redirect()->back()->with('error', 'You are not authorized to update this post.');
        }

        // Validate the input data
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        // Update the post
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();

        // Redirect or show a success message
        return redirect()->back()->with('success', 'Post updated successfully.');
    }
}
