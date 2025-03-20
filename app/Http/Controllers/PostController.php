<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Services\PostServive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    const VIEW_TEMPLATE = 'posts.';
    const UPLOAD = 'uploads/posts';

    protected $postRepository;
    protected $postServive;
    public function __construct(PostServive $postServive,PostRepositoryInterface $postRepository) {
        $this->postRepository = $postRepository;
        $this->postServive = $postServive;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->postServive->paginate();
        return view(self::VIEW_TEMPLATE . __FUNCTION__, compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view(self::VIEW_TEMPLATE . __FUNCTION__, compact('users'));
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
        $users = $request->user_id;
        $post = $this->postRepository->create($data);
        if($post){
            $post->users()->sync($users);
        }
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
        $data = $request->except('image');
        $oldImage = $post->image;
        if($request->has('image')){
            $data['image'] = Storage::put(self::UPLOAD, $request->file('image'));
        }
        $this->postRepository->update($post->id, $data);
        if($oldImage && Storage::exists($oldImage)){
            Storage::delete($oldImage);
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->postRepository->delete($post->id);
        return back();
    }
}
