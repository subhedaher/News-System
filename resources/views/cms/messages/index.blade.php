@extends('cms.parent')

@section('title', 'Messages')
@section('main-title' . 'Read Messages')
@section('breadcrumb-main', 'Messages')
@section('breadcrumb-sub', 'Read')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Read Messages</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Full Name</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th>Settings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($messages as $message)
                                        <tr>
                                            <td>{{ ++$loop->index }}</td>
                                            <td>{{ $message->full_name }}</td>
                                            <td>{{ $message->phone_number }}</td>
                                            <td>{{ $message->email }}</td>
                                            <td>{{ $message->message }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button"
                                                        onclick="deleteMessage('{{ route('message.delete', $message->id) }}' , this)"
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
    <script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js"></script>
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
    <script>
        function deleteMessage(route, ref) {
            axios.delete(route)
                .then(function(response) {
                    toastr.success(response.data.message);
                    ref.closest('tr').remove();
                }).catch(function(error) {
                    toastr.error(error.response.data.message);
                });
        }
    </script>
@endsection
