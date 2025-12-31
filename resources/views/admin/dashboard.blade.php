@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <x-admin.dashboard-card />

    <div class="row gy-4 mt-1">
        <x-admin.dashboard-user-list />
        <div class="col-xxl-3 col-xl-12">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <h6 class="mb-2 fw-bold text-lg mb-0">Top Performer</h6>
                        <a href="javascript:void(0)"
                            class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                            View All
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                        </a>
                    </div>

                    <div class="mt-32">

                        <div class="d-flex align-items-center justify-content-between gap-3 mb-24">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/users/user1.png') }}" alt=""
                                    class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                <div class="flex-grow-1">
                                    <h6 class="text-md mb-0 fw-medium">Dianne Russell</h6>
                                    <span class="text-sm text-secondary-light fw-medium">Agent ID: 36254</span>
                                </div>
                            </div>
                            <span class="text-primary-light text-md fw-medium">$20</span>
                        </div>

                        <div class="d-flex align-items-center justify-content-between gap-3 mb-24">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/users/user2.png') }}" alt=""
                                    class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                <div class="flex-grow-1">
                                    <h6 class="text-md mb-0 fw-medium">Wade Warren</h6>
                                    <span class="text-sm text-secondary-light fw-medium">Agent ID: 36254</span>
                                </div>
                            </div>
                            <span class="text-primary-light text-md fw-medium">$20</span>
                        </div>

                        <div class="d-flex align-items-center justify-content-between gap-3 mb-24">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/users/user3.png') }}" alt=""
                                    class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                <div class="flex-grow-1">
                                    <h6 class="text-md mb-0 fw-medium">Albert Flores</h6>
                                    <span class="text-sm text-secondary-light fw-medium">Agent ID: 36254</span>
                                </div>
                            </div>
                            <span class="text-primary-light text-md fw-medium">$30</span>
                        </div>

                        <div class="d-flex align-items-center justify-content-between gap-3 mb-24">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/users/user4.png') }}" alt=""
                                    class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                <div class="flex-grow-1">
                                    <h6 class="text-md mb-0 fw-medium">Bessie Cooper</h6>
                                    <span class="text-sm text-secondary-light fw-medium">Agent ID: 36254</span>
                                </div>
                            </div>
                            <span class="text-primary-light text-md fw-medium">$40</span>
                        </div>

                        <div class="d-flex align-items-center justify-content-between gap-3 mb-24">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/users/user5.png') }}" alt=""
                                    class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                <div class="flex-grow-1">
                                    <h6 class="text-md mb-0 fw-medium">Arlene McCoy</h6>
                                    <span class="text-sm text-secondary-light fw-medium">Agent ID: 36254</span>
                                </div>
                            </div>
                            <span class="text-primary-light text-md fw-medium">$10</span>
                        </div>

                        <div class="d-flex align-items-center justify-content-between gap-3">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/users/user1.png') }}" alt=""
                                    class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                <div class="flex-grow-1">
                                    <h6 class="text-md mb-0 fw-medium">Arlene McCoy</h6>
                                    <span class="text-sm text-secondary-light fw-medium">Agent ID: 36254</span>
                                </div>
                            </div>
                            <span class="text-primary-light text-md fw-medium">$10</span>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
