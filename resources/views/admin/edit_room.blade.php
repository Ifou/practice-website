<html>
<head>
    @include('admin.css')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
                <h2 class="h5 no-margin-bottom">Edit Room</h2>
            </div>
        </div>
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="room_title">Room Title</label>
                    <input type="text" class="form-control" id="room_title" name="room_title" value="{{ $room->room_title }}" required>
                    <div class="invalid-feedback">
                        Please provide a room title.
                    </div>
                </div>
                <div class="form-group">
                    <label for="room_description">Room Description</label>
                    <textarea class="form-control" id="room_description" name="room_description" rows="3" required>{{ $room->room_description }}</textarea>
                    <div class="invalid-feedback">
                        Please provide a room description.
                    </div>
                </div>
                <div class="form-group">
                    <label for="room_image">Room Image</label>
                    <input type="file" class="form-control-file" id="room_image" name="room_image" accept=".jpg,.jpeg,.png" onchange="previewImage(event)">
                    <div class="invalid-feedback">
                        Please upload a room image.
                    </div>
                    <div class="mt-3">
                        <img id="image_preview" src="{{ asset('images/' . $room->room_image) }}" alt="Image Preview" class="img-fluid" style="display: block;">
                    </div>
                </div>
                <div class="form-group">
                    <label for="room_price">Room Price</label>
                    <input type="text" class="form-control" id="room_price" name="room_price" value="{{ $room->room_price }}" required>
                    <div class="invalid-feedback">
                        Please provide a room price.
                    </div>
                </div>
                <div class="form-group">
                    <label for="room_type">Room Type</label>
                    <select class="form-control" id="room_type" name="room_type" required>
                        <option value="" disabled>Select Room Type</option>
                        <option value="Presidential Suite" {{ $room->room_type == 'Presidential Suite' ? 'selected' : '' }}>Presidential Suite</option>
                        <option value="Executive Suite" {{ $room->room_type == 'Executive Suite' ? 'selected' : '' }}>Executive Suite</option>
                        <option value="Junior Suite" {{ $room->room_type == 'Junior Suite' ? 'selected' : '' }}>Junior Suite</option>
                        <option value="Deluxe Room" {{ $room->room_type == 'Deluxe Room' ? 'selected' : '' }}>Deluxe Room</option>
                        <option value="Standard Room" {{ $room->room_type == 'Standard Room' ? 'selected' : '' }}>Standard Room</option>
                    </select>
                    <div class="invalid-feedback">
                        Please select a room type.
                    </div>
                </div>
                <div class="form-group">
                    <label for="room_status">Room Status</label>
                    <input type="text" class="form-control" id="room_status" name="room_status" value="{{ $room->room_status }}" required>
                    <div class="invalid-feedback">
                        Please provide a room status.
                    </div>
                </div>
                <div class="form-group">
                    <label for="room_capacity">Room Capacity</label>
                    <input type="text" class="form-control" id="room_capacity" name="room_capacity" value="{{ $room->room_capacity }}" required>
                    <div class="invalid-feedback">
                        Please provide a room capacity.
                    </div>
                </div>
                <div class="form-group">
                    <label for="room_wifi">Room Wifi</label>
                    <input type="text" class="form-control" id="room_wifi" name="room_wifi" value="{{ $room->room_wifi }}" required>
                    <div class="invalid-feedback">
                        Please provide room wifi details.
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update Room</button>
            </form>
        </div>
    </div>
    @include('admin.footer')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('image_preview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</div>
</body>
</html>
