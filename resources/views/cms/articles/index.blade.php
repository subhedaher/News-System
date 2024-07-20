@extends('cms.parent')

@section('title', 'Articles')
@section('main-title', 'Articles')
@section('breadcrumb-main', 'Articles')
@section('breadcrumb-sub', 'Read')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Read Articles</h3>
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
                                        <th>Writer</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Views</th>
                                        <th>Date Publish</th>
                                        <th>Settings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($articles as $article)
                                        <tr>
                                            <td>{{ ++$loop->index }}</td>
                                            <td>{{ $article->title }}</td>
                                            <td>{{ $article->slug }}</td>
                                            <td><img src="{{ Storage::url($article->image) }}" width="60"
                                                    alt="article image"></td>
                                            @if (auth('admin'))
                                                <td>{{ $article->writer->full_name }}</td>
                                            @endif
                                            <td>{{ $article->category->name }}</td>
                                            <td>{{ $article->status }}</td>
                                            <td>{{ $article->views }}</td>
                                            <td>{{ $article->date_publish ?? '-' }}</td>

                                            <td>
                                                <div class="btn-group">
                                                    <a type="button" href="{{ route('articles.show', $article->slug) }}"
                                                        class="btn btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @if (session('guard') == 'writer')
                                                        <a type="button"
                                                            href="{{ route('articles.edit', $article->slug) }}"
                                                            class="btn btn-primary">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endif
                                                    <button type="button"
                                                        onclick="deleteCategory('{{ route('articles.destroy', $article) }}' , this)"
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
                            <a href="{{ route('articles.trash') }}" class="btn btn-primary">Trash</a>
                            {{ $articles->links() }}
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
        function deleteCategory(route, ref) {
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
