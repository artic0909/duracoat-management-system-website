@extends('manager.layouts.app')

@section('title', '9 Tank Testing')

@section('content')

    <style>
        /* ===== Add Modal Custom Styles ===== */
        #addModal .modal-content {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.18);
        }

        #addModal .modal-header {
            background: linear-gradient(135deg, #1a1f5e 0%, #3a5bd9 60%, #5e88f5 100%);
            padding: 20px 28px;
            border-bottom: none;
        }

        #addModal .modal-header .modal-title {
            color: #fff;
            font-size: 1.15rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        #addModal .modal-header .modal-title i {
            font-size: 1rem;
            opacity: 0.85;
        }

        #addModal .modal-header .btn-close {
            filter: invert(1) brightness(2);
            opacity: 0.8;
        }

        #addModal .modal-header .badge-testing {
            background: rgba(255, 255, 255, 0.18);
            color: #fff;
            font-size: 0.7rem;
            padding: 4px 10px;
            border-radius: 20px;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        #addModal .modal-body {
            background: #f4f6fb;
            padding: 20px 24px;
            max-height: 68vh;
            overflow-y: auto;
        }

        #addModal .modal-body::-webkit-scrollbar {
            width: 5px;
        }

        #addModal .modal-body::-webkit-scrollbar-track {
            background: #e9ecf5;
        }

        #addModal .modal-body::-webkit-scrollbar-thumb {
            background: #b0bddf;
            border-radius: 10px;
        }

        /* --- Meta Info Row --- */
        #addModal .meta-section {
            background: #fff;
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 18px;
            box-shadow: 0 2px 8px rgba(58, 91, 217, 0.07);
            border-left: 4px solid #3a5bd9;
        }

        #addModal .meta-section label {
            font-size: 0.72rem;
            font-weight: 600;
            color: #6b7a99;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        #addModal .meta-section .form-control {
            font-size: 0.82rem;
            border-radius: 8px;
            border: 1.5px solid #dde3f0;
            padding: 7px 12px;
        }

        /* --- Tank Card --- */
        #addModal .tank-card {
            background: #fff;
            border-radius: 12px;
            padding: 16px 18px 14px 18px;
            margin-bottom: 14px;
            box-shadow: 0 2px 10px rgba(58, 91, 217, 0.06);
            border: 1.5px solid #eaedf5;
            transition: box-shadow 0.2s;
        }

        #addModal .tank-card:hover {
            box-shadow: 0 6px 22px rgba(58, 91, 217, 0.13);
            border-color: #c5d0f0;
        }

        #addModal .tank-card-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
            padding-bottom: 10px;
            border-bottom: 1.5px dashed #eaedf5;
        }

        #addModal .tank-number-badge {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3a5bd9, #5e88f5);
            color: #fff;
            font-size: 0.85rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 3px 8px rgba(58, 91, 217, 0.25);
        }

        #addModal .tank-title-text {
            font-size: 0.88rem;
            font-weight: 700;
            color: #232b4e;
            margin: 0;
            line-height: 1.2;
        }

        #addModal .tank-chemical-badge {
            margin-left: auto;
            background: #eef1fb;
            color: #3a5bd9;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
            border: 1px solid #d0d8f5;
            white-space: nowrap;
        }

        #addModal .tank-fields label {
            font-size: 0.7rem;
            font-weight: 600;
            color: #7a89b0;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 5px;
        }

        #addModal .tank-fields .form-control {
            font-size: 0.82rem;
            border-radius: 8px;
            border: 1.5px solid #dde3f0;
            padding: 7px 12px;
            background: #fff;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        #addModal .tank-fields .form-control:focus {
            border-color: #3a5bd9;
            box-shadow: 0 0 0 3px rgba(58, 91, 217, 0.1);
        }

        #addModal .tank-fields .form-control[readonly] {
            background: #f4f6fb;
            color: #8896bb;
            cursor: not-allowed;
        }

        #addModal .field-icon {
            position: relative;
        }

        #addModal .field-icon .form-control {
            padding-left: 34px;
        }

        #addModal .field-icon .fi {
            position: absolute;
            left: 11px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec8;
            font-size: 0.8rem;
        }

        /* --- Footer --- */
        #addModal .modal-footer {
            background: #fff;
            border-top: 1.5px solid #eaedf5;
            padding: 14px 24px;
        }

        #addModal .btn-submit-tests {
            background: linear-gradient(135deg, #3a5bd9, #5e88f5);
            border: none;
            color: #fff;
            font-weight: 700;
            font-size: 0.85rem;
            padding: 9px 28px;
            border-radius: 10px;
            letter-spacing: 0.4px;
            transition: opacity 0.2s, transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 4px 12px rgba(58, 91, 217, 0.25);
        }

        #addModal .btn-submit-tests:hover {
            opacity: 0.92;
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(58, 91, 217, 0.35);
        }

        #addModal .btn-close-modal {
            background: #f0f2f8;
            border: 1.5px solid #dde3f0;
            color: #6b7a99;
            font-weight: 600;
            font-size: 0.83rem;
            padding: 8px 22px;
            border-radius: 10px;
        }

        #addModal .btn-close-modal:hover {
            background: #e5e9f5;
            color: #3a5bd9;
        }

        #addModal .tanks-count-info {
            font-size: 0.75rem;
            color: #8896bb;
        }
    </style>



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
                        9 Tank Testings
                    </li>
                </ol>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
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
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
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
                                                    <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF"
                                                        fill-rule="nonzero">
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

    {{-- ===== Table Custom Styles ===== --}}
    <style>
        /* ===== 9-Tank Table Styles ===== */
        .ninetank-section {
            padding: 0 20px 20px 20px;
        }

        /* Card wrapper */
        .ninetank-card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(58, 91, 217, 0.10);
        }

        /* Card Header */
        .ninetank-card-header {
            background: linear-gradient(135deg, #1a1f5e 0%, #3a5bd9 60%, #5e88f5 100%);
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .ninetank-card-header .header-title {
            color: #fff;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 0.4px;
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 0;
        }

        .ninetank-card-header .header-title i {
            opacity: 0.85;
            font-size: 0.9rem;
        }

        .ninetank-card-header .header-meta {
            font-size: 0.72rem;
            color: rgba(255, 255, 255, 0.75);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .ninetank-card-header .header-count-badge {
            background: rgba(255, 255, 255, 0.18);
            color: #fff;
            font-size: 0.68rem;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
            letter-spacing: 0.4px;
        }

        /* Table head */
        .ninetank-table thead tr {
            background: #f4f6fb;
        }

        .ninetank-table thead th {
            font-size: 0.68rem !important;
            font-weight: 700 !important;
            text-transform: uppercase;
            letter-spacing: 0.55px;
            color: #5e6e9a !important;
            padding: 11px 14px !important;
            border-bottom: 2px solid #e5e9f5 !important;
            white-space: nowrap;
            background: #f4f6fb;
            opacity: 1 !important;
        }

        .ninetank-table tbody tr {
            border-bottom: 1px solid #eef1f8;
            transition: background 0.15s;
        }

        .ninetank-table tbody tr:hover {
            background: #f8f9fd;
        }

        .ninetank-table tbody td {
            padding: 12px 14px !important;
            vertical-align: middle;
        }

        /* SL Number badge */
        .sl-badge {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3a5bd9, #5e88f5);
            color: #fff;
            font-size: 0.78rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(58, 91, 217, 0.22);
        }

        /* Status pills */
        .status-pill {
            display: inline-block;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 3px 9px;
            border-radius: 20px;
            letter-spacing: 0.4px;
            margin-bottom: 3px;
        }

        .status-pill.pending {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffe08a;
        }

        .status-pill.pre-treat {
            background: #cff4fc;
            color: #055160;
            border: 1px solid #9eeaf9;
        }

        .status-pill.powder-applied {
            background: #dce7ff;
            color: #1d3a9e;
            border: 1px solid #b6caff;
        }

        .status-pill.delivered {
            background: #d1e7dd;
            color: #0a3622;
            border: 1px solid #a3cfbb;
        }

        /* Date cell */
        .date-cell {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.78rem;
            font-weight: 600;
            color: #3d4e7a;
        }

        .date-cell i {
            color: #8896bb;
            font-size: 0.72rem;
        }

        /* Jobcard cell */
        .jobcard-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #eef1fb;
            color: #3a5bd9;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 4px 11px;
            border-radius: 8px;
            border: 1px solid #d0d8f5;
        }

        /* Nested product table */
        .product-sub-table {
            border: none !important;
            margin: 0 !important;
        }

        .product-sub-table thead th {
            background: #eef1fb !important;
            color: #5e6e9a !important;
            font-size: 0.65rem !important;
            font-weight: 700 !important;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            padding: 7px 10px !important;
            border-bottom: 1.5px solid #dde3f0 !important;
            border-top: none !important;
            opacity: 1 !important;
        }

        .product-sub-table tbody td {
            font-size: 0.75rem;
            padding: 7px 10px !important;
            color: #4a5578;
            border-color: #eaedf5 !important;
        }

        .product-sub-table .material-name {
            font-weight: 700;
            color: #232b4e;
            font-size: 0.78rem;
        }

        .product-sub-table .material-meta {
            font-size: 0.68rem;
            color: #8896bb;
        }

        .ral-badge {
            background: linear-gradient(135deg, #3a5bd9, #5e88f5);
            color: #fff !important;
            font-size: 0.68rem;
            font-weight: 700;
            padding: 3px 9px;
            border-radius: 6px;
        }

        /* Action buttons */
        .btn-test-result {
            background: #eef1fb;
            border: 1.5px solid #d0d8f5;
            color: #3a5bd9;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 8px;
            white-space: nowrap;
            transition: background 0.15s, box-shadow 0.15s;
        }

        .btn-test-result:hover {
            background: #3a5bd9;
            color: #fff;
            box-shadow: 0 3px 10px rgba(58, 91, 217, 0.25);
        }

        .btn-print-report {
            background: #edfaf3;
            border: 1.5px solid #a3cfbb;
            color: #0a6641;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 8px;
            white-space: nowrap;
            transition: background 0.15s, box-shadow 0.15s;
        }

        .btn-print-report:hover {
            background: #198754;
            color: #fff;
            box-shadow: 0 3px 10px rgba(25, 135, 84, 0.22);
        }

        /* Two-row group header */
        .ninetank-table thead tr.group-header th {
            background: #eef1fb;
            color: #3a5bd9;
            font-size: 0.65rem !important;
            font-weight: 800 !important;
            text-align: center;
            padding: 6px 8px !important;
            border-bottom: 1px solid #dde3f0 !important;
            border-right: 2px solid #d0d8f5;
            white-space: nowrap;
            letter-spacing: 0.5px;
        }

        .ninetank-table thead tr.group-header th.tank-group-hd {
            position: relative;
        }

        .ninetank-table thead tr.sub-header th {
            background: #f4f6fb;
            font-size: 0.62rem !important;
            font-weight: 700 !important;
            color: #8896bb !important;
            text-transform: uppercase;
            padding: 6px 10px !important;
            white-space: nowrap;
            border-bottom: 2px solid #e5e9f5 !important;
        }

        .ninetank-table thead tr.sub-header th.border-tank {
            border-right: 2px solid #d0d8f5 !important;
        }

        /* Tank result badges inside the table */
        .tank-result-ok {
            display: inline-block;
            background: #d1fae5;
            color: #065f46;
            font-size: 0.62rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 12px;
            border: 1px solid #6ee7b7;
        }

        .tank-result-low {
            display: inline-block;
            background: #fef9c3;
            color: #854d0e;
            font-size: 0.62rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 12px;
            border: 1px solid #fde68a;
        }

        .tank-result-high {
            display: inline-block;
            background: #fee2e2;
            color: #991b1b;
            font-size: 0.62rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 12px;
            border: 1px solid #fca5a5;
        }

        .tank-val {
            font-size: 0.75rem;
            font-weight: 700;
            color: #232b4e;
        }

        .tank-chem-text {
            font-size: 0.68rem;
            color: #8896bb;
            font-weight: 600;
        }

        .tank-need-text {
            font-size: 0.72rem;
            font-weight: 700;
            color: #3a5bd9;
        }

        .tank-cell-border {
            border-right: 2px solid #eaedf5 !important;
        }

        .ninetank-table tbody td.tank-cell-border:last-of-type {
            border-right: 2px solid #d0d8f5 !important;
        }
    </style>

    <div class="container-fluid py-4 ninetank-section">
        <div class="row">
            <div class="col-12">
                {{-- Card with gradient header --}}
                <div class="ninetank-card mb-4">

                    {{-- Card Header --}}
                    <div class="ninetank-card-header">
                        <h6 class="header-title">
                            <i class="fas fa-flask"></i>
                            9-Tank Pre-Treatment Testing Records
                        </h6>
                        <div class="d-flex align-items-center gap-3">
                            <span class="header-meta">
                                <i class="fas fa-list"></i> Total Records:
                                <span class="header-count-badge">1</span>
                            </span>
                        </div>
                    </div>
                    {{-- Table --}}
                    <div class="table-responsive" style="background:#fff;">
                        <table class="table ninetank-table mb-0">
                            <thead>
                                {{-- Row 1: Group headers --}}
                                <tr class="group-header">
                                    {{-- Fixed info cols: rowspan --}}
                                    <th rowspan="2" style="vertical-align:middle; border-right:2px solid #d0d8f5;">SL</th>
                                    <th rowspan="2" style="vertical-align:middle; border-right:2px solid #d0d8f5;"><i
                                            class="fas fa-calendar-alt me-1"></i>Testing Date</th>

                                    {{-- Tank group headers --}}
                                    <th colspan="3" class="tank-group-hd text-center"><i class="fas fa-flask me-1"></i>Tank
                                        1 — Apdeg-60</th>
                                    <th colspan="3" class="tank-group-hd text-center"><i class="fas fa-flask me-1"></i>Tank
                                        2 — Water</th>
                                    <th colspan="3" class="tank-group-hd text-center"><i class="fas fa-flask me-1"></i>Tank
                                        3 — Aprust-21</th>
                                    <th colspan="3" class="tank-group-hd text-center"><i class="fas fa-flask me-1"></i>Tank
                                        4 — Water</th>
                                    <th colspan="3" class="tank-group-hd text-center"><i class="fas fa-flask me-1"></i>Tank
                                        5 — S-101</th>
                                    <th colspan="3" class="tank-group-hd text-center"><i class="fas fa-flask me-1"></i>Tank
                                        6 — Act-505</th>
                                    <th colspan="3" class="tank-group-hd text-center"><i class="fas fa-flask me-1"></i>Tank
                                        7 — Aphox-ZC</th>
                                    <th colspan="3" class="tank-group-hd text-center"><i class="fas fa-flask me-1"></i>Tank
                                        8 — Water</th>
                                    <th colspan="3" class="tank-group-hd text-center" style="border-right:none;"><i
                                            class="fas fa-flask me-1"></i>Tank 9 — Passeal-1</th>
                                    <th rowspan="2" style="vertical-align:middle; border-left:2px solid #d0d8f5;"><i
                                            class="fas fa-bolt me-1"></i>Actions</th>
                                </tr>
                                {{-- Row 2: Sub-headers for each tank --}}
                                <tr class="sub-header">
                                    {{-- T1 --}}
                                    <th>Value (ml)</th>
                                    <th>Result</th>
                                    <th class="border-tank">Need (kg)</th>
                                    {{-- T2 --}}
                                    <th>Value (ph)</th>
                                    <th>Result</th>
                                    <th class="border-tank">Need Attn</th>
                                    {{-- T3 --}}
                                    <th>Value (ml)</th>
                                    <th>Result</th>
                                    <th class="border-tank">Need (kg)</th>
                                    {{-- T4 --}}
                                    <th>Value (ph)</th>
                                    <th>Result</th>
                                    <th class="border-tank">Need Attn</th>
                                    {{-- T5 --}}
                                    <th>Value (ph)</th>
                                    <th>Result</th>
                                    <th class="border-tank">Need Attn</th>
                                    {{-- T6 --}}
                                    <th>Value (ph)</th>
                                    <th>Result</th>
                                    <th class="border-tank">Need Attn</th>
                                    {{-- T7 --}}
                                    <th>Value (ml)</th>
                                    <th>Result</th>
                                    <th class="border-tank">Need (kg)</th>
                                    {{-- T8 --}}
                                    <th>Value (ph)</th>
                                    <th>Result</th>
                                    <th class="border-tank">Need Attn</th>
                                    {{-- T9 --}}
                                    <th>Value (ph)</th>
                                    <th>Result</th>
                                    <th>Need Attn</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    {{-- SL --}}
                                    <td style="border-right:2px solid #eaedf5;">
                                        <div class="sl-badge">1</div>
                                    </td>

                                    {{-- Testing Date --}}
                                    <td style="border-right:2px solid #eaedf5;">
                                        <div class="date-cell">
                                            <i class="fas fa-calendar-alt"></i> 03/11/2025
                                        </div>
                                    </td>

                                    {{-- ===== Tank 1 (Apdeg-60) ===== --}}
                                    <td><span class="tank-val">14.5 ml</span></td>
                                    <td><span class="tank-result-ok">OK</span></td>
                                    <td class="tank-cell-border"><span class="tank-need-text">2.3 kg</span></td>

                                    {{-- ===== Tank 2 (Water) ===== --}}
                                    <td><span class="tank-val">7.2 ph</span></td>
                                    <td><span class="tank-result-ok">OK</span></td>
                                    <td class="tank-cell-border"><span class="tank-need-text">—</span></td>

                                    {{-- ===== Tank 3 (Aprust-21) ===== --}}
                                    <td><span class="tank-val">18.0 ml</span></td>
                                    <td><span class="tank-result-low">Low</span></td>
                                    <td class="tank-cell-border"><span class="tank-need-text">3.1 kg</span></td>

                                    {{-- ===== Tank 4 (Water) ===== --}}
                                    <td><span class="tank-val">6.8 ph</span></td>
                                    <td><span class="tank-result-ok">OK</span></td>
                                    <td class="tank-cell-border"><span class="tank-need-text">—</span></td>

                                    {{-- ===== Tank 5 (S-101) ===== --}}
                                    <td><span class="tank-val">8.5 ph</span></td>
                                    <td><span class="tank-result-high">High</span></td>
                                    <td class="tank-cell-border"><span class="tank-need-text">Check</span></td>

                                    {{-- ===== Tank 6 (Act-505) ===== --}}
                                    <td><span class="tank-val">5.4 ph</span></td>
                                    <td><span class="tank-result-ok">OK</span></td>
                                    <td class="tank-cell-border"><span class="tank-need-text">—</span></td>

                                    {{-- ===== Tank 7 (Aphox-ZC) ===== --}}
                                    <td><span class="tank-val">22.0 ml</span></td>
                                    <td><span class="tank-result-ok">OK</span></td>
                                    <td class="tank-cell-border"><span class="tank-need-text">1.8 kg</span></td>

                                    {{-- ===== Tank 8 (Water) ===== --}}
                                    <td><span class="tank-val">7.0 ph</span></td>
                                    <td><span class="tank-result-ok">OK</span></td>
                                    <td class="tank-cell-border"><span class="tank-need-text">—</span></td>

                                    {{-- ===== Tank 9 (Passeal-1) ===== --}}
                                    <td><span class="tank-val">4.1 ph</span></td>
                                    <td><span class="tank-result-low">Low</span></td>
                                    <td><span class="tank-need-text">Check</span></td>

                                    {{-- Actions --}}
                                    <td style="border-left:2px solid #d0d8f5;">
                                        <div class="d-flex flex-column gap-2">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#testresultModal"
                                                class="btn btn-test-result">
                                                <i class="fas fa-vial me-1"></i> Test Result
                                            </button>
                                            <a href="test-result.html" class="btn btn-print-report">
                                                <i class="fas fa-print me-1"></i> Print Report
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Card Footer --}}
                    <div
                        style="background:#f4f6fb; padding: 10px 20px; border-top: 1.5px solid #eaedf5; font-size:0.72rem; color:#8896bb;">
                        <i class="fas fa-info-circle me-1"></i>
                        Showing 1 of 1 records &bull; 9-Tank Pre-Treatment Testing Module
                    </div>

                </div>
            </div>
        </div>
    </div>



    <!-- Add Button -->
    <button type="button" class="btn btn-primary addFixedModalButton" data-bs-toggle="modal" data-bs-target="#addModal">
        <i class="fa fa-plus"></i>
    </button>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <form class="modal-content" method="POST" action="">
                @csrf

                {{-- ===== Modal Header ===== --}}
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">
                        <i class="fas fa-flask"></i>
                        9-Tank Pre-Treatment Testing
                        <span class="badge-testing ms-2">New Entry</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                {{-- ===== Modal Body ===== --}}
                <div class="modal-body">
                    {{-- Tank 1 --}}
                    <div class="tank-card">
                        <div class="tank-card-header">
                            <div class="tank-number-badge">1</div>
                            <p class="tank-title-text">Tank 1 <span class="text-muted fw-normal"
                                    style="font-size:0.75rem;">— De-greasing</span></p>
                            <span class="tank-chemical-badge"><i class="fas fa-atom me-1"></i> Apdeg-60</span>
                        </div>
                        <div class="row g-3 tank-fields">
                            <div class="col-md-3">
                                <label>Chemical Name</label>
                                <div class="field-icon">
                                    <i class="fas fa-vial fi"></i>
                                    <input type="text" name="t1_chemical_name" value="Apdeg-60" class="form-control"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Testing Value (ml)</label>
                                <div class="field-icon">
                                    <i class="fas fa-tint fi"></i>
                                    <input type="text" name="t1_testing_value" placeholder="Enter value"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Result</label>
                                <div class="field-icon">
                                    <i class="fas fa-check-circle fi"></i>
                                    <input type="text" name="t1_result" class="form-control" readonly
                                        placeholder="Auto-calculated">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Need Chemical (kg)</label>
                                <div class="field-icon">
                                    <i class="fas fa-weight fi"></i>
                                    <input type="text" name="t1_need_chemical" class="form-control" readonly
                                        placeholder="Auto-calculated">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tank 2 --}}
                    <div class="tank-card">
                        <div class="tank-card-header">
                            <div class="tank-number-badge">2</div>
                            <p class="tank-title-text">Tank 2 <span class="text-muted fw-normal"
                                    style="font-size:0.75rem;">— Rinse Water</span></p>
                            <span class="tank-chemical-badge"><i class="fas fa-atom me-1"></i> Water</span>
                        </div>
                        <div class="row g-3 tank-fields">
                            <div class="col-md-3">
                                <label>Chemical Name</label>
                                <div class="field-icon">
                                    <i class="fas fa-vial fi"></i>
                                    <input type="text" name="t2_chemical_name" value="Water" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Testing Value (ph)</label>
                                <div class="field-icon">
                                    <i class="fas fa-tint fi"></i>
                                    <input type="text" name="t2_testing_value" placeholder="Enter value"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Result</label>
                                <div class="field-icon">
                                    <i class="fas fa-check-circle fi"></i>
                                    <input type="text" name="t2_result" class="form-control" readonly
                                        placeholder="Auto-calculated">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Need Attention</label>
                                <div class="field-icon">
                                    <i class="fas fa-exclamation-circle fi"></i>
                                    <input type="text" name="t2_need_attention" class="form-control" readonly
                                        placeholder="Auto-calculated">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tank 3 --}}
                    <div class="tank-card">
                        <div class="tank-card-header">
                            <div class="tank-number-badge">3</div>
                            <p class="tank-title-text">Tank 3 <span class="text-muted fw-normal"
                                    style="font-size:0.75rem;">— Rust Remover</span></p>
                            <span class="tank-chemical-badge"><i class="fas fa-atom me-1"></i> Aprust-21</span>
                        </div>
                        <div class="row g-3 tank-fields">
                            <div class="col-md-3">
                                <label>Chemical Name</label>
                                <div class="field-icon">
                                    <i class="fas fa-vial fi"></i>
                                    <input type="text" name="t3_chemical_name" value="Aprust-21" class="form-control"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Testing Value (ml)</label>
                                <div class="field-icon">
                                    <i class="fas fa-tint fi"></i>
                                    <input type="text" name="t3_testing_value" placeholder="Enter value"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Result</label>
                                <div class="field-icon">
                                    <i class="fas fa-check-circle fi"></i>
                                    <input type="text" name="t3_result" class="form-control" readonly
                                        placeholder="Auto-calculated">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Need Chemical (kg)</label>
                                <div class="field-icon">
                                    <i class="fas fa-weight fi"></i>
                                    <input type="text" name="t3_need_chemical" class="form-control" readonly
                                        placeholder="Auto-calculated">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tank 4 --}}
                    <div class="tank-card">
                        <div class="tank-card-header">
                            <div class="tank-number-badge">4</div>
                            <p class="tank-title-text">Tank 4 <span class="text-muted fw-normal"
                                    style="font-size:0.75rem;">— Rinse Water</span></p>
                            <span class="tank-chemical-badge"><i class="fas fa-atom me-1"></i> Water</span>
                        </div>
                        <div class="row g-3 tank-fields">
                            <div class="col-md-3">
                                <label>Chemical Name</label>
                                <div class="field-icon">
                                    <i class="fas fa-vial fi"></i>
                                    <input type="text" name="t4_chemical_name" value="Water" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Testing Value (ph)</label>
                                <div class="field-icon">
                                    <i class="fas fa-tint fi"></i>
                                    <input type="text" name="t4_testing_value" placeholder="Enter value"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Result</label>
                                <div class="field-icon">
                                    <i class="fas fa-check-circle fi"></i>
                                    <input type="text" name="t4_result" class="form-control" readonly
                                        placeholder="Auto-calculated">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Need Attention</label>
                                <div class="field-icon">
                                    <i class="fas fa-exclamation-circle fi"></i>
                                    <input type="text" name="t4_need_attention" class="form-control" readonly
                                        placeholder="Auto-calculated">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tank 5 --}}
                    <div class="tank-card">
                        <div class="tank-card-header">
                            <div class="tank-number-badge">5</div>
                            <p class="tank-title-text">Tank 5 <span class="text-muted fw-normal"
                                    style="font-size:0.75rem;">— Surface Treatment</span></p>
                            <span class="tank-chemical-badge"><i class="fas fa-atom me-1"></i> S-101</span>
                        </div>
                        <div class="row g-3 tank-fields">
                            <div class="col-md-3">
                                <label>Chemical Name</label>
                                <div class="field-icon">
                                    <i class="fas fa-vial fi"></i>
                                    <input type="text" name="t5_chemical_name" value="S-101" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Testing Value (ph)</label>
                                <div class="field-icon">
                                    <i class="fas fa-tint fi"></i>
                                    <input type="text" name="t5_testing_value" placeholder="Enter value"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Result</label>
                                <div class="field-icon">
                                    <i class="fas fa-check-circle fi"></i>
                                    <input type="text" name="t5_result" class="form-control" readonly
                                        placeholder="Auto-calculated">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Need Attention</label>
                                <div class="field-icon">
                                    <i class="fas fa-exclamation-circle fi"></i>
                                    <input type="text" name="t5_need_attention" class="form-control" readonly
                                        placeholder="Auto-calculated">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tank 6 --}}
                    <div class="tank-card">
                        <div class="tank-card-header">
                            <div class="tank-number-badge">6</div>
                            <p class="tank-title-text">Tank 6 <span class="text-muted fw-normal"
                                    style="font-size:0.75rem;">— Activator</span></p>
                            <span class="tank-chemical-badge"><i class="fas fa-atom me-1"></i> Act-505</span>
                        </div>
                        <div class="row g-3 tank-fields">
                            <div class="col-md-3">
                                <label>Chemical Name</label>
                                <div class="field-icon">
                                    <i class="fas fa-vial fi"></i>
                                    <input type="text" name="t6_chemical_name" value="Act-505" class="form-control"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Testing Value (ph)</label>
                                <div class="field-icon">
                                    <i class="fas fa-tint fi"></i>
                                    <input type="text" name="t6_testing_value" placeholder="Enter value"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Result</label>
                                <div class="field-icon">
                                    <i class="fas fa-check-circle fi"></i>
                                    <input type="text" name="t6_result" class="form-control" readonly
                                        placeholder="Auto-calculated">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Need Attention</label>
                                <div class="field-icon">
                                    <i class="fas fa-exclamation-circle fi"></i>
                                    <input type="text" name="t6_need_attention" class="form-control" readonly
                                        placeholder="Auto-calculated">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tank 7 --}}
                    <div class="tank-card">
                        <div class="tank-card-header">
                            <div class="tank-number-badge">7</div>
                            <p class="tank-title-text">Tank 7 <span class="text-muted fw-normal"
                                    style="font-size:0.75rem;">— Phosphating</span></p>
                            <span class="tank-chemical-badge"><i class="fas fa-atom me-1"></i> Aphox-ZC</span>
                        </div>
                        <div class="row g-3 tank-fields">
                            <div class="col-md-3">
                                <label>Chemical Name</label>
                                <div class="field-icon">
                                    <i class="fas fa-vial fi"></i>
                                    <input type="text" name="t7_chemical_name" value="Aphox-ZC" class="form-control"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Testing Value (ml)</label>
                                <div class="field-icon">
                                    <i class="fas fa-tint fi"></i>
                                    <input type="text" name="t7_testing_value" placeholder="Enter value"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Result</label>
                                <div class="field-icon">
                                    <i class="fas fa-check-circle fi"></i>
                                    <input type="text" name="t7_result" class="form-control" readonly
                                        placeholder="Auto-calculated">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Need Chemical (kg)</label>
                                <div class="field-icon">
                                    <i class="fas fa-weight fi"></i>
                                    <input type="text" name="t7_need_chemical" class="form-control" readonly
                                        placeholder="Auto-calculated">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tank 8 --}}
                    <div class="tank-card">
                        <div class="tank-card-header">
                            <div class="tank-number-badge">8</div>
                            <p class="tank-title-text">Tank 8 <span class="text-muted fw-normal"
                                    style="font-size:0.75rem;">— Rinse Water</span></p>
                            <span class="tank-chemical-badge"><i class="fas fa-atom me-1"></i> Water</span>
                        </div>
                        <div class="row g-3 tank-fields">
                            <div class="col-md-3">
                                <label>Chemical Name</label>
                                <div class="field-icon">
                                    <i class="fas fa-vial fi"></i>
                                    <input type="text" name="t8_chemical_name" value="Water" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Testing Value (ph)</label>
                                <div class="field-icon">
                                    <i class="fas fa-tint fi"></i>
                                    <input type="text" name="t8_testing_value" placeholder="Enter value"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Result</label>
                                <div class="field-icon">
                                    <i class="fas fa-check-circle fi"></i>
                                    <input type="text" name="t8_result" class="form-control" readonly
                                        placeholder="Auto-calculated">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Need Attention</label>
                                <div class="field-icon">
                                    <i class="fas fa-exclamation-circle fi"></i>
                                    <input type="text" name="t8_need_attention" class="form-control" readonly
                                        placeholder="Auto-calculated">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tank 9 --}}
                    <div class="tank-card" style="margin-bottom: 4px;">
                        <div class="tank-card-header">
                            <div class="tank-number-badge">9</div>
                            <p class="tank-title-text">Tank 9 <span class="text-muted fw-normal"
                                    style="font-size:0.75rem;">— Passivation</span></p>
                            <span class="tank-chemical-badge"><i class="fas fa-atom me-1"></i> Passeal-1</span>
                        </div>
                        <div class="row g-3 tank-fields">
                            <div class="col-md-3">
                                <label>Chemical Name</label>
                                <div class="field-icon">
                                    <i class="fas fa-vial fi"></i>
                                    <input type="text" name="t9_chemical_name" value="Passeal-1" class="form-control"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Testing Value (ph)</label>
                                <div class="field-icon">
                                    <i class="fas fa-tint fi"></i>
                                    <input type="text" name="t9_testing_value" placeholder="Enter value"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Result</label>
                                <div class="field-icon">
                                    <i class="fas fa-check-circle fi"></i>
                                    <input type="text" name="t9_result" class="form-control" readonly
                                        placeholder="Auto-calculated">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Need Attention</label>
                                <div class="field-icon">
                                    <i class="fas fa-exclamation-circle fi"></i>
                                    <input type="text" name="t9_need_attention" class="form-control" readonly
                                        placeholder="Auto-calculated">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>{{-- end modal-body --}}

                {{-- ===== Modal Footer ===== --}}
                <div class="modal-footer justify-content-between">
                    <span class="tanks-count-info"><i class="fas fa-info-circle me-1"></i> 9 tanks configured &bull; Fill
                        testing values to submit</span>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-close-modal" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-submit-tests">
                            <i class="fas fa-paper-plane me-1"></i> Submit Tests
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection