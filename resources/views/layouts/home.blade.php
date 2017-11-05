@extends('layouts.app')

@section('content')

<div class="hidden-xs" style="margin-top: -20px; margin-bottom: 25px; width: 100%">
	<img style="width:100%" src="https://s3-us-west-2.amazonaws.com/freerider/system/intro/2.jpg" alt="Los Angeles">
</div>

<div class="visible-xs-block" style="margin-top: -15px; width: 100%">
	<img style="width:100%" src="https://s3-us-west-2.amazonaws.com/freerider/system/intro/8.jpg" alt="Los Angeles">
</div>

<div class="visible-xs-block row">
	<div class="col-md-12">
		<img class="d-block img-responsive" src="https://s3-us-west-2.amazonaws.com/freerider/system/intro/3.jpg" alt="Chicago">
	</div>
	<div class="col-md-12" style="margin-top: -20px; padding-bottom: 15px; border-bottom: solid 1px #f2f2f2">
		<br class="visible-xs-block">
		<img class="d-block img-responsive" src="https://s3-us-west-2.amazonaws.com/freerider/system/intro/4.jpg" alt="Chicago">
	</div>
</div>

<div class="container" style="width: 90%">
	<div class="row hidden-xs">
		<div class="col-md-6">
			<img style="border-radius: 2px" class="d-block img-responsive" src="https://s3-us-west-2.amazonaws.com/freerider/system/intro/3.jpg" alt="Chicago">
		</div>
		<div class="col-md-6">
			<br class="visible-xs-block">
			<img style="border-radius: 2px" class="d-block img-responsive" src="https://s3-us-west-2.amazonaws.com/freerider/system/intro/4.jpg" alt="Chicago">
		</div>
	</div>
    
    <div class="hidden-xs row" style="margin-top: 70px;">
    	<div class="col-md-12">
			<div class="tab" style="border-width: 0px; margin-bottom: -10px">
				@foreach (App\Order::$category as $key => $element)
					<button style="text-align: center;" class="tablinks {{ ($key == 'others' || $key == 'watch') ? "hidden-xs" : '' }}" onclick="openStatus(event, '{{ $key }}')" {{ $key == 'food' ? "id=defaultOpen" : '' }}>{{ App\Order::$category[$key] }}</button>
				@endforeach
			</div>

			@foreach (App\Order::$category as $key => $element)
				<div id="{{ $key }}" class="tabcontent" style="padding-top: 10px; border-width: 0px">
					<div class="order-carousel owl-carousel owl-theme">
						@foreach ($loopOrders[$key] as $order)
				            @include('order.single-order', ['radius' => 'border-bottom-left-radius: 2px; border-bottom-right-radius: 2px;'])
				        @endforeach
				    </div>
				</div>
			@endforeach
		</div>
	</div>

	<div class="visible-xs-block row" style="margin-top: 50px;">
		<h3 style="color: grey; font-weight: 300">為您精選的產品</h3>
		<hr>
		@include('order.related-orders')
	</div>

	<div class="row" style="margin-top: 15px">
		<div class="col-md-4 col-md-offset-4 col-xs-8 col-xs-offset-2">
		    <form action="{{ route('order.search') }}" method="GET">
		        <button type="submit" class="btn btn-info btn-outline btn-lg btn-block" style="border-radius: 0; font-size: 15px;">查看所有分類</button>
		    </form>
	    </div>
	</div>

	<div class="row hidden-xs" style="padding-top: 90px;">
		<div class="col-md-8">
		    <form action="{{ route('order.search') }}" method="GET">
		    	<input type="hidden" name="country" id="country" value="japan">
				<input class="img-responsive" type="image" src="https://s3-us-west-2.amazonaws.com/freerider/system/country/japan.jpg">
			</form>
		</div>
		<div class="col-md-4">
			<form action="{{ route('order.search') }}" method="GET">
		    	<input type="hidden" name="country" id="country" value="korea">
				<input class="img-responsive" type="image" src="https://s3-us-west-2.amazonaws.com/freerider/system/country/korea.jpg">
			</form>
		</div>
	</div>

	<div class="row hidden-xs" style="margin-top: 15px">
		<div class="col-md-7">
			<div class="row">
				<div class="col-md-12">
				    <form action="{{ route('order.search') }}" method="GET">
				    	<input type="hidden" name="country" id="country" value="taiwan">
						<input class="img-responsive" type="image" src="https://s3-us-west-2.amazonaws.com/freerider/system/country/taiwan.jpg">
					</form>
				</div>
			</div>
			<div class="row" style="margin-top: 15px">
				<div class="col-md-12">
				    <form action="{{ route('order.search') }}" method="GET">
				    	<input type="hidden" name="country" id="country" value="singapore">
						<input class="img-responsive" type="image" src="https://s3-us-west-2.amazonaws.com/freerider/system/country/singapore.jpg">
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="row">
				<div class="col-md-6">
					<form action="{{ route('order.search') }}" method="GET">
				    	<input type="hidden" name="country" id="country" value="usa">
						<input class="img-responsive" type="image" src="https://s3-us-west-2.amazonaws.com/freerider/system/country/usa.jpg">
					</form>
				</div>
				<div class="col-md-6" style="text-align: left">
					<form action="{{ route('order.search') }}" method="GET">
				    	<input type="hidden" name="country" id="country" value="france">
						<input class="img-responsive" type="image" src="https://s3-us-west-2.amazonaws.com/freerider/system/country/paris.jpg">
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="row visible-xs-block" style="padding-top: 90px">
		<div class="row">
			<div class="col-xs-12">
				<form action="{{ route('order.search') }}" method="GET">
			    	<input type="hidden" name="country" id="country" value="japan">
					<input class="img-responsive" type="image" src="https://s3-us-west-2.amazonaws.com/freerider/system/countrySquare/japan.jpg">
				</form>
			</div>
		</div>
		<div class="row" style="margin-top: 10px">
			<div class="col-xs-6" style="padding-right: 5px">
				<form action="{{ route('order.search') }}" method="GET">
			    	<input type="hidden" name="country" id="country" value="korea">
					<input class="img-responsive" type="image" src="https://s3-us-west-2.amazonaws.com/freerider/system/countrySquare/korea.jpg">
				</form>
			</div>
			<div class="col-xs-6" style="padding-left: 5px">
				<form action="{{ route('order.search') }}" method="GET">
			    	<input type="hidden" name="country" id="country" value="usa">
					<input class="img-responsive" type="image" src="https://s3-us-west-2.amazonaws.com/freerider/system/countrySquare/usa.jpg">
				</form>
			</div>
		</div>
	</div>

	<div class="row" style="margin-top: 20px">
		<div class="col-md-4 col-md-offset-4 col-xs-8 col-xs-offset-2">
		    <form action="{{ route('order.search') }}" method="GET">
		        <button type="submit" class="btn btn-info btn-outline btn-lg btn-block" style="border-radius: 0; font-size: 15px;">查看所有產品</button>
		    </form>
		</div>
	</div>

	<div class="hidden-xs row" style="margin-top: 100px">
		<div class="col-md-8 col-ms-12">
			<div class="blog-carousel owl-carousel owl-theme">
				@foreach ($caro_blogs as $blog)
					<a href="{{ route('blog.show', ['blog' => $blog->id]) }}">
						<img class="img-responsive border-radius-2" src="https://s3-us-west-2.amazonaws.com/freerider/blogImgs/originals/{{ $blog->id }}/{{ $blog->blogImgs->first()->filename }}" alt="First slide">
						<div class="center-align white-text" style="position:absolute;bottom:0;left:0;right:0;font-size:17px;color:white;background-color: rgba(0, 0, 0, 0.5);height:70px;padding-left:15px;padding-right:15px; border-radius: 0 0 2px 2px;">
							<span style="line-height: 70px; font-weight: 300; letter-spacing: 1px">{{ $blog->title }}</span>
						</div>
					</a>
				@endforeach
			</div>
		</div>
		<div class="col-md-4" style="padding-left: 25px">
			@foreach($relatedBlogs as $blog)
			    <div class="row" style="margin-bottom: 15px;">
			        <div class="col-md-5">
			            <a href="{{ route('blog.show', ['blog' => $blog->id]) }}">
			                <img src="https://s3-us-west-2.amazonaws.com/freerider/blogImgs/squares/{{ $blog->id }}/{{ $blog->blogImgs->first()->filename }}" class="img-responsive img-circle">
			            </a>
			        </div>
			        <div class="col-md-7">
			            <div><a href="{{ route('blog.show', ['blog' => $blog->id]) }}"><h3 style="color: black; font-weight: 400; font-size: 15px">{{ str_limit($blog->title, 50) }}</h3></a></div>
			            <div style="font-size: 12.5px">{{ Carbon\Carbon::parse($blog->created_at)->format('Y年m月d日') }}</div>
			        </div>
			    </div>
			@endforeach
			<div class="row" style="margin-top: 25px">
				<div class="col-md-6 col-md-offset-3">
				    <form action="{{ route('blog.index') }}" method="GET">
				        <button type="submit" class="btn btn-info btn-outline btn-lg btn-block" style="border-radius: 0; font-size: 15px;">查看所有貼文</button>
				    </form>
				</div>
			</div>
		</div>
	</div>

	<div class="visible-xs-block" style="padding-top: 70px">
		<h3 style="color: grey; font-weight: 300">FreeRider部落格</h3>
		<hr>
		@foreach ($similar_blogs as $blog)
			<div class="col-xs-12">
				<div class="card">
	                <a href="{{ route('blog.show', ['blog' => $blog->id]) }}"><img class="img-responsive" src="https://s3-us-west-2.amazonaws.com/freerider/blogImgs/thumbnails/{{ $blog->id }}/{{ $blog->blogImgs->sortby('created_at')->first()->filename }}" alt="First slide"></a>

				    <div class="card-content">
				        <a style="line-height: 25px; padding: 13px; font-weight: 300; color: grey; display:block; white-space: nowrap;overflow: hidden;text-overflow: ellipsis;" href="{{ route('blog.show', ['blog' => $blog->id]) }}">
							{{ $blog->title }}
						</a>
					</div>
				</div>
			</div>
		@endforeach
		<div class="row" style="margin-top: 20px">
			<div class="col-xs-8 col-xs-offset-2">
			    <form action="{{ route('blog.index') }}" method="GET">
			        <button type="submit" class="btn btn-info btn-outline btn-lg btn-block" style="border-radius: 0; font-size: 15px;">查看所有貼文</button>
			    </form>
			</div>
		</div>
	</div>

	<br><br><br><br><br>
