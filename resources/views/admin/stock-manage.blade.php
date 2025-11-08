@extends('admin.layouts.app')

@section('title', 'Stock Management')

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
                    Manage Stocks
                </li>
            </ol>
            <h6 class="font-weight-bolder mb-0">All Paint Stocks</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <form method="GET" action="{{ route('admin.stocks-manage') }}"
                    style="display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 15px; flex-wrap: wrap;">

                    <!-- Search Input + Button -->
                    <div style="display: flex; align-items: center; justify-content: center; gap: 5px;">
                        <input type="text" name="search"
                            placeholder="Search by RAL or Paint ID"
                            value="{{ request('search') }}"
                            style="padding: 8px 12px; border: 1px solid #ccc; border-radius: 6px; width: 220px;">
                        <button type="submit"
                            style="background-color: #17a2b8; color: white; border: none; border-radius: 6px; padding: 8px 14px; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-search" style="margin-right: 5px;"></i> Search
                        </button>
                    </div>

                    <!-- Dropdown Filter -->
                    <select name="stock_status" onchange="this.form.submit()"
                        style="padding: 8px 12px; border: 1px solid #ccc; border-radius: 6px; width: 180px;">
                        <option value="">Filter by Stock</option>
                        <option value="out" {{ request('stock_status') == 'out' ? 'selected' : '' }}>Out of Stock</option>
                        <option value="low" {{ request('stock_status') == 'low' ? 'selected' : '' }}>Low Stock (≤ 5)</option>
                        <option value="in" {{ request('stock_status') == 'in' ? 'selected' : '' }}>In Stock (> 5)</option>
                    </select>

                    <!-- Reset Button -->
                    @if(request('search') || request('stock_status'))
                    <a href="{{ route('admin.stocks-manage') }}"
                        style="background-color: #6c757d; color: white; border: none; border-radius: 6px; padding: 8px 14px; text-decoration: none;">
                        Reset
                    </a>
                    @endif
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
                            <a class="dropdown-item border-radius-md" href="{{ route('admin.profile') }}">
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
                            <a class="dropdown-item border-radius-md" href="{{ route('admin.logout') }}">
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
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        SL
                                    </th>

                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Paint Unicode
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Brand Name
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        RAL
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Shade Name
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Finish
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        IN Stock Quantity
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paints as $paint)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{$loop->iteration}}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{$paint->paint_unique_id}}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{$paint->brand_name}}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success" style="text-transform: uppercase;">{{$paint->ral_code}}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold" style="text-transform: capitalize;">{{$paint->shade_name}}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold" style="text-transform: capitalize;">{{$paint->finish}}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{$paint->quantity}} KG</span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        @if ($paint->quantity > 5)
                                        <span class="badge badge-sm bg-success">In stock</span>
                                        @elseif ($paint->quantity <= 5 && $paint->quantity > 0)
                                            <span class="badge badge-sm bg-warning text-dark">Low Stock</span>
                                            @else
                                            <span class="badge badge-sm bg-danger">Out of stock</span>
                                            @endif
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <button type="button" class="btn btn-primary px-3 py-2 rounded m-0"
                                                data-bs-toggle="modal" data-bs-target="#addstockModal{{$paint->id}}">
                                                <i class="fa fa-plus me-2"></i>Add Stock
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                            <!-- pagination -->
                            <tfoot>
                                <tr>
                                    <td colspan="9" class="text-center">
                                        <div class="d-flex justify-content-center align-items-center gap-3 mt-3">
                                            @if ($paints->onFirstPage())
                                            <span class="text-muted">Prev</span>
                                            @else
                                            <a href="{{ $paints->previousPageUrl() }}" class="text-primary text-decoration-none">Prev</a>
                                            @endif

                                            <span>{{ $paints->currentPage() }} / {{ $paints->lastPage() }}</span>

                                            @if ($paints->hasMorePages())
                                            <a href="{{ $paints->nextPageUrl() }}" class="text-primary text-decoration-none">Next</a>
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


<!-- Add Stock Modal -->
@foreach ($paints as $paint)
<div class="modal fade" id="addstockModal{{$paint->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" action="{{ route('admin.stocks-manage.update', $paint->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Paint Stock (Qty)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                @if($paint->quantity > 5)
                <h5 class="fw-bolder text-success m-0 p-0">Current Stock: {{ $paint->quantity }} KG</h5>
                <small class="text-success">This paint is in stock</small>
                @elseif($paint->quantity <= 5 && $paint->quantity > 0)
                    <h5 class="fw-bolder text-warning m-0 p-0">Current Stock: {{ $paint->quantity }} KG</h5>
                    <small class="text-warning">This paint is low in stock</small>
                    @else
                    <h5 class="fw-bolder text-danger m-0 p-0">Current Stock: {{ $paint->quantity }} KG</h5>
                    <small class="text-danger">This paint is out of stock. Please restock</small>
                    @endif

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>Paint Name (RAL Code)</label>
                            <input type="text" value="{{ $paint->ral_code }}" class="form-control" readonly>
                        </div>
                        <div class="col-md-6">
                            <label>Brand Name</label>
                            <input type="text" value="{{ $paint->brand_name }}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>Shade Name</label>
                            <input type="text" class="form-control" value="{{ $paint->shade_name }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label>Finishing</label>
                            <input type="text" class="form-control" value="{{ $paint->finish }}" readonly>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label>Add Paint Quantity (For Restock)</label>
                            <input type="number" name="quantity" class="form-control" placeholder="Enter quantity in KG" required>
                            <input type="hidden" name="id" value="{{ $paint->id }}">
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Stock Update</button>
            </div>
        </form>
    </div>
</div>
@endforeach


@endsection