@extends('viewer.layouts.app')

@section('title', 'Clients & Materials Management')

@section('content')
<!-- Select2 CSS (included for consistency/styling of table if needed, though mostly for forms) -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    /* Select2 Bootstrap 5 Theme Fixes */
    .select2-container .select2-selection--single {
        height: 38px !important;
        padding: 5px 0;
        border: 1px solid #d2d6da;
        border-radius: 0.5rem;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding-left: 12px;
        line-height: normal;
        color: #495057;
    }
    .select2-container {
        z-index: 999999;
    }
</style>

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm">
                        <a class="opacity-5 text-dark" href="javascript:;">Viewer</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
                        Manage Clients & Materials
                    </li>
                </ol>
                <h6 class="font-weight-bolder mb-0">All Clients & Materials</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <form method="GET" action="{{ route('viewer.client-material-manage') }}"
                        style="display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 15px; flex-wrap: wrap;">

                        <!-- Search Input + Button -->
                        <div style="display: flex; align-items: center; justify-content: center; gap: 5px;">
                            <input type="text" name="search"
                                placeholder="Search by Email"
                                value="{{ request('search') }}"
                                style="padding: 8px 12px; border: 1px solid #ccc; border-radius: 6px; width: 220px;">
                            <button type="submit"
                                style="background-color: #17a2b8; color: white; border: none; border-radius: 6px; padding: 8px 14px; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-search" style="margin-right: 5px;"></i>Search
                            </button>
                        </div>

                        <!-- Type Dropdown -->
                        <select name="type" onchange="this.form.submit()"
                            style="padding: 8px 12px; border: 1px solid #ccc; border-radius: 6px; width: 180px;">
                            <option value="">Filter by Type</option>
                            <option value="MS" {{ request('type') == 'MS' ? 'selected' : '' }}>MS</option>
                            <option value="ALU" {{ request('type') == 'ALU' ? 'selected' : '' }}>ALU</option>
                        </select>

                        <!-- Reset Button -->
                        @if(request('search') || request('type'))
                        <a href="{{ route('viewer.client-material-manage') }}"
                            style="background-color: #6c757d; color: white; border: none; border-radius: 6px; padding: 8px 14px; text-decoration: none;">
                            Reset
                        </a>
                        @endif
                        <a href="{{ route('viewer.export.client.in') }}"
                            style="background-color: #034078; color: white; border: none; border-radius: 6px; padding: 8px 14px; text-decoration: none;">
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
                                <a class="dropdown-item border-radius-md" href="{{ route('viewer.profile') }}">
                                    <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <img src="{{asset('assets/img/team-2.jpg')}}" class="avatar avatar-sm me-3" />
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
                                <a class="dropdown-item border-radius-md" href="{{ route('viewer.logout') }}">
                                    <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <img src="{{asset('assets/img/team-2.jpg')}}"
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
                            <table class="table table-bordered align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SL</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Client's Details</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mobile</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Material Details</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($clients as $client)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ ($clients->currentPage() - 1) * $clients->perPage() + $loop->iteration }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <!-- Client Info -->
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $client->client_name }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $client->client_unique_id }}</p>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Mobile -->
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $client->mobile ?? '-' }}</p>
                                        </td>

                                        <!-- Email -->
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $client->email ?? '-' }}</span>
                                        </td>

                                        <!-- Material Details -->
                                        <td class="align-middle text-center">
                                            @if (!empty($client->material_details) && is_array($client->material_details))
                                            <table class="table table-sm table-bordered mb-0">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th class="text-xs text-secondary">Date</th>
                                                        <th class="text-xs text-secondary">Material Name</th>
                                                        <th class="text-xs text-secondary">Quantity</th>
                                                        <th class="text-xs text-secondary">Paint Name - Code</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($client->material_details as $material)
                                                    @php
                                                    $paint = $material['paint_id'] ? App\Models\Paint::find($material['paint_id']) : null;
                                                    @endphp
                                                    <tr>
                                                        <td class="text-xs">
                                                            @if(isset($material['date']) && $material['date'])
                                                                {{ \Carbon\Carbon::parse($material['date'])->format('d/m/Y') }}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td class="text-xs">
                                                            {{ $material['material_name'] ?? 'N/A' }}
                                                            ({{ $material['type'] ?? '-' }})
                                                        </td>
                                                        <td class="text-xs">
                                                            {{ $material['quantity'] ?? '-' }}
                                                            {{ $material['unit'] ?? '' }}
                                                        </td>
                                                        <td class="text-xs">
                                                            @if ($paint)
                                                            <p class="m-0 text-xs fw-bolder">{{ $paint->ral_code ?? '-' }}</p>
                                                            @else
                                                            <p class="m-0 text-xs text-muted">N/A</p>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @else
                                            <p class="text-xs text-muted mb-0">No materials added</p>
                                            @endif
                                        </td>

                                        <!-- Actions -->
                                        <td class="align-middle text-center text-sm">
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button type="button" class="btn btn-warning px-3 py-2 rounded m-0" data-bs-toggle="modal"
                                                    data-bs-target="#viewModal{{ $client->id }}">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No clients found</td>
                                    </tr>
                                    @endforelse
                                </tbody>

                                <!-- pagination -->
                                <tfoot>
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <div class="d-flex justify-content-center align-items-center gap-3 mt-3">
                                                @if ($clients->onFirstPage())
                                                <span class="text-muted">Prev</span>
                                                @else
                                                <a href="{{ $clients->previousPageUrl() }}" class="text-primary text-decoration-none">Prev</a>
                                                @endif

                                                <span>{{ $clients->currentPage() }} / {{ $clients->lastPage() }}</span>

                                                @if ($clients->hasMorePages())
                                                <a href="{{ $clients->nextPageUrl() }}" class="text-primary text-decoration-none">Next</a>
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

    <!-- View Modal -->
    @foreach ($clients as $client)
    <div class="modal fade" id="viewModal{{$client->id}}" tabindex="-1" aria-labelledby="viewClientModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewClientModalLabel">Client Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="fw-bold">Client Name:</label>
                            <p class="text-sm border p-2 rounded bg-light">{{ $client->client_name }}</p>
                        </div>
                        <div class="col-md-4">
                            <label class="fw-bold">Mobile:</label>
                            <p class="text-sm border p-2 rounded bg-light">{{ $client->mobile ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-4">
                            <label class="fw-bold">Email:</label>
                            <p class="text-sm border p-2 rounded bg-light">{{ $client->email ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <h6 class="fw-bold text-secondary mb-2">Material Details</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered align-items-center mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Material Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quantity</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unit</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Paint Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($client->material_details) && is_array($client->material_details))
                                    @foreach ($client->material_details as $material)
                                    @php
                                        $paint = $material['paint_id'] ? App\Models\Paint::find($material['paint_id']) : null;
                                    @endphp
                                    <tr>
                                        <td class="text-sm">
                                            @if(isset($material['date']) && $material['date'])
                                                {{ \Carbon\Carbon::parse($material['date'])->format('d/m/Y') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-sm">{{ $material['type'] ?? '-' }}</td>
                                        <td class="text-sm">{{ $material['material_name'] ?? '-' }}</td>
                                        <td class="text-sm">{{ $material['quantity'] ?? '-' }}</td>
                                        <td class="text-sm">{{ $material['unit'] ?? '-' }}</td>
                                        <td class="text-sm">
                                            @if ($paint)
                                                <span class="fw-bold text-dark">{{ $paint->ral_code }}</span> <br>
                                                <span class="text-xs text-muted">Brand: {{ $paint->brand_name }} | Shade: {{ $paint->shade_name }} | Finish: {{ $paint->finish }}</span>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">No materials found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Viewer has no modals for Add/Edit/Delete as per instructions to keep viewer=viewer (read only) -->
    <!-- Scripts included for consistency if any table interaction needed -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @endsection