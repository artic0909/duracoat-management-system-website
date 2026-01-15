@extends('admin.layouts.app')

@section('title', 'All Jobcards')

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm">
                    <a class="opacity-5 text-dark" href="javascript:;">Admin</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
                    All Jobcards
                </li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Here you can find all the jobcards</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <form action="{{ route('admin.all-jobcards') }}" method="GET" style="display: flex; gap: 10px; align-items: center; margin-bottom: 15px;">
                    <div class="input-group" style="width: 220px;">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" name="jobcard_number" class="form-control" placeholder="Search Jobcard No..."
                            value="{{ request('jobcard_number') }}">
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

                    <a href="{{ route('admin.all-jobcards') }}" class="btn btn-secondary"
                        style="padding: 6px 15px; border-radius: 5px;">Reset</a>

                    <a href="{{ route('admin.export.jobcards') }}" class="btn"
                        style="background-color: #034078; color: white; padding: 6px 15px; border-radius: 5px;">
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
                            <a class="dropdown-item border-radius-md" href="{{ route('admin.profile') }}">
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
                            <a class="dropdown-item border-radius-md" href="{{ route('admin.logout') }}">
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
                                        Date
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
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Delivery Date
                                    </th>

                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jobcards as $index => $jobcard)
                                <tr>
                                    <td class="text-xs font-weight-bold">{{ $index + 1 }}</td>

                                    <td class="text-xs font-weight-bold">
                                        @switch($jobcard->jobcard_status)
                                        @case('pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                        @break
                                        @case('pre-treatment')
                                        <span class="badge bg-info text-white">Pre-Treatment</span>
                                        @break
                                        @case('powder-applied')
                                        <span class="badge bg-primary text-white">Powder Applied</span>
                                        @break
                                        @case('delivered')
                                        <span class="badge bg-success text-white">Delivered</span>
                                        @break
                                        @default
                                        <span class="badge bg-secondary text-white">Unknown</span>
                                        @endswitch
                                    </td>

                                    <td class="text-xs font-weight-bold">{{ \Carbon\Carbon::parse($jobcard->jobcard_creation_date)->format('d/m/Y') }}</td>
                                    <td class="text-xs font-weight-bold">{{ $jobcard->jobcard_number }}</td>

                                    <!-- Nested Material Table -->
                                    <td colspan="4" class="text-xs font-weight-bold p-0">
                                        <table class="table table-bordered table-sm m-0 text-center align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Product / Material</th>
                                                    <th>Paint Details</th>
                                                    <th>Paint Used (Qty)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-xs font-weight-bold">
                                                        {{ $jobcard->material_name }}<br>
                                                        {{ $jobcard->material_quantity }} {{ $jobcard->material_unit }}<br>
                                                        {{ $jobcard->material_type }}
                                                    </td>
                                                    <td class="text-xs font-weight-bold">
                                                        {{ $jobcard->paint->brand_name ?? '' }} <br>
                                                        {{ $jobcard->paint->ral_code ?? $jobcard->ral_code }} <br>
                                                        {{ $jobcard->paint->shade_name ?? '' }} <br>
                                                        {{ $jobcard->paint->finish ?? '' }}
                                                    </td>
                                                    <td class="text-xs font-weight-bold">{{ $jobcard->paint_used ?? '—' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>

                                    <td class="text-center text-xs font-weight-bold">
                                        {{-- PRE-TREATMENT COLUMN --}}
                                        @if ($jobcard->pre_treatment_date)
                                        {{ \Carbon\Carbon::parse($jobcard->pre_treatment_date)->format('d/m/Y') }}
                                        @else
                                        <button type="button" class="btn btn-success px-3 py-2 rounded m-0"
                                            data-bs-toggle="modal" data-bs-target="#pretreatmentModal{{ $jobcard->id }}">
                                            <i class="fa fa-check"></i>
                                        </button>
                                        @endif
                                    </td>

                                    <td class="text-center text-xs font-weight-bold">
                                        {{-- POWDER APPLY COLUMN --}}
                                        @if (!$jobcard->pre_treatment_date)
                                        {{-- Pre-treatment not done yet → show "-" --}}
                                        —
                                        @elseif ($jobcard->powder_apply_date)
                                        {{ \Carbon\Carbon::parse($jobcard->powder_apply_date)->format('d/m/Y') }}
                                        @else
                                        {{-- Pre-treatment done, powder not yet done → show powder apply button --}}
                                        <button type="button" class="btn btn-success px-3 py-2 rounded m-0"
                                            data-bs-toggle="modal" data-bs-target="#powderappliedModal{{ $jobcard->id }}">
                                            <i class="fa fa-check"></i>
                                        </button>
                                        @endif
                                    </td>

                                    <td class="text-center text-xs font-weight-bold">
                                        <!-- {{-- DELIVERY COLUMN --}} -->
                                        @if (!$jobcard->pre_treatment_date)
                                        <!-- {{-- No pre-treatment → disable everything --}} -->
                                        —
                                        @elseif (!$jobcard->powder_apply_date)
                                        <!-- {{-- Powder apply not done yet --}} -->
                                        —
                                        @elseif ($jobcard->delivery_date)
                                        {{ \Carbon\Carbon::parse($jobcard->delivery_date)->format('d/m/Y') }}
                                        @elseif ($jobcard->delivery_statement)
                                        <button type="button" class="btn btn-info"
                                            data-bs-target="#deliveryStatementModal{{ $jobcard->id }}"
                                            data-bs-toggle="modal"
                                            data-bs-dismiss="modal">
                                            View Statement
                                        </button>
                                        @elseif (
                                        $jobcard->pre_treatment_date &&
                                        $jobcard->powder_apply_date &&
                                        \App\Models\JobcardTest::where('jobcard_id', $jobcard->id)->exists()
                                        )
                                        <!-- {{-- All 3 conditions satisfied → show delivery button --}} -->
                                        <button type="button" class="btn btn-success px-3 py-2 rounded m-0"
                                            data-bs-toggle="modal" data-bs-target="#deliveredModal{{ $jobcard->id }}">
                                            <i class="fa fa-check"></i>
                                        </button>
                                        @else
                                        <!-- {{-- If test not found or any condition missing --}} -->
                                        <span class="text-danger">Pending Test</span>
                                        @endif
                                    </td>


                                    <td class="text-center text-xs font-weight-bold">
                                        <div class="d-flex gap-2 flex-column">
                                            <!-- @if ($jobcard->tests->isNotEmpty())
                                            @if ($jobcard->tests->isNotEmpty())
                                            <a href="{{ route('admin.jobcard-test', $jobcard->id) }}"
                                                class="btn btn-outline-secondary px-3 py-2 rounded m-0">
                                                Test Again
                                            </a>
                                            @else
                                            <a href="{{ route('admin.jobcard-test', $jobcard->id) }}"
                                                class="btn btn-primary px-3 py-2 rounded m-0">
                                                Give Test
                                            </a>
                                            @endif

                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#testresultModal{{ $jobcard->id }}"
                                                class="btn btn-outline-primary px-3 py-2 rounded m-0">
                                                Test Result
                                            </button>
                                            <a href="{{ route('admin.jobcard.view', $jobcard->id) }}" target="_blank"
                                                class="btn btn-info px-3 py-2 rounded m-0">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            <a href="{{ route('admin.jobcard.pdf', $jobcard->id) }}"
                                                class="btn btn-outline-success px-3 py-2 rounded m-0">
                                                Print Jobcard
                                            </a>

                                            @if ($jobcard->paint_used)
                                            <button type="button" class="btn btn-danger rounded m-0"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $jobcard->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            @else
                                            <div>
                                                <a href="{{ route('admin.edit-jobcards', $jobcard->id) }}" class="btn btn-info rounded m-0">
                                                    <i class="fa fa-pencil"></i>
                                                </a>

                                                <button type="button" class="btn btn-danger rounded m-0"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal{{ $jobcard->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @else
                                <tr>
                                    <td colspan="12" class="text-center text-muted py-4">
                                        No jobcards created yet for this order.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>

                            <!-- pagination -->
                            <tfoot>
                                <tr>
                                    <td colspan="11" class="text-center">
                                        <div class="d-flex justify-content-center align-items-center gap-3 mt-3">
                                            @if ($jobcards->onFirstPage())
                                            <span class="text-muted">Prev</span>
                                            @else
                                            <a href="{{ $jobcards->previousPageUrl() }}" class="text-primary text-decoration-none">Prev</a>
                                            @endif

                                            <span>{{ $jobcards->currentPage() }} / {{ $jobcards->lastPage() }}</span>

                                            @if ($jobcards->hasMorePages())
                                            <a href="{{ $jobcards->nextPageUrl() }}" class="text-primary text-decoration-none">Next</a>
                                            @else
                                            <span class="text-muted">Next</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>

                            <!-- Modals -->
                            <!-- Pre-Treatment Modal -->
                            @foreach ($jobcards as $jobcard)
                            <div class="modal fade" id="pretreatmentModal{{ $jobcard->id }}" tabindex="-1" aria-labelledby="pretreatmentLabel{{ $jobcard->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route('admin.update.pretreatment', $jobcard->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirm Pre-Treatment</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure this material has completed <strong>Pre-Treatment</strong> today?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-info text-white">Yes, Confirm</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach

                            <!-- Powder Applied Modal -->
                            @foreach ($jobcards as $jobcard)
                            <div class="modal fade" id="powderappliedModal{{ $jobcard->id }}" tabindex="-1" aria-labelledby="powderappliedLabel{{ $jobcard->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route('admin.update.powderapplied', $jobcard->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirm Powder Applied</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure this material has completed <strong>Powder Application</strong> today?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Yes, Confirm</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach

                            <!-- Delivered Modal -->
                            @foreach ($jobcards as $jobcard)
                            <!-- Delivered Confirmation Modal -->
                            <div class="modal fade" id="deliveredModal{{ $jobcard->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deliveredLabel{{ $jobcard->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route('manager.update.delivered', $jobcard->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirm Delivery</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    Are you sure this
                                                    <strong class="text-danger">
                                                        material quantity ({{ $jobcard->material_quantity }} {{ $jobcard->material_unit }})
                                                    </strong> has been delivered today?
                                                </p>

                                                <label for="invoice">TAX Invoice<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control mb-3" name="invoice" placeholder="Tax Invoice" required>

                                                <!-- Trigger for 2nd Modal -->
                                                <button type="button" class="btn btn-primary"
                                                    data-bs-target="#deliveryStatementModal{{ $jobcard->id }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-dismiss="modal">
                                                    Or give a delivery statement ?
                                                </button>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-success">Yes, Confirm</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Delivery Statement Modal -->
                            <div class="modal fade" id="deliveryStatementModal{{ $jobcard->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deliveryStatementLabel{{ $jobcard->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route('manager.update.delivered-statement', $jobcard->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delivery Statement</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <label for="delivery_statement_{{ $jobcard->id }}" class="form-label fw-semibold">Write your delivery statement:</label>
                                                <textarea name="delivery_statement" id="delivery_statement_{{ $jobcard->id }}" rows="4" class="form-control" placeholder="Write your delivery note or reason...">{{$jobcard->delivery_statement}}</textarea>
                                                
                                                <label for="invoice" class="mt-2">TAX Invoice<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control mb-3" name="invoice" placeholder="Tax Invoice" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button"
                                                    class="btn btn-secondary"
                                                    data-bs-target="#deliveredModal{{ $jobcard->id }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-dismiss="modal">
                                                    ← Back
                                                </button>
                                                <button type="submit" class="btn btn-primary">Submit Statement</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Jobcard Modal -->
@foreach ($jobcards as $jobcard)
<div class="modal fade" id="deleteModal{{ $jobcard->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('admin.add-jobcards.delete', $jobcard->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Jobcard</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this Jobcard {{ $jobcard->jobcard_number }}?</p>
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

<!-- QC Test Result Modal -->
@foreach($jobcards as $jobcard)
<div class="modal fade" id="testresultModal{{ $jobcard->id }}" tabindex="-1"
    aria-labelledby="testResultLabel{{ $jobcard->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form class="modal-content shadow-lg border-0 rounded-3">
            <div class="modal-header">
                <h5 class="modal-title fw-semibold" id="testResultLabel{{ $jobcard->id }}">
                    <i class="fa fa-flask me-2"></i>QC Test Results — Jobcard #{{ $jobcard->jobcard_number }}
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
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fa fa-times me-1"></i>Close
                </button>
                <a href="{{ route('admin.jobcard-test.download', $jobcard->id) }}" class="btn btn-warning">
                    <i class="fa fa-download me-1"></i>Download
                </a>
            </div>
        </form>
    </div>
</div>
@endforeach


@endsection