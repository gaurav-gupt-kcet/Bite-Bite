@extends('layouts.frontend')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card fade-in-up">
                <div class="card-header text-center">
                    <h4><i class="bi bi-shield-lock"></i> Verify Your Account</h4>
                </div>
                <div class="card-body p-4">
                    <p class="text-center mb-4">
                        <i class="bi bi-envelope-check" style="font-size: 48px; color: #ff6b35;"></i>
                    </p>
                    <p class="text-center mb-3">
                        We've sent a verification code to your email. 
                    </p>
                    <div class="alert alert-info text-center">
                        <i class="bi bi-info-circle"></i> <strong>Demo Mode:</strong> OTP will be shown after registration!
                    </div>

                    @if(session('success'))
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle"></i> {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('otp.verify') }}">
                        @csrf

                        <!-- OTP Input -->
                        <div class="mb-3">
                            <label for="otp" class="form-label text-center d-block"><i class="bi bi-key"></i> Enter 6-digit OTP</label>
                            <input id="otp" type="text" class="form-control text-center @error('otp') is-invalid @enderror" 
                                   name="otp" value="" required autofocus 
                                   maxlength="6" pattern="[0-9]*" inputmode="numeric"
                                   placeholder="000000" style="letter-spacing: 8px; font-size: 28px; font-weight: bold;">
                            @error('otp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-check-circle"></i> Verify OTP
                            </button>
                        </div>
                    </form>

                    <hr>

                    <div class="text-center">
                        <p class="mb-2">Didn't receive the OTP?</p>
                        <form method="POST" action="{{ route('otp.resend') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="bi bi-arrow-clockwise"></i> Resend OTP
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection