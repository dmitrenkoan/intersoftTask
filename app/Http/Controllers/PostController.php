<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Picture;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')->paginate(10);
        return view('layouts.adminPosts', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::orderBy('name', 'asc')->get();
        return view('layouts.adminAddPost', [
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post();
        // Проверяяем является ли вложенный файл картинкой
        $this->validate($request, [
            'picture' => 'image',
        ]);

        $post->title = $request->title;
        $post->user_id = $request->user_id;
        $post->detail_text = $request->detail_text;
        $post->publication_date = $request->publication_date;

        if(!empty($request->picture)) {
            $pictureID = PictureController::add($request);
            $post->picture_id = $pictureID;

        }
        $post->save();
        return redirect('/admin/note');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::with('user', 'picture')->find($id);
        $users = User::orderBy('name', 'asc')->get();
        return view('layouts.adminEditPost', [
            'post' => $post,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        // Проверяяем является ли вложенный файл картинкой
        $this->validate($request, [
            'picture' => 'image',
        ]);

        $post->title = $request->title;
        $post->user_id = $request->user_id;
        $post->detail_text = $request->detail_text;
        $post->publication_date = $request->publication_date;

        if(!empty($request->picture)) {
            if(!empty($post->picture_id)) {
                //Удаляем старую фотографию //
                $status = PictureController::remove($post->picture_id);
            }
            $pictureID = PictureController::add($request);
            $post->picture_id = $pictureID;

        }
        if(!empty($request->remove_picture)) {
            //Удаляем старую фотографию //
            $status = PictureController::remove($post->picture_id);
            if($status) {
                $post->picture_id = NULL;
            }
        }
        $post->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(!empty($post->picture_id)) {
            //Удаляем старую фотографию //
            $status = PictureController::remove($post->picture_id);
        }
        $post->delete();
        return redirect('/admin/note');

    }

    public function publicIndex() {
        $posts = Post::with('user')->paginate(10);
        return view('layouts.posts', [
            'posts' => $posts
        ]);
    }
}
