@extends('front.layout.app')

@section('content')
    <style>
        body {
            background: #002147;
        }

        .page-banner-section {
            background-image: url({{asset('storage/images/homepage/PhotoJ.jpg')}});
        }

        .nice-select {
            margin-top: 7%;
            width: 90%;
            border: none;
        }

        #calendar {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 10px;
        }

        .icon-place {
            text-align: center;
            vertical-align: center;
        }

        .highlight-class {
            background-color: dodgerblue;
            cursor: pointer;
        }

        .fc-unthemed td.fc-today {
            background-color: #1CB042;
        }
    </style>

    <!-- Page Banner Start -->
    <div class="section page-banner-section">
        <div class="shape-2"></div>
        <div class="container">
            <div class="page-banner-wrap">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Page Banner Content Start -->
                        <div class="page-banner text-center">
                            <h2 class="title">Concerts</h2>
                        </div>
                        <!-- Page Banner Content End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Banner End -->

    <!-- Event List Start -->
    <div class="meeta-event-list section-padding">
        <div class="container">
            <div class="meeta-event-list-wrap">
                <!-- Event List Top Bar Start -->
                <div class="event-list-top-bar">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{route('search')}}" method="GET">

                                <div class="event-list-search">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <div class="single-form">
                                                <i class="fas fa-search"></i>
                                                <input type="text" name="q"
                                                       value="{{isset($request) ? $request->q : "" }}"
                                                       placeholder="Search Concerts">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="single-form ">
                                                <select name="d">
                                                    <option value="0">Select Month</option>
                                                    @foreach ($months as $month)
                                                        @php
                                                            $m = $month->format('Y-m');
                                                            $date_coverted = date("Y-m", strtotime(isset($request) ? $request->d : 'now'));
                                                        @endphp
                                                        <option value="{{$m}}" {{isset($request) && $date_coverted == $m ? "selected" : "" }}>{{$month->format('M-Y')}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="single-form ">
                                                <select name="serie">
                                                    <option value="0">Select Series</option>
                                                    @foreach ($series as $serie)
                                                        <option value="{{$serie}}" {{isset($request) && $request->serie == $serie ? "selected" : "" }}>{{$serie}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-btn">
                                                <button class="btn btn-primary" style="width: 100%"><i
                                                            class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-btn">
                                                <button type="button" class="list-show btn btn-dark"
                                                        style="width: 100%"><i
                                                            class="fa fa-list"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-btn">
                                                <button type="button" class="calendar-show btn btn-primary"
                                                        style="width: 100%"><img
                                                            src="{{asset('front/assets/images/calendar.png')}}"
                                                            style="height:20px" alt=""></button>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="col-md-12" style="margin-top:2%">
                                    <h5>Categories</h5>
                                    <hr>
                                    <div class="row">
                                        @php
                                            $chunks = array_chunk($genres, 4);
                                        @endphp
                                        @foreach($chunks as $genre)
                                            <div class="col-md-3">
                                                @foreach ($genre as $item)
                                                    <label><input type="checkbox"
                                                                  {{isset($request->g) && in_array($item, $request->g) ? "checked" : ""}} name="g[]"
                                                                  value="{{$item}}"> {{$item}} </label>
                                                @endforeach
                                            </div>

                                        @endforeach
                                    </div>
                                </div>
                            </form>

                        </div>


                    </div>

                </div>
                <!-- Event List Top Bar End -->

                <!-- Event List Content Start -->
                <div class="event-list-content-wrap">
                    <div class="">
                        <div class="" id="grid">
                            <div class="row" id="calendarArea">
                                <div id="calendar"></div>
                            </div>
                            <div class="row" id="listArea">
                                @if(count($events))
                                    @foreach ($events as $event)
                                        <div class="col-lg-12 col-sm-12">
                                            <div class="row event-list-item">
                                                <div class="col-md-4">
                                                    <div class="event-img">
                                                        <a href="{{route("event_detail", $event->id)}}"><img
                                                                    src="{{asset($event->image)}}"
                                                                    alt="{{$event->title}}"></a>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="event-list-content">
                                                        <div class="event-price">
                                                            <span class="cat">{{$event->genre}}</span>
                                                        </div>
                                                        <h3 class="title"><a
                                                                    href="{{route("event_detail", $event->id)}}">
                                                                {{$event->title}}
                                                            </a></h3>
                                                        <div class="meta-data">
                                                            <span><i class="fas fa-calendar"></i>{{date('m-d-Y',strtotime($event->date))}}</span>
                                                            <span><i class="fas fa-map-marker-alt"></i> {{Str::substr($event->location, 0, 20) }}...</span>
                                                        </div>
                                                        <div class="event-desc">
                                                            <p>
                                                                    <?= Str::substr(strip_tags($event->description), 0, 120); ?>
                                                                ...
                                                            </p>
                                                        </div>
                                                        <br>
                                                        <a class="btn-2" href="{{route("event_detail", $event->id)}}">View
                                                            Details</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-lg-12 col-sm-12" style="margin-top:2%">
                                        <div class="alert alert-danger" style="background-color:#fdfd96">No Concerts
                                            Found.
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Event List End -->
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            var eventDates = [];
            @foreach($events as $event)
            eventDates.push('{{$event->date}}');
            @endforeach
            console.log(eventDates);
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: '',
                    // right: 'month,basicWeek,basicDay'
                },
                defaultDate: '{{date("Y-m-d")}}',
                navLinks: false,
                dayRender: function (date, cell) {
                    if (eventDates.includes(date.format('YYYY-MM-DD'))) {
                        cell.addClass('highlight-class');
                    }
                },
            });

            setTimeout(function () {
                $(".fc-day-top").each(function () {
                    if (eventDates.includes($(this).attr("data-date"))) {
                        $(this).addClass('highlight-class');
                    }
                })
            }, 100)

        });


        $("#calendarArea").hide();
        $(".calendar-show").click(function () {
            $(".list-show").removeClass("btn-dark");
            $(this).addClass("btn-dark");
            $("#calendarArea").show();
            $("#listArea").hide();
        });


        $(".list-show").click(function () {
            $(this).addClass("btn-dark");
            $(".calendar-show").removeClass("btn-dark");
            $("#calendarArea").hide();
            $("#listArea").show();
        });

        @if($pageType == 'calendar')
        $(".calendar-show").click();
        @else
        $(".list-show").click();
        @endif

        $(document).on("click", ".highlight-class", function () {
            var filterDate = $(this).attr("data-date");
            window.location.href = "https://ratezest.com/search?q=&d=" + filterDate + "&serie=0";
        })

    </script>
@endsection
