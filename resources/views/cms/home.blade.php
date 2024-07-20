@extends('cms.parent')

@section('title', 'Home')
@section('main-title', 'Home')
@section('breadcrumb-main', 'Home')
@section('breadcrumb-sub', 'Home')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                @if (session('guard') === 'admin')
                    @include('cms.components.statistics', [
                        'color' => 'info',
                        'counts' => $countAdmins,
                        'label' => 'Admins',
                        'route' => route('admins.index'),
                    ])
                    @include('cms.components.statistics', [
                        'color' => 'info',
                        'counts' => $countWriters,
                        'label' => 'Writers',
                        'route' => route('writers.index'),
                    ])
                @endif
                @include('cms.components.statistics', [
                    'color' => 'success',
                    'counts' => $countCategories,
                    'label' => 'Categories',
                    'route' => route('categories.index'),
                ])
                @if (session('guard') === 'admin')
                    @include('cms.components.statistics', [
                        'color' => 'success',
                        'counts' => $countArticles,
                        'label' => 'Approved Articles',
                        'route' => route('articles.index'),
                    ])
                    @include('cms.components.statistics', [
                        'color' => 'success',
                        'counts' => $totalArticles,
                        'label' => 'Total Articles',
                        'route' => route('articles.index'),
                    ])
                @endif
                @if (session('guard') == 'writer')
                    @include('cms.components.statistics', [
                        'color' => 'success',
                        'counts' => $countArticlesWriter,
                        'label' => 'Approved Articles',
                        'route' => route('articles.index'),
                    ])
                @endif
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection
