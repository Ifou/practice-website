<html>
<head>
    @include('admin.css')
    <!-- Add Bootstrap CSS -->
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
                <h2 class="h5 no-margin-bottom">Add Room</h2>
            </div>
        </div>
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                <div class="form-group">
                    <label for="room_title">Room Title</label>
                    <input type="text" class="form-control" id="room_title" name="room_title" required>
                    <div class="invalid-feedback">
                        Please provide a room title.
                    </div>
                </div>
                <div class="form-group">
                    <label for="room_description">Room Description</label>
                    <textarea class="form-control" id="room_description" name="room_description" rows="3" required></textarea>
                    <div class="invalid-feedback">
                        Please provide a room description.
                    </div>
                </div>
                <div class="form-group">
                    <label for="room_image">Room Image</label>
                    <input type="file" class="form-control-file" id="room_image" name="room_image" accept=".jpg,.jpeg,.png" required onchange="previewImage(event)">
                    <div class="invalid-feedback">
                        Please upload a room image.
                    </div>
                    <div class="mt-3">
                        <img id="image_preview" src="#" alt="Image Preview" class="img-fluid" style="display: none;">
                    </div>
                </div>
                <div class="form-group">
                    <label for="room_price">Room Price</label>
                    <input type="text" class="form-control" id="room_price" name="room_price" required>
                    <div class="invalid-feedback">
                        Please provide a room price.
                    </div>
                </div>
                <div class="form-group">
                    <label for="room_type">Room Type</label>
                    <select class="form-control" id="room_type" name="room_type" required>
                        <option value="" disabled selected>Select Room Type</option>
                        <option value="Presidential Suite">Presidential Suite</option>
                        <option value="Executive Suite">Executive Suite</option>
                        <option value="Junior Suite">Junior Suite</option>
                        <option value="Deluxe Room">Deluxe Room</option>
                        <option value="Standard Room">Standard Room</option>
                    </select>
                    <div class="invalid-feedback">
                        Please select a room type.
                    </div>
                </div>
                <div class="form-group">
                    <label for="room_status">Room Status</label>
                    <input type="text" class="form-control" id="room_status" name="room_status" required>
                    <div class="invalid-feedback">
                        Please provide a room status.
                    </div>
                </div>
                <div class="form-group">
                    <label for="room_capacity">Room Capacity</label>
                    <input type="text" class="form-control" id="room_capacity" name="room_capacity" required>
                    <div class="invalid-feedback">
                        Please provide a room capacity.
                    </div>
                </div>
                <div class="form-group">
                    <label for="room_wifi">Room Wifi</label>
                    <input type="text" class="form-control" id="room_wifi" name="room_wifi" required>
                    <div class="invalid-feedback">
                        Please provide room wifi details.
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Add Room</button>
            </form>
        </div>
    </div>
    @include('admin.footer')
    <!-- Add Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        // Function to preview image after picking a picture
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
