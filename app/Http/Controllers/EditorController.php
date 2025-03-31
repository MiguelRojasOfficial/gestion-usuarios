<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class EditorController extends Controller
{
    public function index(Request $request)
{
    $query = Article::where('user_id', auth()->id());
        
    if ($request->filled('title')) {
        $query->where('title', 'like', '%' . $request->title . '%');
    }

    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    

    $articles = $query->paginate(10);
    $users = User::all();

    return view('editor.articles.index', compact('articles', 'users'));
}

public function create(array $data)
{
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ]);

    $role = Role::where('name', 'editor')->first();
    $user->roles()->attach($role);

    return $user;
}

public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('editor.articles.index')->with('success', 'Artículo creado con éxito.');
    }

public function edit($id)
    {
        $article = Article::findOrFail($id);

        if ($article->user_id !== auth()->id()) {
            return redirect()->route('editor.articles.index')->with('error', 'No tienes permiso para editar este artículo.');
        }

        return view('editor.articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        if ($article->user_id !== auth()->id()) {
            return redirect()->route('editor.articles.index')->with('error', 'No tienes permiso para editar este artículo.');
        }

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $article->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('editor.articles.index')->with('success', 'Artículo actualizado con éxito.');
    }

}
