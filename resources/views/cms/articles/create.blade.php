@extends('cms.parent')

@section('title', 'Articles')
@section('main-title', 'Articles')
@section('breadcrumb-main', 'Articles')
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
                            <h3 class="card-title">Create Articles</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="custom-select" id="category_id">
                                        <option></option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" placeholder="Enter Title">
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" id="slug" placeholder="Enter Slug">
                                </div>
                                <div class="form-group">
                                    <label for="short_info">Short Info</label>
                                    <input type="text" class="form-control" id="short_info"
                                        placeholder="Enter Short Info">
                                </div>
                                <div class="form-group">
                                    <label for="info">Info</label>
                                    <textarea id="info" class="form-control" placeholder="Enter Info" rows="10"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image">
                                            <label class="custom-file-label">Choose Image</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="button" class="btn btn-primary" onclick="addArticle()">Add</button>
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
    <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });

        function addArticle() {
            let data = new FormData();
            data.append('category_id', document.getElementById('category_id').value);
            data.append('slug', document.getElementById('slug').value);
            data.append('title', document.getElementById('title').value);
            data.append('short_info', document.getElementById('short_info').value);
            data.append('info', document.getElementById('info').value);
            data.append('image', document.getElementById('image').files[0]);
            axios.post('{{ route('articles.store') }}', data)
                .then(function(response) {
                    toastr.success(response.data.message);
                    document.getElementById('data').reset();
                }).catch(function(error) {
                    toastr.error(error.response.data.message);
                });
        }
    </script>
@endsection
