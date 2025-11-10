@extends('viewer.layouts.app')

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
                    <form action="{{ route('viewer.edit-jobcards.update', $jobcard->id) }}" method="POST" class="m-4">
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
                        <div class="row mb-3">
                            <div class="col-md-1">
                                <label class="form-label">Type</label>
                                <input type="text" value="{{ $jobcard->material_type }}" class="form-control" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Product Name</label>
                                <input type="text" value="{{ $jobcard->material_name }}" class="form-control" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Product Quantity</label>
                                <input type="text" value="{{ $jobcard->material_quantity }}" class="form-control" readonly>
                            </div>
                            <div class="col-md-1">
                                <label class="form-label">Unit</label>
                                <input type="text" value="{{ $jobcard->material_unit }}" class="form-control" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Paint Code (RAL)</label>
                                <input type="text" value="{{ $jobcard->ral_code }}" class="form-control" readonly>
                            </div>
                            <input type="hidden" name="paint_id" value="{{ $jobcard->paint_id }}" readonly>
                            <div class="col-md-2">
                                <label class="form-label">Paint Used (Qty)</label>
                                <input type="number" class="form-control" name="paint_used"
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

@endsection