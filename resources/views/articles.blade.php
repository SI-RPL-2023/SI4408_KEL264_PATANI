@extends('layouts.app2')


@section('content')
    <div class="row">
        <div class="container">
            <header>
                <div class="page-header min-vh-50" style="background-image: url('images/artikel.avif');" loading="lazy">
                    <span class="mask bg-gradient-dark opacity-4"></span>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 mx-auto text-white text-center">
                                <h2 class="text-white">Baca Artikel Dari Patani</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6 overflow-hidden">
                <div class="container">
                    <div class="row border-radius-md pb-4 p-3 mx-sm-0 mx-1 position-relative">
                        <form action="{{route('articles.search')}}" method="post">
                            @csrf
                            @method('post')
                            <div class="col-lg-9 mt-lg-n2 mt-2">
                                <label class="ms-0">Search Judul Artikel</label>
                                <div class="input-group input-group-static">
                                    <span class="input-group-text"></span>
                                    <input class="form-control " placeholder="Please select date" name="search" type="text">
                                </div>
                            </div>
                            <div class="col-lg-3 mt-lg-n2 mt-2">
                                <label>&nbsp;</label>
                                <button type="submit" class="btn bg-gradient-success w-100 mb-0">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <section class="pt-7 pb-0">
                    <div class="container">
                        <div class="row">
                            @foreach($articles as $article)
                             <div class="col-lg-4 col-md-6 mb-5">
                                <div class="card mt-5 mt-md-0">
                                    <div class="card-header p-0 mx-3 mt-n4 position-relative z-index-2">
                                        <a class="d-block blur-shadow-image">
                                            <img src="{{asset('images/'.$article->image)}}" alt="img-blur-shadow" class="img-fluid border-radius-lg" loading="lazy">
                                        </a>
                                    </div>
                                    <div class="card-body pt-3">

                                        <a href="javascript:;">
                                            <h5>
                                                {{$article->title}}
                                            </h5>
                                        </a>
                                        <p style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                                            {!! $article->content !!}
                                            <!-- Tombol untuk melihat detail artikel -->
                                            <!-- Tombol untuk modal -->
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#detailModal{{$article->id}}">
                                                Lihat Detail
                                            </button>
                                    </div>
                                </div>
                            </div>


    @endforeach


                        </div>
                    </div>
                </section>

            </div>

        </div>
    </div>



    @foreach($articles as $article)

        <!-- Modal untuk detail artikel -->
        <div class="modal fade" id="detailModal{{$article->id}}" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Detail Artikel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Penulis : {{$article->user->name}}</p>
                        <img src="{{asset('images/'.$article->image)}}" alt="img-blur-shadow" class="img-fluid border-radius-lg" loading="lazy">

                        <div class="p-3">
                            {!! $article->content !!}
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
