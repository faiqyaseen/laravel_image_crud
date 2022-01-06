<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
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
        $records = Post::get();

        return view('posts.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->except([
            '_token',
            '_method',
            'image'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $ImageName = 'post-' . time(). '.' . $extension;
            $image->move(public_path('/images/post'), $ImageName);

            $data['image'] = $ImageName;
        }

        Post::create($data);

        return redirect()
            ->route('posts.index')
            ->with('success','Post has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Post::where('id', $id)->first();

        return view('posts.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Post::where('id', $id)->first();

        return view('posts.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $data = $request->except([
            '_token',
            '_method',
            'image'
        ]);

        $post = Post::where('id', $id)->first();
        $prev_image = $post->image;

        if ($request->hasFile('image')) {
            if ($prev_image != null) {
                if (file_exists(public_path('images/post/'.$prev_image))) {
                    unlink(public_path('/images/post/'.$prev_image));
                }
            }

            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $ImageName = 'post-' . time(). '.' . $extension;
            $image->move(public_path('/images/post'), $ImageName);

            $data['image'] = $ImageName;
        } else {
            $data['image'] = $prev_image;
            
        }

        Post::where('id', $id)->update($data);

        return redirect()
            ->route('posts.index')
            ->with('success','Post has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where('id', $id)->first();

        if ($post->image != null) {
            if (file_exists(public_path('images/post/'.$post->image))) {
                unlink(public_path('/images/post/'.$post->image));
            }
        }

        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('success','Post has been deleted successfully.');
    }
}
