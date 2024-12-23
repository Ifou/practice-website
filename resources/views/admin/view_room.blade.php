<html>
<head>
    <title>View Room</title>
    @include('admin.css')
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
                <h2 class="h5 no-margin-bottom">View Rooms</h2>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="block">
                        <div class="title"><strong>Rooms List</strong></div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Capacity</th>
                                    <th>WiFi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rooms as $room)
                                    <tr>
                                        <td>{{ $room->room_title }}</td>
                                        <td>{{ $room->room_description }}</td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#imageModal" data-image="{{ asset('images/' . $room->room_image) }}">
                                                <img src="{{ asset('images/' . $room->room_image) }}" alt="{{ $room->room_title }}" width="100">
                                            </a>
                                        </td>
                                        <td>{{ $room->room_price }}</td>
                                        <td>{{ $room->room_type }}</td>
                                        <td>{{ $room->room_status }}</td>
                                        <td>{{ $room->room_capacity }}</td>
                                        <td>{{ $room->room_wifi }}</td>
                                        <td>
                                            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this room?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{ $room->id }}">Delete</button>
                                            </form>
                                            <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-primary">Edit</a>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination">
                            {{ $rooms->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('admin.footer')
</body>

<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Room Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="modalImage" src="" alt="Room Image" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this room?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Success Confirmation Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Room deleted successfully.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#imageModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var imageSrc = button.data('image');
        var modal = $(this);
        modal.find('#modalImage').attr('src', imageSrc);
    });

    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var roomId = button.data('id');
        var modal = $(this);
        modal.find('#confirmDelete').data('id', roomId);
    });

    $('#confirmDelete').on('click', function () {
        var roomId = $(this).data('id');
        var form = $('<form>', {
            'method': 'POST',
            'action': '/rooms/' + roomId
        });
        var token = $('<input>', {
            'type': 'hidden',
            'name': '_token',
            'value': '{{ csrf_token() }}'
        });
        var hiddenInput = $('<input>', {
            'type': 'hidden',
            'name': '_method',
            'value': 'DELETE'
        });
        form.append(token, hiddenInput).appendTo('body').submit();
    });

    @if(session('success'))
    $(document).ready(function() {
        $('#successModal').modal('show');
    });
    @endif
</script>

</html>

