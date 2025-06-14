@extends('admin.layouts.master')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css"
        integrity="sha512-3uVpgbpX33N/XhyD3eWlOgFVAraGn3AfpxywfOTEQeBDByJ/J7HkLvl4mJE1fvArGh4ye1EiPfSBnJo2fgfZmg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        input::placeholder {
            color: rgb(193, 189, 189);
            opacity: 1;
            /* Firefox lowers opacity by default */
        }

        .form-select {
            background: transparent;
            border: 1px solid transparent;
            border-radius: 4px;
            color: white;
            background-image: linear-gradient(135deg, #2e3e4a, #0c2c3e),
                linear-gradient(to right, #38afc3, #1487b3);
            background-origin: border-box;
            background-clip: padding-box, border-box;
        }
    </style>
    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics ">
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ol class="breadcrumb">

                            <li class="breadcrumb-item active"> <span class="badge badge-light-primary">
                                    {{ $title }}</span>
                            </li>
                        </ol>

                    </div>

                    <div class="card-content">
                        <div class="card-body card-dashboard" style="padding-top: 0px;">
                            <form id="aiForm" class="row" method="post" enctype="multipart/form-data">

                                @csrf
                                @if (Session::has('error'))
                                    <div class="alert alert-danger text-center">
                                        <i class="fa fa-times"></i> {{ Session::get('error') }}
                                    </div>
                                @endif
                                <input type="hidden" name="id" value="{{ isset($record) ? $record->id : 0 }}">
                                <div class="form-group col-md-12">
                                    <label class="text-white" for="reason">{{ __('messages.FirstCampaign') }}</label>
                                    <br>
                                    <label class="text-white" for="first_campaign_yes">
                                        <input type="radio" class="first_campaign" name="first_campaign"
                                            id="first_campaign_yes" checked value="1"> {{ __('messages.Yes') }}
                                    </label>
                                    <label class="text-white" for="first_campaign_no">
                                        <input type="radio" class="first_campaign" name="first_campaign"
                                            id="first_campaign_no" value="0"> {{ __('messages.No') }}
                                    </label>
                                </div>
                                <div class="firstCampaignNo">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="text-white" for="used_platforms">Which platform were you
                                                using?</label>
                                            <select name="used_platforms" class="form-control " id="used_platforms">
                                                <option value="snapchat">Snapchat</option>
                                                <option value="tiktok">TikTok</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="text-white" for="best_platform">What is the best platform that
                                                gave
                                                results?</label>
                                            <select name="best_platform" class="form-control   " id="best_platform"
                                                required>
                                                <option value="snapchat">Snapchat</option>
                                                <option value="tiktok">TikTok</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="text-white" for="worst_platform">What was the worst platform in
                                                results?</label>
                                            <select name="worst_platform" class="form-control" id="worst_platform" required>
                                                <option value="snapchat">Snapchat</option>
                                                <option value="tiktok">TikTok</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="text-white" for="previous_budget">How much was the budget?</label>
                                            <input type="number" class="form-control" name="previous_budget"
                                                id="previous_budget" placeholder="e.g., 500" required min="160"
                                                value="160" step="1">
                                        </div>


                                        <div class="form-group col-md-6">
                                            <label class="text-white" for="campaign_start">Campaign Start Date</label>
                                            <input type="date" class="form-control" name="campaign_start"
                                                id="campaign_start" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="text-white" for="campaign_end">Campaign End Date</label>
                                            <input type="date" class="form-control" name="campaign_end" id="campaign_end"
                                                required>
                                        </div>


                                        <div class="form-group col-md-6">
                                            <label class="text-white" for="comments">Where was the issue?</label>
                                            <textarea name="comments" class="form-control" id="comments" rows="3"
                                                placeholder="The more details you give, the more results you will get." required></textarea>
                                        </div>
                                    </div>
                                </div>


                                <div class="firstCampaignYes">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="text-white" for="business">What is your business ?
                                            </label>
                                            <input type="text" class="form-control" name="business" id="business"
                                                placeholder="What is your business ?" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="text-white"
                                                for="reason">{{ __('messages.CampaignGoal') }}</label>
                                            <input type="text" class="form-control" name="campaignGoal"
                                                id="campaignGoal" placeholder="{{ __('messages.CampaignGoal') }}"
                                                required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="text-white"
                                                for="social_media">{{ __('messages.SocialMediaOption') }}</label>
                                            <select name="social_media" class="form-control select2" id="social_media"
                                                required>
                                                <option value="snapchat">{{ __('messages.Snapchat') }}</option>
                                                <option value="tiktok">{{ __('messages.TikTok') }}</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="text-white"
                                                for="location">{{ __('messages.BudgetRange') }}</label>
                                            <input type="text" class="form-control" name="budgetRange"
                                                id="budgetRange" placeholder="{{ __('messages.BudgetRange') }}" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="text-white"
                                                for="location">{{ __('messages.CampaignTarget') }}</label>
                                            {{-- <input type="text" class="form-control" name="target"
                                                placeholder="{{ __('messages.CampaignTarget') }}" required> --}}
                                            <select name="target" class="form-control" id="gender" required>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>

                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="text-white"
                                                for="keywords">{{ __('messages.AdsKeywords') }}</label>
                                            <input type="text" class="form-control" id="tags-input" id="keywords"
                                                name="keywords" placeholder="{{ __('messages.AdsKeywords') }}">
                                        </div>

                                    </div>


                                </div>

                                <div class="form-group col-md-12">
                                    <hr>
                                    <button class="btn btn-primary primary-btn" type="submit" id="submitAI"><i
                                            class="fa fa-pencil"></i>
                                        {{ __('messages.SuggestContent') }}</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card mt-5">
                    <div id="aiResults" class="mt-3"></div>
                </div>
            </div>
        </div>


    </section>
    <!-- Dashboard Analytics end -->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js"
        integrity="sha512-SXJkO2QQrKk2amHckjns/RYjUIBCI34edl9yh0dzgw3scKu0q4Bo/dUr+sGHMUha0j9Q1Y7fJXJMaBi4xtyfDw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- <script>
        $(".firstCampaignNo").hide();
        $(".first_campaign").change(function() {

            $(".firstCampaignNo").hide();
            $(".firstCampaignNo .form-control").removeAttr("required")

            if ($(".first_campaign:checked").val() == "0") {
                $(".firstCampaignNo").show();
                $(".firstCampaignNo .form-control").prop("required", true)
            }
        });

        $(".first_campaign").change();

        $('#tags-input').tagsinput({
            confirmKeys: [13, 188]
        });

        $('.bootstrap-tagsinput input').on('keypress', function(e) {
            if (e.keyCode == 13) {
                e.keyCode = 188;
                e.preventDefault();
            };
        });
    </script> --}}

    <script>
        const today = new Date().toISOString().split('T')[0];
        const startInput = document.getElementById('campaign_start');
        const endInput = document.getElementById('campaign_end');

        startInput.setAttribute('min', today);
        endInput.setAttribute('min', today);

        startInput.addEventListener('change', function() {
            endInput.setAttribute('min', this.value);
        });
    </script>

    {{-- <script>
        $(document).ready(function() {
            $('#aiForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData($('#aiForm')[0]);

                $.ajax({
                    url: "{{ route('ai.fetch') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        // Optional: show loading spinner
                    },
                    success: function(response) {
                        console.log(response);

                        if (response.description) {
                            alert("AI Description: " + response.description);
                            // Or display it in a modal or div
                            $('#aiResults').html(`
                                <h4>Description</h4><p>${response.description}</p>
                                <h4>Strategy</h4><p>${response.strategy}</p>
                                <h4>Values</h4><pre>${response.values}</pre>
                            `);
                        }
                    },
                    error: function(xhr) {
                        alert("Something went wrong: " + xhr.responseText);
                    }
                });
            });

            // Show/hide first campaign fields
            $(".firstCampaignNo").hide();
            $(".first_campaign").change(function() {
                const isFirst = $(".first_campaign:checked").val() === "1";

                $(".firstCampaignNo").toggle(!isFirst);
                $(".firstCampaignNo .form-control, .firstCampaignNo textarea").prop("required", !isFirst);
            }).change();
        });
    </script> --}}

    <!-- Your form stays the same -->
    <div id="aiResults" class="mt-4"></div>

    <script>
        $(document).ready(function() {
            // Handle First Campaign Yes/No toggle
            $(".firstCampaignNo").hide();
            $(".first_campaign").change(function() {
                const isFirst = $(".first_campaign:checked").val() === "1";
                $(".firstCampaignNo").toggle(!isFirst);
                $(".firstCampaignNo .form-control, .firstCampaignNo textarea").prop("required", !isFirst);
            }).change();

            // Handle form submission
            $('#aiForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('ai.fetch') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        $('#aiResults').html(
                            '<p class="text-white">Generating ad, please wait...</p>');
                    },
                    success: function(response) {
                        aiResponse = response; // ✅ Save globally
                        console.log(response);
                        if (response.description) {
                            $('#aiResults').html(`
                            <div class="card text-white bg-dark p-3 mb-3">
                                <h4>Generated Ad Preview</h4>
                                <strong>Title:</strong> <p>${response.title}</p>
                                <strong>Description:</strong> <p>${response.description}</p>
                                <strong>Strategy:</strong> <p>${response.strategy}</p>
                                <strong>Platform:</strong> <p>${response.platform}</p>
                                <strong>Keywords:</strong> <p>${response.values}</p>
                                <button class="btn btn-success mt-2" id="acceptAd">Accept</button>
                                <button class="btn btn-warning mt-2" id="regenerateAd">Regenerate</button>
                            </div>
                        `);

                            window.generatedAd = response;
                        }
                    },
                    error: function(xhr) {
                        $('#aiResults').html(
                            `<p class="text-danger">Something went wrong: ${xhr.responseText}</p>`
                        );
                    }
                });
            });

            // Accept button
            $(document).on('click', '#acceptAd', function() {
                // const adData = window.generatedAd;
                // alert("Ad accepted! Now saving...");


                let saveData = {

                    // Form data (original inputs)
                    campaign_goal: $('#campaignGoal').val(),
                    business_keywords: $('#keywords').val(),
                    age: $('#age').val(),
                    gender: $('#gender').val(),
                    target_choices: $('#target').val(),
                    budget_range: $('#budgetRange').val(),
                    platform: $('#social_media').val(),
                    campaign_end: $('#campaign_end').val(),
                    campaign_start: $('#campaign_start').val(),
                    is_first_campaign: $('.first_campaign:checked').val() === "1",

                    previous_platform: $('#used_platforms').val(),
                    best_platform: $('#best_platform').val(),
                    worst_platform: $('#worst_platform').val(),
                    previous_budget: $('#used_budget').val(),
                    campaign_duration: $('#duration').val(),

                    // AI-generated values from fetch response
                    ai_title: aiResponse.title,
                    ai_description: aiResponse.description,
                    ai_strategy: aiResponse.strategy,
                    ai_platform: aiResponse.platform,
                    ai_values: aiResponse.values
                };

                $.ajax({
                    url: "{{ route('ai.save.response') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: saveData,
                    success: function(res) {
                        // alert("Campaign saved successfully! ID: " + res.campaign_id);
                        window.location.href = "/ads/add/" + res.campaign_id + "";


                    },
                    error: function(xhr) {
                        alert("Error saving campaign: " + xhr.responseText);
                    }
                });
            });

            // Regenerate
            $(document).on('click', '#regenerateAd', function() {
                $('#aiForm').submit();
            });
        });
    </script>


    {{-- <script>
        // Function to show/hide additional campaign fields
        function toggleCampaignFields() {
            const selectedVal = $(".first_campaign:checked").val();

            if (selectedVal === "0") { // No Show additional fields
                $(".firstCampaignNo").show();
                $(".firstCampaignNo .form-control").prop("required", true);
            } else { // Yes Hide additional fields
                $(".firstCampaignNo").hide();
                $(".firstCampaignNo .form-control").removeAttr("required");
            }
        }

        // Bind the function to change event
        $(".first_campaign").on("change", toggleCampaignFields);

        // Run on page load
        $(document).ready(function() {
            toggleCampaignFields();

            // Tags input logic (unchanged)
            $('#tags-input').tagsinput({
                confirmKeys: [13, 188]
            });

            $('.bootstrap-tagsinput input').on('keypress', function(e) {
                if (e.keyCode == 13) {
                    e.keyCode = 188;
                    e.preventDefault();
                }
            });
        });
    </script> --}}
@endsection
