@extends('mitra.layout')

@section('content')
    <div class="row m-4">
        <div class="card p-3">
            <h2 class="m-3">List Workshops</h2>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addWorkshopModal">
                Tambah Workshop
            </button>

            <!-- Modal -->
            <div class="modal fade" id="addWorkshopModal" tabindex="-1" aria-labelledby="addWorkshopModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addWorkshopModalLabel">Tambah Workshop</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('mitraWorkshops.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="start_time" class="form-label">Start Time</label>
                                    <input type="datetime-local" class="form-control" id="start_time" name="start_time">
                                </div>
                                <div class="mb-3">
                                    <label for="end_time" class="form-label">End Time</label>
                                    <input type="datetime-local" class="form-control" id="end_time" name="end_time">
                                </div>
                                <div class="mb-3">
                                    <label for="capacity" class="form-label">Capacity</label>
                                    <input type="number" class="form-control" id="capacity" name="capacity">
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-striped table-hover" id="workshops-table">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Capacity</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($workshops as $workshop)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $workshop->title }}</td>
                        <td>{{ $workshop->description }}</td>
                        <td>{{ $workshop->start_time }}</td>
                        <td>{{ $workshop->end_time }}</td>
                        <td>{{ $workshop->capacity }}</td>
                        <td><img src="{{ asset('workshop_images/'.$workshop->image) }}" alt="{{ $workshop->title }}" height="100"></td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#participant-modal-{{ $workshop->id }}">
                                Lihat Peserta
                            </button>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editWorkshopModal{{$workshop->id}}">
                                Edit
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $workshop->id }}">
                                Delete
                            </button>                        </td>
                    </tr>

                    <!-- Modal Edit Workshop -->
                    <div class="modal fade" id="editWorkshopModal{{$workshop->id}}" tabindex="-1" aria-labelledby="editWorkshopModal{{$workshop->id}}Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editWorkshopModal{{$workshop->id}}Label">Edit Workshop</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('workshops.update', $workshop->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" value="{{$workshop->title}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="3" required>{{$workshop->description}}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="start_time" class="form-label">Start Time</label>
                                            <input type="datetime-local" class="form-control" id="start_time" name="start_time" value="{{date('Y-m-d\TH:i', strtotime($workshop->start_time))}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="end_time" class="form-label">End Time</label>
                                            <input type="datetime-local" class="form-control" id="end_time" name="end_time" value="{{date('Y-m-d\TH:i', strtotime($workshop->end_time))}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="capacity" class="form-label">Capacity</label>
                                            <input type="number" class="form-control" id="capacity" name="capacity" value="{{$workshop->capacity}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                            @if($workshop->image)
                                                <img src="{{asset('workshop_images/'.$workshop->image)}}" alt="{{$workshop->title}}" class="img-thumbnail mt-2" width="200px">
                                            @endif
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



                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $workshop->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $workshop->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $workshop->id }}">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this workshop?
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('workshops.