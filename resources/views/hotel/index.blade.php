<!DOCTYPE html>
<html lang="en">
<body>
    @include('hotel.header')
    <!-- banner -->
    <section class="banner_main">
        <div id="myCarousel" class="carousel slide banner" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="first-slide" src="{{ asset('images/banner1.jpg') }}" alt="Banner image 1">
                    <div class="container">
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="second-slide" src="{{ asset('images/banner2.jpg') }}" alt="Banner image 2">
                </div>
                <div class="carousel-item">
                    <img class="third-slide" src="{{ asset('images/banner3.jpg') }}" alt="Banner image 3">
                </div>
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="booking_ocline">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="book_room">
                            <h1>Book a Room Online</h1>
                            <form class="book_now" action="{{ route('book') }}" method="GET">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="book_btn" type="submit">Book Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end banner -->
    <!-- about -->
    <div class="about">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="titlepage">
                        <h2 id="about-us">About Us</h2>

                        <p>The passage gained popularity in the 1960s when Letraset included it in their design templates, becoming a staple of web design templates worldwide.</p>
                        <a class="read_more" href="Javascript:void(0)"> Read More</a>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="about_img">
                        <figure><img src="images/about.png" alt="#"/></figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end about -->
    <!-- our_room -->
    <!-- our_room -->
    <div class="our_room">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Our Rooms</h2>
                        <p>Pick Your Poison! </p>
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
                            <div class="bed_room">
                                <h3>{{ $room->room_title }}</h3>
                                <p>{{ $room->room_description }}</p>
                                <br>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#roomModal"
                                        data-id="{{ $room->id }}"
                                        data-title="{{ $room->room_title }}"
                                        data-description="{{ $room->room_description }}"
                                        data-image="{{ asset('images/' . $room->room_image) }}"
                                        data-price="{{ $room->room_price }}"
                                        data-type="{{ $room->room_type }}"
                                        data-status="{{ $room->room_status }}"
                                        data-capacity="{{ $room->room_capacity }}"
                                        data-wifi="{{ $room->room_wifi }}">
                                    View Room
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- our_room -->

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

    <!-- blog -->
    <div class="blog">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Blog</h2>
                        <p>Lorem Ipsum available, but the majority have suffered </p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($rooms->take(6) as $room)
                    <div class="col-md-4">
                        <div class="blog_box">
                            <div class="blog_img">
                                <figure><img src="{{ asset('images/' . $room->room_image) }}" alt="{{ $room->room_title }}" style="width: 400px; height: 200px;"/></figure>
                            </div>
                            <div class="blog_room">
                                <h3>{{ $room->room_title }}</h3>
                                <span>{{ $room->room_type }}</span>
                                <p>{{ $room->room_description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end blog -->
        <!--  contact -->
        <div class="contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="titlepage">
                            <h2>Contact Us</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <form id="request" class="main_form" action="{{ route('contacts.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <input class="contactus" placeholder="Name" type="text" name="name" required>
                                </div>
                                <div class="col-md-12">
                                    <input class="contactus" placeholder="Email" type="email" name="email" required>
                                </div>
                                <div class="col-md-12">
                                    <input class="contactus" placeholder="Phone Number" type="tel" name="phone" required>
                                </div>
                                <div class="col-md-12">
                                    <textarea class="textarea" placeholder="Message" name="message" required></textarea>
                                </div>
                                <div class="col-md-12">
                                    <button class="send_btn" type="submit">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="map_main" aria-label="Google Map showing Eiffel Tower, Paris">
                            <div class="map-responsive">
                                <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&amp;q=Eiffel+Tower+Paris+France" width="600" height="400" frameborder="0" style="border:0; width: 100%;" allowfullscreen=""></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end contact -->
        <!--  footer -->
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

