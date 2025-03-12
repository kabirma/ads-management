@extends('front.layout.app')


@section('content')
   
	<!-- Section -- intro -->
	<section class="section section--intro" id="intro">
		<div class="section__content section__content--fluid-width section__content--intro">
			<div class="intro">
				<div class="intro__content">
					<div class="intro__title">{{$setting->name}}</div>
					<div class="intro__subtitle">{{$setting->short_description}}</div>
					<!-- <div class="intro__description">For as low as <span>$0.95</span> per user account</div> -->
					<div class="intro__buttons intro__buttons--left">
					<a href="#"  class="btn btn--orange-bg modal-toggle" data-openpopup="signuplogin" data-popup="login"><i class="fa fa-user"></i>
						{{__("messages.LOGIN")}}</a>
					<a href="#"  class="btn btn--orange-bg modal-toggle" data-openpopup="signuplogin" data-popup="signup"> <i class="fa fa-rocket"></i>{{__("messages.GETSTARTED")}}</a>
					</div>
				</div>
			</div>
		</div>
		<div class="intro-animation">
			<img src="{{asset($setting->cover)}}" alt="" title="" />
		</div>
		<svg class="svg-intro-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"
			preserveAspectRatio="none">
			<path d="M0,70 C30,130 70,50 100,70 L100,100 0,100 Z" fill="#ffffff" />
		</svg>
		<svg class="svg-intro-bottom-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"
			preserveAspectRatio="none">
			<path d="M0,70 C30,130 70,50 100,70 L100,100 0,100 Z" fill="#ffffff" fill-opacity="0.4" />
		</svg>
		<svg class="svg-intro-bottom-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"
			preserveAspectRatio="none">
			<path d="M95,0 Q90,90 10,100 L100,100 100,0 Z" fill="#ffffff" fill-opacity="0.1" />
		</svg>
	</section>


	<section class="section section--about" id="about">

		<div class="section__content section__content--fluid-width section__content--about">
			<div class="grid grid--5col grid--about">

				<div class="grid__item grid__item--x2">
					<h3 class="grid__title"><?= $setting->about_heading ?></h3>
					<p class="grid__text"> <?= $setting->about_content ?></p>
				</div>
				<div class="grid__item grid__item--x3">
					<div class="grid__image grid__image--right" data-paroller-factor="0.2"
						data-paroller-type="foreground" data-paroller-direction="vertical"><img
							src="{{asset($setting->about_image)}}" alt="" title="" /></div>
				</div>
			</div>
		</div>

	</section>


	<!-- Section -- about -->
	<section class="section section--features" id="vision">

		<div class="section__content section__content--fluid-width section__content--about">
			<div class="grid grid--2col grid--about">

				<div class="grid__item grid__item--x1 grid__item--floated-right">
					
					<h3 class="grid__title"><span> <?= $setting->vision_heading ?></span></h3>
					<p class="grid__text"><?= $setting->vision_content ?>

				</div>
				<div class="grid__item grid__item--x1">
				<h3 class="grid__title"><span> <?= $setting->mission_heading ?></span></h3>
				<p class="grid__text"><?= $setting->mission_content ?>
		<br><br>

		<br><br>

				</div>

			</div>
		</div>
	</section>
	