</div>

<script>
	function openStatus(evt, cityName) {
	    var i, tabcontent, tablinks;
	    tabcontent = document.getElementsByClassName("tabcontent");
	    for (i = 0; i < tabcontent.length; i++) {
	        tabcontent[i].style.display = "none";
	    }
	    tablinks = document.getElementsByClassName("tablinks");
	    for (i = 0; i < tablinks.length; i++) {
	        tablinks[i].className = tablinks[i].className.replace(" active", "");
	    }
	    document.getElementById(cityName).style.display = "block";
	    evt.currentTarget.className += " active";
	}

	// Get the element with id="defaultOpen" and click on it
	document.getElementById("defaultOpen").click();

	$(document).ready(function(){
		$('.order-carousel').owlCarousel({
			items: 4,
			loop: true,
			margin: 5,
			nav: true,
			dots: false,
			lazyLoad: true,
			autoplay: false,
			navText : ['<i class="material-icons" style="font-size:36px; margin-left:-91px; color:#666666">keyboard_arrow_left</i>','<i class="material-icons" style="font-size:36px; margin-right:-90px; color:#666666">keyboard_arrow_right</i>']
		});
	});

	$(document).ready(function(){
		$('.blog-carousel').owlCarousel({
			items: 1,
			loop: true,
			margin: 5,
			nav: false,
			dots: true,
			lazyLoad: true,
			autoplay: true,
		});
	});
</script>

@endsection
