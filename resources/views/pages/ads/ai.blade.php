@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css"
        integrity="sha512-3uVpgbpX33N/XhyD3eWlOgFVAraGn3AfpxywfOTEQeBDByJ/J7HkLvl4mJE1fvArGh4ye1EiPfSBnJo2fgfZmg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .bootstrap-tagsinput {
            width: 100%;
            padding: 0.571rem 1rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.45;
            color: #6e6b7b;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #d8d6de;
            appearance: none;
            border-radius: 0.357rem;
        }

        .tag {
            background-color: #5bbe25;
            padding: 4px 6px;
            border-radius: 3px;
        }

        .form-group label {
            margin-bottom: 5px !important;
        }

        .form-group {
            margin-bottom: 1% !important;
        }
    </style>
    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics">
        <div class="row">
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
                            <form action="{{ route('generateAd.ads') }}" method="post" class="row"
                                enctype="multipart/form-data">
                                @csrf
                                @if (Session::has('error'))
                                    <div class="alert alert-danger text-center">
                                        <i class="fa fa-times"></i> {{ Session::get('error') }}
                                    </div>
                                @endif
                                <input type="hidden" name="id" value="{{ isset($record) ? $record->id : 0 }}">
                                <div class="form-group col-md-12">
                                    <label for="reason">{{ __('messages.FirstCampaign') }}</label>
                                    <br>
                                    <label for="first_campaign_yes">
                                        <input type="radio" class="first_campaign" name="first_campaign"
                                            id="first_campaign_yes" checked value="1"> {{ __('messages.Yes') }}
                                    </label>
                                    <label for="first_campaign_no">
                                        <input type="radio" class="first_campaign" name="first_campaign"
                                            id="first_campaign_no" value="0"> {{ __('messages.No') }}
                                    </label>
                                </div>


                                <div class="form-group col-md-12 firstCampaignNo">
                                    <label for="social_media">{{ __('messages.UsedSocialMedia') }}</label>
                                    <select name="used_social_media[]" class="form-control select2" multiple required>
                                        <option value="snapchat">{{ __('messages.Snapchat') }}</option>
                                        <option value="tiktok">{{ __('messages.TikTok') }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12 firstCampaignNo">
                                    <label for="social_media">{{ __('messages.BestSocialMedia') }}</label>
                                    <select name="best_social_media[]" class="form-control select2" multiple required>
                                        <option value="snapchat">{{ __('messages.Snapchat') }}</option>
                                        <option value="tiktok">{{ __('messages.TikTok') }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12 firstCampaignNo">
                                    <label for="social_media">{{ __('messages.WorstSocialMedia') }}</label>
                                    <select name="worst_social_media[]" class="form-control select2" multiple required>
                                        <option value="snapchat">{{ __('messages.Snapchat') }}</option>
                                        <option value="tiktok">{{ __('messages.TikTok') }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12 firstCampaignNo">
                                    <label for="keywords">{{ __('messages.BudgetUsed') }}</label>
                                    <input type="text" class="form-control" name="used_budget"
                                        placeholder="{{ __('messages.BudgetUsed') }}" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="keywords">{{ __('messages.CampaignDuration') }}</label>
                                    <input type="text" class="form-control" name="duration"
                                        placeholder="{{ __('messages.CampaignDuration') }}" required>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="reason">{{ __('messages.CampaignGoal') }}</label>
                                    <input type="text" class="form-control" name="campaignGoal"
                                        placeholder="{{ __('messages.CampaignGoal') }}" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="social_media">{{ __('messages.SocialMediaOption') }}</label>
                                    <select name="social_media" class="form-control select2" required>
                                        <option value="snapchat">{{ __('messages.Snapchat') }}</option>
                                        <option value="tiktok">{{ __('messages.TikTok') }}</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="location">{{ __('messages.BudgetRange') }}</label>
                                    <input type="text" class="form-control" name="budgetRange"
                                        placeholder="{{ __('messages.BudgetRange') }}" required>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="location">{{ __('messages.CampaignTarget') }}</label>
                                    <input type="text" class="form-control" name="target"
                                        placeholder="{{ __('messages.CampaignTarget') }}" required>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="location">{{ __('messages.AgeRange') }}</label>
                                    <input type="text" class="form-control" name="age_range"
                                        placeholder="{{ __('messages.AgeRange') }}" required>
                                </div>

                                 <div class="form-group col-md-12">
                                    <label for="social_media">{{ __('messages.Gender') }}</label>
                                    <select name="gender" class="form-control select2" required>
                                        <option value="male">{{ __('messages.Male') }}</option>
                                        <option value="female">{{ __('messages.Female') }}</option>
                                        <option value="both">{{ __('messages.Both') }}</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="keywords">{{ __('messages.AdsKeywords') }}</label>
                                    <input type="text" class="form-control" id="tags-input" name="keywords"
                                        placeholder="{{ __('messages.AdsKeywords') }}">
                                </div>

                                <div class="form-group col-md-12">
                                    <hr>
                                    <button class="btn btn-primary"><i class="fa fa-pencil"></i>
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

    <script>
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
    </script>
@endsection
