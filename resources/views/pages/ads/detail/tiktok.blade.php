@extends('layouts.master')

@section('content')
    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-12">
                @if (Session::has('success'))
                    <div class="alert alert-success text-center">
                        <i class="fa fa-check"></i> {{ Session::get('success') }}
                    </div>
                @endif

                @if (Session::has('error'))
                    <div class="alert alert-danger text-center">
                        <i class="fa fa-times"></i> {{ Session::get('error') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"> <span class="badge badge-light-primary">{{ $title }}
                                    Details</span></li>
                        </ol>

                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard" style="padding-top: 0px;">
                                <h2>{{$ad->name}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 steps" id="step4" style="background: white; text-algn:center; padding:1rem; border-radius:8px; margin-bottom:2rem;">
            <div class="step-heading">
                <h2>Choose Your Content</h2>
             </div>
            <div class="titleRow row">
                <div class="form-group col-md-12">
                    <label for="title">Title</label>
                    <input id="title" name="title" type="text" required class="form-control" value="{{$ad->name}}">
                </div>
                <div class="form-group col-md-12">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" cols="30" rows="10">{{$ad->description}}</textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="call_to_action">Call to Action</label>
                    <input id="title" name="title" type="text" required class="form-control" value="{{$ad->call_to_action}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="website_url">Website Url</label>
                    <input id="website_url" name="website_url" type="text" required class="form-control" value={{$ad->landing_page_url}}>
                </div>


                @php
  $campaignData = json_decode($ad->campaign->data, true);
  $budget = $campaignData['budget'] ?? null;
$campaign_name = $campaignData['campaign_name'];
  @endphp
   <div class="form-group col-md-12">
    <label for="campaign_name">Camplagin Name</label>
    <input id="campaign_name" name="campaign_name" type="text" required class="form-control" value={{$campaign_name}}>
</div>

<div class="form-group col-md-6">
    <label for="platform">PlatForm</label>
    <input id="platform" name="platform" type="text" required class="form-control" value={{$ad->platform}}>
</div>
                <div class="form-group col-md-6">
                    <label for="budget">Budget</label>
                    <input id="budget" name="budget" type="text" required class="form-control" value={{$budget}}>
                </div>

            </div>

        </div>


    </section>
    <!-- Dashboard Analytics end -->
@endsection
