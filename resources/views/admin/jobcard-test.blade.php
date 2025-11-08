@extends('admin.layouts.app')

@section('title', 'QC Testings')

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
                    Give Tests
                </li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Here you can find all the jobcards of this <span
                    class="text-primary">{{ $jobcard->client->client_name }} - {{ $jobcard->client->email }}</span></h6>
            <h6 class="font-weight-bolder mb-0">Order NO: <span class="text-primary">
                    {{ $jobcard->order->order_number }}</span>&nbsp;||&nbsp;Jobcard NO: <span class="text-primary"> {{ $jobcard->jobcard_number }}</span></h6>
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
                                        Creation Date
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
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">1</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
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
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($jobcard->jobcard_creation_date)->format('d/m/Y') }}</p>
                                    </td>

                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $jobcard->jobcard_number }}</p>
                                    </td>
                                    <!-- nested table -->
                                    <td colspan="4" class="p-0">
                                        <table
                                            class="table table-bordered table-sm m-0 text-center align-middle">
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
                                                            {{ $jobcard->material_name }}
                                                        </p>
                                                        <p class="m-0 text-secondary text-xs font-weight-bold">
                                                            {{ $jobcard->material_quantity }} {{ $jobcard->material_unit }}
                                                        </p>
                                                        <p class="m-0 text-secondary text-xs font-weight-bold">
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
                                    </td>
                                    <!-- nested table -->

                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($jobcard->pre_treatment_date)->format('d/m/Y') }}</span>

                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($jobcard->powder_apply_date)->format('d/m/Y') }}</span>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <!-- Testing Fields -->
                    <form class="p-4 shadow rounded bg-white"
                        action="{{ route('admin.jobcard-test.store', $jobcard->id) }}"
                        method="POST" id="qcTestForm">
                        @csrf

                        <h5 class="fw-bolder mb-3 text-primary">🧪 QC Testings & Results</h5>

                        @php
                        $existingTest = \App\Models\JobcardTest::where('jobcard_id', $jobcard->id)->first();
                        @endphp

                        <!-- 1️⃣ Cross Hatch Adhesion Test -->
                        <div class="card shadow-sm mb-3 border-0">
                            <div class="card-body">
                                <h6 class="fw-semibold mb-3 text-secondary">1️⃣ Cross Hatch Adhesion Test</h6>
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label class="form-label">Adhesion Grade (GT0–GT5)</label>
                                        <input type="text" class="form-control" id="adhesionInput"
                                            name="adhesionInput"
                                            value="{{ $existingTest->testing[0]['test_value'] ?? '' }}"
                                            placeholder="e.g., GT1">
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Result</label>
                                        <input type="text" class="form-control text-success fw-semibold"
                                            id="adhesionResult" readonly
                                            name="adhesionResult"
                                            value="{{ $existingTest->testing[0]['test_result'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2️⃣ Pencil Hardness Test -->
                        <div class="card shadow-sm mb-3 border-0">
                            <div class="card-body">
                                <h6 class="fw-semibold mb-3 text-secondary">2️⃣ Pencil Hardness Test</h6>
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label class="form-label">Observed Hardness</label>
                                        <input type="text" class="form-control" id="hardnessInput"
                                            name="hardnessInput"
                                            value="{{ $existingTest->testing[1]['test_value'] ?? '' }}"
                                            placeholder="e.g., 2H">
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Result</label>
                                        <input type="text" class="form-control text-success fw-semibold"
                                            id="hardnessResult" name="hardnessResult" readonly
                                            value="{{ $existingTest->testing[1]['test_result'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3️⃣ Impact Resistance Test -->
                        <div class="card shadow-sm mb-3 border-0">
                            <div class="card-body">
                                <h6 class="fw-semibold mb-3 text-secondary">3️⃣ Impact Resistance Test</h6>
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label class="form-label">Result (kg·cm)</label>
                                        <input type="number" class="form-control" id="impactInput"
                                            name="impactInput"
                                            value="{{ $existingTest->testing[2]['test_value'] ?? '' }}"
                                            placeholder="e.g., 45">
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Acceptance</label>
                                        <input type="text" class="form-control text-success fw-semibold"
                                            id="impactResult" readonly name="impactResult"
                                            value="{{ $existingTest->testing[2]['test_result'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 4️⃣ Conical Mandrel Bend Test -->
                        <div class="card shadow-sm mb-3 border-0">
                            <div class="card-body">
                                <h6 class="fw-semibold mb-3 text-secondary">4️⃣ Conical Mandrel Bend Test</h6>
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label class="form-label">Observation</label>
                                        <select class="form-select" id="bendInput" name="bendInput">
                                            <option value="">Select Observation</option>
                                            <option value="No cracks or detachment"
                                                {{ ($existingTest->testing[3]['test_value'] ?? '') == 'No cracks or detachment' ? 'selected' : '' }}>
                                                No cracks or detachment</option>
                                            <option value="Hairline cracks"
                                                {{ ($existingTest->testing[3]['test_value'] ?? '') == 'Hairline cracks' ? 'selected' : '' }}>
                                                Hairline cracks</option>
                                            <option value="Peeling or detachment"
                                                {{ ($existingTest->testing[3]['test_value'] ?? '') == 'Peeling or detachment' ? 'selected' : '' }}>
                                                Peeling or detachment</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Result</label>
                                        <input type="text" class="form-control text-success fw-semibold"
                                            id="bendResult" readonly name="bendResult"
                                            value="{{ $existingTest->testing[3]['test_result'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 5️⃣ Cupping Test -->
                        <div class="card shadow-sm mb-3 border-0">
                            <div class="card-body">
                                <h6 class="fw-semibold mb-3 text-secondary">5️⃣ Cupping Test</h6>
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label class="form-label">Depth (mm)</label>
                                        <input type="number" class="form-control" id="cuppingInput"
                                            name="cuppingInput"
                                            value="{{ $existingTest->testing[4]['test_value'] ?? '' }}"
                                            placeholder="e.g., 8">
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Result</label>
                                        <input type="text" class="form-control text-success fw-semibold"
                                            id="cuppingResult" name="cuppingResult" readonly
                                            value="{{ $existingTest->testing[4]['test_result'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 6️⃣ Gloss Measurement Test -->
                        <div class="card shadow-sm mb-4 border-0">
                            <div class="card-body">
                                <h6 class="fw-semibold mb-3 text-secondary">6️⃣ Gloss Measurement Test</h6>
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label class="form-label">Finish Type</label>
                                        <select id="glossType" class="form-select" name="glossType">
                                            <option value="">Select Type</option>
                                            <option value="Matt"
                                                {{ ($existingTest->testing[5]['gloss_type'] ?? '') == 'Matt' ? 'selected' : '' }}>
                                                Matt
                                            </option>
                                            <option value="Semi-Gloss"
                                                {{ ($existingTest->testing[5]['gloss_type'] ?? '') == 'Semi-Gloss' ? 'selected' : '' }}>
                                                Semi-Gloss
                                            </option>
                                            <option value="Gloss"
                                                {{ ($existingTest->testing[5]['gloss_type'] ?? '') == 'Gloss' ? 'selected' : '' }}>
                                                Gloss
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Gloss Units (GU)</label>
                                        <input type="number" class="form-control" id="glossInput"
                                            name="glossInput"
                                            value="{{ $existingTest->testing[5]['test_value'] ?? '' }}"
                                            placeholder="e.g., 25">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Result</label>
                                        <input type="text" class="form-control text-success fw-semibold"
                                            id="glossResult" readonly name="glossResult"
                                            value="{{ $existingTest->testing[5]['test_result'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Submit Button -->
                        <div class="text-end">
                            <a href="{{ route('admin.view-created-jobcards', $jobcard->order_id) }}"
                                class="btn btn-secondary shadow-sm">
                                <i class="fa-regular fa-circle-left me-2"></i>Back To Jobcards
                            </a>

                            <button type="submit" class="btn btn-primary shadow-sm" id="submitBtn">
                                <i class="fa fa-check-circle me-2"></i>Submit Results
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modern JS Auto Checking -->
<script>
    document.addEventListener('input', function() {
        const adhesion = document.getElementById('adhesionInput').value.trim().toUpperCase();
        const adhesionResult = document.getElementById('adhesionResult');
        adhesionResult.value =
            adhesion.startsWith('GT0') ? '✅ PASS – Excellent adhesion' :
            adhesion.startsWith('GT1') ? '✅ Acceptable adhesion' :
            /GT[2-5]/.test(adhesion) ? '❌ FAIL – Poor adhesion' :
            '';

        const hardness = document.getElementById('hardnessInput').value.trim().toUpperCase();
        const hardnessResult = document.getElementById('hardnessResult');
        if (!hardness) hardnessResult.value = '';
        else if (['H', '2H', '3H', '4H'].includes(hardness)) hardnessResult.value = '✅ PASS – Meets hardness criteria';
        else hardnessResult.value = '❌ FAIL – Below acceptable hardness';

        const impact = parseFloat(document.getElementById('impactInput').value);
        const impactResult = document.getElementById('impactResult');
        if (!isNaN(impact)) {
            impactResult.value = impact >= 50 ? '✅ PASS – Meets architectural grade' :
                impact >= 40 ? '✅ Acceptable – General powder' :
                '❌ FAIL – Below standard';
        } else impactResult.value = '';

        const bend = document.getElementById('bendInput').value;
        const bendResult = document.getElementById('bendResult');
        if (!bend) bendResult.value = '';
        else if (bend.includes('No cracks')) bendResult.value = '✅ PASS';
        else if (bend.includes('Hairline')) bendResult.value = '⚠️ Acceptable';
        else bendResult.value = '❌ FAIL';

        const cup = parseFloat(document.getElementById('cuppingInput').value);
        const cupResult = document.getElementById('cuppingResult');
        if (!isNaN(cup)) cupResult.value = cup >= 8 ? '✅ PASS – Meets Duracoat standard' : '❌ FAIL – Below 8mm';
        else cupResult.value = '';

        const glossType = document.getElementById('glossType').value;
        const glossValue = parseFloat(document.getElementById('glossInput').value);
        const glossResult = document.getElementById('glossResult');
        if (glossType && !isNaN(glossValue)) {
            let pass = false;
            if (glossType === 'Matt' && glossValue >= 10 && glossValue <= 30) pass = true;
            if (glossType === 'Semi-Gloss' && glossValue >= 31 && glossValue <= 70) pass = true;
            if (glossType === 'Gloss' && glossValue >= 71 && glossValue <= 95) pass = true;
            glossResult.value = pass ? '✅ PASS – Within range' : '❌ FAIL – Out of range';
        } else glossResult.value = '';
    });
</script>
@endsection