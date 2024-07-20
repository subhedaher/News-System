@extends('parent')

@section('title', 'Article')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
@endsection

@section('content')
    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">{{ $article->title }}</h1>

        @include('components.ol', [
            'lable' => 'Article',
        ])

        <div class="row">

            <!-- Post Content Column -->
            <div class="col-lg-8">
                <!-- Preview Image -->
                <img class="img-fluid rounded" src="{{ Storage::url($article->image) }}" alt="image Article">
                <hr>
                <!-- Post Content -->
                <p class="lead">{{ $article->short_info }}</p>
                <hr>
                <p>{{ $article->info }}</p>
                <hr>
                <!-- Comments Form -->
                <div class="card my-4">
                    <h5 class="card-header">Leave a Comment:</h5>
                    <div class="card-body">
                        <form id="data">
                            <div class="form-group">
                                <label for="full_name">Full Name</label>
                                <input type="text" id="full_name" class="form-control"></input>
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea class="form-control" id="content" rows="3"></textarea>
                            </div>
                            <button type="button" onclick="comment('{{ route('comment', $article->id) }}')"
                                class="btn btn-primary">Send</button>
                        </form>
                    </div>
                </div>

                @foreach ($comments as $comment)
                    <div class="callout callout-info">
                        <h5>{{ $comment->full_name }}</h5>
                        <p>{{ $comment->content }}</p>
                    </div>
                @endforeach


            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4 mb-4">

                <div class="card">
                    <h5 class="card-header">Info</h5>
                    <div class="card-body">
                        <p>Category: <strong>{{ $article->category->name }}</strong></p>
                        <hr>
                        <p>Writer: <strong>{{ $article->writer->full_name }}</strong></p>
                        <hr>
                        <p>Date Publish: <strong>{{ $article->date_publish }}</strong></p>
                        <hr>
                        <p>Views: <strong>{{ $article->views }}</strong></p>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js"></script>
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
    <script>
        function comment(route) {
            axios.post(route, {
                full_name: document.getElementById('full_name').value,
                content: document.getElementById('content').value,
                article_id: '{{ $article->id }}',
            }).then(function(response) {
                toastr.success(response.data.message);
                document.getElementById('data').reset();
            }).catch(function(error) {
                toastr.error(error.response.data.message);
            });
        }
    </script>
@endsection
