@extends('viewer.layouts.app')

@section('title', 'Viewer Dashboard')

@section('content')

    <style>
        /* Premium Dashboard Design - Variant 2 */
        .dashboard-container {
            padding: 1.5rem;
        }

        .text-left-force {
            text-align: left !important;
        }

        /* Hero Cards (Gradient) */
        .hero-card {
            border: none;
            border-radius: 20px;
            color: #fff;
            overflow: hidden;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 160px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .hero-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .hero-card .bg-overlay {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: rgba(255, 255, 255, 0.1);
            clip-path: circle(50% at 90% 10%);
            pointer-events: none;
        }

        .hero-card-content {
            position: relative;
            z-index: 2;
            padding: 1.5rem;
        }

        .hero-title {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.9;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .hero-value {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.2;
        }

        .hero-icon {
            position: absolute;
            right: 20px;
            bottom: 20px;
            font-size: 4rem;
            opacity: 0.2;
            transform: rotate(-10deg);
        }

        /* Gradient Variants */
        .gradient-blue {
            background: linear-gradient(120deg, #4facfe 0%, #00f2fe 100%);
        }

        .gradient-purple {
            background: linear-gradient(120deg, #a18cd1 0%, #fbc2eb 100%);
        }

        /* Generic */
        .gradient-orange {
            background: linear-gradient(120deg, #f6d365 0%, #fda085 100%);
        }

        .gradient-red {
            background: linear-gradient(120deg, #ff9a9e 0%, #fecfef 99%, #fecfef 100%);
            background: linear-gradient(to right, #ff416c, #ff4b2b);
        }

        .gradient-deep-blue {
            background: linear-gradient(to right, #434343 0%, black 100%);
        }

        /* Dark mode feel */
        .gradient-royal {
            background: linear-gradient(to right, #141e30, #243b55);
        }

        .bg-main-stats {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .bg-warn-stats {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .bg-danger-stats {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            background: linear-gradient(to right, #ed213a, #93291e);
        }

        /* Action/Alert Grid */
        .action-card {
            background: #fff;
            border-radius: 16px;
            border-left: 6px solid;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .action-card:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .action-card.pending {
            border-color: #ffc107;
        }

        .action-card.pretreat {
            border-color: #0dcaf0;
        }

        .action-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-left: 1rem;
        }

        .bg-light-yellow {
            background-color: #fff3cd;
            color: #ffc107;
        }

        .bg-light-info {
            background-color: #cff4fc;
            color: #0dcaf0;
        }

        /* Operations Grid */
        .op-card {
            background: #fff;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(0, 0, 0, 0.05);
            text-align: center;
            transition: transform 0.2s;
        }

        .op-card:hover {
            transform: translateY(-5px);
            border-color: #e9ecef;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
        }

        .op-value {
            font-size: 2rem;
            font-weight: 700;
            color: #344767;
            margin-top: 0.5rem;
        }

        .op-label {
            color: #8898aa;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .op-icon-circle {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 1.25rem;
            transition: all 0.3s;
        }

        .op-card:hover .op-icon-circle {
            transform: scale(1.1);
        }

        .op-icon-primary {
            background: rgba(5, 117, 230, 0.1);
            color: #0575e6;
        }

        .op-icon-success {
            background: rgba(0, 176, 155, 0.1);
            color: #00b09b;
        }

        .op-icon-warning {
            background: rgba(255, 195, 113, 0.1);
            color: #ff5f6d;
        }

        .op-icon-dark {
            background: rgba(52, 71, 103, 0.1);
            color: #344767;
        }

        .section-header {
            font-weight: 700;
            color: #344767;
            margin: 2.5rem 0 1.5rem;
            display: flex;
            align-items: center;
        }

        .section-header::before {
            content: '';
            display: inline-block;
            width: 20px;
            height: 4px;
            background: linear-gradient(to right, #667eea, #764ba2);
            border-radius: 2px;
            margin-right: 10px;
        }
    </style>

    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Viewer</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Dashboard</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <!-- Search could go here -->
                </div>
                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item dropdown pe-2 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-cog cursor-pointer fa-lg"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="{{ route('viewer.profile') }}">
                                    <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <img src="{{ asset('assets/img/team-2.jpg') }}" class="avatar avatar-sm me-3">
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
                                            <div
                                                class="avatar avatar-sm bg-gradient-dark me-3 d-flex align-items-center justify-content-center">
                                                <i class="fa fa-power-off text-white"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">Logout</span>
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


    <div class="dashboard-container">

        <!-- HERO SECTION: Paint Inventory -->
        <div class="row">
            <div class="col-12">
                <h5 class="section-header">Inventory Highlights</h5>
            </div>

            <!-- Total Paint -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="hero-card bg-main-stats">
                    <div class="bg-overlay"></div>
                    <div class="hero-card-content">
                        <div class="hero-title">Total Paints in Stock</div>
                        <div class="hero-value">{{ $sumofquantity}} <span style="font-size: 1rem; opacity:0.8;">KG</span>
                        </div>
                    </div>
                    <i class="fas fa-cubes hero-icon"></i>
                </div>
            </div>

            <!-- Low Stock -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="hero-card bg-warn-stats">
                    <div class="bg-overlay"></div>
                    <div class="hero-card-content">
                        <div class="hero-title">Low Stock Alert</div>
                        <div class="hero-value">{{$lowstock}} <span style="font-size: 1rem; opacity:0.8;">Items</span></div>
                    </div>
                    <i class="fas fa-exclamation-triangle hero-icon"></i>
                </div>
            </div>

            <!-- Out of Stock -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="hero-card bg-danger-stats">
                    <div class="bg-overlay"></div>
                    <div class="hero-card-content">
                        <div class="hero-title">Empty / Needs Refill</div>
                        <div class="hero-value">{{$restock}} <span style="font-size: 1rem; opacity:0.8;">Items</span></div>
                    </div>
                    <i class="fas fa-times-circle hero-icon"></i>
                </div>
            </div>
        </div>

    <!-- ACTION ROW: Pending & Pretreatment -->
    <div class="row mt-2">
        <div class="col-md-6 mb-4">
            <div class="action-card pending position-relative">
                <div style="text-align: left !important;">
                    <a href="{{ route('viewer.total-pending-materials') }}" class="stretched-link"></a>
                    <h6 class="text-dark font-weight-bold mb-1">Total Pending Material</h6>
                    <span class="text-xs text-muted">Awaiting processing</span>
                    <h3 class="font-weight-bolder text-warning mt-2 mb-0">{{ $pendingCount }}</h3>
                    <a href="{{ route('viewer.total-pending-materials.export') }}" class="btn btn-sm btn-outline-warning mt-2 mb-0 position-relative" style="z-index: 2;">Export</a>
                </div>
                <div class="action-icon bg-light-yellow">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="action-card pretreat position-relative">
                <div style="text-align: left !important;">
                    <a href="{{ route('viewer.total-pretreatment-done') }}" class="stretched-link"></a>
                    <h6 class="text-dark font-weight-bold mb-1">Pretreatment Done</h6>
                    <span class="text-xs text-muted">Ready for coating</span>
                    <h3 class="font-weight-bolder text-info mt-2 mb-0">{{ $pretreatmentCount }}</h3>
                    <a href="{{ route('viewer.total-pretreatment-done.export') }}" class="btn btn-sm btn-outline-info mt-2 mb-0 position-relative" style="z-index: 2;">Export</a>
                </div>
                <div class="action-icon bg-light-info">
                    <i class="fas fa-check-double"></i>
                </div>
            </div>
        </div>
    </div>


        <!-- OPERATIONS GRID -->
        <div class="row">
            <div class="col-12">
                <h5 class="section-header">System Metrics</h5>
            </div>

            <!-- Total Clients -->
            <div class="col-lg-2dot4 col-md-4 col-sm-6 mb-4">
                <div class="op-card">
                    <div class="op-icon-circle op-icon-primary">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <div class="op-label">Clients</div>
                    <div class="op-value">{{$totalClients}}</div>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="col-lg-2dot4 col-md-4 col-sm-6 mb-4">
                <div class="op-card">
                    <div class="op-icon-circle op-icon-dark">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <div class="op-label">Orders</div>
                    <div class="op-value">{{$totalOrders}}</div>
                </div>
            </div>

            <!-- Total Jobcards -->
            <div class="col-lg-2dot4 col-md-4 col-sm-6 mb-4">
                <div class="op-card">
                    <div class="op-icon-circle op-icon-primary">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div class="op-label">Jobcards</div>
                    <div class="op-value">{{$totalJobcards}}</div>
                </div>
            </div>

            <!-- Total Deliveries -->
            <div class="col-lg-2dot4 col-md-4 col-sm-6 mb-4">
                <div class="op-card">
                    <div class="op-icon-circle op-icon-success">
                        <i class="fas fa-truck"></i>
                    </div>
                    <div class="op-label">Deliveries</div>
                    <div class="op-value">{{$totalDeliveries}}</div>
                </div>
            </div>

            <!-- Total Tests -->
            <div class="col-lg-2dot4 col-md-4 col-sm-6 mb-4">
                <div class="op-card">
                    <div class="op-icon-circle op-icon-warning">
                        <i class="fas fa-microscope"></i>
                    </div>
                    <div class="op-label">Tests Done</div>
                    <div class="op-value">{{$totalTests}}</div>
                </div>
            </div>
        </div>

    </div>

    <!-- Custom Column for 5-grid layout -->
    <style>
        @media (min-width: 992px) {
            .col-lg-2dot4 {
                flex: 0 0 20%;
                max-width: 20%;
            }
        }
    </style>

@endsection