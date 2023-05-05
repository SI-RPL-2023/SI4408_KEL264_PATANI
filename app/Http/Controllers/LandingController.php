<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Product;
use App\Models\Registration;
use App\Models\Workshop;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function articles(){
        $articles = Article::orderBy('created_at', 'desc')->get();
        return view('articles' , ['articles' => $articles]);
    }

    public function register(Request $request, Workshop $workshop)
    {
        // Cek apakah user sudah terdaftar atau belum
        $isRegistered = $workshop->registrations()->where('user_id', auth()->id())->exists();
        if ($isRegistered) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar pada workshop ini');
        }

        // Tambahkan data pendaftaran ke tabel registrations
        $registration = new Registration();
        $registration->user_id = auth()->id();
        $registration->workshop_id = $workshop->id;
        $registration->save();

        $workshop = Workshop::find($workshop->id);
        $workshop->capacity = $workshop->capacity - 1;
        $workshop->update();

        return redirect()->back()->with('success', 'Berhasil mendaftar ke workshop ini');
    }

    public function articlesSearch(Request $request){
        $articles = Article::orderBy('created_at', 'desc')
            ->where('title', 'like', '%' . $request->search . '%')
            ->get();
        return view('articles' , ['articles' => $articles]);
    }

    public function workshops(){
        $workshops = Workshop::orderBy('created_at', 'desc')->get();
        return view('workshops' , ['workshops' => $workshops]);
    }

    public function workshopsSearch(Request $request){
        $workshops = Workshop::orderBy('created_at', 'desc')
            ->where('title', 'like', '%' . $request->search . '%')
            ->get();
        return view('workshops' , ['workshops' => $workshops]);
    }

    public function store(Request $request){
        $products = Product::all();
        return view('store' , compact('products'));
    }
}
