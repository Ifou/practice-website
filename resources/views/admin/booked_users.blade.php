<html>
<head>
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
                <h2 class="h5 no-margin-bottom">Booked Users</h2>
            </div>
        </div>
        <section class="no-padding-top no-padding-bottom">
{{--            <div class="container-fluid">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-3 col-sm-6">--}}
{{--                        <div class="statistic-block block">--}}
{{--                            <div class="progress-details d-flex align-items-end justify-content-between">--}}
{{--                                <div class="title">--}}
{{--                                    <div class="icon"><i class="icon-user-1"></i></div><strong>Booked Clients</strong>--}}
{{--                                </div>--}}
{{--                                <div class="number dashtext-1">{{ $bookedClientsCount }}</div>--}}
{{--                            </div>--}}
{{--                            <div class="progress progress-template">--}}
{{--                                <div role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-1"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-3 col-sm-6">--}}
{{--                        <div class="statistic-block block">--}}
{{--                            <div class="progress-details d-flex align-items-end justify-content-between">--}}
{{--                                <div class="title">--}}
{{--                                    <div class="icon"><i class="icon-question"></i></div><strong>Vacant Rooms</strong>--}}
{{--                                </div>--}}
{{--                                <div class="number dashtext-2">{{ $vacantRoomsCount }}</div>--}}
{{--                            </div>--}}
{{--                            <div class="progress progress-template">--}}
{{--                                <div role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-2"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-3 col-sm-6">--}}
{{--                        <div class="statistic-block block">--}}
{{--                            <div class="progress-details d-flex align-items-end justify-content-between">--}}
{{--                                <div class="title">--}}
{{--                                    <div class="icon"><i class="icon-hour-glass"></i></div><strong>Waiting Rooms</strong>--}}
{{--                                </div>--}}
{{--                                <div class="number dashtext-3">{{ $waitingRoomsCount }}</div>--}}
{{--                            </div>--}}
{{--                            <div class="progress progress-template">--}}
{{--                                <div role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-3"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-3 col-sm-6">--}}
{{--                        <div class="statistic-block block">--}}
{{--                            <div class="progress-details d-flex align-items-end justify-content-between">--}}
{{--                                <div class="title">--}}
{{--                                    <div class="icon"><i class="icon-contract"></i></div><strong>Booked Rooms</strong>--}}
{{--                                </div>--}}
{{--                                <div class="number dashtext-4">{{ $bookedRoomsCount }}</div>--}}
{{--                            </div>--}}
{{--                            <div class="progress progress-template">--}}
{{--                                <div role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-4"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="col-lg">
                <div class="block">
                    <div class="title d-flex justify-content-between align-items-center">
                        <strong>Bookings Table</strong>
                        <form method="GET" action="{{ route('home') }}" class="form-inline">
                            <label for="per_page" class="mr-2">Show</label>
                            <select name="per_page" id="per_page" class="form-control mr-2" onchange="this.form.submit()">
                                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                                <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
                                <option value="30" {{ $perPage == 30 ? 'selected' : '' }}>30</option>
                            </select>
                            <label for="per_page">entries</label>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Number</th>
                                <th>Email</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Room Status</th>
                                <th>Room Title</th>
                                <th>Room Type</th>
                                <th>Room Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bookings as $booking)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $booking->full_name }}</td>
                                    <td>{{ $booking->number }}</td>
                                    <td>{{ $booking->email }}</td>
                                    <td>{{ $booking->start_date }}</td>
                                    <td>{{ $booking->end_date }}</td>
                                    <td>{{ $booking->room->room_status }}</td>
                                    <td>{{ $booking->room->room_title }}</td>
                                    <td>{{ $booking->room->room_type }}</td>
                                    <td>{{ $booking->room->room_price }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $bookings->appends(['per_page' => $perPage])->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>

@include('admin.footer')
</body>
</html>
