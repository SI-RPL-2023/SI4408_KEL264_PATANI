@extends('layouts.app2')

@section('content')
     <div class="section  p-5">
          <div class="card m-5 p-5">
               <h5 class="title">Review</h5>
          <form action="{{ route('add.review')}}" method="POST">
               @csrf
               <div class="mb-3">
                    <textarea class="form-control" style="background-color:#F9F5F6;" id="review" name="review" rows="3"></textarea>
               </div>
               <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"><a href="{{ route('order.list') }}" style="color: white">Close</a></button>
                    <button type="submit" class="btn btn-primary">Add Review</button>
               </div>
          </form>
          </div>
     </div>
@endsection
