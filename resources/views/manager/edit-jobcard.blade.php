@extends('manager.layouts.app')

@section('title', 'Update Jobcard')

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
                    Edit Jobcards
                </li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Here you can edit jobcard for each client</h6>
            <!-- <h5 class="font-weight-bolder mb-0">Client Name/ Email / Mobile</h5> -->
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search"
                            aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Type here..." />
                </div>
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
                    <form action="{{ route('manager.edit-jobcards.update', $jobcard->id) }}" method="POST" class="m-4">
                        @csrf
                        @method('PUT')

                        <!-- Client Details -->
                        <h6 class="font-weight-bolder mb-0">Client's Details:</h6>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Client Name</label>
                                <input type="text" class="form-control" value="{{ $jobcard->client->client_name }}" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Client Email</label>
                                <input type="email" class="form-control" value="{{ $jobcard->client->email }}" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Mobile</label>
                                <input type="text" class="form-control" value="{{ $jobcard->client->mobile }}" readonly>
                            </div>
                        </div>

                        <!-- Jobcard Details -->
                        <h6 class="font-weight-bolder mb-0">Create Jobcard:</h6>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Date</label>
                                <input type="text" class="form-control"
                                    value="{{ \Carbon\Carbon::parse($jobcard->jobcard_creation_date)->format('d/m/Y') }}" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Order No.</label>
                                <input type="text" class="form-control" value="{{ $jobcard->order->order_number }}" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Jobcard No.</label>
                                <input type="text" class="form-control" name="jobcard_number" value="{{ $jobcard->jobcard_number }}">
                            </div>
                        </div>

                        <!-- Product Row -->
                        <!-- Choose Client's Product / Material -->
                        <h6 class="font-weight-bolder mb-2">Choose Client's Product / Material:</h6>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="border rounded p-2" style="max-height: 220px; overflow-y: auto;">
                                    @foreach($clientMaterials as $index => $mat)
                                    <div class="form-check">
                                        <input class="form-check-input material-radio"
                                            type="{{ count($clientMaterials) > 1 ? 'radio' : 'checkbox' }}"
                                            name="selected_material"
                                            id="mat{{ $index }}"
                                            value="{{ $index }}"
                                            data-type="{{ $mat['type'] }}"
                                            data-name="{{ $mat['material_name'] }}"
                                            data-quantity="{{ $mat['quantity'] }}"
                                            data-unit="{{ $mat['unit'] }}"
                                            data-paint_id="{{ $mat['paint_id'] }}"
                                            data-paint_code="{{ $mat['paint_code'] }}"
                                            {{ ($jobcard->material_name == $mat['material_name'] && $jobcard->material_type == $mat['type']) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="mat{{ $index }}">
                                            {{ $mat['material_name'] }} ({{ $mat['type'] }}) - Qty: {{ $mat['quantity'] }} {{ $mat['unit'] }} | RAL: {{ $mat['paint_code'] }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Product Row -->
                        <h6 class="font-weight-bolder mb-2">Material Details:</h6>
                        <div class="row mb-3">
                            <div class="col-md-1">
                                <label class="form-label">Type</label>
                                <input type="text" name="material_type" value="{{ $jobcard->material_type }}" class="form-control" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Product Name</label>
                                <input type="text" name="material_name" value="{{ $jobcard->material_name }}" class="form-control" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Product Quantity</label>
                                <input type="text" name="material_quantity" value="{{ $jobcard->material_quantity }}" class="form-control">
                            </div>
                            <div class="col-md-1">
                                <label class="form-label">Unit</label>
                                <input type="text" name="material_unit" value="{{ $jobcard->material_unit }}" class="form-control" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Paint Code (RAL)</label>
                                <input type="text" name="ral_code" value="{{ $jobcard->ral_code }}" class="form-control" readonly>
                            </div>
                            <input type="hidden" name="paint_id" value="{{ $jobcard->paint_id }}" readonly>
                            <div class="col-md-2">
                                <label class="form-label">Paint Used (Qty)</label>
                                <input type="text" class="form-control" name="paint_used"
                                    placeholder="Used Quantity KG" value="{{ $jobcard->paint_used }}">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-info">Update Jobcard</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.querySelectorAll('.material-radio').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelector('input[name="material_type"]').value = this.dataset.type;
            document.querySelector('input[name="material_name"]').value = this.dataset.name;
            document.querySelector('input[name="material_quantity"]').value = this.dataset.quantity;
            document.querySelector('input[name="material_unit"]').value = this.dataset.unit;
            document.querySelector('input[name="paint_id"]').value = this.dataset.paint_id;
            document.querySelector('input[name="ral_code"]').value = this.dataset.paint_code;
        });
    });
</script>

@endsection