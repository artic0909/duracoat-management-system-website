@extends('admin.layouts.app')

@section('title', 'Paints Management')

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
                        Paints
                    </li>
                </ol>
                <h6 class="font-weight-bolder mb-0">All Used Paints</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">

                    <form method="GET" action="{{ route('admin.used-paints') }}"
                        style="display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 15px; flex-wrap: wrap;">

                        <!-- Search Input + Button -->
                        <div style="display: flex; align-items: center; justify-content: center; gap: 5px;">
                            <input type="text" name="search" placeholder="Search by RAL code"
                                value="{{ request('search') }}"
                                style="padding: 8px 12px; border: 1px solid #ccc; border-radius: 6px; width: 220px;">

                        </div>

                        <!-- From Date + To Date Filter -->
                        <!-- <div style="display: flex; align-items: center; gap: 8px;">
                            From:<input type="date" name="from_date" value="{{ request('from_date') }}"
                                style="padding: 8px 12px; border: 1px solid #ccc; border-radius: 6px;">
                            To:<input type="date" name="to_date" value="{{ request('to_date') }}"
                                style="padding: 8px 12px; border: 1px solid #ccc; border-radius: 6px;">
                        </div> -->

                        <button type="submit"
                            style="background-color: #17a2b8; color: white; border: none; border-radius: 6px; padding: 8px 14px; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-search" style="margin-right: 5px;"></i> Search
                        </button>

                        <!-- Reset Button -->
                        @if(request('search') || request('from_date') || request('to_date'))
                            <a href="{{ route('admin.used-paints') }}"
                                style="background-color: #6c757d; color: white; border: none; border-radius: 6px; padding: 8px 14px; text-decoration: none;">
                                Reset
                            </a>
                        @endif
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
                                <a class="dropdown-item border-radius-md" href="{{route('admin.profile')}}">
                                    <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <img src="{{asset('assets/img/team-2.jpg')}}" class="avatar avatar-sm me-3" />
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
                                <a class="dropdown-item border-radius-md" href="{{route('admin.logout')}}">
                                    <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <img src="{{asset('assets/img/team-2.jpg')}}"
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
                                        <th
                                            class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Date</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Paint Details
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Brand Name
                                        </th>
                                        <th
                                            class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            RAL
                                        </th>
                                        <th
                                            class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Shade Name
                                        </th>
                                        <th
                                            class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Finish
                                        </th>
                                        <th
                                            class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Total Used Quantity
                                        </th>
                                        <!-- <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Actions
                                        </th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($usedPaints as $paint)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{$loop->iteration}}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ \Carbon\Carbon::parse($paint->last_updated_at ?? $paint->last_created_at)->format('d-m-Y') }}
                                                </p>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 text-sm">{{$paint->paint->ral_code}}</h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    {{$paint->paint->paint_unique_id}}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{$paint->paint->brand_name}}</p>
                                            </td>
                                            <td class="align-middle text-start text-sm">
                                                <span class="badge badge-sm bg-primary">{{$paint->paint->ral_code}}</span>
                                            </td>
                                            <td class="align-middle text-start">
                                                <span class="text-secondary text-xs font-weight-bold"
                                                    style="text-transform: capitalize;">{{$paint->paint->shade_name}}</span>
                                            </td>
                                            <td class="align-middle text-start">
                                                <span class="text-secondary text-xs font-weight-bold"
                                                    style="text-transform: capitalize;">{{$paint->paint->finish}}</span>
                                            </td>
                                            <td class="align-middle text-start">
                                                <span
                                                    class="badge badge-sm bg-primary">{{ number_format($paint->total_used_paint, 2) }}
                                                    KG</span>
                                            </td>

                                            <!-- <td class="align-middle text-center text-sm">
                                                <div class="d-flex gap-2 justify-content-center">
                                                    <button type="button" class="btn btn-info px-3 py-2 rounded m-0"
                                                        data-bs-toggle="modal" data-bs-target="#editModal{{$paint->id}}">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-danger px-3 py-2 rounded m-0"
                                                        data-bs-toggle="modal" data-bs-target="#deleteModal{{$paint->id}}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td> -->
                                        </tr>
                                    @endforeach
                                </tbody>

                                <!-- Pagination -->
                                <tfoot>
                                    <tr>
                                        <td colspan="9" class="text-start">
                                            <div class="d-flex justify-content-center align-items-center gap-3 mt-3">
                                                @if ($usedPaints->onFirstPage())
                                                    <span class="text-muted">Prev</span>
                                                @else
                                                    <a href="{{ $usedPaints->previousPageUrl() }}"
                                                        class="text-primary text-decoration-none">Prev</a>
                                                @endif

                                                <span>{{ $usedPaints->currentPage() }} /
                                                    {{ $usedPaints->lastPage() }}</span>

                                                @if ($usedPaints->hasMorePages())
                                                    <a href="{{ $usedPaints->nextPageUrl() }}"
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

@endsection