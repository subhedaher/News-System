@extends('cms.parent')

@section('title', 'Article')
@section('main-title', 'Article Info')
@section('breadcrumb-main', 'Article')
@section('breadcrumb-sub', 'Read')

@section('content')
    <section class="content ml-2">
        <div class="container-fluid">
            <div class="row">
                <!-- Post Content Column -->
                <div class="col-lg-7">
                    <!-- Preview Image -->
                    <img width="800" class="img-fluid rounded" src="{{ Storage::url($article->image) }}" alt="image">
                    <hr>
                    <!-- Post Content -->
                    <p>{{ $article->short_info }}</p>
                    <hr>
                    <p>{{ $article->info }}</p>
                    <hr>
                </div>

                <!-- Sidebar Widgets Column -->
                <div class="col-md-5">
                    <!-- Side Widget -->
                    <div class="card">
                        <h5 class="card-header">Info</h5>
                        <div class="card-body">
                            <p>Title: <strong>{{ $article->title }}</strong></p>
                            <hr>
                            <p>Slug: <strong>{{ $article->slug }}</strong></p>
                            <hr>
                            <p>Category: <strong>{{ $article->category->name }}</strong></p>
                            <hr>
                            <p>Status: <strong>{{ $article->status }}</strong></p>
                            <hr>
                            <p>Notes: <strong>{{ $notes }}</strong></p>
                            <hr>
                            <p>Date Publish: <strong>{{ $article->data_publish ?? '-' }}</strong></p>
                            <hr>
                            <p>Views: <strong>{{ $article->views }}</strong></p>


                        </div>
                    </div>
                </div>
                @if ($article->status === 'wating' && session('guard') === 'admin')
                    <div class="mb-2">
                        <button type="button" onclick="approved('{{ route('approved', $article) }}')"
                            class="btn btn-primary m-1">Approved</button>
                        <button type="button" onclick="showNotesRejected()" class="btn btn-warning m-1">Rejected</button>
                        <button type="button" onclick="showNotesHardRejected()" class="btn btn-danger m-1">Hard
                            Rejected</button>
                    </div>
                @endif


            </div>
            @if ($article->status === 'wating' && session('guard') === 'admin')
                <div class="mb-2 col-7">
                    <div class="form-group d-none" id="rejected">
                        <form>
                            <label>Notes Rejected</label>
                            <textarea class="form-control mb-2" id="rejectednotes" rows="3" placeholder="Enter ..."></textarea>
                            <button type="button" onclick="rejected('{{ route('rejected', $article->slug) }}')"
                                class="btn btn-primary">Send</button>
                        </form>
                    </div>

                    <div class="form-group d-none" id="hardrejected">
                        <form>
                            <label>Notes Hard Rejected</label>
                            <textarea class="form-control mb-2" id="hardRejectednotes" name="hardrejectednotes" rows="3"
                                placeholder="Enter ..."></textarea>
                            <button type="button" onclick="hardRejected('{{ route('hardRejected', $article->slug) }}')"
                                class="btn btn-primary">Send</button>
                        </form>
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection
@section('scripts')

    <script>
        function approved(route) {
            axios.put(route)
                .then(function(response) {
                    toastr.success(response.data.message);
                    window.location.href = '{{ route('articles.index') }}';
                }).catch(function(error) {
                    toastr.error(error.response.data.message);
                });
        }

        function rejected(route) {
            axios.put(route, {
                    rejectednotes: document.getElementById('rejectednotes').value
                })
                .then(function(response) {
                    toastr.success(response.data.message);
                    window.location.href = '{{ route('articles.index') }}';
                }).catch(function(error) {
                    toastr.error(error.response.data.message);
                });
        }

        function hardRejected(route) {
            axios.put(route, {
                    hardRejectednotes: document.getElementById('hardRejectednotes').value
                })
                .then(function(response) {
                    toastr.success(response.data.message);
                    window.location.href = '{{ route('articles.index') }}';
                }).catch(function(error) {
                    toastr.error(error.response.data.message);
                });
        }

        function showNotesRejected() {
            let rejected = document.getElementById('rejected');
            let hardrejected = document.getElementById('hardrejected');
            rejected.classList.add('d-block');
            hardrejected.classList.remove('d-block');
        }

        function showNotesHardRejected() {
            let rejected = document.getElementById('rejected');
            let hardrejected = document.getElementById('hardrejected');
            hardrejected.classList.add('d-block');
            rejected.classList.remove('d-block');
        }
    </script>

@endsection
