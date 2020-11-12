<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\AdminPostStoreRequest;
use Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Управление новостями';
        $posts = Post::paginate(5);

        return view('admin.posts.posts_content')
            ->with(['title'=>$title, 'posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Добавить новость';

        return view('admin.posts.posts_create')->with(['title'=>$title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AdminPostStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminPostStoreRequest $request)
    {
        //dd($request);
        $data = $this->getData($request); // Intervention Image

        if (Post::create($data)) {
            return redirect()->route('admin.post.index')
                ->with(['status' => 'Материал успешно добавлен']);
        }

        $request->flash();
        return redirect()->back()
            ->with(['error' => 'Ошибка добавления материала']);

    }

    public function getData($request) {

        $data = $request->except('_token');

        // обрабатываем изображение
        if($request->hasFile('img')) {
            $image = $request->file('img');
            if($image->isValid()) {
                $ext = $image->getClientOriginalExtension(); // ? strtolower()
                $filename = time() . '-' . Str::random(8). '.'.$ext;
                //dd($image, $filename, $ext);

                $img = Image::make($image);
                //$img->fit(600,200)->save(public_path().'/'.'img/'.$filename);//резать очень индивидуально
                $img->save(public_path().'/'.'img/'.$filename);

                $data['img'] = $filename;
            }
        }

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $title = 'Редактирование новости';

        return view('admin.posts.posts_create')
            ->with(['title'=>$title, 'post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AdminPostStoreRequest  $request
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(AdminPostStoreRequest $request, Post $post)
    {
        //dd($request, $post);
        $data = $this->getData($request);

        if($post->update($data)) {
            return redirect()->route('admin.post.index')
                ->with(['status' => 'Материал был успешно изменен']);
        }

        $request->flash();
        return redirect()->back()
            ->with(['error' => 'Ошибка сохранения материала']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        if($post->delete()) {
            return redirect()->route('admin.post.index')
                ->with(['status' => 'Данные успешно удалены.']);
        }

        return redirect()->back()
            ->with(['error' => 'Ошибка удаления данных.']);
    }
}
