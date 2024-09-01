@extends('layouts.app')

@section('content')
    <!-- Container utama untuk form -->
    <div class="container mt-5">
        <a href="{{ route('home') }}" class="btn btn-secondary mb-4">
            Back
        </a>

        <!-- Card untuk form ganti password -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Change Password</h5>
            </div>
            <div class="card-body">
                <form id="changePasswordForm">
                    <!-- Current Password -->
                    <div class="mb-3">
                        <label for="currentPasswordInput" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="currentPasswordInput"
                            placeholder="Enter your current password">
                    </div>

                    <!-- New Password -->
                    <div class="mb-3">
                        <label for="newPasswordInput" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="newPasswordInput"
                            placeholder="Enter your new password">
                    </div>

                    <!-- Error Message -->
                    <div id="changePasswordError" class="alert alert-danger d-none" role="alert">
                        <i class="fas fa-exclamation-circle"></i> Password salah atau baru tidak cocok. Silakan coba lagi.
                    </div>
                </form>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="button" class="btn btn-primary" id="submitChangePassword">
                    Submit
                </button>
            </div>
        </div>
    </div>
@endsection

