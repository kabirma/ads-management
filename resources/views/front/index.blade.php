@extends('front.layout.app')


@section('content')
   
	<!-- Section -- intro -->
	<section class="section section--intro" id="intro">
		<div class="section__content section__content--fluid-width section__content--intro">
			<div class="intro">
				<div class="intro__content">
					<div class="intro__title"><span>Powerful services</span> for powerful applications</div>
					<div class="intro__subtitle">We believe we have created the most efficient SaaS landing page for
						your users. </div>
					<div class="intro__description">For as low as <span>$0.95</span> per user account</div>
					<div class="intro__buttons intro__buttons--left">
						<a href="index-2.html" class="btn btn--blue-bg btn--play modal-toggle"
							data-openpopup="animation">WATCH DEMO</a>
						<a href="index-2.html" class="btn btn--orange-bg">START NOW</a>
					</div>
				</div>
			</div>
		</div>
		<div class="intro-animation">
			<img src="{{ asset('front/images/intro-animation.png')}}" alt="" title="" />
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

	<!-- Section -- about -->
	<section class="section section--about" id="about">

		<div class="section__content section__content--fluid-width section__content--about">
			<div class="grid grid--5col grid--about">

				<div class="grid__item grid__item--x2">
					<h3 class="grid__title">Build your SAAS landing page using the <span>intelligent BEM
							interface</span></h3>
					<p class="grid__text">Blocks, Elements and Modifiers. A smart HTML/CSS structure that can easely be
						reused. Layout driven by the purpose of modularity.</p>
					<ul class="grid__list">
						<li>Simple and Smart HTML code</li>
						<li>Works reintegrated in any part of the layout</li>
						<li>Reuse the elements from one design to another</li>
					</ul>

				</div>
				<div class="grid__item grid__item--x3">
					<div class="grid__image grid__image--right" data-paroller-factor="0.2"
						data-paroller-type="foreground" data-paroller-direction="vertical"><img
							src="{{ asset('front/images/desktop-frame-about.png')}}" alt="" title="" /></div>
				</div>
			</div>
		</div>

	</section>
	<!-- Section -- about -->
	<section class="section section--about">

		<div class="section__content section__content--fluid-width section__content--about">
			<div class="grid grid--5col grid--about">

				<div class="grid__item grid__item--x2 grid__item--floated-right">
					<h3 class="grid__title">Powerful services for <span>powerful applications</span></h3>
					<p class="grid__text">Responsive code that makes your landing page look good on all devices
						(desktops, tablets, and phones). Created with mobile specialists.</p>
					<ul class="grid__list">
						<li>Responsive code</li>
						<li>Look good on all devices</li>
						<li>Created with mobile specialists</li>
					</ul>

				</div>
				<div class="grid__item grid__item--x3">
					<div class="grid__image grid__image--left" data-paroller-factor="0.2"
						data-paroller-type="foreground" data-paroller-direction="vertical"><img
							src="{{ asset('front/images/desktop-frame-about-2.png')}}" alt="" title="" /></div>
				</div>

			</div>
		</div>

	</section>
	<!-- Section -- about -->
	<section class="section section--about" id="about2">

		<div class="section__content section__content--fluid-width section__content--about">
			<div class="grid grid--5col grid--about">

				<div class="grid__item grid__item--x2">
					<h3 class="grid__title">Layout driven by the <span>purpose of modularity</span>.</h3>
					<p class="grid__text">Choose between multiple unique designs and easy integrate elements from one
						design to another. Following the latest design trends.</p>
					<ul class="grid__list">
						<li>Elements from one design to another</li>
						<li>Following the latest design trends</li>
						<li>Reuse the elements from one design to another</li>
					</ul>

				</div>
				<div class="grid__item grid__item--x3">
					<div class="grid__image grid__image--right" data-paroller-factor="0.2"
						data-paroller-type="foreground" data-paroller-direction="vertical"><img
							src="{{ asset('front/images/desktop-frame-about-3.png')}}" alt="" title="" /></div>
				</div>
			</div>
		</div>

	</section>

	<!-- Section -- features -->
	<section class="section section--features" id="features">

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


	</section>



	<!-- Section -- pricing -->
	<section class="section" id="pricing">

		<div class="section__content section__content--fluid-width section__content--padding">
			<h2 class="section__title section__title--centered">Our Plans</h2>
			<div class="section__description section__description--centered">
				We believe we have created the most efficient SaaS landing page for your users. Landing page with
				features that will convince you to use it for your SaaS business.
			</div>


			<div class="pricing">
				<div class="pricing__switcher switcher">
					<div class="switcher__buttons">
						<div class="switcher__button switcher__button--enabled">Monthly</div>
						<div class="switcher__button">Yearly</div>
						<div class="switcher__border"></div>
					</div>

				</div>


				<div class="pricing__plan">
					<h3 class="pricing__title">FREE</h3>
					<div class="pricing__values">
						<div class="pricing__value pricing__value--show"><span>$</span>0 <b>/ month</b></div>
						<div class="pricing__value pricing__value--hide pricing__value--hidden"><span>$</span>0 <b>/
								yearly</b></div>
					</div>
					<ul class="pricing__list">
						<li><b>1</b> User Account</li>
						<li><b>10</b> Team Members</li>
						<li><b>Unlimited</b> Emails Accounts</li>
						<li>Set And Manage Permissions</li>
						<li class="disabled">API &amp; extension support</li>
						<li class="disabled">Developer support</li>
						<li class="disabled">A / B Testing</li>
					</ul>
					<a class="pricing__signup" href="#">Sign up</a>
				</div>
				<div class="pricing__plan pricing__plan--popular">
					<div class="pricing__badge-bg"></div>
					<div class="pricing__badge-text">POPULAR</div>
					<h3 class="pricing__title">PRO</h3>
					<div class="pricing__values">
						<div class="pricing__value pricing__value--show"><span>$</span>49 <b>/ month</b></div>
						<div class="pricing__value pricing__value--hide pricing__value--hidden"><span>$</span>529 <b>/
								yearly</b></div>
					</div>
					<ul class="pricing__list">
						<li><b>50</b> User Account</li>
						<li><b>500</b> Team Members</li>
						<li><b>Unlimited</b> Emails Accounts</li>
						<li>Set And Manage Permis sions</li>
						<li>API &amp; extension support</li>
						<li>Developer support</li>
						<li class="disabled">A / B Testing</li>
					</ul>
					<a class="pricing__signup" href="#">Sign up</a>
				</div>
				<div class="pricing__plan">
					<h3 class="pricing__title">ULTRA</h3>
					<div class="pricing__values">
						<div class="pricing__value pricing__value--show"><span>$</span>99 <b>/ month</b></div>
						<div class="pricing__value pricing__value--hide pricing__value--hidden"><span>$</span>900 <b>/
								yearly</b></div>
					</div>
					<ul class="pricing__list">
						<li><b>Unlimited</b> User Account</li>
						<li><b>Unlimited</b> Team Members</li>
						<li><b>Unlimited</b> Emails Accounts</li>
						<li>Set And Manage Permissions</li>
						<li>API &amp; extension support</li>
						<li>Developer support</li>
						<li>A / B Testing</li>

					</ul>
					<a class="pricing__signup" href="#">Sign up</a>
				</div>
			</div>

			<div class="clear"></div>
		</div>

	</section>

	<!-- Section -- testimonials -->
	<section class="section section--testimonials" id="testimonials">

		<div class="section__content section__content--fluid-width section__content--padding">
			<h2 class="section__title section__title--centered">Success stories</h2>
			<div class="testimonials">
				<div class="testimonials__content swiper-wrapper">
					<div class="testimonials__slide swiper-slide">
						<div class="testimonials__thumb" data-swiper-parallax="-50%"><img src="{{ asset('front/images/avatar-1.jpg')}}"
								alt="" title="" /></div>
						<div class="testimonials__source">Lason Duvan <a href="#">New York Business Center</a></div>
						<div class="testimonials__text" data-swiper-parallax="-100%">
							<p>"Business is all about the customer: what the customer wants and what they get. "</p>
						</div>

					</div>
					<div class="testimonials__slide swiper-slide">
						<div class="testimonials__thumb" data-swiper-parallax="-50%"><img src="{{ asset('front/images/avatar-2.jpg')}}"
								alt="" title="" /></div>
						<div class="testimonials__source">Jada Sacks <a href="#">Paris Tehnics</a></div>
						<div class="testimonials__text" data-swiper-parallax="-100%">
							<p>" I've internalized it to the point of understanding that the success of my actions
								and/or endeavors"</p>
						</div>

					</div>
					<div class="testimonials__slide swiper-slide">
						<div class="testimonials__thumb" data-swiper-parallax="-50%"><img src="{{ asset('front/images/avatar-3.jpg')}}"
								alt="" title="" /></div>
						<div class="testimonials__source">Lason Duvan <a href="#">Music Software</a></div>
						<div class="testimonials__text" data-swiper-parallax="-100%">
							<p>"The American Dream is that any man or woman, despite of his or her background, can
								change their circumstances"</p>
						</div>

					</div>
					<div class="testimonials__slide swiper-slide">
						<div class="testimonials__thumb" data-swiper-parallax="-50%"><img src="{{ asset('front/images/avatar-4.jpg')}}"
								alt="" title="" /></div>
						<div class="testimonials__source">Duran Jackson <a href="#">New York Business Center</a></div>
						<div class="testimonials__text" data-swiper-parallax="-100%">
							<p>"Generally, every customer wants a product or service that solves their problem, worth
								their money"</p>
						</div>

					</div>
					<div class="testimonials__slide swiper-slide">
						<div class="testimonials__thumb" data-swiper-parallax="-50%"><img src="{{ asset('front/images/avatar-5.jpg')}}"
								alt="" title="" /></div>
						<div class="testimonials__source">Maria Allesi <a href="#">Italy Solutions</a></div>
						<div class="testimonials__text" data-swiper-parallax="-100%">
							<p>"No one can make you successful; the will to success comes from within.' I've made this
								my motto."</p>
						</div>

					</div>
					<div class="testimonials__slide swiper-slide">
						<div class="testimonials__thumb" data-swiper-parallax="-50%"><img src="{{ asset('front/images/avatar-6.jpg')}}"
								alt="" title="" /></div>
						<div class="testimonials__source">Jenifer Patrison<a href="#">App Dating</a></div>
						<div class="testimonials__text" data-swiper-parallax="-100%">
							<p>"Can change their circumstances and rise as high as they are willing to work"</p>
						</div>

					</div>
				</div>

				<div class="testimonials__pagination swiper-pagination"></div>
				<div class="testimonials__button--next swiper-button-next"></div>
				<div class="testimonials__button--prev swiper-button-prev"></div>
			</div>
			<div class="clear"></div>
		</div>

	</section>


	<!-- Section -->
	<section class="section" id="support">
		<div class="section__content section__content--fluid-width section__content--padding">
			<div class="grid grid--2col grid--support">
				<div class="grid__item grid__item--padding">

					<h3 class="grid__title">Help &amp; Support</h3>
					<p class="grid__text">Your issue is our main priority. Our 24/7 support team is here to help you and
						make sure our product is up to date. Have a presale question about our products and features? Or
						looking for a refund? We would love to hear what you concern is. Online awards and publications.
						Get our media resources and learn about our company information.</p>
				</div>
				<div class="grid__item grid__item--padding grid__item--centering">
					<a href="#" class="grid__more">GET IN TOUCH NOW</a>
				</div>
				<svg class="svg-support-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"
					preserveAspectRatio="none">
					<path d="M0,90 Q0,100 3,100 L95,96 Q100,96 99,80 L95,25 Q94,15 90,15 L6,0 Q2,0 2,10 Z"
						fill="#fb993e" />
				</svg>
			</div>
			<div class="clear"></div>
		</div>

	</section>


	<!-- Section -->
	<section class="section section--clients" id="clients">
		<div class="section__content section__content--fluid-width">
			<div class="grid grid--5col">

				<div class="grid__item">
					<div class="grid__client-logo"><a href="#"><img src="{{ asset('front/images/clients/clients-logo1.png')}}" alt=""
								title="" /></a></div>
				</div>
				<div class="grid__item">
					<div class="grid__client-logo"><a href="#"><img src="{{ asset('front/images/clients/clients-logo2.png')}}" alt=""
								title="" /></a></div>
				</div>
				<div class="grid__item">
					<div class="grid__client-logo"><a href="#"><img src="{{ asset('front/images/clients/clients-logo3.png')}}" alt=""
								title="" /></a></div>
				</div>
				<div class="grid__item">
					<div class="grid__client-logo"><a href="#"><img src="{{ asset('front/images/clients/clients-logo4.png')}}" alt=""
								title="" /></a></div>
				</div>
				<div class="grid__item">
					<div class="grid__client-logo"><a href="#"><img src="{{ asset('front/images/clients/clients-logo5.png')}}" alt=""
								title="" /></a></div>
				</div>
			</div>

		</div>
		<svg class="svg-cta-top" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
			<path d="M0,70 C30,130 70,50 100,70 L100,100 0,100 Z" fill="#42387a" />
		</svg>
	</section>

	<!-- Section -->
	<section class="section section--cta" id="cta">
		<div class="section__content section__content--fluid-width section__content--padding section__content--cta">
			<h2 class="section__title section__title--centered section__title--cta">Get Started Now!</h2>
			<div class="section__description section__description--centered section__description--cta">
				We believe we have created the most efficient SaaS landing page for your users. Landing page with
				features that will convince you to use it for your SaaS business.
			</div>
			<div class="intro__buttons intro__buttons--centered">
				<a href="index-2.html" class="btn btn--orange-bg">CREATE AN ACCOUNT</a>
			</div>
		</div>
		<svg class="svg-cta-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
			<path d="M0,70 C30,130 70,50 100,70 L100,100 0,100 Z" fill="#ffffff" />
		</svg>
	</section>

@endsection