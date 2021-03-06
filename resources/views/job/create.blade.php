@extends('layouts.app')

@section('content')
<div class="container" style="width: 90%">
	<div class="row">
    	<div class="col-md-8">
			<h3 style="color: grey; font-weight: 300">填寫訂單詳情</h3>
			<hr>
			<form class="order-form" action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}
				<input type="hidden" name="quantity" id="quantity" value="1">
				<div class="row">
					<div class="col-md-8">
					    <input type="text" value="" id="name" name="name" placeholder="訂單名稱" required>
					</div>
					<div class="col-md-4">
					    <input type="integer" value="" id="price" name="price" placeholder="價格" required>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
					    <select id="category" name="category">
					    	<option value="">選擇分類...</option>
					    	@foreach (App\Order::$category as $key => $element)
								<option value="{{ $key }}">{{ $element }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-4">
					    <select id="country" name="country">
					    	<option value="">選擇國家...</option>
					    	@foreach (App\Order::$country as $key => $element)
								<option value="{{ $key }}">{{ $element }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-4">
					    <input placeholder="此日期前交收" id="endDate" name="endDate" class="textbox-n" type="text" onfocus="(this.type='date')" required> 
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
					    <input type="text" value="" id="link" name="link" placeholder="相關網址" required>
					</div>
				</div>

				<div class="row" style="margin-top: 5px">
					<div class="col-md-12">
					    <textarea style="width: 100%; padding: 10px; border-color: #AAA" type="text" value="" id="description" name="description" placeholder="詳細描述" rows="5" required></textarea>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						<input id="orderImgs" name="orderImgs[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="true">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<br class="hidden-xs hidden-sm">
						<button type="submit" class="btn btn-info btn-outline btn-lg btn-block">提交訂單</button>
					</div>
				</div>
			</form>
		</div>

		<br class="visible-xs-block visible-sm-block">
		<br class="visible-xs-block visible-sm-block">
		<br class="visible-xs-block visible-sm-block">

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

@endsection
