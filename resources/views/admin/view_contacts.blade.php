<html>
<head>
    <base href="{{ asset('/public') }}">
    @include('admin.css')
    <!-- Add Bootstrap CSS for modal -->
</head>
<body>
<header class="header">
    @include('admin.header')
</header>
<div class="d-flex align-items-stretch">
    @include('admin.sidebar')
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Contacts</h2>
            </div>
        </div>
        <section class="no-padding">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg">
                        <div class="block">
                            <div class="title"><strong>Contacts List</strong></div>
                            <div class="table-responsive">
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Message</th>
                                        <th>Created At</th>
                                        <th>Send Message</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($contacts as $contact)
                                        <tr>
                                            <td>{{ $contact->id }}</td>
                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>{{ $contact->phone }}</td>
                                            <td>{{ $contact->message }}</td>
                                            <td>{{ $contact->created_at }}</td>
                                            <td>
                                                <!-- Button to trigger modal -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sendEmailModal" data-email="{{ $contact->email }}">
                                                    Send
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- Modal Structure -->
<div class="modal fade" id="sendEmailModal" tabindex="-1" role="dialog" aria-labelledby="sendEmailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.send_email') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="sendEmailModalLabel">Send Email</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" readonly>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send Email</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.footer')

<!-- Add Bootstrap JS and jQuery for modal functionality -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script>
    $('#sendEmailModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var email = button.data('email');
        var modal = $(this);
        modal.find('.modal-body #email').val(email);
    });
</script>
</body>
</html>
