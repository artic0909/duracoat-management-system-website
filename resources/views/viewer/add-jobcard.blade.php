@extends('viewer.layouts.app')

@section('title', 'Add Jobcards')

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
                    Add Jobcards
                </li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Here you can create jobcards for each client</h6>
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
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" />
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
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <img src="../assets/img/team-2.jpg"
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
                        <li>
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="d-flex py-1">
                                    <div class="avatar avatar-sm bg-gradient-secondary me-3 my-auto">
                                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>credit-card</title>
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g transform="translate(-2169.000000, -745.000000)"
                                                    fill="#FFFFFF" fill-rule="nonzero">
                                                    <g transform="translate(1716.000000, 291.000000)">
                                                        <g transform="translate(453.000000, 454.000000)">
                                                            <path class="color-background"
                                                                d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
                                                                opacity="0.593633743"></path>
                                                            <path class="color-background"
                                                                d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            Payment successfully completed
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-clock me-1"></i>
                                            2 days
                                        </p>
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
                    <form action="{{ route('viewer.add-jobcards.store', $order->id) }}" method="POST" class="m-4">
                        @csrf

                        <!-- Row 1 -->
                        <h6 class="font-weight-bolder mb-2">Client's Details:</h6>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Client Name</label>
                                <input type="text" name="client_name" value="{{ $order->client->client_name }}" class="form-control" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Client Email</label>
                                <input type="email" name="client_email" value="{{ $order->client->email }}" class="form-control" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Mobile</label>
                                <input type="text" name="client_mobile" value="{{ $order->client->mobile }}" class="form-control" readonly>
                            </div>
                        </div>

                        <!-- Row 2 -->
                        <h6 class="font-weight-bolder mb-2">Create Jobcard:</h6>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Date<span class="text-danger">*</span></label>
                                <input type="date" name="jobcard_creation_date" class="form-control" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Order No.</label>
                                <input type="text" name="order_number" value="{{ $order->order_number }}" class="form-control" readonly>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Jobcard No.<span class="text-danger">*</span></label>
                                <input type="text" name="jobcard_number" class="form-control" placeholder="Enter Jobcard No." required>
                            </div>
                        </div>

                        <!-- Row 3 -->
                        <h6 class="font-weight-bolder mb-2">Choose Client's Product / Material:</h6>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="border rounded p-2" style="max-height: 220px; overflow-y: auto;">
                                    @foreach($clientMaterials as $index => $mat)
                                    <div class="form-check">
                                        <input class="form-check-input material-radio" type="radio"
                                            name="selected_material"
                                            id="mat{{ $index }}"
                                            value="{{ $index }}"
                                            data-type="{{ $mat['type'] }}"
                                            data-name="{{ $mat['material_name'] }}"
                                            data-quantity="{{ $mat['quantity'] }}"
                                            data-unit="{{ $mat['unit'] }}"
                                            data-paint_id="{{ $mat['paint_id'] }}"
                                            data-paint_code="{{ $mat['paint_code'] }}">
                                        <label class="form-check-label" for="mat{{ $index }}">
                                            {{ $mat['material_name'] }} ({{ $mat['type'] }}) - Qty: {{ $mat['quantity'] }} {{ $mat['unit'] }} | RAL: {{ $mat['paint_code'] }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Dynamic Row 4 -->
                        <h6 class="font-weight-bolder mb-2">Material Details:</h6>
                        <div id="materialDetailsRow" class="row mb-3">
                            <div class="col-md-1">
                                <label class="form-label">Type</label>
                                <input type="text" name="material_type" class="form-control" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Product Name</label>
                                <input type="text" name="material_name" class="form-control" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Quantity</label>
                                <input type="text" name="material_quantity" class="form-control" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Unit</label>
                                <input type="text" name="material_unit" class="form-control" readonly>
                            </div>
                            <input type="hidden" name="paint_id">
                            <div class="col-md-3">
                                <label class="form-label">Paint Code (RAL)</label>
                                <input type="text" name="ral_code" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Create Jobcard</button>
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