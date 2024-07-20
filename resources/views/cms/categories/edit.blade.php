@extends('cms.parent')

@section('title', 'Categories')
@section('main-title', 'Categories')
@section('breadcrumb', 'Categories')
@section('breadcrumb-sub', 'Edit')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter Name"
                                        value="{{ $category->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" id="slug" placeholder="Enter Slug"
                                        value="{{ $category->slug }}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description"
                                        placeholder="Enter Description" value="{{ $category->description }}">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="button" class="btn btn-primary"
                                    onclick="updateCategory('{{ route('categories.update', $category->slug) }}')">Save</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('scripts')
    <script>
        function updateCategory(route) {
            axios.put(route, {
                name: document.getElementById('name').value,
                slug: document.getElementById('slug').value,
                description: document.getElementById('description').value,
            }).then(function(response) {
                toastr.success(response.data.message);
                window.location.href = '{{ route('categories.index') }}';
            }).catch(function(error) {
                toastr.error(error.response.data.message);
            });
        }
    </script>
@endsection
