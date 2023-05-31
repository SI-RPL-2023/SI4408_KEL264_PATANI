<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Product;
use App\Models\Registration;
use App\Models\Workshop;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    public function editProfile(){
        return view('editProfile');
    }
    public function articles(){
        $articles = Article::orderBy('created_at', 'desc')->get();
        return view('articles' , ['articles' => $articles]);
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->no_wa = $request->input('no_wa');
        $user->update();

        return redirect()->route('home')->with('success', 'Profile updated successfully.');
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
        $reviews = Review::all();
        $user = Auth::user();
        $user_name = $user->name;
        return view('store' , compact('products', 'reviews', 'user_name'));
    }
    public function storeSearch(Request $request){
        $products = Product::orderBy('created_at', 'desc')
            ->where('name', 'like', '%' . $request->search . '%')
            ->get();
        $reviews = Review::orderBy('created_at', 'desc')
            ->where('comment', 'like', '%' . $request->search . '%')
            ->get();
        return view('store' , ['products' => $products, 'reviews' => $reviews]);
    }
}
