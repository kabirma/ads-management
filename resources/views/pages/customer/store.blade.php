@extends('admin.layouts.master')

@section('content')
    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ol class="breadcrumb">

                            <li class="breadcrumb-item active"> <span class="badge badge-light-primary">
                                    @if (Auth::user()->role_id === 1)
                                        {{ __('messages.EDIT') }}
                                        {{ $title }}
                                    @else
                                        {{ __('messages.Profile') }}
                                    @endif
                                </span>
                            </li>
                        </ol>
                        @if (Auth::user()->role_id === 1)
                            <a href="{{ route('view.customer') }}"
                                class="btn btn-sm btn-primary primary-btn waves-effect addnew">
                                <i class="fa fa-list"></i> <span>{{ __('messages.VIEW') }} {{ $title }}</span>
                            </a>
                        @endif

                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard" style="padding-top: 0px;">
                            <form action="{{ route('save.customer') }}" method="post" class="row">
                                @if (Session::has('success'))
                                    <div class="alert alert-success text-center">
                                        <i class="fa fa-check"></i> {{ Session::get('success') }}
                                    </div>
                                @endif

                                @csrf
                                <input type="hidden" name="id" value="{{ isset($record) ? $record->id : 0 }}">
                                <div class="form-group col-md-12">
                                    <label for="full_name">{{ __('messages.Name') }}</label>
                                    <input id="full_name" name="full_name"
                                        value="{{ isset($record) ? $record->full_name : '' }}" type="text" required
                                        class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="email">{{ __('messages.Email') }}</label>
                                    <div class="input-group">
                                        <input id="email" name="email"
                                            value="{{ isset($record) ? $record->email : '' }}" type="email" required
                                            class="form-control ">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text primary-btn">
                                                @if (isset($record) && $record->email_verified_at != null)
                                                    <a href="{{ route('verify.email') }}"
                                                        class="btn btn-success btn-sm">{{ __('messages.VerifyEmail') }}</a>
                                                @else
                                                    {{ __('messages.EmailVerified') }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone">{{ __('messages.Phone') }}</label>
                                    <input id="phone" name="phone" value="{{ isset($record) ? $record->phone : '' }}"
                                        type="tel" required class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="mobile">{{ __('messages.Mobile') }}</label>
                                    <input id="mobile" name="mobile"
                                        value="{{ isset($record) ? $record->mobile : '' }}" type="tel" required
                                        class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">{{ __('messages.Username') }}</label>
                                    <input id="name" name="name" value="{{ isset($record) ? $record->name : '' }}"
                                        type="text" required class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <hr>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="password">{{ __('messages.Password') }}</label>
                                    <input id="password" name="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="confirmPassword">{{ __('messages.ConfirmPassword') }}</label>
                                    <input id="confirmPassword" name="confirmPassword" type="password"
                                        class="form-control @error('confirmPassword') is-invalid @enderror">
                                    @error('confirmPassword')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <hr>
                                    <button class="btn btn-primary primary-btn"><i class="fa fa-check"></i>
                                        {{ __('messages.SAVE') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
    <!-- Dashboard Analytics end -->
@endsection
@push('script')
    <script>
        $(".amount_calculated").change(function() {
            $("#balance").val($("#customer_total").val() - $("#amount_paid").val());
        })
    </script>
@endpush
