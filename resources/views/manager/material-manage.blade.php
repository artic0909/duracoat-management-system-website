@extends('manager.layouts.app')

@section('title', 'Clients & Materials Management')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    /* Select2 Bootstrap 5 Theme Fixes (Optional if not using a specific theme) */
    .select2-container .select2-selection--single {
        height: 38px !important;
        /* Match Bootstrap form-control height */
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
    
    /* Ensure z-index is correct for modals */
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
                        <a class="opacity-5 text-dark" href="javascript:;">Manager</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
                        Manage Clients & Materials
                    </li>
                </ol>
                <h6 class="font-weight-bolder mb-0">All Clients & Materials</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <form method="GET" action="{{ route('manager.client-material-manage') }}"
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
                        <a href="{{ route('manager.client-material-manage') }}"
                            style="background-color: #6c757d; color: white; border: none; border-radius: 6px; padding: 8px 14px; text-decoration: none;">
                            Reset
                        </a>
                        @endif
                        <a href="{{ route('manager.export.client.in') }}"
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
                                <a class="dropdown-item border-radius-md" href="{{ route('manager.profile') }}">
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
                                <a class="dropdown-item border-radius-md" href="{{ route('manager.logout') }}">
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
                                                    <h6 class="mb-0 text-sm">{{ $loop->iteration }}</h6>
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
                                                        <th class="text-xs text-secondary">Material Name</th>
                                                        <th class="text-xs text-secondary">Quantity</th>
                                                        <th class="text-xs text-secondary">Paint Name - Code</th>
                                                        <!-- <th class="text-xs text-secondary">Paint Use (qty)</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($client->material_details as $material)
                                                    @php
                                                    $paint = $material['paint_id'] ? App\Models\Paint::find($material['paint_id']) : null;
                                                    @endphp
                                                    <tr>
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
                                                <button type="button" class="btn btn-info px-3 py-2 rounded m-0" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $client->id }}">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger px-3 py-2 rounded m-0" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $client->id }}">
                                                    <i class="fa fa-trash"></i>
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




    <!-- Add Button -->
    <button type="button" class="btn btn-primary addFixedModalButton" data-bs-toggle="modal"
        data-bs-target="#addModal">
        <i class="fa fa-plus"></i>
    </button>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addClientModalLabel">Add Client Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="addClientForm" method="POST" action="{{ route('manager.client-material-manage.store') }}">
                    @csrf
                    <div class="modal-body">
                        <!-- Client Info -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Client Full Name</label>
                                <input type="text" class="form-control" name="client_name" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Mobile</label>
                                <input type="number" class="form-control" name="mobile" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>

                        <hr>
                        <h6 class="fw-bold text-secondary mb-3">Material Details</h6>

                        <!-- Dynamic Material Details Section -->
                        <div id="material-details-container">
                            <div class="row g-2 material-row mb-2">
                                <div class="col-md-2">
                                    <input type="date" name="date[]" class="form-control" required>
                                </div>
                                <div class="col-md-1">
                                    <select name="material_type[]" class="form-select" required>
                                        <option value="">Type</option>
                                        <option value="MS">MS</option>
                                        <option value="ALU">ALU</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="material_name[]" class="form-control"
                                        placeholder="Material Name" required>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="quantity[]" class="form-control"
                                        placeholder="Quantity" required>
                                </div>
                                <div class="col-md-1">
                                    <select name="unit[]" class="form-select" required>
                                        <option value="">Unit</option>
                                        <option value="KG">KG</option>
                                        <option value="Nos">Nos</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="paint_id[]" class="form-select select2-paint">
                                        <option value="">Select Paint (Optional)</option>
                                        @foreach ($paints as $paint)
                                        <option value="{{ $paint->id }}">{{ $paint->ral_code }} - {{ $paint->brand_name }} - {{ $paint->shade_name}} - {{ $paint->finish }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1 d-flex align-items-center">
                                    <button type="button" class="btn btn-success btn-sm add-material-row">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- /Material Details Section -->
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save Client</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    @foreach ($clients as $client)
    <div class="modal fade" id="editModal{{$client->id}}" tabindex="-1" aria-labelledby="editClientModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editClientModalLabel">Update Client Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('manager.client-material-manage.update', $client->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <!-- Client Info -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Client Full Name</label>
                                <input type="text" class="form-control" name="client_name" value="{{ $client->client_name }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Mobile</label>
                                <input type="text" class="form-control" name="mobile" value="{{ $client->mobile }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $client->email }}" required>
                            </div>
                        </div>

                        <hr>
                        <h6 class="fw-bold text-secondary mb-3">Material Details</h6>

                        <!-- Material Details -->
                        <div id="edit-material-details-container{{ $client->id }}">
                            @if(!empty($client->material_details))
                            @foreach ($client->material_details as $index => $material)
                            <div class="row g-2 material-row mb-2">
                                <div class="col-md-2">
                                    <input type="date" name="date[]" class="form-control" value="{{ $material['date'] ?? '' }}" required>
                                </div>
                                <div class="col-md-1">
                                    <select name="material_type[]" class="form-select" required>
                                        <option value="">Type</option>
                                        <option value="MS" {{ $material['type'] == 'MS' ? 'selected' : '' }}>MS</option>
                                        <option value="ALU" {{ $material['type'] == 'ALU' ? 'selected' : '' }}>ALU</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="material_name[]" class="form-control" value="{{ $material['material_name'] ?? '' }}" placeholder="Material Name" required>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="quantity[]" class="form-control" value="{{ $material['quantity'] ?? '' }}" placeholder="Quantity" required>
                                </div>
                                <div class="col-md-1">
                                    <select name="unit[]" class="form-select" required>
                                        <option value="">Select Unit</option>
                                        <option value="KG" {{ $material['unit'] == 'KG' ? 'selected' : '' }}>KG</option>
                                        <option value="Nos" {{ $material['unit'] == 'Nos' ? 'selected' : '' }}>Nos</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="paint_id[]" class="form-select select2-paint">
                                        <option value="">Select Paint (Optional)</option>
                                        @foreach ($paints as $paint)
                                        <option value="{{ $paint->id }}" {{ isset($material['paint_id']) && $material['paint_id'] == $paint->id ? 'selected' : '' }}>
                                            {{ $paint->ral_code }} - {{ $paint->brand_name }} - {{ $paint->shade_name}} - {{ $paint->finish }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1 d-flex align-items-center gap-1">
                                    <button type="button" class="btn btn-success btn-sm add-material-row">
                                        <i class="fa fa-plus"></i>
                                    </button>

                                    <button type="button" class="btn btn-danger btn-sm remove-material-row">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <!-- Show one empty row if no materials exist -->
                            <div class="row g-2 material-row mb-2">
                                <div class="col-md-2">
                                    <input type="date" name="date[]" class="form-control" required>
                                </div>
                                <div class="col-md-1">
                                    <select name="material_type[]" class="form-select" required>
                                        <option value="">Type</option>
                                        <option value="MS">MS</option>
                                        <option value="ALU">ALU</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="material_name[]" class="form-control" placeholder="Material Name" required>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="quantity[]" class="form-control" placeholder="Quantity" required>
                                </div>
                                <div class="col-md-2">
                                    <select name="unit[]" class="form-select" required>
                                        <option value="">Unit</option>
                                        <option value="KG">KG</option>
                                        <option value="Nos">Nos</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="paint_id[]" class="form-select select2-paint">
                                        <option value="">Select Paint (Optional)</option>
                                        @foreach ($paints as $paint)
                                        <option value="{{ $paint->id }}">{{ $paint->ral_code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1 d-flex align-items-center">
                                    <button type="button" class="btn btn-success btn-sm add-material-row">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Update Client</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @endforeach

    <!-- Delete Modal -->
    @foreach ($clients as $client)
    <div class="modal fade" id="deleteModal{{$client->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('manager.client-material-manage.delete', $client->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Client's Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this Client's Details?</p>
                    <p><span class="text-danger">{{$client->client_name}} - {{$client->client_unique_id}}</span></p>
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


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- JS for Dynamic Material Rows -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Initialize Select2 on page load
            function initSelect2() {
                $('.select2-paint').select2({
                    dropdownParent: $('body'), // Fix for select2 inside modal
                    width: '100%',
                    placeholder: "Select Paint (Optional)",
                    allowClear: true
                });
                
                // Fix for Select2 inside bootstrap modal not searchable
                // When a modal is opened, attach select2 to that modal
                 $('.modal').on('shown.bs.modal', function () {
                    $(this).find('.select2-paint').each(function() {
                        $(this).select2({
                            dropdownParent: $(this).closest('.modal'), 
                            width: '100%',
                            placeholder: "Select Paint (Optional)",
                            allowClear: true
                        });
                    });
                });
            }
            initSelect2();


            function createMaterialRow() {
                return `
        <div class="row g-2 material-row mb-2">
            <div class="col-md-2">
                <input type="date" name="date[]" class="form-control" required>
            </div>
            <div class="col-md-1">
                <select name="material_type[]" class="form-select" required>
                    <option value="">Type</option>
                    <option value="MS">MS</option>
                    <option value="ALU">ALU</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="text" name="material_name[]" class="form-control" placeholder="Material Name" required>
            </div>
            <div class="col-md-2">
                <input type="text" name="quantity[]" class="form-control" placeholder="Quantity" required>
            </div>
            <div class="col-md-1">
                <select name="unit[]" class="form-select" required>
                    <option value="">Unit</option>
                    <option value="KG">KG</option>
                    <option value="Nos">Nos</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="paint_id[]" class="form-select select2-paint">
                    <option value="">Select Paint (Optional)</option>
                    @foreach ($paints as $paint)
                        <option value="{{ $paint->id }}">{{ $paint->ral_code }} - {{ $paint->brand_name }} - {{ $paint->shade_name }} - {{ $paint->finish }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1 d-flex align-items-center">
                <button type="button" class="btn btn-danger btn-sm remove-material-row">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>`;
            }

            document.addEventListener('click', function(e) {
                const addBtn = e.target.closest('.add-material-row');
                const removeBtn = e.target.closest('.remove-material-row');

                if (addBtn) {
                    e.preventDefault();
                    const parentModal = addBtn.closest('.modal');
                    const container = parentModal.querySelector('[id^="edit-material-details-container"]') ||
                        parentModal.querySelector('#material-details-container');
                    
                    // Add new row
                    container.insertAdjacentHTML('beforeend', createMaterialRow());
                    
                    // Re-initialize select2 for the new row's select element
                    // We need to find the specific select2-paint element we just added. 
                    // To keep it simple, we can re-init on all inside this modal or just target the last one.
                     $(container).find('.select2-paint:last').select2({
                        dropdownParent: $(parentModal),
                        width: '100%',
                        placeholder: "Select Paint (Optional)",
                        allowClear: true
                    });
                }

                if (removeBtn) {
                    e.preventDefault();
                    // Destroy select2 before removing if needed, though mostly automatic in simple cases.
                    const row = removeBtn.closest('.material-row');
                    $(row).find('.select2-paint').select2('destroy');
                    row.remove();
                }
            });

        });
    </script>



    @endsection