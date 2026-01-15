@extends('viewer.layouts.app')

@section('title', 'Total Powder Applied')

@section('content')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Total Powder Applied</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SL
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Jobcard No</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Creation Date</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Client Name</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Order No</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Material Name</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Quantity</th>
                                        <th
                                            class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jobcards as $key => $jobcard)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $jobcards->firstItem() + $key }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $jobcard->jobcard_number }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($jobcard->jobcard_creation_date)->format('d-m-Y') }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $jobcard->order->client->client_name ?? 'N/A' }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $jobcard->order->order_number ?? 'N/A' }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $jobcard->material_name }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $jobcard->material_quantity }}
                                                    {{ $jobcard->material_unit }}</p>
                                            </td>
                                            <td class="align-middle text-start text-sm">
                                                <span
                                                <span
                                                    class="badge badge-sm bg-gradient-warning">{{ ucfirst($jobcard->jobcard_status) }}</span>
                                                <p class="text-xs font-weight-bold mb-0 mt-1">{{ $jobcard->powder_apply_date ? \Carbon\Carbon::parse($jobcard->powder_apply_date)->format('d-m-Y') : 'N/A' }}</p>
                                            </td>

                                            <td class="align-middle text-start">
                                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{ $jobcard->id }}">
                                                    View
                                                </button>

                                                <!-- View Modal -->
                                                <div class="modal fade" id="viewModal{{ $jobcard->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $jobcard->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-light">
                                                                <h5 class="modal-title" id="viewModalLabel{{ $jobcard->id }}">Jobcard Details: {{ $jobcard->jobcard_number }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-start">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <h6 class="text-primary font-weight-bold border-bottom pb-2">Client & Order Details</h6>
                                                                        <p class="mb-1"><strong>Client Name:</strong> {{ $jobcard->order->client->client_name ?? 'N/A' }}</p>
                                                                        <p class="mb-1"><strong>Email:</strong> {{ $jobcard->order->client->email ?? 'N/A' }}</p>
                                                                        <p class="mb-1"><strong>Phone:</strong> {{ $jobcard->order->client->mobile ?? 'N/A' }}</p>
                                                                        <p class="mb-2"><strong>Address:</strong> {{ $jobcard->order->client->address ?? 'N/A' }}</p>
                                                                        <p class="mb-1 mt-3"><strong>Order Number:</strong> <span class="badge bg-secondary">{{ $jobcard->order->order_number ?? 'N/A' }}</span></p>
                                                                        <p class="mb-1"><strong>Order Date:</strong> {{ $jobcard->order->created_at ? $jobcard->order->created_at->format('d-m-Y') : 'N/A' }}</p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <h6 class="text-primary font-weight-bold border-bottom pb-2">Jobcard Information</h6>
                                                                        <p class="mb-1"><strong>Jobcard No:</strong> <span class="badge bg-primary">{{ $jobcard->jobcard_number }}</span></p>
                                                                        <p class="mb-1"><strong>Status:</strong> <span class="badge bg-warning">{{ ucfirst($jobcard->jobcard_status) }}</span></p>
                                                                        <p class="mb-1"><strong>Created Date:</strong> {{ \Carbon\Carbon::parse($jobcard->jobcard_creation_date)->format('d-m-Y') }}</p>
                                                                    </div>
                                                                </div>
                                                                <hr class="my-4">
                                                                <h6 class="text-primary font-weight-bold border-bottom pb-2">Material & Paint Details</h6>
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered table-sm mb-0">
                                                                        <thead class="table-light">
                                                                            <tr>
                                                                                <th>Material</th>
                                                                                <th>Quantity</th>
                                                                                <th>Paint/RAL Code</th>
                                                                                <th>Brand</th>
                                                                                <th>Shade</th>
                                                                                <th>Finish</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="align-middle">{{ $jobcard->material_name }}</td>
                                                                                <td class="align-middle">{{ $jobcard->material_quantity }} {{ $jobcard->material_unit }}</td>
                                                                                <td class="align-middle">{{ $jobcard->paint->ral_code ?? 'N/A' }}</td>
                                                                                <td class="align-middle">{{ $jobcard->paint->brand_name ?? 'N/A' }}</td>
                                                                                <td class="align-middle">{{ $jobcard->paint->shade_name ?? 'N/A' }}</td>
                                                                                <td class="align-middle">{{ $jobcard->paint->finish ?? 'N/A' }}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                @if($jobcard->description)
                                                                <div class="mt-3">
                                                                    <strong>Description/Notes:</strong>
                                                                    <p class="text-sm text-muted border p-2 rounded bg-light">{{ $jobcard->description }}</p>
                                                                </div>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div
                        class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
                        <div class="d-flex align-items-center mb-3 mb-lg-0">
                            <span class="text-sm text-secondary">
                                Showing {{ $jobcards->firstItem() }} to {{ $jobcards->lastItem() }} of
                                {{ $jobcards->total() }} entries
                            </span>
                        </div>
                        <div class="d-flex align-items-center">
                            {{ $jobcards->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
