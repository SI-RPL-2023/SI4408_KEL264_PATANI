@extends('layouts.app2')

@section('content')

    <div class="section  p-5">
        <div class="card m-5 p-5">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Bukti Transfer</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->bukti_trf }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->total }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->id }}">
                                View Items
                            </button>
                            @foreach($order->reviews as $review)
                                @if($review->status == 'yes')
                                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"><a href="{{ route('order.list') }}" style="color:white">Review</a>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $review->id }}">Review
                                    </button>
                                @endif
                        </td>
                    </tr>
                    {{-- modal edit review --}}
                    <div class="modal fade" id="editModal{{ $review->id }}" tabindex="-1" aria-labelledby="editModal{{ $review->id }}Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModal{{ $review->id }}Label">Add Review</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="color:black;" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('order.addReview', $review->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Review</label>
                                            <input type="text" class="form-control" id="review" name="review" value="{{ $review->comment }}">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Add Review</button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </tbody>
                @endforeach
            </table>

            @foreach($orders as $order)
            <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Order Items (Order ID: {{ $order->id }})</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->product->price }}</td>
                                        <td>{{ $item->quantity * $item->product->price }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>



@endsection
