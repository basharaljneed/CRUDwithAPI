<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlogResource;
use App\Models\blog;
use Illuminate\Http\Request;
use App\Http\Controllers\perapitrait;
use App\Http\Requests\InfoRequest;
use App\Models\personal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    use perapitrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog = blog::first();
        if ($blog) {

            return $this->infopers(new BlogResource(blog::first()), 'ok', 200);
        }
        return $this->infopers('null', 'The blog Not Found', 401);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'blog_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->infopers('null', $validator->errors(), 400);
        }

        // $blog = blog::create($request->all());
        $blog = blog::create([

            'title' => $request->title,
            'body' => $request->body,
            'blog_id' => $request->blog_id,


        ]);

        return $this->infopers(new BlogResource($blog), $validator->errors(), 201);

        // return response()->json('mess is saved');

        //
    }

    /**
     * Display the specified resource.
     */
    public function show(blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */ public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'blog_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->infopers('null', $validator->errors(), 400);
        }
        $blog = new BlogResource(blog::find($id));

        if (!$blog) {

            return $this->infopers('null', 'The blog Not Found', 401);
        };

        $blog->update($request->all());


        return $this->infopers($blog, 'The blog is updated', 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $blog = blog::find($id);
        if (!$blog) {

            return $this->infopers('null', 'The blog Not Found', 404);
        };

        $blog->delete();
        if ($blog) {
            return $this->infopers('null', 'The blog is deleted', 201);
        }
    }
}
