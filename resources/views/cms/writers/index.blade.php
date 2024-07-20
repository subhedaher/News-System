@extends('cms.parent')

@section('title', 'Writers')
@section('main-title', 'Writers')
@section('breadcrumb', 'Writers')
@section('breadcrumb-sub', 'Read')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Read Writers</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Full Name</th>
                                        <th>Role</th>
                                        <th>Bio</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                        <th>Admin</th>
                                        <th>Settings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($writers as $writer)
                                        <tr>
                                            <td>{{ ++$loop->index }}</td>
                                            <td>{{ $writer->full_name }}</td>
                                            <td>{{ $writer->roles[0]->name }}</td>
                                            <td>{{ $writer->bio }}</td>
                                            <td>{{ $writer->phone_number }}</td>
                                            <td>{{ $writer->address }}</td>
                                            <td>{{ $writer->admin->full_name }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a type="button" href="{{ route('writers.edit', $writer) }}"
                                                        class="btn btn-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button"
                                                        onclick="deleteWriter('{{ route('writers.destroy', $writer) }}' , this)"
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
                            {{ $writers->links() }}
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
        function deleteWriter(route, ref) {
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
