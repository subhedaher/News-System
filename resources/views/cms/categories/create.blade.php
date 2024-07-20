@extends('cms.parent')

@section('title', 'Categories')
@section('main-title', 'Categories')
@section('breadcrumb-main', 'Categories')
@section('breadcrumb-sub', 'Create')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter Name">
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" id="slug" placeholder="Enter Slug">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description"
                                        placeholder="Enter Description">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="button" class="btn btn-primary" onclick="addCategory()">Add</button>
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
        function addCategory() {
            axios.post('{{ route('categories.store') }}', {
                name: document.getElementById('name').value,
                slug: document.getElementById('slug').value,
                description: document.getElementById('description').value,
            }).then(function(response) {
                toastr.success(response.data.message);
                document.getElementById('data').reset();
            }).catch(function(error) {
                toastr.error(error.response.data.message);
            });
        }
    </script>
@endsection
