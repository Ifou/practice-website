<html>

<style>
    .status-booked {
        color: green;
    }

    .status-vacant {
        color: white;
    }

    .status-rejected {
        color: red;
    }
</style>

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
                                <th>Actions</th>
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
                                    <td class="status-{{ strtolower($booking->room->room_status) }}">{{ $booking->room->room_status }}</td>
                                    <td>{{ $booking->room->room_title }}</td>
                                    <td>{{ $booking->room->room_type }}</td>
                                    <td>{{ $booking->room->room_price }}</td>
                                    <td>
                                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                        <form action="{{ route('bookings.approve', $booking->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                        </form>
                                        <form action="{{ route('bookings.reject', $booking->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                        </form>
                                    </td>
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
