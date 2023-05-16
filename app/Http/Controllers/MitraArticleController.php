<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MitraArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::where('user_id' , Auth::id())->get();

        return view('mitra.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {  // Validasi input


        // Membuat objek Article baru
        $article = new Article();
        $article->title = $request->title;
        $article->content = $request->content;
        $article->user_id = Auth::id();

        // Jika ada file gambar yang diunggah, simpan ke storage dan update nama file ke field image_path pada database
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->move('images');
            $article->image = basename($imagePath);
        }

        // Simpan article ke database
        $article->save();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('mitraArticles.index')->with('success', 'Article has been created successfully.');
    }


    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {   $article = Article::findOrFail($id);

        $article->title = $request->input('title');
        $article->content = $request->input('content');

        // Cek apakah terdapat file gambar yang di-upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);
            $article->image = $filename;
        }

        $article->save();

        return redirect()->route('mitraArticles.index')->with('success', 'Artikel berhasil diupdate.');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('mitraArticles.index')->with('success', 'Article deleted successfully!');
    }
}