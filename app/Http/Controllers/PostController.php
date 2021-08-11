<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::orderBy('id', 'ASC')->paginate(5);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePost $request)
    {
        $data = $request->all();
        if ($request->image->isValid()) {
            $fileName = \Str::of($request->title)->slug('-') . '.' . $request->image->getClientOriginalExtension();
            $image = $request->image->storeAs('posts', $fileName);
            $data['image'] = $image;
            Post::create($data);
        }
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($post = Post::find($id)) {
            return view('admin.posts.show', compact('post'));
        }
        return redirect()->route('posts.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($post = Post::find($id)) {
            return view('admin.posts.edit', compact('post'));
        }
        return redirect()->route('posts.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatePost $request, $id)
    {
        if (!$post = Post::find($id)) {
            return redirect()->route('posts.index');
        }

        $data = $request->all();

        if ($request->image && $request->image->isValid()) {
            if (\Storage::exists($post->image)) {
                \Storage::delete($post->image);
            }
            $fileName = \Str::of($request->title)->slug('-') . '.' . $request->image->getClientOriginalExtension();
            $image = $request->image->storeAs('posts', $fileName);
            $data['image'] = $image;
        }

        $post->update($data);
        return redirect()->route('posts.index')->with('message', 'Post atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($post = Post::find($id)) {
            $post->delete();
            if (\Storage::exists($post->image)) {
                \Storage::delete($post->image);
            }
            return redirect()->route('posts.index')->with('message', 'Post deletado com sucesso');
        }
        return redirect()->route('posts.index');
    }


    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $posts = Post::where('title', 'LIKE', "%{$request->search}%")
            ->orWhere('content', 'LIKE', "%{$request->search}%")
            ->paginate();
        return view('admin.posts.index', compact('posts', 'filters'));
    }
}
