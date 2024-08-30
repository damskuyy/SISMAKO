@extends('layouts.app')

@section('content')
    <livewire:layout.header />
    <div class="card">
        <div class="img-fluid py-6" style="background-image: url('dist/img/gif/bg.png');">

            <div class="container">
                <div class="row">
                    <div class="col-md-4 modals">
                        <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#passwordModal"
                            data-url="/database">
                            <div class="card shadow-sm mb-4 hover-shadow"
                                style="background-color: rgba(0, 123, 255, 0.25);">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ asset('dist/img/gif/protection.gif') }}" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                        Database
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 modals">
                        <a href="#" class="text-decoration-none" data-bs-toggle="modal"
                            data-bs-target="#passwordModal" data-url="/korespondensi">
                            <div class="card shadow-sm mb-4 hover-shadow"
                                style="background-color: rgba(0, 123, 255, 0.25);">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ asset('dist/img/gif/passport.gif') }}" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                        Korespondensi
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 modals">
                        <a href="#" class="text-decoration-none" data-bs-toggle="modal"
                            data-bs-target="#passwordModal" data-url="/administrasi">
                            <div class="card shadow-sm mb-4 hover-shadow" style="background-color: rgba(255, 0, 0, 0.25);">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ asset('dist/img/gif/files.gif') }}" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                        Administrasi
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 modals">
                        <a href="#" class="text-decoration-none" data-bs-toggle="modal"
                            data-bs-target="#passwordModal" data-url="/penilaian">
                            <div class="card shadow-sm mb-4 hover-shadow"
                                style="background-color: rgba(0, 123, 255, 0.25);">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ asset('dist/img/gif/passed.gif') }}" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                        Penilaian
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 modals">
                        <a href="#" class="text-decoration-none" data-bs-toggle="modal"
                            data-bs-target="#passwordModal" data-url="/sarpras">
                            <div class="card shadow-sm mb-4 hover-shadow" style="background-color: rgba(255, 0, 0, 0.25);">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ asset('dist/img/gif/school.gif') }}" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                        Sarpras
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 modals">
                        <a href="#" class="text-decoration-none" data-bs-toggle="modal"
                            data-bs-target="#passwordModal" data-url="/finance">
                            <div class="card shadow-sm mb-4 hover-shadow" style="background-color: rgba(0, 128, 0, 0.25);">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ asset('dist/img/gif/dollar.gif') }}" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                        Keuangan
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 modals">
                        <a href="#" class="text-decoration-none" data-bs-toggle="modal"
                            data-bs-target="#passwordModal" data-url="/finance">
                            <div class="card shadow-sm mb-4 hover-shadow" style="background-color:  rgba(255, 0, 0, 0.25);">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ asset('dist/img/gif/360-feedback.gif') }}" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                        Penilaian Kinerja Guru (PKG)
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 modals">
                        <a href="#" class="text-decoration-none" data-bs-toggle="modal"
                            data-bs-target="#passwordModal" data-url="/sekolah-keasramaan">
                            <div class="card shadow-sm mb-4 hover-shadow"
                                style="background-color:  rgba(0, 128, 0, 0.25);">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ asset('dist/img/gif/quran.gif') }}" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                        Sekolah dan Keasramaan
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('created-by') }}" class="text-decoration-none">
                            <div class="card shadow-sm mb-4 hover-shadow"
                                style="background-color: rgba(0, 128, 0, 0.25);">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ asset('dist/img/gif/management-consulting.gif') }}" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                        Created By
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for entering current password -->
        <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="passwordModalLabel">Enter Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="passwordForm">
                            <div class="mb-3">
                                <label for="passwordInput" class="form-label">Password</label>
                                <input type="password" class="form-control" id="passwordInput"
                                    placeholder="Enter your password">
                            </div>
                            <div id="passwordError" class="alert alert-danger d-none" role="alert">
                                Password salah. Silakan coba lagi.
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="submitPassword">Submit</button>
                        <button type="button" class="btn btn-link" id="changePasswordButton">Change Password</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for changing password -->
        <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="changePasswordForm">
                            <div class="mb-3">
                                <label for="currentPasswordInput" class="form-label">Current Password</label>
                                <input type="password" class="form-control" id="currentPasswordInput"
                                    placeholder="Enter your current password">
                            </div>
                            <div class="mb-3">
                                <label for="newPasswordInput" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="newPasswordInput"
                                    placeholder="Enter your new password">
                            </div>
                            <div id="changePasswordError" class="alert alert-danger d-none" role="alert">
                                Password salah atau baru tidak cocok. Silakan coba lagi.
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="submitChangePassword">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for successful password change -->
        <div class="modal modal-blur fade show" id="modal-success" tabindex="-1" role="dialog"
            style="display: none;">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-status bg-success"></div>
                    <div class="modal-body text-center py-4">
                        <!-- SVG yang diperbesar dan dipastikan di tengah -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon mb-2 text-green icon-lg d-block mx-auto">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                            <path d="M9 12l2 2l4 -4"></path>
                        </svg>
                        <h3>Password Successfully Changed</h3>
                        <div class="text-secondary">Make sure you don't forget the password you just changed</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modalKorepondensi --}}
@endsection
