@extends('auth.master')

@section('content')
    
    <div class="auth-wrapper auth-basic px-2">
        <div class="auth-inner my-2">
            <!-- Login basic -->
            <div class="card mb-0">
                <div class="card-body">
                    <a href="#0" class="brand-logo">
                        <img src="{{ asset($setting->logo) }}" style="height:100px">
                    </a>
                    <form class="auth-login-form mt-2" action="{{ route('login.submit') }}" method="POST">
                        @csrf

                        @if (session('success'))
                            <div class="alert alert-success mt-1 alert-validation-msg" role="alert">
                                <div class="alert-body d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-info me-50">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="16" x2="12" y2="12"></line>
                                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                    </svg>
                                    <span>{{ session('success') }}</span>
                                </div>
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">

                                <p class="mb-0"> <i class="fa fa-times">
                                    </i>
                                    {{ session('error') }}
                                </p>
                                
                            </div>
                        @endif


                        <div class="mb-1">
                            <label for="login-email" class="form-label">Email</label>
                            <input type="text" id="email" class="form-control" id="login-email"
                                name="email" placeholder="Enter Admin Email." value="{{ old('email') }}"
                                aria-describedby="login-email" tabindex="1" autofocus required>

                        </div>

                        <div class="mb-1">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="login-password">Password</label>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input type="password" name="password" required class="form-control form-control-merge"
                                    id="login-password" tabindex="2" placeholder="Enter Password"
                                    aria-describedby="login-password" />
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>

                        <div class="mb-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember-me" name="remember"
                                    tabindex="3" {{ old('remember') ? 'checked' : '' }} />
                                <label class="form-check-label" for="remember-me"> Remember Me </label>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100" tabindex="4">Sign in</button>
                    </form>


                    <div class="divider my-2">
                        <div class="divider-text"></div>
                    </div>

                </div>
            </div>
            <!-- /Login basic -->
        </div>
    </div>
@endsection
