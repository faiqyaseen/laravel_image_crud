<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $posts = Post::getPaginatePosts([], 5);

        if($request->ajax()) {
            $view = view('post_data', compact('posts'))->render();
            return response()->json(['html' => $view]);
        }

        return view('home', compact('posts'));
    }

    public function myPosts(Request $request)
    {
        $id = Auth::user()->id;
        $posts = Post::getPaginatePosts(['users.id' => $id], 5);

        if($request->ajax()) {
            $view = view('mypost_data', compact('posts'))->render();
            return response()->json(['html' => $view]);
        }

        return view('my_posts', compact('posts'));
    }

    public function addPost(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required'
        ]);

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

        $data['user_id'] =  Auth::user()->id;

        Post::create($data);

        return redirect()
            ->route('home')
            ->with('success','Post has been added successfully.');
    }
}