<!-- Section -->
	<section class="section" id="joinus">
		<div class="section__content section__content--fluid-width section__content--padding">
			<div class="grid grid--2col grid--support">
			
				<div class="grid__item grid__item--padding">
					<h3 class="grid__title">{{$setting->join_us_heading}}</h3>
					<p class="grid__text"><?= $setting->join_us_content ?></p>

				</div>
					<div class="grid__item grid__item--padding  grid__item--centering">

					<a href="#"  class="btn btn--orange-bg modal-toggle" data-openpopup="signuplogin" data-popup="login">{{__("messages.LOGIN")}}</a>
					<a href="#"  class="btn btn--orange-bg modal-toggle" data-openpopup="signuplogin" data-popup="signup">{{__("messages.GETSTARTED")}}</a>
				</div>
				<svg class="svg-support-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"
					preserveAspectRatio="none">
					<path d="M0,90 Q0,100 3,100 L95,96 Q100,96 99,80 L95,25 Q94,15 90,15 L6,0 Q2,0 2,10 Z"
						fill="#476A30" />
				</svg>
			</div>
			<div class="clear"></div>
		</div>

	</section>


	<!-- Section -- features -->
	<!-- <section class="section section--features" id="features">

		<div class="section__content section__content--fluid-width section__content--features">
			<h2 class="section__title section__title--centered">Features designed for you</h2>
			<div class="section__description section__description--centered">
				We believe we have created the most efficient SaaS landing page for your users. Landing page with
				features that will convince you to use it for your SaaS business.
			</div>
			<div class="grid grid--3col grid--features">

				<div class="grid__item">
					<div class="grid__icon"><img src="{{ asset('front/images/icons/icons-64-violet/responsive-64.png')}}" alt="" title="" />
					</div>
					<h3 class="grid__title"><span>Responsive</span> Layout Template</h3>
					<p class="grid__text">Responsive code that makes your landing page look good on all devices
						(desktops, tablets, and phones). Created with mobile specialists.</p>
				</div>

				<div class="grid__item">
					<div class="grid__icon"><img src="{{ asset('front/images/icons/icons-64-violet/desktop-chart-64.png')}}" alt=""
							title="" /></div>
					<h3 class="grid__title">SaaS Landing Page <span>Analysis</span></h3>
					<p class="grid__text">A perfect structure created after we analized trends in SaaS landing page
						designs. Analysis made to the most popular SaaS businesses.</p>
				</div>

				<div class="grid__item">
					<div class="grid__icon"><img src="{{ asset('front/images/icons/icons-64-violet/browser-64.png')}}" alt="" title="" />
					</div>
					<h3 class="grid__title">Smart <span>BEM</span> Grid</h3>
					<p class="grid__text">Blocks, Elements and Modifiers. A smart HTML/CSS structure that can easely be
						reused. Layout driven by the purpose of modularity.</p>
				</div>

			</div>

			<div class="grid grid--3col grid--features">


				<div class="grid__item">
					<div class="grid__icon"><img src="{{ asset('front/images/icons/icons-64-violet/users-64.png')}}" alt="" title="" />
					</div>
					<h3 class="grid__title">User <span>Friendly</span></h3>
					<p class="grid__text">Easy to navigate. Made with user experience in mind, in order to provide the
						perfect landing page experience for your client.</p>
				</div>

				<div class="grid__item">
					<div class="grid__icon"><img src="{{ asset('front/images/icons/icons-64-violet/security-64.png')}}" alt="" title="" />
					</div>
					<h3 class="grid__title">Best online <span>Security</span></h3>
					<p class="grid__text">A perfect structure created after we analized trends in SaaS landing page
						designs. Analysis made to the most popular SaaS businesses.</p>
				</div>

				<div class="grid__item">
					<div class="grid__icon"><img src="{{ asset('front/images/icons/icons-64-violet/target-64.png')}}" alt="" title="" />
					</div>
					<h3 class="grid__title">Target <span>audience</span></h3>
					<p class="grid__text">Blocks, Elements and Modifiers. A smart HTML/CSS structure that can easely be
						reused. Layout driven by the purpose of modularity.</p>
				</div>

			</div>
		</div>


	</section> -->


	<section class="section section--features" id="our_team">

		<div class="section__content section__content--fluid-width section__content--features">
			<h2 class="section__title section__title--centered">{{$setting->our_team_heading}}</h2>
			<div class="section__description section__description--centered">
				<?= $setting->our_team_content ?>
			</div>
			
		</div>


	</section>


