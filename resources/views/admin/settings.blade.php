@extends('layouts.admin')

@section('page-title', 'Settings')

@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5><i class="bi bi-gear me-2"></i>Site Settings</h5>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                </div>
                @endif
                
                <form action="/admin/settings/update" method="POST">
                    @csrf
                    
                    <h6 class="mb-3 text-muted">General Information</h6>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Site Name</label>
                                <input type="text" name="site_name" class="form-control" value="{{ env('SITE_NAME', 'Bite Bite') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Site Email</label>
                                <input type="email" name="site_email" class="form-control" value="{{ env('SITE_EMAIL', 'info@shuddhswad.com') }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="site_phone" class="form-control" value="{{ env('SITE_PHONE', '+91 9876543210') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" name="site_address" class="form-control" value="{{ env('SITE_ADDRESS', 'Mumbai, India') }}">
                            </div>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <h6 class="mb-3 text-muted">Social Media Links</h6>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Facebook URL</label>
                                <input type="url" name="facebook_url" class="form-control" placeholder="https://facebook.com/..." value="{{ env('FACEBOOK_URL', '') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Instagram URL</label>
                                <input type="url" name="instagram_url" class="form-control" placeholder="https://instagram.com/..." value="{{ env('INSTAGRAM_URL', '') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Twitter URL</label>
                                <input type="url" name="twitter_url" class="form-control" placeholder="https://twitter.com/..." value="{{ env('TWITTER_URL', '') }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i> Save Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5><i class="bi bi-info-circle me-2"></i>Quick Info</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="text-muted small">PHP Version</label>
                    <p class="mb-0">{{ phpversion() }}</p>
                </div>
                <div class="mb-3">
                    <label class="text-muted small">Laravel Version</label>
                    <p class="mb-0">{{ app()->version() }}</p>
                </div>
                <div class="mb-3">
                    <label class="text-muted small">Environment</label>
                    <p class="mb-0">{{ app()->environment() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
