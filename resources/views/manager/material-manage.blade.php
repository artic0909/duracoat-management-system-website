@extends('manager.layouts.app')

@section('title', 'Clients & Materials Management')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
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
                        Manage Clients & Materials
                    </li>
                </ol>
                <h6 class="font-weight-bolder mb-0">All Clients & Materials</h6>
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
                            <table class="table table-bordered align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Client's Details
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Mobile
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Email
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Material Details
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
                                                    <h6 class="mb-0 text-sm">Client Name</h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        Unique ID
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                9685552658
                                            </p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">client@gmail.com</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <!-- Nested table starts here -->
                                            <table class="table table-responsive table-bordered">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th class="text-xs text-secondary">
                                                            Material Name
                                                        </th>
                                                        <th class="text-xs text-secondary">
                                                            Quantity
                                                        </th>
                                                        <th class="text-xs text-secondary">
                                                            Paint Name - Code
                                                        </th>
                                                        <th class="text-xs text-secondary">
                                                            Paint Use (qty)
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-xs">Iron Rod(MS)</td>
                                                        <td class="text-xs">250 KG</td>
                                                        <td class="text-xs">
                                                            <p class="m-0 text-xs">Red Oxide</p>
                                                            <p class="m-0 text-xs fw-bolder">RAL-334</p>
                                                        </td>
                                                        <td class="text-xs">32 KG</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-xs">Cement(MS)</td>
                                                        <td class="text-xs">400 Nos</td>
                                                        <td class="text-xs">
                                                            <p class="m-0 text-xs">Red Oxide</p>
                                                            <p class="m-0 text-xs fw-bolder">RAL-334</p>
                                                        </td>
                                                        <td class="text-xs">32 KG</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!-- Nested table ends here -->
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button type="button" class="btn btn-info px-3 py-2 rounded m-0"
                                                    data-bs-toggle="modal" data-bs-target="#editModal">
                                                    <i class="fa fa-pencil"></i>
                                                </button>

                                                <button type="button" class="btn btn-danger px-3 py-2 rounded m-0"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                    <i class="fa fa-trash"></i>
                                                </button>
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




    <!-- Add Button -->
    <button type="button" class="btn btn-primary addFixedModalButton" data-bs-toggle="modal"
        data-bs-target="#addModal">
        <i class="fa fa-plus"></i>
    </button>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addClientModalLabel">Add Client Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <form id="addClientForm" method="POST" action="">

                    <div class="modal-body">
                        <!-- Client Info -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Client Name</label>
                                <input type="text" class="form-control" name="client_name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Unique ID</label>
                                <input type="text" class="form-control" name="unique_id" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Mobile</label>
                                <input type="number" class="form-control" name="mobile" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>

                        <hr>
                        <h6 class="fw-bold text-secondary mb-3">Material Details</h6>

                        <!-- Dynamic Material Details Section -->
                        <div id="material-details-container">
                            <div class="row g-2 material-row mb-2">
                                <div class="col-md-1">
                                    <select name="materials[0][type]" class="form-select" required>
                                        <option value="">Type</option>
                                        <option value="MS">MS</option>
                                        <option value="ALU">ALU</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="materials[0][name]" class="form-control"
                                        placeholder="Material Name" required>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="materials[0][quantity]" class="form-control"
                                        placeholder="Quantity" required>
                                </div>
                                <div class="col-md-2">
                                    <select name="materials[0][units]" class="form-select" required>
                                        <option value="">Select Unit</option>
                                        <option value="KG">KG</option>
                                        <option value="Nos">Nos</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="materials[0][paint_use]" class="form-select" required>
                                        <option value="">Select Paint</option>
                                        <option value="Red Oxide">Red Oxide</option>
                                        <option value="White Paint">White Paint</option>
                                        <option value="Black Enamel">Black Enamel</option>
                                    </select>
                                </div>
                                <div class="col-md-1 d-flex align-items-center">
                                    <button type="button" class="btn btn-success btn-sm add-material-row">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- /Material Details Section -->
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save Client</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal need code again for this-->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addClientModalLabel">Update Client Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <form id="addClientForm" method="POST" action="">

                    <div class="modal-body">
                        <!-- Client Info -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Client Name</label>
                                <input type="text" class="form-control" name="client_name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Unique ID</label>
                                <input type="text" class="form-control" name="unique_id" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Mobile</label>
                                <input type="text" class="form-control" name="mobile" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>

                        <hr>
                        <h6 class="fw-bold text-secondary mb-3">Material Details</h6>

                        <!-- Dynamic Material Details Section -->
                        <div id="material-details-container">
                            <div class="row g-2 material-row mb-2">
                                <div class="col-md-1">
                                    <select name="materials[0][type]" class="form-select" required>
                                        <option value="">Type</option>
                                        <option value="MS">MS</option>
                                        <option value="ALU">ALU</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="materials[0][name]" class="form-control"
                                        placeholder="Material Name" required>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="materials[0][units]" class="form-control"
                                        placeholder="Units" required>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="materials[0][quantity]" class="form-control"
                                        placeholder="Quantity (KG)" required>
                                </div>
                                <div class="col-md-3">
                                    <select name="materials[0][paint_use]" class="form-select" required>
                                        <option value="">Select Paint</option>
                                        <option value="Red Oxide">Red Oxide</option>
                                        <option value="White Paint">White Paint</option>
                                        <option value="Black Enamel">Black Enamel</option>
                                    </select>
                                </div>
                                <div class="col-md-1 d-flex align-items-center">
                                    <button type="button" class="btn btn-success btn-sm add-material-row">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- /Material Details Section -->
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Update Client</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Client's Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this Client's Details?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>


    <!-- JS for Dynamic Material Rows -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let materialIndex = 1;

            document.addEventListener('click', function(e) {
                // Add Material Row
                if (e.target.closest('.add-material-row')) {
                    e.preventDefault();
                    const container = document.getElementById('material-details-container');
                    const newRow = document.createElement('div');
                    newRow.classList.add('row', 'g-2', 'material-row', 'mb-2');

                    newRow.innerHTML = `
                    <div class="col-md-1">
                                        <select name="materials[0][type]" class="form-select" required>
                                            <option value="">Type</option>
                                            <option value="MS">MS</option>
                                            <option value="ALU">ALU</option>
                                        </select>
                                    </div>
          <div class="col-md-3">
            <input type="text" name="materials[${materialIndex}][name]" class="form-control"
                   placeholder="Material Name" required>
          </div>
          <div class="col-md-2">
            <input type="number" name="materials[${materialIndex}][quantity]" class="form-control"
                   placeholder="Quantity" required>
          </div>
          <div class="col-md-2">
            <select name="materials[${materialIndex}][units]" class="form-select" required>
              <option value="">Select Unit</option>
              <option value="KG">KG</option>
              <option value="Nos">Nos</option>
            </select>
          </div>
          <div class="col-md-3">
            <select name="materials[${materialIndex}][paint_use]" class="form-select" required>
              <option value="">Select Paint</option>
              <option value="Red Oxide">Red Oxide</option>
              <option value="White Paint">White Paint</option>
              <option value="Black Enamel">Black Enamel</option>
            </select>
          </div>
          <div class="col-md-1 d-flex align-items-center">
            <button type="button" class="btn btn-danger btn-sm remove-material-row">
              <i class="fa fa-times"></i>
            </button>
          </div>
        `;

                    container.appendChild(newRow);
                    materialIndex++;
                }

                // Remove Material Row
                if (e.target.closest('.remove-material-row')) {
                    e.preventDefault();
                    e.target.closest('.material-row').remove();
                }
            });
        });
    </script>
    @endsection