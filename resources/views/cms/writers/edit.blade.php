@extends('cms.parent')

@section('title', 'Writers')
@section('main-title', 'Writers')
@section('breadcrumb-main', 'Writers')
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
                            <h3 class="card-title">Edit Writer</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="custom-select" id="role_id">
                                        <option></option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" @selected($role->id == $currentRole->id)>
                                                {{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="button" class="btn btn-primary"
                                    onclick="updateWriter('{{ route('writers.update', $writer) }}')">Save</button>
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
        function updateWriter(route) {
            axios.put(route, {
                role_id: document.getElementById('role_id').value,
            }).then(function(response) {
                toastr.success(response.data.message);
                window.location.href = '{{ route('writers.index') }}';
            }).catch(function(error) {
                toastr.error(error.response.data.message);
            });
        }
    </script>
@endsection
