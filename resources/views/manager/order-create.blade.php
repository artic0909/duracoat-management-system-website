@extends('manager.layouts.app')

@section('title', 'Order Create & Management')

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm">
                    <a class="opacity-5 text-dark" href="javascript:;">Manager</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
                    Create Orders
                </li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Here you can create new orders for each client</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <form action="{{ route('manager.orders-and-jobcards') }}" method="GET" style="display: flex; gap: 10px; align-items: center; margin-bottom: 15px;">
                    <div class="input-group" style="width: 220px;">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" name="order_number" class="form-control" placeholder="Search Order No..."
                            value="{{ request('order_number') }}">
                    </div>

                    <div>
                        <label for="from_date">From:</label>
                        <input type="date" name="from_date" value="{{ request('from_date') }}"
                            style="padding: 6px 10px; border: 1px solid #ccc; border-radius: 5px;">
                    </div>

                    <div>
                        <label for="end_date">To:</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}"
                            style="padding: 6px 10px; border: 1px solid #ccc; border-radius: 5px;">
                    </div>

                    <button type="submit" class="btn btn-primary"
                        style="padding: 6px 15px; border-radius: 5px;">Search</button>

                    <a href="{{ route('manager.orders-and-jobcards') }}" class="btn btn-secondary"
                        style="padding: 6px 15px; border-radius: 5px;">Reset</a>

                    <a href="{{ route('manager.export.orders') }}" class="btn"
                        style="background-color: #034078; color: white; padding: 6px 15px; border-radius: 5px;">
                        Export
                    </a>
                </form>

            </div>
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-cog cursor-pointer"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4"
                        aria-labelledby="dropdownMenuButton">
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="{{ route('manager.profile') }}">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <img src="{{ asset('assets/img/team-2.jpg') }}" class="avatar avatar-sm me-3" />
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">Profile Settings</span>
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="{{ route('manager.logout') }}">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <img src="{{ asset('assets/img/team-2.jpg') }}"
                                            class="avatar avatar-sm bg-gradient-dark me-3" />
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">Logout</span>&nbsp;<i
                                                class="fa fa-power-off"></i>
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 text-nowrap">
                            <thead>
                                <tr>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        SL
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Date & Time
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Order NO
                                    </th>
                                    <th
                                        class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Client Name
                                    </th>
                                    <th
                                        class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email
                                    </th>
                                    <th
                                        class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Mobile
                                    </th>
                                    <th
                                        class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Total Jobcards
                                    </th>
                                    <th
                                        class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Amount
                                    </th>
                                    <th
                                        class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Billing Amount
                                    </th>
                                    <th
                                        class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jobcard Details
                                    </th>
                                    <th
                                        class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $order->created_at->format('d-m-Y') }}</h6>

                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $order->order_number }}</p>
                                    </td>
                                    <td class="align-middle text-start">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $order->client->client_name }}</span>
                                    </td>
                                    <td class="align-middle text-start">
                                        <span
                                            class="text-secondary text-xs font-weight-bold">{{ $order->client->email }}</span>
                                    </td>
                                    <td class="align-middle text-start">
                                        <span
                                            class="text-secondary text-xs font-weight-bold">{{ $order->client->mobile }}</span>
                                    </td>
                                    <td class="align-middle text-start">
                                        <span
                                            class="text-white badge badge-sm bg-gradient-info text-xs font-weight-bold">{{ $order->jobcards->count() }}</span>
                                    </td>
                                    <td class="align-middle text-start">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $order->amount ?? '0' }}</span>
                                    </td>
                                    <td class="align-middle text-start">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $order->billing_amount ?? '0' }}</span>
                                    </td>
                                    <td class="align-middle text-start text-sm">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="{{ route('manager.add-jobcards', ['order_id' => $order->id] )}}"
                                                class="btn btn-primary px-3 py-2 rounded m-0">
                                                <i class="fa fa-plus"></i> Add Jobcard
                                            </a>

                                            <a href="{{ route('manager.view-created-jobcards', $order->id) }}"
                                                class="btn btn-success px-3 py-2 rounded m-0">
                                                <i class="fa fa-eye"></i> View
                                            </a>
                                        </div>
                                    </td>
                                    <td class="align-middle text-start text-sm">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <button type="button" class="btn btn-info px-3 py-2 rounded m-0"
                                                data-bs-toggle="modal" data-bs-target="#editModal{{$order->id}}">
                                                <i class="fa fa-pencil"></i>
                                            </button>

                                            <button type="button" class="btn btn-danger px-3 py-2 rounded m-0"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal{{$order->id}}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                            <!-- pagination -->
                            <tfoot>
                                <tr>
                                    <td colspan="9" class="text-start">
                                        <div class="d-flex justify-content-center align-items-center gap-3 mt-3">
                                            @if ($orders->onFirstPage())
                                            <span class="text-muted">Prev</span>
                                            @else
                                            <a href="{{ $orders->previousPageUrl() }}" class="text-primary text-decoration-none">Prev</a>
                                            @endif

                                            <span>{{ $orders->currentPage() }} / {{ $orders->lastPage() }}</span>

                                            @if ($orders->hasMorePages())
                                            <a href="{{ $orders->nextPageUrl() }}" class="text-primary text-decoration-none">Next</a>
                                            @else
                                            <span class="text-muted">Next</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Button -->
