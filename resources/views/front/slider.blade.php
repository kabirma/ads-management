<style>
    .home-slider-card img{
        height:70vh;
        width: 100vw;
        object-fit: cover;
    }

    #tagLine h2{
        text-align: center;
        font-size:55px;
        text-transform: capitalize;
        margin-bottom:2%;
        margin-top:-1%;
    }

    #desktop_heading{
        text-transform: capitalize;
        font-size:18px;
        color:#0091E7;
        font-style: italic;
        font-weight: 600;
    }
    #mobile_heading{
        display: none;
    }

    @media only screen and (max-width: 786px) {
        .home-slider-card img{
            height:85vh;
            width: 100vw;
            object-fit:cover;
        }
        .home-slider-card__container{
            top:60%;
        }
        #tagLine h2{
            font-size:35px;
            margin-top:3%;
        }
        #mobile_heading{
            display: block;
            font-size:25px;
            letter-spacing: 2px;
            font-weight: 700;
            text-transform: capitalize;
            background-color:darkblue;
            padding:7% 5% 4% 5%;
            text-align: center;
            color:#0091E7;
        }
        .meeta-header-section .header-middle{
            padding:30px 0px;
        }
    }
</style>
<h2 id="mobile_heading">Feature Concerts</h2>
<section data-gtm="home-slider" class="home-slider" data-messages="">
    <div class="home-slider__main slider">
        @foreach ($spot_light_events as $item)
        <div data-gtm="home-slider-card" class="home-slider-card">
            <div class="home-slider-card__background home-slider-card__background--loading">
              <span data-gtm="responsive-picture" class="responsive-picture responsive-picture--loading" style="--rp-aspect-ratio-md: 0.375000;--rp-aspect-ratio-xs: 1.333333">
                <picture>
                  <source media="(min-width: 768px)" data-srcset="{{asset($item->image)}}">
                  <source data-srcset="{{asset($item->image)}}">
                    <img  data-src="{{asset($item->image)}}" />
                </picture>
              </span>
            </div>
            <div class="home-slider-card__container">

                <div class="home-slider-card__headline">
                    <h3 data-gtm="block-title" class="block-title">
                        <a href="{{route('spotlight_event', $item->id)}}">
                            <span class="block-title__block">{{ $item->artist }}</span>
                        </a>
                    </h3>
                </div>
                <div class="home-slider-card__tagline">
                    <p data-gtm="block-title" class="block-title block-title--secondary">
                        <a href="{{route('spotlight_event', $item->id)}}" tabindex="-1">
                            <span class="block-title__block">{{date("F", strtotime($item->date))}}</span><span class="block-title__block">{{date("d", strtotime($item->date))}}</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
        @endforeach

{{--        <div data-gtm="home-slider-card" class="home-slider-card">--}}
{{--            <div class="home-slider-card__background home-slider-card__background--loading">--}}
{{--              <span data-gtm="responsive-picture" class="responsive-picture responsive-picture--loading" style="--rp-aspect-ratio-md: 0.375000;--rp-aspect-ratio-xs: 1.333333">--}}
{{--                <picture>--}}
{{--                  <source media="(min-width: 768px)" data-srcset="{{asset('front/slider/img/5.jpeg')}}">--}}
{{--                  <source  data-srcset="{{asset('front/slider/img/5.jpeg')}}">--}}
{{--                    <img data-src="{{asset('front/slider/img/5.jpeg')}}" />--}}
{{--                </picture>--}}
{{--              </span>--}}
{{--            </div>--}}
{{--            <div class="home-slider-card__container">--}}
{{--                <div class="home-slider-card__headline">--}}
{{--                    <h3 data-gtm="block-title" class="block-title">--}}
{{--                        <a href="#">--}}
{{--                            <span class="block-title__block">Academy</span><span class="block-title__block">of</span><span class="block-title__block">St</span><span class="block-title__block">Martin</span><span class="block-title__block">in</span><span class="block-title__block">the</span><span class="block-title__block">Fields</span><span class="block-title__block">with</span><span class="block-title__block">Joshua</span><span class="block-title__block">Bell</span>--}}
{{--                        </a>--}}
{{--                    </h3>--}}
{{--                </div>--}}
{{--                <div class="home-slider-card__tagline">--}}
{{--                    <p data-gtm="block-title" class="block-title block-title--secondary">--}}
{{--                        <a href="" tabindex="-1">--}}
{{--                            <span class="block-title__block">Mar</span><span class="block-title__block">30</span>--}}
{{--                        </a>--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

    </div>
    <div class="home-slider__nav">
        <button class="home-slider__nav__btn home-slider__nav__btn--prev" aria-label="Previous Event">
            <span id="desktop_heading">Feature Concerts</span>
            <br>
            <br>
            <div class="chevron_bottom"></div>
            <br>
            <br>

        </button>
        <div class="home-slider__nav__items home-slider__nav__items--loading">
            <span class="home-slider__nav__active"></span>
            <div class="home-slider__nav__items__window">
                <div class="home-slider__nav__items__rail">
                    @foreach ($spot_light_events as $item)
                    <div class="home-slider__nav-item">
                        <span class="home-slider__nav-item-headline" style="text-transform: uppercase;">{{$item->artist}}</span>
                        <p class="home-slider__nav-item-tagline">
                            <span class="home-slider__nav-item-date" style="text-transform: uppercase;">{{date("M/d", strtotime($item->date))}}</span><br>
                            <a href="{{route('spotlight_event', $item->id)}}" class="home-slider__nav-item-link" style="margin-top:4%">Info</a>
                        </p>
                    </div>
                    @endforeach

{{--                    <div class="home-slider__nav-item">--}}
{{--                        <span class="home-slider__nav-item-headline">Academy of St Martin in the Fields with Joshua Bell</span>--}}
{{--                        <p class="home-slider__nav-item-tagline">--}}
{{--                            <span class="home-slider__nav-item-date">3/30</span>--}}
{{--                            <a href="#" class="home-slider__nav-item-link">Tickets & Info</a>--}}
{{--                        </p>--}}
{{--                    </div>--}}

                </div>
            </div>
        </div>
        <button class="home-slider__nav__btn home-slider__nav__btn--next" aria-label="Next Event">
            <div class="chevron_top"></div>
        </button>
    </div>
</section>
<section id="tagLine">
    <h2>
        Your New Jersey source for Free Summer Concerts
    </h2>
</section>