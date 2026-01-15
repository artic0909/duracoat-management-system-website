@extends('manager.layouts.app')

@section('title', 'Material Out')

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
                        Material Out
                    </li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Here you can find all the ready for material out</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <form action="{{ route('manager.material-out') }}" method="GET"
                        style="display: flex; gap: 10px; align-items: center; margin-bottom: 15px;">
                        <div class="input-group" style="width: 220px;">
                            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                            <input type="text" name="order_number" class="form-control"
                                placeholder="Search ord/jobcard no..." value="{{ request('order_number') }}">
                        </div>

                        <div>
                            <label for="from_date">From:</label>
                            <input type="date" name="from_date" value="{{ request('from_date') }}"
                                style="padding: 6px 10px; border: 1px solid #ccc; border-radius: 5px;">
                        </div>

                        <div>
                            <label for="end_date">To:</label>
                            <input type="date" name="end_date" value="{{ request('end_date') }}"
                                style="padding: 6px 10px; border: 1px solid #ccc; border-radius: 5px;">
                        </div>

                        <button type="submit" class="btn btn-primary"
                            style="padding: 6px 15px; border-radius: 5px;">Search</button>

                        <a href="{{ route('manager.material-out') }}" class="btn btn-secondary"
                            style="padding: 6px 15px; border-radius: 5px;">Reset</a>

                        <a href="{{ route('manager.export.client.out') }}" class="btn"
                            style="background-color: #034078; color: white; padding: 6px 15px; border-radius: 5px;">Export</a>
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
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
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
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            SL
                                        </th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status
                                        </th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Ord No
                                        </th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Invoice
                                        </th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jobcard Details
                                        </th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Pre-treatment Date
                                        </th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Powder Apply Date
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Material Delivery Date
                                        </th>


                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Detailed View
                                        </th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jobcards as $jobcard)
                                        <tr>

                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ ($jobcards->currentPage() - 1) * $jobcards->perPage() + $loop->iteration }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs fw-bolder mb-0 bg-success text-dark m-0 p-1"
                                                    style="text-transform: capitalize;">
                                                    {{ $jobcard->jobcard_status }}
                                                </p>
                                            </td>

                                            <td>
                                                <p class="text-xs fw-bolder mb-0 bg-primary text-white m-0 p-1">
                                                    {{ $jobcard->order->order_number }}</p>
                                            </td>

                                            <td>
                                                <p class="text-xs fw-bolder mb-0 bg-secondary text-white m-0 p-1">{{ $jobcard->invoice ?? '—' }}</p>
                                            </td>

                                            <td>
                                                <p class="text-xs fw-bolder mb-0 bg-warning text-dark m-0 p-1">
                                                    Jobcard No: {{ $jobcard->jobcard_number }}
                                                    <br>
                                                    Creation Date:
                                                    {{ \Carbon\Carbon::parse($jobcard->jobcard_creation_date)->format('d/m/Y') }}
                                                </p>
                                            </td>

                                            <td>
                                                <span
                                                    class="text-secondary text-xs fw-bolder bg-success text-dark m-0 p-1">{{ \Carbon\Carbon::parse($jobcard->pre_treatment_date)->format('d/m/Y') }}</span>

                                            </td>
                                            <td>
                                                <span
                                                    class="text-secondary text-xs fw-bolder bg-success text-dark m-0 p-1">{{ \Carbon\Carbon::parse($jobcard->powder_apply_date)->format('d/m/Y') }}</span>

                                            </td>
                                            <td>
                                                @if ($jobcard->delivery_date)
                                                    <span class="text-secondary text-xs fw-bolder bg-success text-dark m-0 p-1">
                                                        {{ \Carbon\Carbon::parse($jobcard->delivery_date)->format('d/m/Y') }}
                                                    </span>
                                                @elseif ($jobcard->delivery_statement)
                                                    <button type="button" class="btn btn-primary"
                                                        data-bs-target="#deliveryStatementModal{{ $jobcard->id }}"
                                                        data-bs-toggle="modal" data-bs-dismiss="modal">
                                                        View Statement
                                                    </button>
                                                @else
                                                    —
                                                @endif

                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#materialdetailsModal{{ $jobcard->id }}">
                                                    Detailed View
                                                </button>
                                            </td>


                                        </tr>
                                    @endforeach
                                </tbody>

                                <!-- pagination -->
                                <tfoot>
                                    <tr>
                                        <td colspan="9" class="text-start">
                                            <div class="d-flex justify-content-center align-items-center gap-3 mt-3">
                                                @if ($jobcards->onFirstPage())
                                                    <span class="text-muted">Prev</span>
                                                @else
                                                    <a href="{{ $jobcards->previousPageUrl() }}"
                                                        class="text-primary text-decoration-none">Prev</a>
                                                @endif

                                                <span>{{ $jobcards->currentPage() }} / {{ $jobcards->lastPage() }}</span>

                                                @if ($jobcards->hasMorePages())
                                                    <a href="{{ $jobcards->nextPageUrl() }}"
                                                        class="text-primary text-decoration-none">Next</a>
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

    <!-- Material Details Modal -->
    @foreach ($jobcards as $jobcard)
        <div class="modal fade" id="materialdetailsModal{{ $jobcard->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <form class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bolder" id="exampleModalLabel">Order No: {{ $jobcard->order->order_number }}
                            || Jobcard No: {{ $jobcard->jobcard_number }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5 class="fw-bolder">Client's Details</h5>
                        <table class="table table-bordered table-sm m-0 text-start align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-xs">Client Name</th>
                                    <th class="text-xs">Client Email</th>
                                    <th class="text-xs">Client Contact</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p class="m-0 text-secondary text-xs font-weight-bold">
                                            {{ $jobcard->client->client_name }}</p>
                                    </td>
                                    <td>
                                        <p class="m-0 text-secondary text-xs font-weight-bold">{{ $jobcard->client->email }}</p>
                                    </td>
                                    <td>
                                        <p class="m-0 text-secondary text-xs font-weight-bold">{{ $jobcard->client->mobile }}
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <br>

                        <h5 class="fw-bolder">Material Details</h5>
                        <table class="table table-bordered table-sm m-0 text-start align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-xs">Product / Material Description</th>
                                    <th class="text-xs">Paint Code (RAL)</th>
                                    <th class="text-xs">Paint Used (Qty)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p class="m-0 text-secondary text-xs font-weight-bold">
                                            {{ $jobcard->material_name }}<br>
                                            {{ $jobcard->material_quantity }} {{ $jobcard->material_unit }}<br>
                                            {{ $jobcard->material_type }}
                                        </p>
                                    </td>
                                    <td>
                                        <span
                                            class="badge bg-gradient-info text-white text-xs font-weight-bold">{{ $jobcard->ral_code }}</span>
                                    </td>
                                    <td>
                                        <span class="text-secondary text-xs font-weight-bold">{{ $jobcard->paint_used ?? '—' }}
                                            KG</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <br>

                        <h5 class="fw-bolder">Test Results</h5>
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
                                @forelse($jobcard->tests as $test)
                                    @foreach($test->testing as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                {{ $item['test_name'] ?? '-' }}
                                                @if (isset($item['gloss_type']) && $item['gloss_type'])
                                                    <span class="badge bg-warning text-dark">{{ $item['gloss_type'] }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $item['test_value'] ?? '-' }}</td>
                                            <td>
                                                @php
                                                    $result = strtoupper($item['test_result'] ?? 'N/A');
                                                    $badge = match ($result) {
                                                        'PASS' => 'bg-success',
                                                        'FAIL' => 'bg-danger',
                                                        'ACCEPTABLE' => 'bg-warning text-dark',
                                                        default => 'bg-secondary',
                                                    };
                                                @endphp
                                                <span class="badge {{ $badge }}">{{ $result }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">
                                            No test results for this jobcard.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('manager.jobcard.pdf', $jobcard->id) }}" class="btn btn-success">
                            <i class="fa fa-file me-1"></i>Print Jobcard
                        </a>

                        <a href="{{ route('manager.jobcard-test.download', $jobcard->id) }}" class="btn btn-warning">
                            <i class="fa fa-download me-1"></i>Download Test Result
                        </a>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    <!-- Delivered Statement Modal -->
    @foreach ($jobcards as $jobcard)
        <div class="modal fade" id="deliveryStatementModal{{ $jobcard->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="deliveryStatementLabel{{ $jobcard->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('manager.update.delivered-statement', $jobcard->id) }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delivery Statement</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <label for="delivery_statement_{{ $jobcard->id }}" class="form-label fw-semibold">Write your
                                delivery statement:</label>
                            <textarea name="delivery_statement" id="delivery_statement_{{ $jobcard->id }}" rows="4"
                                class="form-control" placeholder="Write your delivery note or reason..."
                                readonly>{{$jobcard->delivery_statement}}</textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">Submit Statement</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

@endsection