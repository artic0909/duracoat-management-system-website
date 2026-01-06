@extends('manager.layouts.app')

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
                        action="{{ route('manager.jobcard-test.store', $jobcard->id) }}"
                        method="POST" id="qcTestForm">
                        @csrf

                        <h5 class="fw-bolder mb-3 text-primary">🧪 QC Testings & Results</h5>

                        <!-- 1. Substrate -->
                        <div class="card shadow-sm mb-3 border-0">
                            <div class="card-body">
                                <h6 class="fw-semibold mb-3 text-secondary">1. Substrate</h6>
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label class="form-label">Substrate Type</label>
                                        <select class="form-select" id="substrateInput" name="substrateInput">
                                            <option value="">Select Substrate</option>
                                            <option value="Aluminium Profile" {{ ($existingTest->testing[0]['test_value'] ?? '') == 'Aluminium Profile' ? 'selected' : '' }}>Aluminium Profile</option>
                                            <option value="M S Profile" {{ ($existingTest->testing[0]['test_value'] ?? '') == 'M S Profile' ? 'selected' : '' }}>M S Profile</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Result</label>
                                        <input type="text" class="form-control text-success fw-semibold" id="substrateResult" readonly name="substrateResult" value="{{ $existingTest->testing[0]['test_result'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Dry filmThickness -->
                        <div class="card shadow-sm mb-3 border-0">
                            <div class="card-body">
                                <h6 class="fw-semibold mb-3 text-secondary">2. Dry filmThickness ({{ $jobcard->min_micron }} - {{ $jobcard->max_micron }} micron)</h6>
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label class="form-label">Thickness (micron)</label>
                                        <input type="number" class="form-control" id="filmThicknessInput" name="filmThicknessInput" value="{{ $existingTest->testing[1]['test_value'] ?? '' }}" placeholder="Enter thickness">
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Result</label>
                                        <input type="text" class="form-control text-success fw-semibold" id="filmThicknessResult" readonly name="filmThicknessResult" value="{{ $existingTest->testing[1]['test_result'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Baking Temperature -->
                        <div class="card shadow-sm mb-3 border-0">
                            <div class="card-body">
                                <h6 class="fw-semibold mb-3 text-secondary">3. Baking Temperature</h6>
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label class="form-label">Temperature (C)</label>
                                        <input type="text" class="form-control" id="bakingTempInput" name="bakingTempInput" value="{{ $existingTest->testing[2]['test_value'] ?? '' }}" placeholder="e.g. 200">
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Result</label>
                                        <input type="text" class="form-control text-success fw-semibold" id="bakingTempResult" readonly name="bakingTempResult" value="{{ $existingTest->testing[2]['test_result'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 4. Baking Time -->
                        <div class="card shadow-sm mb-3 border-0">
                            <div class="card-body">
                                <h6 class="fw-semibold mb-3 text-secondary">4. Baking Time</h6>
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label class="form-label">Time (Minutes)</label>
                                        <input type="text" class="form-control" id="bakingTimeInput" name="bakingTimeInput" value="{{ $existingTest->testing[3]['test_value'] ?? '' }}" placeholder="e.g. 10">
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Result</label>
                                        <input type="text" class="form-control text-success fw-semibold" id="bakingTimeResult" readonly name="bakingTimeResult" value="{{ $existingTest->testing[3]['test_result'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 5. Colour Uniformity Test -->
                        <div class="card shadow-sm mb-3 border-0">
                            <div class="card-body">
                                <h6 class="fw-semibold mb-3 text-secondary">5. Colour Uniformity Test</h6>
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label class="form-label">Observation</label>
                                        <select class="form-select" id="colourUniformityInput" name="colourUniformityInput">
                                            <option value="">Select Observation</option>
                                            <option value="Close to standard" {{ ($existingTest->testing[4]['test_value'] ?? '') == 'Close to standard' ? 'selected' : '' }}>Close to standard</option>
                                            <option value="Not standard" {{ ($existingTest->testing[4]['test_value'] ?? '') == 'Not standard' ? 'selected' : '' }}>Not standard</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Result</label>
                                        <input type="text" class="form-control text-success fw-semibold" id="colourUniformityResult" readonly name="colourUniformityResult" value="{{ $existingTest->testing[4]['test_result'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                         <!-- 6. M E K Test -->
                         <div class="card shadow-sm mb-3 border-0">
                            <div class="card-body">
                                <h6 class="fw-semibold mb-3 text-secondary">6. M E K Test</h6>
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-3">
                                        <label class="form-label">Rubs (Count)</label>
                                        <input type="number" class="form-control" id="mekRubsInput" name="mekRubsInput" value="{{ $existingTest->testing[5]['rubs_value'] ?? '' }}" placeholder="e.g. 30">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Peel Off?</label>
                                        <select class="form-select" id="mekPeelInput" name="mekPeelInput">
                                            <option value="">Select</option>
                                            <option value="No" {{ ($existingTest->testing[5]['peel_value'] ?? '') == 'No' ? 'selected' : '' }}>No</option>
                                            <option value="Yes" {{ ($existingTest->testing[5]['peel_value'] ?? '') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Result</label>
                                        <input type="text" class="form-control text-success fw-semibold" id="mekResult" readonly name="mekResult" value="{{ $existingTest->testing[5]['test_result'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 7. Cross Hatch Test -->
                         <div class="card shadow-sm mb-3 border-0">
                            <div class="card-body">
                                <h6 class="fw-semibold mb-3 text-secondary">7. Cross Hatch Test</h6>
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label class="form-label">Observation</label>
                                        <select class="form-select" id="crossHatchInput" name="crossHatchInput">
                                            <option value="">Select Observation</option>
                                            <option value="11x1" {{ ($existingTest->testing[6]['test_value'] ?? '') == '11x1' ? 'selected' : '' }}>11x1</option>
                                            <option value="Peel off > 5%" {{ ($existingTest->testing[6]['test_value'] ?? '') == 'Peel off > 5%' ? 'selected' : '' }}>Peel off > 5%</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Result</label>
                                        <input type="text" class="form-control text-success fw-semibold" id="crossHatchResult" readonly name="crossHatchResult" value="{{ $existingTest->testing[6]['test_result'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 8. Conical Mandrel Test -->
                        <div class="card shadow-sm mb-3 border-0">
                            <div class="card-body">
                                <h6 class="fw-semibold mb-3 text-secondary">8. Conical Mandrel Test</h6>
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label class="form-label">Observation</label>
                                         <select class="form-select" id="mandrelInput" name="mandrelInput">
                                            <option value="">Select Observation</option>
                                            <option value="No Crack" {{ ($existingTest->testing[7]['test_value'] ?? '') == 'No Crack' ? 'selected' : '' }}>No Crack</option>
                                            <option value="Cracked" {{ ($existingTest->testing[7]['test_value'] ?? '') == 'Cracked' ? 'selected' : '' }}>Cracked</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Result</label>
                                        <input type="text" class="form-control text-success fw-semibold" id="mandrelResult" readonly name="mandrelResult" value="{{ $existingTest->testing[7]['test_result'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 9. Pencil Hardness Test -->
                        <div class="card shadow-sm mb-3 border-0">
                            <div class="card-body">
                                <h6 class="fw-semibold mb-3 text-secondary">9. Pencil Hardness Test</h6>
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label class="form-label">Hardness (H/h)</label>
                                        <input type="text" class="form-control" id="pencilHardnessInput" name="pencilHardnessInput" value="{{ $existingTest->testing[8]['test_value'] ?? '' }}" placeholder="e.g. H">
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Result</label>
                                        <input type="text" class="form-control text-success fw-semibold" id="pencilHardnessResult" readonly name="pencilHardnessResult" value="{{ $existingTest->testing[8]['test_result'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-end">
                            <a href="{{ route('manager.view-created-jobcards', $jobcard->order_id) }}"
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
    document.addEventListener('DOMContentLoaded', function() {
        validateQC();
    });

    document.addEventListener('input', function() {
        validateQC();
    });

    function validateQC() {
        function updateResultClass(element, isPass) {
            if (isPass) {
                element.classList.remove('text-danger');
                element.classList.add('text-success');
            } else {
                element.classList.remove('text-success');
                element.classList.add('text-danger');
            }
        }

        // 1. Substrate
        const substrateInput = document.getElementById('substrateInput');
        const substrateResult = document.getElementById('substrateResult');
        if(substrateInput && substrateResult) {
            const val = substrateInput.value;
            // Only update if not already set or ensure consistency
            // Logic: substrate selects -> result is fixed text
            if(val) {
                 substrateResult.value = 'Observations: Reference - AAMA 2603';
                 updateResultClass(substrateResult, true);
            } else {
                 substrateResult.value = '';
                 substrateResult.classList.remove('text-danger', 'text-success');
            }
        }

        // 2. Dry Film Thickness
        const thicknessInput = document.getElementById('filmThicknessInput');
        const thicknessResult = document.getElementById('filmThicknessResult');
        if(thicknessInput && thicknessResult) {
            const thickness = parseFloat(thicknessInput.value);
            const minMicron = parseFloat('{{ $jobcard->min_micron }}');
            const maxMicron = parseFloat('{{ $jobcard->max_micron }}');

            if (!isNaN(thickness) && minMicron && maxMicron) {
                 if (thickness >= minMicron && thickness <= maxMicron) {
                     thicknessResult.value = 'Pass';
                     updateResultClass(thicknessResult, true);
                 } else {
                     thicknessResult.value = 'Fail';
                     updateResultClass(thicknessResult, false);
                 }
            } else if (!isNaN(thickness)) {
                 thicknessResult.value = 'Fail (Micron range not set)';
                 updateResultClass(thicknessResult, false);
            } else {
                thicknessResult.value = '';
                thicknessResult.classList.remove('text-danger', 'text-success');
            }
        }

        // 3. Baking Temp
        const tempInput = document.getElementById('bakingTempInput');
        const tempResult = document.getElementById('bakingTempResult');
        if(tempInput && tempResult) {
            const temp = tempInput.value.trim();
            if(temp) {
                 if(temp.includes('200')) {
                     tempResult.value = 'Pass';
                     updateResultClass(tempResult, true);
                 } else {
                     if (parseInt(temp) === 200) {
                        tempResult.value = 'Pass';
                        updateResultClass(tempResult, true);
                     } else {
                        tempResult.value = 'Fail';
                        updateResultClass(tempResult, false);
                     }
                 }
            } else {
                tempResult.value = '';
                tempResult.classList.remove('text-danger', 'text-success');
            }
        }

        // 4. Baking Time
        const timeInput = document.getElementById('bakingTimeInput');
        const timeResult = document.getElementById('bakingTimeResult');
        if(timeInput && timeResult) {
            const time = timeInput.value.trim();
            if(time) {
                 if (parseInt(time) === 10) {
                     timeResult.value = 'Pass';
                     updateResultClass(timeResult, true);
                 } else {
                     timeResult.value = 'Fail';
                     updateResultClass(timeResult, false);
                 }
            } else {
                timeResult.value = '';
                timeResult.classList.remove('text-danger', 'text-success');
            }
        }

        // 5. Colour Uniformity
        const colourInput = document.getElementById('colourUniformityInput');
        const colourResult = document.getElementById('colourUniformityResult');
        if(colourInput && colourResult) {
            const colour = colourInput.value;
            if(colour) {
                 if (colour === 'Close to standard') {
                     colourResult.value = 'Pass';
                     updateResultClass(colourResult, true);
                 } else {
                     colourResult.value = 'Fail';
                     updateResultClass(colourResult, false);
                 }
            } else {
                colourResult.value = '';
                colourResult.classList.remove('text-danger', 'text-success');
            }
        }

        // 6. MEK Test
        const rubsInput = document.getElementById('mekRubsInput');
        const peelInput = document.getElementById('mekPeelInput');
        const mekResult = document.getElementById('mekResult');
        if(rubsInput && peelInput && mekResult) {
            const rubs = parseInt(rubsInput.value);
            const peel = peelInput.value;
            
            if (!isNaN(rubs) && peel) {
                if (rubs >= 30 && peel === 'No') {
                    mekResult.value = 'No Peel off'; // Pass
                    updateResultClass(mekResult, true);
                } else {
                    mekResult.value = 'Fail';
                    updateResultClass(mekResult, false);
                }
            } else {
                mekResult.value = '';
                mekResult.classList.remove('text-danger', 'text-success');
            }
        }

        // 7. Cross Hatch
        const crossInput = document.getElementById('crossHatchInput');
        const crossResult = document.getElementById('crossHatchResult');
        if(crossInput && crossResult) {
            const cross = crossInput.value;
            if(cross) {
                if(cross === '11x1') {
                    crossResult.value = 'No Peel off';
                    updateResultClass(crossResult, true);
                } else {
                    crossResult.value = 'Fail';
                    updateResultClass(crossResult, false);
                }
            } else {
                crossResult.value = '';
                crossResult.classList.remove('text-danger', 'text-success');
            }
        }

        // 8. Conical Mandrel
        const mandrelInput = document.getElementById('mandrelInput');
        const mandrelResult = document.getElementById('mandrelResult');
        if(mandrelInput && mandrelResult) {
            const mandrel = mandrelInput.value;
            if(mandrel) {
                if(mandrel === 'No Crack') {
                    mandrelResult.value = 'No Crack';
                    updateResultClass(mandrelResult, true);
                } else {
                    mandrelResult.value = 'Fail';
                    updateResultClass(mandrelResult, false);
                }
            } else {
                mandrelResult.value = '';
                mandrelResult.classList.remove('text-danger', 'text-success');
            }
        }

        // 9. Pencil Hardness
        const pencilInput = document.getElementById('pencilHardnessInput');
        const pencilResult = document.getElementById('pencilHardnessResult');
        if(pencilInput && pencilResult) {
            const pencil = pencilInput.value.trim();
            if(pencil) {
                if(pencil === 'H' || pencil === 'h') {
                    pencilResult.value = 'Pass';
                    updateResultClass(pencilResult, true);
                } else {
                    pencilResult.value = 'Fail';
                    updateResultClass(pencilResult, false);
                }
            } else {
                pencilResult.value = '';
                pencilResult.classList.remove('text-danger', 'text-success');
            }
        }
    }
</script>
@endsection