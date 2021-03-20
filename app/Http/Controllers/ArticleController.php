<?php

namespace App\Http\Controllers;

use App\Http\Resources\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get articles

        $articles = \App\Models\Articles::paginate(15);


        // return collection of articles as a resource

        return Article::collection($articles);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $article = $request->isMethod("put") ? \App\Models\Articles::findOrFail($request->article_id) : new Article($request) ;
        $article->id = $request->input("article_id");
        $article->title = $request->input("title");
        $article->body = $request->input("body");

        if($article->save()) {
            return new Article($article);
        }

        // if($article->create()) {
        //     return new Article($article);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Get single article

        $article = \App\Models\Articles::findOrFail($id);

        return new Article($article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        $article = \App\Models\Articles::findOrFail($id);

        if($article->delete()) {
            return new Article($article);
        }

    }
}
