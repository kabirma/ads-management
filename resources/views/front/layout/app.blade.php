<!DOCTYPE html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1" />
	<meta name="author" content="SmartTemplates" />
	<meta name="description" content="landing page template for saas companies" />
	<meta name="keywords"
		content="landing page template, saas landing page template, saas website template, one page saas template" />
	<title>{{$setting->name}}</title>
	<link rel="stylesheet" href="{{ asset('front/css/swiper.css')}}">
	<link rel="stylesheet" href="{{ asset('front/style.css')}}">
	<link rel="icon" type="image/x-icon" href="{{asset($setting->favicon)}}">

	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,900" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
	<header class="header">
		<div class="header__content header__content--fluid-width">
			<div class="header__logo-title">{{$setting->name}}</div>
			<nav class="header__menu">
				<ul>
					<li><a class="selected header-link" href="{{route('index')}}">HOME</a></li>
					
					<li><a href="{{route('index')}}#about" class="header-link">ABOUT US</a></li>
					<li><a href="{{route('index')}}#pricing" class="header-link">PRICING</a></li>
					<li><a href="{{route('index')}}#joinus" class="header-link">JOIN US</a></li>
					<li><a href="{{route('index')}}#contact" class="header-link">CONTACT</a></li>
					@if(Auth::user())
						<li class="header__btn header__btn--signup"><a href="{{route('dashboard')}}">Dashboard</a></li>
						<li class="header__btn header__btn--signup"><a href="{{route('logout')}}">Logout</a></li>
					@else
						<li class="header__btn header__btn--signup modal-toggle" data-openpopup="signuplogin"
						data-popup="login"><a href="#">LOGIN</a></li>
						<li class="header__btn header__btn--signup modal-toggle" data-openpopup="signuplogin"
							data-popup="signup"><a href="#">GET STARTED</a></li>
					@endif
				</ul>
			</nav>
		</div>
	</header>


    @yield('content')

	<footer class="footer" id="footer">
		<div class="footer__content footer__content--fluid-width footer__content--svg">

			<div class="grid grid--5col">

				<div class="grid__item grid__item--x2">
					<h3 class="grid__title grid__title--footer-logo">{{$setting->name}}</h3>
					<p>{{$setting->short_description}}</p>
					<p class="grid__text grid__text--copyright">Copyright &copy; {{date('Y')}} {{$setting->name}}. <br />All Rights
						Reserved. </p>
					<ul class="grid__list grid__list--sicons">
						<li><a href="#"><img src="{{ asset('front/images/social/black/twitter.png')}}" alt="" title="" /></a></li>
						<li><a href="#"><img src="{{ asset('front/images/social/black/facebook.png')}}" alt="" title="" /></a></li>
						<li><a href="#"><img src="{{ asset('front/images/social/black/linkedin.png')}}" alt="" title="" /></a></li>
					</ul>
				</div>
				<div class="grid__item">
					<h3 class="grid__title grid__title--footer">USEFUL LINKS</h3>
					<ul class="grid__list grid__list--fmenu">
					
						<li><a href="#intro">HOME</a></li>
						<li><a href="#about">ABOUT US</a></li>
						<li><a href="#pricing">PRICING</a></li>
						<li><a href="#joinus">JOIN US</a></li>
						<li><a href="#contact">CONTACT</a></li>
					</ul>
				</div> 
				<div class="grid__item">
					<h3 class="grid__title grid__title--footer">Support</h3>
					<ul class="grid__list grid__list--fmenu">
						@foreach(App\Models\Page::get() as $page)
						<li><a href="{{route('content',$page->category)}}">{{$page->title}}</a></li>
						@endforeach
					
					</ul>
				</div>

				<div class="grid__item">
					<h3 class="grid__title grid__title--footer">Get in Touch</h3>
					<ul class="grid__list grid__list--fmenu">
						
						<li><a href="#0"> <i class="fa fa-phone"></i> {{$setting->phone}}</a></li>
						<li><a href="#0"> <i class="fa fa-at"></i> {{$setting->email}}</a></li>
						<li><a href="#0"> <i class="fa fa-map-marker"></i> {{$setting->address}}</a></li>
						
					
					</ul>
				</div>

			</div>


		</div>


	</footer>


	<section class="modal modal--signuplogin">
		<div class="modal__overlay modal__overlay--toggle"></div>
		<div class="modal__wrapper modal-transition">

			<div class="modal__body">

				<div class="modal__content modal__content--login">
					<div class="modal__info">
						<h2 class="modal__title">First time here?</h2>
						<div class="modal__descr">Join now and make <span>Ads management</span> as easy as possible</div>
						
						<button class="modal__switch modal__switch--signup" data-popup="signup">Signup</button>
					</div>
					<div class="modal__form form">
						<h2 class="form__title">Login</h2>
						<form class="form__container" id="LoginForm" method="post"
							action="{{route('login.submit')}}">
                            @csrf
							<div class="form__row">
								<label class="form__label">Email</label>
								<input name="email" class="form__input" type="email" />
								<span class="form__row-border"></span>
							</div>
							<div class="form__row">
								<label class="form__label" for="password">Password</label>
								<input name="password" id="password" class="form__input" type="password" />
								<span class="form__row-border"></span>
							</div>
							<div class="modal__switch modal__switch--forgot" data-popup="forgot">Forgot Password?</div>
							<input type="submit" name="submit" class="form__submit btn btn--green-bg" id="submitl"
								value="LOGIN" />
						</form>
					</div>
				</div> <!-- End Modal login -->

				<div class="modal__content modal__content--forgot">
					<div class="modal__form form">
						<h2 class="form__title">Forgot Password</h2>
						<form class="form__container" id="ForgotForm" method="post"
							action="{{ route('password.email') }}">
							<div class="form__row">
								<label class="form__label">Email</label>
								<input name="email" class="form__input" type="text" />
								<span class="form__row-border"></span>
							</div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
							<input type="submit" name="submit" class="form__submit btn btn--green-bg" id="submitf"
								value="RESET PASSWORD" />
						</form>
					</div>
					<div class="modal__info">
						<h2 class="modal__title">We got you covered</h2>
						<div class="modal__descr">A new password will be sent by email. Remembered your password?</div>
						<button class="modal__switch modal__switch--signup" data-popup="login">Login</button>
					</div>
				</div> <!-- End Modal login -->


				<div class="modal__content modal__content--signup">
					<div class="modal__form form">
						<h2 class="form__title">Signup</h2>
						<form class="form__container" id="SignupForm" method="post"
							action="{{ route('register') }}">
                            @csrf
							<div class="form__row">
								<label class="form__label" for="names">Username</label>
								<input name="name" id="name" class="form__input" type="text" />
								<span class="form__row-border"></span>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
							<div class="form__row">
								<label class="form__label">Email</label>
								<input name="email" class="form__input" type="email" />
								<span class="form__row-border"></span>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
							<div class="form__row">
								<label class="form__label" for="pass">Password</label>
								<input name="password" id="pass" class="form__input" type="password" />
								<span class="form__row-border"></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>

                            <div class="form__row">
								<label class="form__label" for="pass">Confirm Password</label>
								<input name="password_confirmation" id="pass" class="form__input" type="password" />
								<span class="form__row-border"></span>
							</div>

							<input type="submit" name="submit" class="form__submit btn btn--green-bg" id="submit"
								value="SIGNUP" />
						</form>
					</div>
					<div class="modal__info">
						<h2 class="modal__title">Allready have an account?</h2>
						<div class="modal__descr">Login now and starting using our <span>amazing</span> platform</div>
						
						<button class="modal__switch modal__switch--login" data-popup="login">Login</button>
					</div>
				</div> <!-- End Modal signup -->

			</div>

		</div>
	</section> <!-- Modal for Login and Signup -->

	<section class="modal modal--animation">
		<div class="modal__overlay modal__overlay--toggle"></div>
		<div class="modal__wrapper modal__wrapper--image modal-transition">
			<div class="modal__body">
				<button class="modal__close modal__overlay--toggle"><span></span></button>
				<div class="modal__header">How it works animation</div>

				<div class="modal__image">
					<img src="{{ asset('front/images/intro-animation.gif')}}" alt="" title="" />
				</div>
			</div>
		</div>
	</section> <!-- Modal for animation -->
	<script src="{{ asset('front/js/jquery-3.3.1.min.js')}}"></script>
	<script src="{{ asset('front/js/jquery.paroller.min.js')}}"></script>
	<script src="{{ asset('front/js/jquery.custom.js')}}"></script>
	<script src="{{ asset('front/js/swiper.min.js')}}"></script>
	<script src="{{ asset('front/js/swiper.custom.js')}}"></script>
	<script src="{{ asset('front/js/menu.js')}}"></script>

    @yield('js')

    <script>
        @error('password')
        setTimeout(() => {
			$(".modal--signuplogin").addClass('modal--visible');
			$(".modal__content--signup").addClass('modal__content--visible');
		}, 500);
        @enderror

        @error('email')
		setTimeout(() => {
			$(".modal--signuplogin").addClass('modal--visible');
			$(".modal__content--signup").addClass('modal__content--visible');
		}, 500);
        @enderror

        @error('name')
		setTimeout(() => {
			$(".modal--signuplogin").addClass('modal--visible');
			$(".modal__content--signup").addClass('modal__content--visible');
		}, 500);
        @enderror
    </script>

</body>


</html>
