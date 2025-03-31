<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Notifications\ArticleUpdated;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Article::query();

    if ($request->filled('title')) {
        $query->where('title', 'like', '%' . $request->title . '%');
    }

    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    if ($request->filled('user_id')) {
        $query->where('user_id', $request->user_id);
    }

    $articles = $query->paginate(10);
    $users = User::all();

    return view('editor.articles.index', compact('articles', 'users'));
}
   
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('editor.articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'content']);
        $data['user_id'] = auth()->id();
    
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }
    
        $article = Article::create($data);
        $admins = User::whereHas('roles', function($query) {
            $query->where('name', 'admin');
        })->get();
    
        foreach ($admins as $admin) {
            $admin->notify(new ArticleUpdated($article, 'publicado'));
        }

    
        return redirect()->route('editor.articles.index')->with('success', 'Artículo creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        if ($article->user_id !== Auth::id()) 
        {
            abort(403);
        }

        return view('editor.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        if ($article->user_id !== Auth::id()) 
        {
            abort(403);
        }

        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);
    
        $data = $request->only(['title', 'content']);
    
        if ($request->hasFile('image')) {
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
    
            $data['image'] = $request->file('image')->store('articles', 'public');
        } else {
            $data['image'] = $article->image;
        }
    
        $article->update($request->all());
        $admins = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();
        foreach ($admins as $admin) {
        $admin->notify(new ArticleUpdated($article, 'actualizado'));
    }
    
        return redirect()->route('editor.articles.index')->with('success', 'Artículo actualizado');
    }
    
    public function destroy(Article $article)
    {
        if ($article->user_id !== Auth::id()) 
        {
            abort(403);
        }
        
        $article->delete();
        return redirect()->route('editor.articles.index')->with('success', 'Artículo eliminado');
    }
}