<button type="button" class="btn btn-primary addFixedModalButton" data-bs-toggle="modal"
    data-bs-target="#addModal">
    <i class="fa fa-plus"></i>
</button>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form class="modal-content" method="POST" action="{{ route('manager.orders-and-jobcards.store') }}">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Order Number</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <!-- Choose Client -->
                    <div class="col-md-12 mb-3">
                        <label for="clientSelect" class="form-label">Choose Client</label>
                        <select name="client_id" id="clientSelect" class="form-control" required>
                            <option value="" selected disabled>Select Client</option>
                            @foreach ($clients as $client)
                            <option value="{{ $client->id }}"
                                data-name="{{ $client->client_name }}"
                                data-email="{{ $client->email }}"
                                data-mobile="{{ $client->mobile }}">

                                {{ $client->client_name }} |
                                {{ $client->email }} |
                                {{ $client->mobile }} |
                                {{ $client->client_unique_id }} |

                                @if(!empty($client->material_details))
                                @foreach ($client->material_details as $material)
                                {{ $material['material_name'] ?? '' }}{{ !$loop->last ? ', ' : '' }} |
                                {{ $material['quantity'] ?? '' }}{{ !$loop->last ? ', ' : '' }}
                                {{ $material['unit'] ?? '' }}{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                                @else
                                No Material
                                @endif
                            </option>
                            @endforeach
                        </select>

                    </div>

                    <!-- Client Details -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Client Name</label>
                        <input type="text" name="client_name_display" id="clientName" class="form-control" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Client Email</label>
                        <input type="text" name="client_email_display" id="clientEmail" class="form-control" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Client Mobile</label>
                        <input type="text" name="client_mobile_display" id="clientMobile" class="form-control" readonly>
                    </div>

                    <!-- Order Number -->
                    <div class="col-md-6">
                        <label class="form-label">Enter Order Number</label>
                        <input type="text" name="order_number" class="form-control" required placeholder="Enter Order Number">
                    </div>

                    <!-- Amount -->
                    <div class="col-md-6">
                        <label class="form-label">Amount</label>
                        <input type="text" name="amount" class="form-control" placeholder="Enter Amount">
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create Order</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
@foreach ($orders as $order)
<div class="modal fade" id="editModal{{ $order->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $order->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('manager.orders-and-jobcards.update', $order->id) }}" method="POST" class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $order->id }}">Update Order Number</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <!-- Select Client -->
                    <div class="col-md-12 mb-3">
                        <label for="clientSelect{{ $order->id }}" class="form-label">Choose Client</label>
                        <select name="client_id" id="clientSelect{{ $order->id }}" class="form-control client-select" data-target="{{ $order->id }}" required>
                            <option value="">Select Client</option>
                            @foreach ($clients as $client)
                            <option value="{{ $client->id }}"
                                data-name="{{ $client->client_name }}"
                                data-email="{{ $client->email }}"
                                data-mobile="{{ $client->mobile }}"
                                {{ $order->client_id == $client->id ? 'selected' : '' }}>
                                {{ $client->client_name }} | {{ $client->email }} | {{ $client->mobile }} | {{ $client->client_unique_id }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Client Info -->
                    <div class="col-md-4">
                        <label class="form-label">Client Name</label>
                        <input type="text" class="form-control" id="clientName{{ $order->id }}"
                            value="{{ $order->client->client_name ?? '' }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Client Email</label>
                        <input type="text" class="form-control" id="clientEmail{{ $order->id }}"
                            value="{{ $order->client->email ?? '' }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Client Mobile</label>
                        <input type="text" class="form-control" id="clientMobile{{ $order->id }}"
                            value="{{ $order->client->mobile ?? '' }}" readonly>
                    </div>

                    <!-- Order Number -->
                    <div class="col-md-6 mt-3">
                        <label class="form-label">Enter Order Number</label>
                        <input type="text" name="order_number" class="form-control"
                            value="{{ $order->order_number }}" required>
                    </div>

                    <!-- Amount -->
                    <div class="col-md-6 mt-3">
                        <label class="form-label">Amount</label>
                        <input type="text" name="amount" class="form-control"
                            value="{{ $order->amount }}" placeholder="Enter Amount">
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-info">Update Order</button>
            </div>
        </form>
    </div>
</div>
@endforeach


<!-- Delete Modal -->
@foreach ($orders as $order)
<div class="modal fade" id="deleteModal{{$order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('manager.orders-and-jobcards.delete', $order->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this Order <span class="text-danger">{{ $order->order_number }}</span>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </form>
    </div>
</div>
@endforeach



<!-- JS for Auto-Filling Client Details -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const clientSelect = document.getElementById('clientSelect');
        const clientName = document.getElementById('clientName');
        const clientEmail = document.getElementById('clientEmail');
        const clientMobile = document.getElementById('clientMobile');

        clientSelect.addEventListener('change', function() {
            const selected = this.options[this.selectedIndex];
            clientName.value = selected.getAttribute('data-name') || '';
            clientEmail.value = selected.getAttribute('data-email') || '';
            clientMobile.value = selected.getAttribute('data-mobile') || '';
        });
    });
</script>


@endsection