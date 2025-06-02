@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->



    <!-- wallet header -->
    <div class="mb-4 mt-3 welcome">
        <div class="row align-items-center">
            <div class="col-12 col-md-6">
                <h4 class="mb-2 mb-md-0" style="font-weight: 500; font-size: 23px;">
                    Setting
                </h4>

            </div>
            <div class="col-12 col-md-6 d-flex justify-content-md-end">
                <button class="btn setting-cancel-btn d-block me-2 w-md-auto" type="button">
                    Cancel
                </button>


                <button class="btn btn-primary primary-btn save-button d-block  w-md-auto">
                    Save
                </button>
            </div>
            <!-- <hr class="w-100 m-0 p-0 border-top border-white"
                                    style="position: relative; left: 0; right: 0; width: 100vw;"> -->
        </div>
    </div>


    <!-- wallet Header -->
    <div class="mb-4 mt-3 setting-details-button">
        <div class="row align-items-center">
            <div class="col-12 col-md-6">
                <div class="setting-button-categories">
                    <button id="accountBtn" class="btn primary-btn active">Account</button>
                    <button id="businessBtn" class="btn btn-primary">Business</button>
                </div>

            </div>
        </div>
    </div>
    <hr class="w-100 m-0 p-0 border-top border-white" style="position: relative; left: 0; right: 0; width: 100vw;">


    <!-- setting container -->
    <!-- <div class="setting-container mt-2"> -->

    <!-- Nav tabs -->
    <ul class="nav nav-tabs custom-tabs p-2" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="account-tab" data-bs-toggle="tab" data-bs-target="#account" type="button"
                role="tab" aria-controls="account" aria-selected="true">Account Info</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button"
                role="tab" aria-controls="security" aria-selected="false">Security</button>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content p-3 text-white" id="myTabContent">

        <!-- Account Info -->
        <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-section">
                        <form class="user-info-form">
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">FULL NAME</label>
                                    <input type="text" class="form-control" placeholder="Your Name...">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">USERNAME</label>
                                    <input type="text" class="form-control" placeholder="Your Username...">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">PHONE</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col">
                                    <label class="form-label">EMAIL</label>
                                    <input type="email" class="form-control" placeholder="Your email here...">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">FIELD</label>
                                    <select class="form-select">
                                        <option>Sales</option>
                                        <option>Marketing</option>
                                        <option>Development</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label">GENDER</label>
                                    <select class="form-select">
                                        <option>Male</option>
                                        <option>Female</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">LANGUAGE</label>
                                    <select class="form-select">
                                        <option>English</option>
                                        <option>Urdu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">TIMEZONE</label>
                                    <select class="form-select">
                                        <option>Asia/Karachi</option>
                                        <option>Asia/Dubai</option>
                                        <option>America/New_York</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="photo-section mt-4">
                        <p class="photo-title">Your Photo</p>
                        <hr class="w-100 border-top border-white">
                        <img src="https://via.placeholder.com/80" class="mt-2" alt="Profile Photo">
                        <div class="mt-2">
                            <span class="text-white eidt-photo">Edit your photo</span><br>
                            <a href="#" class="text-danger text-decoration-none delete-photo">Delete</a>
                            <a href="#" class="text-info ms-2 text-decoration-none update-photo">Update</a>
                        </div>
                        <div class="upload-box mt-3">
                            <label for="fileUpload" class="d-block text-white m-0 w-100 h-100 cursor-pointer">
                                <p><strong>Click to upload</strong> or drag and drop</p>
                                <small>SVG, PNG, JPG or GIF (max. 400x400px)</small>
                            </label>
                            <input type="file" id="fileUpload" class="d-none" accept=".svg,.png,.jpg,.jpeg,.gif">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security -->
        <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">

            <!-- Security password card -->
            <div class="password-card ms-0" id="passwordCard">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label password-title">Password</label>
                        <input type="password" class="form-control password-input"
                            placeholder="It is recommended to add a strong password to ensure your account’s security.">
                    </div>
                </div>
                <a href="#" class="forgot-link" id="forgotLink">Forget my password</a>
                <div class="d-flex justify-content-end">
                    <button type="button" class="change-btn primary-btn">Change Password</button>
                </div>
            </div>

            <!-- Password reset card (initially hidden) -->
            <div class="card-custom d-none ms-0" id="resetPasswordCard">
                <!-- Current Password -->
                <div class="mb-4">
                    <label for="currentPassword" class="form-label">Current Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control no-right-border" id="currentPassword"
                            placeholder="Enter your current password" />
                        <span class="input-group-text bg-transparent border-start-0 toggle-password">
                            <img src="../assets/img/icons/password-eye.png" alt="">
                        </span>
                    </div>
                    <a href="#" class="forgot-link">Forget my password</a>
                </div>

                <!-- New Password -->
                <div class="mb-4">
                    <label for="newPassword" class="form-label">New Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control no-right-border" id="newPassword"
                            placeholder="Enter your new password" />
                        <span class="input-group-text bg-transparent border-start-0 toggle-password">
                            <img src="../assets/img/icons/password-eye.png" alt="">
                        </span>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control no-right-border" id="confirmPassword"
                            placeholder="Enter confirm password" />
                        <span class="input-group-text bg-transparent border-start-0 toggle-password">
                            <img src="../assets/img/icons/password-eye.png" alt="">
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>




    <!-- business info first form -->
    <!-- Business Info Container (Initially hidden) -->
    <div id="businessInfo" class="businessinfo-container py-1" style="display: none;">






        <!-- nav tabs for business contents -->
        <!-- Nav tabs -->
        <ul class="nav nav-tabs business-custom-tabs p-2" id="myTabtwo" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general"
                    type="button" role="tab" aria-controls="general" aria-selected="true">General</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="verification-tab" data-bs-toggle="tab" data-bs-target="#verification"
                    type="button" role="tab" aria-controls="verification"
                    aria-selected="false">Verification</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="team-tab" data-bs-toggle="tab" data-bs-target="#team" type="button"
                    role="tab" aria-controls="team" aria-selected="false">Team</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="billing-tab" data-bs-toggle="tab" data-bs-target="#billing" type="button"
                    role="tab" aria-controls="billing" aria-selected="false">Plan and
                    Billing</button>
            </li>
        </ul>
        <!-- General Business Info Section -->
        <div class="tab-content p-3">
            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                <section class="general-businessinfo">
                    <div class="form-section" id="business-form-section">
                        <div class="mb-3">
                            <label class="form-label" for="businessName">Business Name</label>
                            <input type="text" class="form-control" id="businessName" placeholder="Enter name"
                                value="Test">
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="businessDescription">Describe Your
                                Business</label>
                            <textarea class="form-control" id="businessDescription" rows="4" placeholder="Enter..."></textarea>
                        </div>
                        <div class="char-count " style="color: #1487B3; font-size: 14px;">0/250
                            characters left</div>
                    </div>

                    <!-- E-Commerce Section -->
                    <div class="form-section" id="E-commerce-form-section">
                        <div class="mb-3">
                            <label class="form-label">E-Commerce Platform</label><br>
                            <button type="button" class="btn btn-outline-info salla">Salla</button>
                            <button type="button" class="btn btn-outline-info zid">Zid</button>
                            <button type="button" class="btn btn-outline-info shopify">Shopify</button>
                            <button type="button" class="btn btn-outline-info other">Other</button>
                            <button type="button" class="btn btn-outline-info not-ecommerce">Not on
                                E-commerce</button>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="websiteUrl">Website URL</label>
                            <input for="websiteUrl" type="url" class="form-control" id="websiteUrl"
                                placeholder="Enter...">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="currency">Currency</label>
                            <input type="text" class="form-control" id="currency" value="SAR Saudi Riyal" disabled>
                        </div>
                    </div>

                    <!-- Deactivate Section -->
                    <div class="form-section" id="Deactivate-form-section">
                        <label class="form-label">Deactivate Business</label>
                        <p class="text-white deactivite-btn-para" style="font-size: 14px;">
                            When you cancel your subscription, you will not be able to use sahalih
                            service until you subscribe with a plan.
                        </p>
                        <div class="deactivite-btn-container d-flex justify-content-end">
                            <button type="button" class="btn btn-danger">Deactivate</button>
                        </div>

                    </div>
                </section>
            </div>

            <!-- verification tab -->
            <div class="tab-pane fade" id="verification" role="tabpanel" aria-labelledby="verification-tab">

                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-section" id="verification-form-details">
                            <form class="user-info-form">
                                <!-- name -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Name in English</label>
                                        <input type="text" class="form-control" placeholder="Your Name...">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Name in Arabic</label>
                                        <input type="text" class="form-control" placeholder="Your Name...">
                                    </div>
                                </div>

                                <!-- vat Number -->
                                <div class="row mb-3">
                                    <div class="col">
                                        <label class="form-label">VAT Number</label>
                                        <input type="text" class="form-control" placeholder="Your Username...">
                                    </div>
                                </div>

                                <!-- address -->
                                <div class="row mb-3">
                                    <div class="address-for-verification d-flex">
                                        <span class="address-title">Business Address</span>
                                        <span class="ms-3 include-location" style="color: #1487B3;">Add
                                            the location to be included in invoices and reports</span>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">ADDRESS 1</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">ADDRESS 2</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">CITY</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">POSTAL CODE</label>
                                        <input type="text" class="form-control">
                                    </div>

                                </div>
                                <!-- country -->
                                <div class="row mb-3">
                                    <div class="col">
                                        <label class="form-label">Country</label>
                                        <select class="form-select">
                                            <option>Pakistan</option>
                                            <option>China</option>
                                            <option>Dubai</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col">
                                        <label class="form-label">VAT CERTIFICATE <span
                                                class="text-white">(Optional)</span></label>
                                        <div class="verification-upload-box mt-3 shadow">
                                            <label for="fileUpload" style="font-size: 14px;"
                                                class="d-block text-white m-0 w-100 h-100 cursor-pointer">
                                                <p><strong style="color: #38AFC3;">Click to
                                                        upload</strong> or drag and drop</p>
                                                <small class="text-white">SVG, PNG, JPG or GIF (max.
                                                    400x400px)</small>
                                            </label>
                                            <input type="file" id="fileUpload" class="d-none"
                                                accept=".svg,.png,.jpg,.jpeg,.gif">
                                        </div>
                                    </div>
                                </div>



                            </form>
                        </div>
                    </div>


                </div>

            </div>

            <!-- team -->
            <div class="tab-pane fade" id="team" role="tabpanel" aria-labelledby="team-tab">
                <div class="row">
                    <form action="">
                        <div class="team-card ms-0" id="teamCard">
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label password-title">Invite Team Member</label>
                                    <input type="email" class="form-control team-input" placeholder="email address.">
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="change-btn primary-btn">Invite
                                    Member</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- plan and billing -->
            <div class="tab-pane fade" id="billing" role="tabpanel" aria-labelledby="billing-tab">
                <div class="row plan-billing">
                    <!-- My Plan Card -->
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-3 position-relative">
                        <div class="card myplan-card h-100">
                            <div class="card-header">
                                MY PLAN
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <textarea class="form-control my-plan-textarea" rows="3" placeholder="Plan details go here..."></textarea>
                                </div>
                                <div class="deactivite-btn-container d-flex justify-content-end">

                                    <button type="button" class="btn btn-primary primary-btn"
                                        id="myplan-deactivite">Deactivate</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method Card -->
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-3">
                        <div class="card payment-card h-100">
                            <div class="card-header">
                                PAYMENT METHOD
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Choose a card">
                                </div>
                                <div class="card-btn-container d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary primary-btn add-card">
                                        <img src="../assets/img/icons/add-card-btnimage.png" alt=""
                                            width="14" height="14">
                                        Add Card</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <!-- to control button active and hide and show functionality -->
    <script>
        const accountBtn = document.getElementById('accountBtn');
        const businessBtn = document.getElementById('businessBtn');
        const businessInfo = document.getElementById('businessInfo');
        const myTabContent = document.getElementById('myTabContent');
        const myTab = document.getElementById('myTab');

        businessBtn.addEventListener('click', () => {
            businessBtn.classList.add('active');
            accountBtn.classList.remove('active');

            businessInfo.style.display = 'block';
            if (myTabContent) myTabContent.style.display = 'none';
            if (myTab) myTab.style.display = 'none';
        });

        accountBtn.addEventListener('click', () => {
            accountBtn.classList.add('active');
            businessBtn.classList.remove('active');

            businessInfo.style.display = 'none';
            if (myTabContent) myTabContent.style.display = 'block';
            if (myTab) myTab.style.display = 'flex';
        });
    </script>










    <!-- Toggle Password Visibility -->
    <script>
        document.querySelectorAll('.toggle-password').forEach(el => {
            el.addEventListener('click', function() {
                const input = this.previousElementSibling;
                if (input.type === 'password') {
                    input.type = 'text';
                    this.innerHTML = '<i class="bi bi-eye-slash"></i>';
                } else {
                    input.type = 'password';
                    this.innerHTML = '<i class="bi bi-eye"></i>';
                }
            });
        });
    </script>

    <!-- here control the forgot link -->
    <script>
        document.getElementById('forgotLink').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('passwordCard').classList.add('d-none');
            document.getElementById('resetPasswordCard').classList.remove('d-none');
        });
    </script>
@endpush
