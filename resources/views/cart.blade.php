@extends('layouts.app2')

@section('content')

    <div class="section  p-5">
        <div class="card m-5 p-5">
    <table class="table">
        <thead>
        <tr>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php $tots = 0?>
        @foreach ($carts as $cart)
            <tr>
                <td>{{ $cart->product->name }}</td>
                <td>{{ $cart->product->price }}</td>
                <td>{{ $cart->quantity }}</td>
                <td> {{ $cart->product->price * $cart->quantity }}</td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editCartItemModal{{ $cart->id }}">
                        Edit
                    </button>
                    <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>


           <?php $tots += $cart->product->price * $cart->quantity ?>

               <!-- Modal -->
            <div class="modal fade" id="editCartItemModal{{ $cart->id }}" tabindex="-1" aria-labelledby="editCartItemModal{{ $cart->id }}Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCartItemModal{{ $cart->id }}Label">Edit Quantity</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="{{ route('cart.update', $cart->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $cart->quantity }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>Total:</strong> Rp{{ number_format($tots, 0, ',', '.') }}</td>
            <td>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Checkout
                </button>
            </td>
        </tr>
        </tbody>
    </table>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Transfer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{route('order')}}" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">

                        <div class="mb-3">
                            <label for="exampleInputFile" class="form-label">Upload File</label>
                            <input class="form-control" name="bukti_trf" type="file" id="exampleInputFile" aria-describedby="fileHelp">
                            <div id="fileHelp" class="form-text">Upload bukti transfer dalam format JPG, JPEG, atau PNG dengan ukuran maksimal 5MB.</div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection
