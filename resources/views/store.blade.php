@extends('layouts.app2')


@section('content')
    <div class="row">
        <div class="container">
            <header>
                <div class="page-header min-vh-50" style="background-image: url('images/banner-02.jpg');" loading="lazy">
                    <span class="mask bg-gradient-dark opacity-4"></span>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 mx-auto text-white text-center">
                                <h2 class="text-white">Silahkan Berbelanja</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6 overflow-hidden">
                <div class="container">
                    <div class="row border-radius-md pb-4 p-3 mx-sm-0 mx-1 position-relative">
                        <form action="{{'articles.searchh'}}" method="post">
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
                            @foreach($products as $product)
                                <div class="col-lg-4 col-md-6 mb-5">
                                    <div class="card mt-5 mt-md-0">
                                        <div class="card-header p-0 mx-3 mt-n4 position-relative z-index-2">
                                            <a class="d-block blur-shadow-image">
                                                <img src="{{asset('images/'.$product->image)}}" alt="img-blur-shadow" class="img-fluid border-radius-lg" loading="lazy">
                                            </a>
                                        </div>
                                        <div class="card-body pt-3">

                                            <a href="javascript:;">
                                                <h5>
                                                    {{$product->name}}
                                                </h5>
                                            </a>
                                            <p style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                                                {{$product->description}}
                                            </p>
                                                <!-- Tombol untuk melihat detail artikel -->
                                                <!-- Tombol untuk modal -->

                                                <button class="btn btn-lg btn-info">Harga : Rp {{$product->price}}</button>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#detailModal{{$product->id}}">
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



    @foreach($products as $product)

        <!-- Modal untuk detail -->
        <div class="modal fade" id="detailModal{{$product->id}}" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Detail Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Nama Barang : {{$product->name}}</p>
                        <p>Stock : {{$product->stock}} Pcs</p>
                        <img src="{{asset('images/'.$product->image)}}" alt="img-blur-shadow" class="img-fluid border-radius-lg" loading="lazy">
                        <p>Category : {{$product->category->name}} </p>
                        <div class="p-3">
                            {{$product->description }}
                        </div>
                        <h6>Ulasan</h6>
                        <div class="p-3">
                            @foreach($reviews as $review)
                                @if($review->product_id === $product->id)
                                    {{ $user_name }}: "{{$review->comment}}"
                                @endif
                            @endforeach
                        </div>

                        <button class="btn btn-lg btn-info">Harga : Rp {{$product->price}}</button>
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" class="form-control" name="product_id" value="{{ $product->id }}">
                            <div class="d-flex">
                            <input type="number" class="" name="quantity" value="1">
                            <button type="submit" class="btn  btn-lg btn-outline-primary" >Add to cart</button>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
