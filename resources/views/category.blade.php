@extends('parent')

@section('title', 'Category')

@section('content')
    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">Category:
            <small>{{ $last4news[0]->category->name }}</small>
        </h1>

        @include('components.ol', [
            'lable' => 'Category',
        ])

        @foreach ($last4news as $last4new)
            <!-- news title One -->
            <div class="row">
                <div class="col-md-7">
                    <a href="{{ route('articles', $last4new->slug) }}">
                        <img class="img-fluid full-width h-200 rounded mb-3 mb-md-0"
                            src="{{ Storage::url($last4new->image) }}" alt="article image">
                    </a>
                </div>
                <div class="col-md-5">
                    <h3>{{ $last4new->title }}</h3>
                    <p>{{ $last4new->short_info }}</p>
                    <a class="btn btn-primary" href="{{ route('articles', $last4new->slug) }}">View news title
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
            <!-- /.row -->
            <hr>
        @endforeach

        {{ $last4news->links() }}

    </div>
    <!-- /.container -->
@endsection
