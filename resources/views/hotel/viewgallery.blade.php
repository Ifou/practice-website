<!DOCTYPE html>
<html lang="en">
<body>
@include('hotel.header')
<!-- gallery -->
<div class="gallery">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage">
                    <h2>gallery</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($rooms->take(6) as $room)
                <div class="col-md-4 col-sm-6">
                    <div class="room room-hover" id="room-{{ $room->id }}">
                        <div class="room_img">
                            <figure><img src="{{ asset('images/' . $room->room_image) }}" alt="{{ $room->room_title }}" style="width: 400px; height: 200px;"/></figure>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- end gallery -->
@include('hotel.footer')
</body>

<!-- Room Modal -->
<div class="modal fade" id="roomModal" tabindex="-1" role="dialog" aria-labelledby="roomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="roomModalLabel">Room Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #000000">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="roomImage" src="" alt="Room Image" class="img-fluid mb-3">
                <h3 id="roomTitle"></h3>
                <p id="roomDescription"></p>
                <p><strong>Price:</strong> <span id="roomPrice"></span></p>
                <p><strong>Type:</strong> <span id="roomType"></span></p>
                <p><strong>Status:</strong> <span id="roomStatus"></span></p>
                <p><strong>Capacity:</strong> <span id="roomCapacity"></span></p>
                <p><strong>WiFi:</strong> <span id="roomWifi"></span></p>
            </div>
        </div>
    </div>
</div>

<script>
    $('#roomModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var roomId = button.data('id');
        var roomTitle = button.data('title');
        var roomDescription = button.data('description');
        var roomImage = button.data('image');
        var roomPrice = button.data('price');
        var roomType = button.data('type');
        var roomStatus = button.data('status');
        var roomCapacity = button.data('capacity');
        var roomWifi = button.data('wifi');

        var modal = $(this);
        modal.find('#roomModalLabel').text(roomTitle);
        modal.find('#roomTitle').text(roomTitle);
        modal.find('#roomDescription').text(roomDescription);
        modal.find('#roomImage').attr('src', roomImage);
        modal.find('#roomPrice').text(roomPrice);
        modal.find('#roomType').text(roomType);
        modal.find('#roomStatus').text(roomStatus);
        modal.find('#roomCapacity').text(roomCapacity);
        modal.find('#roomWifi').text(roomWifi);
    });
</script>

</html>

