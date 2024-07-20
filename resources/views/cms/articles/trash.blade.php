@extends('cms.parent')

@section('title', 'Articles')
@section('main-title', 'Articles')
@section('breadcrumb-main', 'Articles')
@section('breadcrumb-sub', 'Read Trash')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Read Trash Articles</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Image</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Views</th>
                                        <th>Date Publish</th>
                                        <th>Settings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trashArticles as $trashArticle)
                                        <tr>
                                            <td>{{ ++$loop->index }}</td>
                                            <td>{{ $trashArticle->title }}</td>
                                            <td>{{ $trashArticle->slug }}</td>
                                            <td><img src="{{ Storage::url($trashArticle->image) }}" width="60"
                                                    alt="article image"></td>
                                            <td>{{ $trashArticle->category->name }}</td>
                                            <td>{{ $trashArticle->status }}</td>
                                            <td>{{ $trashArticle->views }}</td>
                                            <td>{{ $trashArticle->date_publish ?? '-' }}</td>

                                            <td>
                                                <div class="btn-group">
                                                    <button type="button"
                                                        onclick="restore('{{ route('articles.restore', $trashArticle->id) }}' , this)"
                                                        class="btn btn-primary">
                                                        <i class="fas fa-trash-restore"></i>
                                                    </button>
                                                    <button type="button"
                                                        onclick="forceDelete('{{ route('articles.forceDelete', $trashArticle->id) }}', this)"
                                                        class="btn btn-danger">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                <li class="page-item"><a class="page-link" href="#">«</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">»</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('scripts')
    <script>
        function restore(route, ref) {
            axios.put(route)
                .then(function(response) {
                    toastr.success(response.data.message);
                    ref.closest('tr').remove();
                })
                .catch(function(error) {
                    toastr.error(error.response.data.message);
                });
        }

        function forceDelete(route, ref) {
            axios.delete(route)
                .then(function(response) {
                    toastr.success(response.data.message);
                    ref.closest('tr').remove();
                })
                .catch(function(error) {
                    toastr.error(error.response.data.message);
                });
        }
    </script>
@endsection
