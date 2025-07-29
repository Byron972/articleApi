<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
           return response()->json([
            'success' => true ,
            'articles' => $articles
        ]);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation des donner
        $validateData= $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published'=> 'boolean'
        
        ]);

        $article = Article::create($validateData);
        return response()->json([
            'success' => true,
            'article' => $article
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return response()->json([
            'success' => true ,
            'article' => $article
        ]);
    }
   

    public function update(Request $request, Article $article)
    {
        $validateData= $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published'=> 'boolean'
        
        ]);
        // Mettre à jour l'article avec les données validées
        $article->update($validateData);
        return response()->json([
            'success' => true,
            'messaage'=> 'Article modifié avec succès',
            'article' => $article
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
         $article->delete();
        return response()->json([
            'success' => true,
            'messaage'=> 'Article modifié avec succès',
            'article' => $article
        ], 201);
    }
}
