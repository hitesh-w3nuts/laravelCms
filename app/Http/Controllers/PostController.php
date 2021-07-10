<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.posts', )->with('posts',$posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->input();
        /*echo "<pre>";
        print_r($data);
        echo "</pre>";exit();*/
        $rules = [
            'name' => 'required',
            'type' => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return redirect('admin/add-new/'.$data['type'])
            ->withInput()
            ->withErrors($validator);
        }else{
            if(isset($data['categoryID']) && empty($data['categoryID'])){
                $data['categoryID'] = 0;
            }elseif(!isset($data['categoryID'])){
                $data['categoryID'] = 0;
            }
            $post = Post::create([
                'name' => $data['name'],
                'content' => $data['content'],
                'type' => $data['type'],
                'categoryID' => $data['categoryID'],
              ]);
        }
        return redirect('admin/edit/'.$data['type'].'/'.$post->id)->with('status',"Post created successfully");
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
    