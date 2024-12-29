<!-- Sidebar Navigation-->
<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        <div class="avatar"><img src="admin/img/avatar-6.jpg" alt="..." class="img-fluid rounded-circle"></div>
        <div class="title">
            <h1 class="h5">Mark Stephen</h1>
            <p>Web Designer</p>
        </div>
    </div>
    <!-- Sidebar Navigation Menus-->
    <span class="heading">Main</span>
    <ul class="list-unstyled" id="sidebar-menu">
        <li id="home-link" class="active"><a href={{route('home')}}> <i class="icon-home"></i>Home </a></li>
        <li id="hotel-management-link"><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Hotel Management </a>
            <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                <li><a href={{url('view_room')}}>View Rooms</a></li>
                <li><a href={{url('create_room')}}>Add Rooms </a></li>
            </ul>
        </li>
        <li id="booking-table-link"><a href={{url('booked_users')}}> <i class="icon-home"></i>Booking Table </a></li>
        <li id="view-contacts-link"><a href="{{ route('view_contacts') }}"> <i class="icon-mail"></i>View Contacts </a></li>
    </ul>
</nav>
<!-- Sidebar Navigation end-->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const links = document.querySelectorAll('#sidebar-menu li');

        links.forEach(link => {
            link.addEventListener('click', function() {
                links.forEach(item => item.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
</script>
