@extends('viewer.layouts.app')

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



    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm">
                        <a class="opacity-5 text-dark" href="javascript:;">Viewer</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
                        9 Tank Testing
                    </li>
                </ol>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
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
                                <a class="dropdown-item border-radius-md" href="{{ route('viewer.profile') }}">
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
                                <a class="dropdown-item border-radius-md" href="{{ route('viewer.logout') }}">
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

    {{-- ===== Extra table styles for filter bar & pagination ===== --}}
    <style>
        /* Filter bar */
        .filter-bar {
            padding: 12px 24px;
            background: #f4f6fb;
            border-bottom: 1.5px solid #eaedf5;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .filter-bar label {
            font-size: 0.72rem;
            font-weight: 700;
            color: #5e6e9a;
            margin-bottom: 0;
            white-space: nowrap;
        }

        .filter-bar .form-control-sm {
            font-size: 0.72rem;
            border: 1.5px solid #dde3f0;
            border-radius: 8px;
            padding: 4px 9px;
            color: #232b4e;
        }

        .filter-bar .btn-filter {
            background: linear-gradient(135deg, #3a5bd9, #5e88f5);
            color: #fff;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 5px 14px;
            border-radius: 8px;
            border: none;
            white-space: nowrap;
        }

        .filter-bar .btn-filter-reset {
            background: #fff;
            color: #5e6e9a;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 8px;
            border: 1.5px solid #dde3f0;
            white-space: nowrap;
        }

        /* Result badge (dynamic) */
        .res-pass {
            display: inline-block;
            background: #d1fae5;
            color: #065f46;
            font-size: 0.62rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 12px;
            border: 1px solid #6ee7b7;
        }

        .res-failed {
            display: inline-block;
            background: #fee2e2;
            color: #991b1b;
            font-size: 0.62rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 12px;
            border: 1px solid #fca5a5;
        }

        /* Need text (High/Low/etc.) */
        .need-ok {
            font-size: 0.72rem;
            font-weight: 700;
            color: #065f46;
        }

        .need-high {
            font-size: 0.72rem;
            font-weight: 700;
            color: #991b1b;
        }

        .need-low {
            font-size: 0.72rem;
            font-weight: 700;
            color: #854d0e;
        }

        .need-warn {
            font-size: 0.72rem;
            font-weight: 700;
            color: #b45309;
        }

        /* Pagination */
        .ninetank-pagination {
            padding: 10px 20px;
            background: #f4f6fb;
            border-top: 1.5px solid #eaedf5;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 8px;
        }

        .ninetank-pagination .pagination {
            margin: 0;
        }

        .ninetank-pagination .page-link {
            font-size: 0.72rem;
            font-weight: 600;
            color: #3a5bd9;
            border: 1.5px solid #d0d8f5;
            padding: 4px 10px;
            border-radius: 6px !important;
            margin: 0 2px;
        }

        .ninetank-pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #3a5bd9, #5e88f5);
            border-color: #3a5bd9;
            color: #fff;
        }

        .ninetank-pagination .page-item.disabled .page-link {
            color: #aab4cc;
            border-color: #eaedf5;
        }

        .ninetank-pagination .pagination-info {
            font-size: 0.72rem;
            color: #8896bb;
        }
    </style>

    <div class="container-fluid py-4 ninetank-section">
        <div class="row">
            <div class="col-12">
                <div class="ninetank-card mb-4">

                    {{-- Card Header --}}
                    <div class="ninetank-card-header">
                        <h6 class="header-title">
                            <i class="fas fa-flask"></i>
                            9-Tank Chemical Pre-Treatment Testing Records
                        </h6>
                        <div class="d-flex align-items-center gap-3">
                            <span class="header-meta">
                                <i class="fas fa-list"></i> Total Records:
                                <span class="header-count-badge">{{ $records->total() }}</span>
                            </span>
                        </div>
                    </div>

                    {{-- Date Filter Bar --}}
                    <form method="GET" action="{{ route('viewer.ninetank-testing') }}" class="filter-bar">
                        <label><i class="fas fa-calendar-alt me-1"></i>From:</label>
                        <input type="date" name="from_date" class="form-control form-control-sm"
                            value="{{ request('from_date') }}" style="width:140px;">
                        <label>To:</label>
                        <input type="date" name="to_date" class="form-control form-control-sm"
                            value="{{ request('to_date') }}" style="width:140px;">
                        <button type="submit" class="btn btn-filter">
                            <i class="fas fa-search me-1"></i>Filter
                        </button>
                        @if(request('from_date') || request('to_date'))
                            <a href="{{ route('viewer.ninetank-testing') }}" class="btn btn-filter-reset">
                                <i class="fas fa-times me-1"></i>Clear
                            </a>
                        @endif
                    </form>

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
                                @forelse($records as $index => $rec)
                                    @php
                                        $sl = ($records->currentPage() - 1) * $records->perPage() + $index + 1;
                                        $rc = fn($v) => strtolower($v ?? '') === 'pass' ? 'res-pass' : 'res-failed';
                                        $nc = function ($v) {
                                            $l = strtolower($v ?? '');
                                            if ($l === 'pass' || str_contains($l, 'no need'))
                                                return 'need-ok';
                                            if ($l === 'high')
                                                return 'need-high';
                                            if ($l === 'low')
                                                return 'need-low';
                                            return 'need-warn';
                                        };
                                    @endphp
                                    <tr>
                                        <td style="border-right:2px solid #eaedf5;">
                                            <div class="sl-badge">{{ $sl }}</div>
                                        </td>
                                        <td style="border-right:2px solid #eaedf5;">
                                            <div class="date-cell">
                                                <i class="fas fa-calendar-alt"></i>
                                                {{ \Carbon\Carbon::parse($rec->testing_date)->format('d/m/Y') }}
                                            </div>
                                        </td>
                                        {{-- Tank 1 --}}
                                        <td><span class="tank-val">{{ $rec->t1_testing_value ?? '—' }} ml</span></td>
                                        <td><span class="{{ $rc($rec->t1_result) }}">{{ $rec->t1_result ?? '—' }}</span></td>
                                        <td class="tank-cell-border"><span
                                                class="{{ $nc($rec->t1_need_chemical) }}">{{ $rec->t1_need_chemical ?? '—' }}</span>
                                        </td>
                                        {{-- Tank 2 --}}
                                        <td><span class="tank-val">{{ $rec->t2_testing_value ?? '—' }} ph</span></td>
                                        <td><span class="{{ $rc($rec->t2_result) }}">{{ $rec->t2_result ?? '—' }}</span></td>
                                        <td class="tank-cell-border"><span
                                                class="{{ $nc($rec->t2_need_attention) }}">{{ $rec->t2_need_attention ?? '—' }}</span>
                                        </td>
                                        {{-- Tank 3 --}}
                                        <td><span class="tank-val">{{ $rec->t3_testing_value ?? '—' }} ml</span></td>
                                        <td><span class="{{ $rc($rec->t3_result) }}">{{ $rec->t3_result ?? '—' }}</span></td>
                                        <td class="tank-cell-border"><span
                                                class="{{ $nc($rec->t3_need_chemical) }}">{{ $rec->t3_need_chemical ?? '—' }}</span>
                                        </td>
                                        {{-- Tank 4 --}}
                                        <td><span class="tank-val">{{ $rec->t4_testing_value ?? '—' }} ph</span></td>
                                        <td><span class="{{ $rc($rec->t4_result) }}">{{ $rec->t4_result ?? '—' }}</span></td>
                                        <td class="tank-cell-border"><span
                                                class="{{ $nc($rec->t4_need_attention) }}">{{ $rec->t4_need_attention ?? '—' }}</span>
                                        </td>
                                        {{-- Tank 5 --}}
                                        <td><span class="tank-val">{{ $rec->t5_testing_value ?? '—' }} ph</span></td>
                                        <td><span class="{{ $rc($rec->t5_result) }}">{{ $rec->t5_result ?? '—' }}</span></td>
                                        <td class="tank-cell-border"><span
                                                class="{{ $nc($rec->t5_need_attention) }}">{{ $rec->t5_need_attention ?? '—' }}</span>
                                        </td>
                                        {{-- Tank 6 --}}
                                        <td><span class="tank-val">{{ $rec->t6_testing_value ?? '—' }} ph</span></td>
                                        <td><span class="{{ $rc($rec->t6_result) }}">{{ $rec->t6_result ?? '—' }}</span></td>
                                        <td class="tank-cell-border"><span
                                                class="{{ $nc($rec->t6_need_attention) }}">{{ $rec->t6_need_attention ?? '—' }}</span>
                                        </td>
                                        {{-- Tank 7 --}}
                                        <td><span class="tank-val">{{ $rec->t7_testing_value ?? '—' }} ml</span></td>
                                        <td><span class="{{ $rc($rec->t7_result) }}">{{ $rec->t7_result ?? '—' }}</span></td>
                                        <td class="tank-cell-border"><span
                                                class="{{ $nc($rec->t7_need_chemical) }}">{{ $rec->t7_need_chemical ?? '—' }}</span>
                                        </td>
                                        {{-- Tank 8 --}}
                                        <td><span class="tank-val">{{ $rec->t8_testing_value ?? '—' }} ph</span></td>
                                        <td><span class="{{ $rc($rec->t8_result) }}">{{ $rec->t8_result ?? '—' }}</span></td>
                                        <td class="tank-cell-border"><span
                                                class="{{ $nc($rec->t8_need_attention) }}">{{ $rec->t8_need_attention ?? '—' }}</span>
                                        </td>
                                        {{-- Tank 9 --}}
                                        <td><span class="tank-val">{{ $rec->t9_testing_value ?? '—' }} ph</span></td>
                                        <td><span class="{{ $rc($rec->t9_result) }}">{{ $rec->t9_result ?? '—' }}</span></td>
                                        <td><span
                                                class="{{ $nc($rec->t9_need_attention) }}">{{ $rec->t9_need_attention ?? '—' }}</span>
                                        </td>
                                        {{-- Actions --}}
                                        <td style="border-left:2px solid #d0d8f5;">
                                            <div class="d-flex flex-column gap-1">

                                                {{-- View Result --}}
                                                <button type="button" class="btn btn-test-result btn-view-result"
                                                    data-date="{{ \Carbon\Carbon::parse($rec->testing_date)->format('d/m/Y') }}"
                                                    data-t1-val="{{ $rec->t1_testing_value }} ml"
                                                    data-t1-res="{{ $rec->t1_result }}"
                                                    data-t1-need="{{ $rec->t1_need_chemical }}"
                                                    data-t2-val="{{ $rec->t2_testing_value }} ph"
                                                    data-t2-res="{{ $rec->t2_result }}"
                                                    data-t2-need="{{ $rec->t2_need_attention }}"
                                                    data-t3-val="{{ $rec->t3_testing_value }} ml"
                                                    data-t3-res="{{ $rec->t3_result }}"
                                                    data-t3-need="{{ $rec->t3_need_chemical }}"
                                                    data-t4-val="{{ $rec->t4_testing_value }} ph"
                                                    data-t4-res="{{ $rec->t4_result }}"
                                                    data-t4-need="{{ $rec->t4_need_attention }}"
                                                    data-t5-val="{{ $rec->t5_testing_value }} ph"
                                                    data-t5-res="{{ $rec->t5_result }}"
                                                    data-t5-need="{{ $rec->t5_need_attention }}"
                                                    data-t6-val="{{ $rec->t6_testing_value }} ph"
                                                    data-t6-res="{{ $rec->t6_result }}"
                                                    data-t6-need="{{ $rec->t6_need_attention }}"
                                                    data-t7-val="{{ $rec->t7_testing_value }} ml"
                                                    data-t7-res="{{ $rec->t7_result }}"
                                                    data-t7-need="{{ $rec->t7_need_chemical }}"
                                                    data-t8-val="{{ $rec->t8_testing_value }} ph"
                                                    data-t8-res="{{ $rec->t8_result }}"
                                                    data-t8-need="{{ $rec->t8_need_attention }}"
                                                    data-t9-val="{{ $rec->t9_testing_value }} ph"
                                                    data-t9-res="{{ $rec->t9_result }}"
                                                    data-t9-need="{{ $rec->t9_need_attention }}" data-bs-toggle="modal"
                                                    data-bs-target="#viewResultModal">
                                                    <i class="fas fa-vial me-1"></i> Test Result
                                                </button>

                                                {{-- Print Report --}}
                                                <a href="{{ route('viewer.ninetank-testing.print', $rec->id) }}"
                                                    target="_blank" class="btn btn-print-report">
                                                    <i class="fas fa-print me-1"></i> Print Report
                                                </a>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="30" class="text-center py-4" style="color:#8896bb; font-size:0.82rem;">
                                            <i class="fas fa-flask me-2 opacity-50"></i>
                                            No testing records found.
                                            @if(request('from_date') || request('to_date'))
                                                <a href="{{ route('viewer.ninetank-testing') }}" class="ms-2"
                                                    style="color:#3a5bd9;font-weight:700;">Clear filter</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination + Info Footer --}}
                    <div class="ninetank-pagination">
                        <span class="pagination-info">
                            <i class="fas fa-info-circle me-1"></i>
                            Showing {{ $records->firstItem() ?? 0 }}–{{ $records->lastItem() ?? 0 }}
                            of {{ $records->total() }} records
                            &bull; 9-Tank Pre-Treatment Testing Module
                        </span>
                        {{ $records->links() }}
                    </div>

                </div>
            </div>
        </div>
        {{-- ======= View Result Modal ======= --}}
        <style>
            .btn-delete-9tank {
                background: #fff0f0;
                color: #b91c1c;
                border: 1.5px solid #fca5a5;
                font-size: 0.72rem;
                font-weight: 700;
                border-radius: 8px;
                padding: 5px 10px;
                transition: all 0.2s;
            }

            .btn-delete-9tank:hover {
                background: #fee2e2;
                color: #991b1b;
                border-color: #f87171;
            }

            #viewResultModal .modal-header {
                background: linear-gradient(135deg, #1e3a8a, #3a5bd9);
                color: #fff;
                border-radius: 14px 14px 0 0;
                padding: 14px 22px;
            }

            #viewResultModal .modal-title {
                font-size: 0.95rem;
                font-weight: 800;
                color: white;
            }

            #viewResultModal .btn-close {
                filter: invert(1);
            }

            #viewResultModal .modal-body {
                background: #f4f6fb;
                padding: 20px;
            }

            #viewResultModal .vr-date-badge {
                display: inline-block;
                background: #e0e7ff;
                color: #3a5bd9;
                font-size: 0.75rem;
                font-weight: 700;
                padding: 3px 12px;
                border-radius: 20px;
                margin-bottom: 14px;
            }

            #viewResultModal table.vr-table {
                background: #fff;
                border-radius: 10px;
                overflow: hidden;
                font-size: 0.78rem;
            }

            #viewResultModal table.vr-table thead th {
                background: #eef1fb;
                color: #3a5bd9;
                font-size: 0.68rem;
                font-weight: 800;
                text-transform: uppercase;
                padding: 8px 12px;
            }

            #viewResultModal table.vr-table tbody td {
                padding: 7px 12px;
                vertical-align: middle;
                border-bottom: 1px solid #eaedf5;
            }

            .vr-res-pass {
                display: inline-block;
                background: #d1fae5;
                color: #065f46;
                font-size: 0.63rem;
                font-weight: 700;
                padding: 2px 10px;
                border-radius: 12px;
                border: 1px solid #6ee7b7;
            }

            .vr-res-failed {
                display: inline-block;
                background: #fee2e2;
                color: #991b1b;
                font-size: 0.63rem;
                font-weight: 700;
                padding: 2px 10px;
                border-radius: 12px;
                border: 1px solid #fca5a5;
            }

            .vr-need-ok {
                color: #065f46;
                font-weight: 700;
            }

            .vr-need-high {
                color: #991b1b;
                font-weight: 700;
            }

            .vr-need-low {
                color: #854d0e;
                font-weight: 700;
            }

            .vr-need-warn {
                color: #b45309;
                font-weight: 700;
            }
        </style>

        <div class="modal fade" id="viewResultModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content" style="border-radius:14px;overflow:hidden;">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fas fa-flask me-2"></i> 9-Tank Test Result
                            <span id="vr-date-label" class="ms-2 vr-date-badge"></span>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table vr-table mb-0">
                            <thead>
                                <tr>
                                    <th>Tank</th>
                                    <th>Chemical</th>
                                    <th>Testing Value</th>
                                    <th>Result</th>
                                    <th>Need Chemical / Attention</th>
                                </tr>
                            </thead>
                            <tbody id="vr-tbody"></tbody>
                        </table>
                    </div>
                    <div class="modal-footer" style="background:#f4f6fb;border-top:1.5px solid #eaedf5;">
                        <button type="button" class="btn btn-close-modal" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            (function () {
                var TANKS = [
                    { label: 'Tank 1 — Apdeg-60', v: 't1Val', r: 't1Res', n: 't1Need' },
                    { label: 'Tank 2 — Water', v: 't2Val', r: 't2Res', n: 't2Need' },
                    { label: 'Tank 3 — Aprust-21', v: 't3Val', r: 't3Res', n: 't3Need' },
                    { label: 'Tank 4 — Water', v: 't4Val', r: 't4Res', n: 't4Need' },
                    { label: 'Tank 5 — S-101', v: 't5Val', r: 't5Res', n: 't5Need' },
                    { label: 'Tank 6 — Act-505', v: 't6Val', r: 't6Res', n: 't6Need' },
                    { label: 'Tank 7 — Aphox-ZC', v: 't7Val', r: 't7Res', n: 't7Need' },
                    { label: 'Tank 8 — Water', v: 't8Val', r: 't8Res', n: 't8Need' },
                    { label: 'Tank 9 — Passeal-1', v: 't9Val', r: 't9Res', n: 't9Need' },
                ];

                function rc(v) { return (v || '').toLowerCase() === 'pass' ? 'vr-res-pass' : 'vr-res-failed'; }
                function nc(v) {
                    var l = (v || '').toLowerCase();
                    if (l === 'pass' || l.includes('no need')) return 'vr-need-ok';
                    if (l === 'high') return 'vr-need-high';
                    if (l === 'low') return 'vr-need-low';
                    return 'vr-need-warn';
                }

                // Populate View Result modal
                document.addEventListener('click', function (e) {
                    var btn = e.target.closest('.btn-view-result');
                    if (!btn) return;
                    var d = btn.dataset;
                    document.getElementById('vr-date-label').textContent = d.date || '';
                    var rows = '';
                    TANKS.forEach(function (t) {
                        var val = d[t.v] || '—';
                        var res = d[t.r] || '—';
                        var need = d[t.n] || '—';
                        rows +=
                            '<tr>' +
                            '<td style="font-weight:700;color:#3a5bd9;white-space:nowrap;">' + t.label + '</td>' +
                            '<td style="color:#5e6e9a;">' + t.label.split('—')[1].trim() + '</td>' +
                            '<td style="font-weight:700;color:#232b4e;">' + val + '</td>' +
                            '<td><span class="' + rc(res) + '">' + res + '</span></td>' +
                            '<td><span class="' + nc(need) + '">' + need + '</span></td>' +
                            '</tr>';
                    });
                    document.getElementById('vr-tbody').innerHTML = rows;
                });

                // Delete confirmation
                document.addEventListener('submit', function (e) {
                    if (!e.target.classList.contains('delete-form-9tank')) return;
                    if (!confirm('Delete this test record?\nThis action cannot be undone.')) {
                        e.preventDefault();
                    }
                });
            })();
        </script>

@endsection