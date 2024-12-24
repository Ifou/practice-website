<!DOCTYPE html>
<html lang="en">
<body>
@include('hotel.header')
<br>
<br>
<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage">
                    <h2>Book Now</h2>
                    <br>
                </div>
            </div>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('book.store') }}" method="POST" onsubmit="return validateForm()">
                    @csrf
                    <div class="form-group">
                        <label for="room_id">Room Type</label>
                        <select class="form-control" id="room_id" name="room_id" required onchange="previewRoom()">
                            <option value="" disabled selected>Select a room</option>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}" data-title="{{ $room->room_title }}" data-description="{{ $room->room_description }}" data-image="{{ asset('images/' . $room->room_image) }}" data-price="{{ $room->room_price }}" data-type="{{ $room->room_type }}" data-status="{{ $room->room_status }}" data-capacity="{{ $room->room_capacity }}" data-wifi="{{ $room->room_wifi }}">{{ $room->room_title }} - {{ $room->room_type }}</option>
                            @endforeach
                        </select>
                        <div id="roomError" style="color: red; display: none;">Please select a room.</div>
                    </div>
                    <div id="roomPreview" style="display: none;">
                        <h3 id="previewTitle"></h3>
                        <img id="previewImage" src="" alt="Room Image" class="img-fluid mb-3">
                        <p id="previewDescription"></p>
                        <p><strong>Price:</strong> <span id="previewPrice"></span></p>
                        <p><strong>Type:</strong> <span id="previewType"></span></p>
                        <p><strong>Status:</strong> <span id="previewStatus"></span></p>
                        <p><strong>Capacity:</strong> <span id="previewCapacity"></span></p>
                        <p><strong>WiFi:</strong> <span id="previewWifi"></span></p>
                    </div>
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" required>
                    </div>
                    <div class="form-group">
                        <label for="number">Number</label>
                        <input type="text" class="form-control" id="number" name="number" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Book Now</button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('hotel.footer')

<script>
    function previewRoom() {
        var selectedRoom = document.getElementById('room_id').selectedOptions[0];
        var roomTitle = selectedRoom.getAttribute('data-title');
        var roomDescription = selectedRoom.getAttribute('data-description');
        var roomImage = selectedRoom.getAttribute('data-image');
        var roomPrice = selectedRoom.getAttribute('data-price');
        var roomType = selectedRoom.getAttribute('data-type');
        var roomStatus = selectedRoom.getAttribute('data-status');
        var roomCapacity = selectedRoom.getAttribute('data-capacity');
        var roomWifi = selectedRoom.getAttribute('data-wifi');

        document.getElementById('previewTitle').innerText = roomTitle;
        document.getElementById('previewDescription').innerText = roomDescription;
        document.getElementById('previewImage').src = roomImage;
        document.getElementById('previewPrice').innerText = roomPrice;
        document.getElementById('previewType').innerText = roomType;
        document.getElementById('previewStatus').innerText = roomStatus;
        document.getElementById('previewCapacity').innerText = roomCapacity;
        document.getElementById('previewWifi').innerText = roomWifi;

        document.getElementById('roomPreview').style.display = 'block';
    }

    function validateForm() {
        var roomSelect = document.getElementById('room_id');
        var roomError = document.getElementById('roomError');
        if (roomSelect.value === "") {
            roomError.style.display = 'block';
            return false;
        } else {
            roomError.style.display = 'none';
            return true;
        }
    }
</script>
</body>
</html>
