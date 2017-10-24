@extends('layouts.app')

@section('content')
<div class="container" style="width: 90%">
	<div class="row">
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-12">
					<div class="order-tab">
						@foreach ($order->orderImgs as $image)
							<button class="tablinks" onclick="openCity(event, '{{ $image->filename }}')" {{ $image->filename == $order->orderImgs->first()->filename ? "id=defaultOpen" : '' }}>
								<img class="img-responsive" src="https://s3-us-west-2.amazonaws.com/freerider/orderImgs/originals/{{ $image->order_id }}/{{ $image->filename }}.jpg" alt="First slide">
							</button>
						@endforeach
					</div>

					@foreach ($order->orderImgs as $image)
						<div id="{{ $image->filename }}" class="tabcontent">
							<img style="border-radius: 2px; border-top-left-radius: 0px" class="img-responsive" src="https://s3-us-west-2.amazonaws.com/freerider/orderImgs/originals/{{ $image->order_id }}/{{ $image->filename }}.jpg" alt="First slide">
						</div>
					@endforeach
				</div>
			</div>

			<br>

			<div class="row">
				<div class="col-md-12">
					<h3 style="color: black; font-weight: 400">{{ $order->name }}</h3>
					<p>發佈日期：{{ $order->created_at }}</p>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-2">
					<a href="{{ route('user.show', ['user' => $order->user]) }}"><img src="https://s3-us-west-2.amazonaws.com/freerider/avatars/thumbnails/{{ $order->user->avatar->filename }}.jpg" class="img-responsive img-circle"></a>
				</div>
				<div class="col-md-6">
					<div><h3 style="color: black; font-weight: 400; margin-top: 15px">${{ $order->price }} + $0 服務費</h3></div>
					<div>產地：{{ App\Order::$country[$order->country] }}</div>
					<div>收貨日期：{{ $order->end_date }} 前</div>
				</div>
				<div class="col-md-4">
					<form style="margin-top: 5%" action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
						{{ csrf_field() }}
						<input type="hidden" name="name" id="name" value="{{ $order->name }}">
						<input type="hidden" name="price" id="price" value="{{ $order->price }}">
						<input type="hidden" name="category" id="category" value="{{ $order->category }}">
						<input type="hidden" name="country" id="country" value="{{ $order->country }}">
						<input type="hidden" name="description" id="description" value="{{ $order->description }}">
						<input type="hidden" name="link" id="link" value="{{ $order->link }}">
						<input type="hidden" name="endDate" id="endDate" value="{{ Carbon\Carbon::today()->addDays(10)->format('Y-m-d') }}">
						<input type="hidden" name="copyOrderId" id="copyOrderId" value="{{ $order->id }}">

						<button type="submit" style="border-radius: 2px 2px 0 0 !important; font-size:15px" class="btn btn-info btn-lg btn-block">我也想要</button>
					</form>

					<form action="{{ route('tran.store') }}" method="POST" enctype="multipart/form-data">
						{{ csrf_field() }}
						<input name="order_id" type="hidden" value="{{ $order->id }}">
						@if (!$order->is_payed || $order->trans || $order->end_date < Carbon\Carbon::today())
							<button type="button" style="border-radius: 0; font-size:15px" class="btn btn-primary btn-outline btn-lg btn-block" disabled='true'>接單</button>
						@else
				            <!-- Trigger the modal with a button -->
				            <button type="button" style="border-radius: 0 0 2px 2px; font-size:15px" class="btn btn-primary btn-outline btn-lg btn-block" data-toggle="modal" data-target="#acceptModal">接單</button>
							<!-- Modal -->
							<div id="acceptModal" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">接單說明</h4>
										</div>
										<div class="modal-body">
											<p>1. 買家已預先支付訂單款項，並會在交易完成後由我們轉帳至您的帳戶，以此保障雙方利益</p>
											<p>2. 請確保您可在訂單要求的收貨日期內交收，之後再接單。</p>
											<p>3. 接單後，此訂單將不能被取消。</p>
											<br>
										</div>
										<div class="modal-footer">
											<button type="button" style="border-radius: 2px;" class="btn btn-default" data-dismiss="modal">返回</button>
											<button type="submit" style="border-radius: 2px !important" class="btn btn-info">確認接單</button>
										</div>
									</div>
								</div>
							</div>
						@endif
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-md-10 col-md-offset-2">
					<h5 style="font-weight: 400; line-height: 20px; white-space: pre-line;">{{ $order->description }}</h5>
					<h5 style="margin-top: 20px; line-height: 20px">相關網址：<a href="{{ url($order->link) }}" target="_blank">{{ $order->link }}</a></h5>
				</div>
			</div>
			<hr>
			<div class="row">
	            <div class="col-md-12">
					<h3 id="comments-count" style="color: black; font-weight: 400">商品評論 ({{ $order->comments->count() }})</h3>
					<div id="comment" class="tab-pane"> <!-- class fade -->
		            	@if (Auth::check())
		            		@include('comment.create')
		            	@endif
		                @include('comment.index')
			        </div>
				</div>
			</div>
		</div>
		<div class="col-md-4" style="padding-left: 25px">
			<h3 style="color: grey; font-weight: 300">為您推薦的商品</h3>
			<hr>
			<div class="col-md-12">
				@include('order.related-orders')
			</div>
			<br>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('.owl-carousel').owlCarousel({
			items: 1,
			loop: true,
			nav: true,
			dots: false,
			lazyLoad: true,
			autoplay: false,
			navText : ['<i class="material-icons" style="font-size:36px;color:#AAA;">keyboard_arrow_left</i>','<i class="material-icons" style="font-size:36px;color:#AAA;">keyboard_arrow_right</i>']
		});
	});

	function openCity(evt, cityName) {
	    // Declare all variables
	    var i, tabcontent, tablinks;

	    // Get all elements with class="tabcontent" and hide them
	    tabcontent = document.getElementsByClassName("tabcontent");
	    for (i = 0; i < tabcontent.length; i++) {
	        tabcontent[i].style.display = "none";
	    }

	    // Get all elements with class="tablinks" and remove the class "active"
	    tablinks = document.getElementsByClassName("tablinks");
	    for (i = 0; i < tablinks.length; i++) {
	        tablinks[i].className = tablinks[i].className.replace(" active", "");
	    }

	    // Show the current tab, and add an "active" class to the link that opened the tab
	    document.getElementById(cityName).style.display = "block";
	    evt.currentTarget.className += " active";
	}

	document.getElementById("defaultOpen").click();
</script>

@endsection