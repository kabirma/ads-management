@extends('front.layout.app')


@section('content')
<style>
    .header__menu > ul > li > a{
        color: black;
    }
</style>

	<!-- Section -- features -->
	<section class="section" id="features">

		<div class="section__content section__content--fluid-width section__content--features">
			<h2 class="section__title section__title--centered">{{$page->title}}</h2>
			<div class="section__description">
				<?= $page->description ?>
			</div>
			
		</div>


	</section>


@endsection