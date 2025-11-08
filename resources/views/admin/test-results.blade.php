@extends('admin.layouts.app')

@section('title', 'Test Results')

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
                    Tests
                </li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Here you can find all the tested jobcards with results</h6>
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
                                        Status
                                    </th>

                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Testing Date
                                    </th>

                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jobcard No
                                    </th>

                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        colspan="4">
                                        Product/ Material Description & Paints
                                    </th>

                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Pre-treatment Date
                                    </th>

                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Powder Apply Date
                                    </th>

                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">2</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0 bg-warning text-dark m-0 p-1">
                                            pending</p>
                                        <p class="text-xs font-weight-bold mb-0 bg-info text-white m-0 p-1">
                                            pre-treat</p>
                                        <p class="text-xs font-weight-bold mb-0 bg-primary text-white m-0 p-1">
                                            powder-applied</p>
                                        <p class="text-xs font-weight-bold mb-0 bg-success text-dark m-0 p-1">
                                            delivered</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">03/11/2025</p>
                                    </td>

                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">DC-JB-001</p>
                                    </td>
                                    <!-- nested table -->
                                    <td colspan="4" class="p-0">
                                        <table
                                            class="table table-bordered table-sm m-0 text-center align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="text-xs">Product / Material Description</th>
                                                    <th class="text-xs">Paint Code (RAL)</th>
                                                    <th class="text-xs">Paint Name</th>
                                                    <th class="text-xs">Paint Used (Qty)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <p class="m-0 text-secondary text-xs font-weight-bold">
                                                            Window Frame</p>
                                                        <p class="m-0 text-secondary text-xs font-weight-bold">
                                                            120 KG</p>
                                                        <p class="m-0 text-secondary text-xs font-weight-bold">
                                                            ALU</p>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge bg-gradient-info text-white text-xs font-weight-bold">RAL-344</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">Red
                                                            Color</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-secondary text-xs font-weight-bold">12
                                                            KG</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <!-- nested table -->

                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">03/11/2025</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">03/11/2025</span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <div class="d-flex gap-2 flex-column">

                                            <a href="jobcard-test.html"
                                                class="btn btn-outline-secondary px-3 py-2 rounded m-0">
                                                Test Again
                                            </a>

                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#testresultModal"
                                                class="btn btn-outline-primary px-3 py-2 rounded m-0">
                                                Test Result
                                            </button>
                                            <a href="test-result.html"
                                                class="btn btn-outline-success px-3 py-2 rounded m-0">
                                                Print Test Report
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- QC Test Result Modal -->
<div class="modal fade" id="testresultModal" tabindex="-1" aria-labelledby="testResultLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form class="modal-content shadow-lg border-0 rounded-3">
            <div class="modal-header">
                <h5 class="modal-title fw-semibold" id="testResultLabel">
                    <i class="fa fa-flask me-2"></i>QC Test Results
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%">#</th>
                                <th>Test Name</th>
                                <th>Observation</th>
                                <th>Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Cross Hatch Adhesion</td>
                                <td>GT0</td>
                                <td><span class="badge bg-success">PASS</span> – Excellent adhesion</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Pencil Hardness</td>
                                <td>2H</td>
                                <td><span class="badge bg-success">PASS</span> – Meets hardness criteria</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Impact Resistance</td>
                                <td>45 kg·cm</td>
                                <td><span class="badge bg-warning text-dark">ACCEPTABLE</span> – General powder
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Conical Mandrel Bend</td>
                                <td>No cracks or detachment</td>
                                <td><span class="badge bg-success">PASS</span></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Cupping Test</td>
                                <td>8 mm</td>
                                <td><span class="badge bg-success">PASS</span> – Meets Duracoat standard</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Gloss Measurement</td>
                                <td>Matt – 25 GU</td>
                                <td><span class="badge bg-success">PASS</span> – Within range</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fa fa-times me-1"></i>Close
                </button>
                <button type="button" class="btn btn-warning">
                    <i class="fa fa-download me-1"></i>Download
                </button>
            </div>
        </form>
    </div>
</div>

@endsection