{{--	//yaha se--}}
	<!-- Section -- pricing -->
	<section class="section" id="pricing">

		<div class="section__content section__content--fluid-width section__content--padding">
			<h2 class="section__title section__title--centered">{{__("messages.OurPlans")}}</h2>
			<div class="section__description section__description--centered">
				{{__("messages.message_content")}}
			</div>


			<div class="pricing">
				<div class="pricing__switcher switcher">
					<div class="switcher__buttons">
						<div class="switcher__button switcher__button--enabled">{{__("messages.Monthly")}}</div>
						<div class="switcher__button">{{__("messages.Yearly")}} </div>
						<div class="switcher__border"></div>
					</div>

				</div>


				<div class="pricing__plan">
					<h3 class="pricing__title">{{__("messages.FREE")}}</h3>
					<div class="pricing__values">
						<div class="pricing__value pricing__value--show"><span>$</span>0 <b>/ {{__("messages.month")}}</b></div>
						<div class="pricing__value pricing__value--hide pricing__value--hidden"><span>$</span>0 <b>/
								{{__("messages.yearly")}}</b></div>
					</div>
					<ul class="pricing__list">
						<li><b>1</b> {{__("messages.UserAccount")}}</li>
						<li><b>10</b> {{__("messages.TeamMembers")}}</li>
						<li><b>{{__("messages.Unlimited")}}</b> {{__("messages.EmailsAccounts")}}</li>
						<li>{{__("messages.SetAndManagePermissions")}}</li>
						<li class="disabled">{{__("messages.API&extensionsupport")}}</li>
						<li class="disabled">{{__("messages.Developersupport")}}</li>
						<li class="disabled">{{__("messages.A/BTesting")}}</li>
					</ul>
					<a class="pricing__signup" href="#">{{__("messages.Signup")}}</a>
				</div>
				<div class="pricing__plan pricing__plan--popular">
					<div class="pricing__badge-bg"></div>
					<div class="pricing__badge-text">{{__("messages.POPULAR")}}</div>
					<h3 class="pricing__title">{{__("messages.PRO")}}</h3>
					<div class="pricing__values">
						<div class="pricing__value pricing__value--show"><span>$</span>49 <b>/ {{__("messages.month")}}</b></div>
						<div class="pricing__value pricing__value--hide pricing__value--hidden"><span>$</span>529 <b>/
								{{__("messages.yearly")}}</b></div>
					</div>
					<ul class="pricing__list">
						<li><b>50</b> {{__("messages.UserAccount")}}</li>
						<li><b>500</b> {{__("messages.TeamMembers")}}</li>
						<li><b>{{__("messages.Unlimited")}}</b> {{__("messages.EmailsAccounts")}}</li>
						<li>{{__("messages.SetAndManagePermissions")}}</li>
						<li>{{__("messages.API&extensionsupport")}}</li>
						<li>{{__("messages.Developersupport")}}</li>
						<li class="disabled">{{__("messages.A/BTesting")}}</li>
					</ul>
					<a class="pricing__signup" href="#">{{__("messages.Signup")}}</a>
				</div>
				<div class="pricing__plan">
					<h3 class="pricing__title">{{__("messages.ULTRA")}}</h3>
					<div class="pricing__values">
						<div class="pricing__value pricing__value--show"><span>$</span>99 <b>/ {{__("messages.month")}}</b></div>
						<div class="pricing__value pricing__value--hide pricing__value--hidden"><span>$</span>900 <b>/
								{{__("messages.yearly")}}</b></div>
					</div>
					<ul class="pricing__list">
						<li><b>{{__("messages.Unlimited")}}</b> {{__("messages.UserAccount")}}</li>
						<li><b>{{__("messages.Unlimited")}}</b> {{__("messages.TeamMembers")}}</li>
						<li><b>{{__("messages.Unlimited")}}</b> {{__("messages.EmailsAccounts")}}</li>
						<li>{{__("messages.SetAndManagePermissions")}}</li>
						<li>{{__("messages.API&extensionsupport")}}</li>
						<li>{{__("messages.Developersupport")}}</li>
						<li>{{__("messages.A/BTesting")}}</li>

					</ul>
					<a class="pricing__signup" href="#">{{__("messages.Signup")}}</a>
				</div>
			</div>

			<div class="clear"></div>
		</div>

	</section>

	<!-- Section -->
	<section class="section section--cta" id="contact">
		<div class="section__content section__content--fluid-width section__content--padding section__content--cta">
			<h2 class="section__title section__title--centered section__title--cta">{{__("messages.cta_title")}}			</h2>
			<div class="section__description section__description--centered section__description--cta">
{{__("messages.cta_description")}}
			</div>
			<div style="display:flex;padding:0 20%">
			<div class="intro__buttons intro__buttons--centered">
				<a href="index-2.html" class="btn btn--orange-bg">
				<i class="fa fa-phone"></i>
				{{$setting->phone}}</a>
			</div>
			<div class="intro__buttons intro__buttons--centered">
				<a href="index-2.html" class="btn btn--orange-bg">
				<i class="fa fa-at"></i>
				{{$setting->email}}</a>
			</div>
			<div class="intro__buttons intro__buttons--centered">
				<a href="index-2.html" class="btn btn--orange-bg">
				<i class="fa fa-map-marker"></i>
				{{$setting->address}}</a>
			</div>
			</div>
		</div>
		<svg class="svg-cta-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
			<path d="M0,70 C30,130 70,50 100,70 L100,100 0,100 Z" fill="#ffffff" />
		</svg>
	</section>

@endsection