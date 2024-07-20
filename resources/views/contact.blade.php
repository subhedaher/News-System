@extends('parent')

@section('title', 'Contact')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
@endsection

@section('content')
    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">Contact
            <small>Subheading</small>
        </h1>

        @include('components.ol', [
            'lable' => 'Contact',
        ])
        <!-- Content Row -->
        <div class="row">
            <!-- Map Column -->
            <div class="col-lg-8 mb-4">
                <!-- Contact Form -->
                <h3>Send us a Message</h3>
                <form id="data">
                    <div class="control-group form-group">
                        <div class="controls">
                            <label for="full_name">Full Name:</label>
                            <input type="text" class="form-control" id="full_name" placeholder="Please enter your name.">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label for="phone_number">Phone Number:</label>
                            <input type="tel" class="form-control" id="phone_number"
                                placeholder="Please enter your phone number.">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label for="email">Email Address:</label>
                            <input type="email" class="form-control" id="email"
                                placeholder="Please enter your email address.">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label for="message">Message:</label>
                            <textarea rows="10" cols="100" class="form-control" id="message" placeholder="Please enter your message"
                                maxlength="999" style="resize:none"></textarea>
                        </div>
                    </div>
                    <!-- For success/fail messages -->
                    <button type="button" onclick="sendMessage()" class="btn btn-primary">Send
                        Message</button>
                </form>
            </div>
            <!-- Contact Details Column -->
            <div class="col-lg-4 mb-4">
                <h3>Contact Details</h3>
                <p>
                    3481 Melrose Place
                    <br>Beverly Hills, CA 90210
                    <br>
                </p>
                <p>
                    <abbr title="Phone">P</abbr>: (123) 456-7890
                </p>
                <p>
                    <abbr title="Email">E</abbr>:
                    <a href="mailto:name@example.com">name@example.com
                    </a>
                </p>
                <p>
                    <abbr title="Hours">H</abbr>: Monday - Friday: 9:00 AM to 5:00 PM
                </p>
            </div>
        </div>
        <!-- /.row -->

        <!-- /.row -->

    </div>
    <!-- /.container -->
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js"></script>
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
    <script>
        function sendMessage() {
            axios.post('{{ route('message') }}', {
                full_name: document.getElementById('full_name').value,
                phone_number: document.getElementById('phone_number').value,
                email: document.getElementById('email').value,
                message: document.getElementById('message').value,
            }).then(function(response) {
                toastr.success(response.data.message);
                document.getElementById('data').reset();
            }).catch(function(error) {
                toastr.error(error.response.data.message);
            });
        }
    </script>
@endsection
