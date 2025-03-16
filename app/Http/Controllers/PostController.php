<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    const VIEW_TEMPLATE = 'posts.';
    const UPLOAD = 'uploads/posts';

    protected $postRepository;
    public function __construct(PostRepositoryInterface $postRepository) {
        $this->postRepository = $postRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->postRepository->all(['*'], ['users']);
        return view(self::VIEW_TEMPLATE . __FUNCTION__, compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::VIEW_TEMPLATE . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('image');
        if($request->has('image')){
            $data['image'] = Storage::put(self::UPLOAD, $request->file('image'));
        }
        $this->postRepository->create($data);
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view(self::VIEW_TEMPLATE . __FUNCTION__);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view(self::VIEW_TEMPLATE . __FUNCTION__, compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
