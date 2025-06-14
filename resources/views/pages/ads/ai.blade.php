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

                    {{-- <div class="firstCampaignNo">
                                    <div class="form-group col-md-12">
                                        <label class="text-white" for="social_media">{{ __('messages.UsedSocialMedia') }}</label>
                                        <select name="used_social_media[]" class="form-control select2" multiple required>
                                            <option value="snapchat">{{ __('messages.Snapchat') }}</option>
                                            <option value="tiktok">{{ __('messages.TikTok') }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="text-white" for="social_media">{{ __('messages.BestSocialMedia') }}</label>
                                        <select name="best_social_media[]" class="form-control select2" multiple required>
                                            <option value="snapchat">{{ __('messages.Snapchat') }}</option>
                                            <option value="tiktok">{{ __('messages.TikTok') }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="text-white" for="social_media">{{ __('messages.WorstSocialMedia') }}</label>
                                        <select name="worst_social_media[]" class="form-control select2" multiple required>
                                            <option value="snapchat">{{ __('messages.Snapchat') }}</option>
                                            <option value="tiktok">{{ __('messages.TikTok') }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="text-white" for="keywords">{{ __('messages.BudgetUsed') }}</label>
                                        <input type="text" class="form-control" name="used_budget"
                                            placeholder="{{ __('messages.BudgetUsed') }}" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="text-white" for="keywords">{{ __('messages.CampaignDuration') }}</label>
                                        <input type="text" class="form-control" name="duration"
                                            placeholder="{{ __('messages.CampaignDuration') }}" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="text-white" for="comments">{{ __('messages.AdsComments') }}</label>
                                        <textarea name="comments" class="form-control" required placeholder="{{ __('messages.AdsComments') }}"></textarea>
                                    </div>

                                </div> --}}

                    <div class="card-content">
                        <div class="card-body card-dashboard" style="padding-top: 0px;">
                            {{-- <form action="{{ route('generateAd.ads') }}" method="post" class="row"
                                enctype="multipart/form-data"> --}}
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
                                    <div class="form-group col-md-12">
                                        <label class="text-white" for="used_platforms"> Which platform were you
                                            using?</label>
                                        <input type="text" class="form-control" name="used_platforms"
                                            placeholder="e.g., Snapchat, TikTok" required>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label class="text-white" for="best_platform">What is the best platform that gave
                                            results?</label>
                                        <input type="text" class="form-control" name="best_platform"
                                            placeholder="e.g., Snapchat" required>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label class="text-white" for="worst_platform"> What was the worst platform in
                                            results?</label>
                                        <input type="text" class="form-control" name="worst_platform"
                                            placeholder="e.g., TikTok" required>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label class="text-white" for="used_budget">How much was the budget?</label>
                                        <input type="text" class="form-control" name="used_budget"
                                            placeholder="e.g., $500" required>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label class="text-white" for="duration">How long was the duration of the
                                            campaign?</label>
                                        <input type="text" class="form-control" name="duration"
                                            placeholder="e.g., 2 weeks" required>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label class="text-white" for="comments"> Where was, in your opinion, the
                                            issue?</label>
                                        <textarea name="comments" class="form-control"
                                            placeholder="Note: The more details you give, the more results you will get." required></textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <small class="form-text text-muted">
                                            <strong>Note:</strong> The more details you give, the more accurate results and
                                            insights you will get.
                                        </small>
                                    </div>

                                </div>

                                <div class="firstCampaignYes">

                                    <div class="form-group col-md-12">
                                        <label class="text-white" for="reason">{{ __('messages.CampaignGoal') }}</label>
                                        <input type="text" class="form-control" name="campaignGoal"
                                            placeholder="{{ __('messages.CampaignGoal') }}" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="text-white"
                                            for="social_media">{{ __('messages.SocialMediaOption') }}</label>
                                        <select name="social_media" class="form-control select2" required>
                                            <option value="snapchat">{{ __('messages.Snapchat') }}</option>
                                            <option value="tiktok">{{ __('messages.TikTok') }}</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label class="text-white" for="location">{{ __('messages.BudgetRange') }}</label>
                                        <input type="text" class="form-control" name="budgetRange"
                                            placeholder="{{ __('messages.BudgetRange') }}" required>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label class="text-white"
                                            for="location">{{ __('messages.CampaignTarget') }}</label>
                                        <input type="text" class="form-control" name="target"
                                            placeholder="{{ __('messages.CampaignTarget') }}" required>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label class="text-white" for="keywords">{{ __('messages.AdsKeywords') }}</label>
                                        <input type="text" class="form-control" id="tags-input" name="keywords"
                                            placeholder="{{ __('messages.AdsKeywords') }}">
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
    </script>

    <div id="aiResults" class="mt-3"></div>

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
