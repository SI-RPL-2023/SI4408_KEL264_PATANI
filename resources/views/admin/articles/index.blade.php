@extends('admin.layout')

@section('content')
    <div class="row m-4">
        <div class="card p-3">
            <h2 class="m-3">List Article</h2>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addArticleModal">
                Add Article
            </button>


            <!-- Modal -->
            <div class="modal fade" id="addArticleModal" tabindex="-1" aria-labelledby="addArticleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="addArticleModalLabel">Add Article</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                                <div class="mb-3">
                                    <label for="content" class="form-label">Content</label>
                                    <textarea class="form-control ckeditor" id="content" name="content" rows="10" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
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
                <div class="">
            <table id="articles-table" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Image</th>
                    <th>Pembuat</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $article->title }}</td>
                        <td style="max-height: 2.5em;overflow: hidden;text-overflow: ellipsis;white-space: nowrap">{{ $article->content }}</td>
                        <td><img src="{{ asset('images/' . $article->image) }}" alt="{{ $article->title }}" height="50"></td>

                        <td>{{$article->user->name}}</td>

                        <td>
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editArticleModal{{ $article->id }}">
                                Edit
                            </button>
                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this article?')">Delete</button>
                            </form>
                        </td>
                    </tr>




                         @endforeach

                @foreach($articles as $article)
                    <!-- Modal Edit Artikel-->
                    <div class="modal fade" id="editArticleModal{{$article->id}}" tabindex="-1" aria-labelledby="editArticleModalLabel{{$article->id}}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editArticleModalLabel{{$article->id}}">Edit Artikel</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="editTitle" class="form-label">Judul Artikel</label>
                                            <input type="text" class="form-control" id="editTitle" name="title" value="{{ $article->title }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="editContent" class="form-label">Konten Artikel</label>
                                            <textarea class="form-control ckeditor" id="editContent" name="content">{{ $article->content }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editImage" class="form-label">Gambar Artikel</label>
                                            <input type="file" class="form-control" id="editImage" name="image">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

                </tbody>
            </table>
                </div>
        </div>
    </div>



@endsection

@push('script')
    <script>
        // let table = new DataTable('#articles-table', {
        //     // options
        // });
        $('#articles-table').DataTable( {
            columnDefs: [ {
                targets: 2,
                render: function ( data, type, row ) {
                    return data.substr( 0, 70);

                }
            } ]
        } );

    </script>

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'content');
    </script>

    @foreach($articles as $article)
        <script>
            CKEDITOR.replace( 'content{{$article->id}}');
        </script>
    @endforeach
@endpush
