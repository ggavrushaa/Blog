<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use Illuminate\Support\Collection;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class PostController extends Controller
{
    public function index()
    {
      $posts = Post::query()->paginate(12);

        return view('user.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('user.posts.create');
    }

    public function store(Request $request)
    {
        $validated = validate($request->all(), [
            'title' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string', 'max:10000'],
            'published_at' => ['nullable', 'string', 'date',],
            'published' => ['nullable', 'boolean'],
        ]);

        $post = Post::query()->firstOrCreate([
            'user_id' => User::query()->value('id'),
            'title' => $validated['title'],
        ], [
            'content' => $validated['content'],
            'published_at' => new Carbon($validated['published_at'] ?? null),
            'published' => $validated['published'] ?? false,
        ]);


        alert(__('Сохранено!'));

        return redirect()->route('user.posts.show', $post);
    }

    public function show(Post $post)
    {
        return view('user.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('user.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = validate($request->all(), Post::$rules);

        $post->fillAttributes($validated)->save();

        alert(__('Сохранено!'));

        return back();
    }

    public function delete($post)
    {
        return redirect()->route('user.posts');
    }
}
