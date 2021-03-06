<form id="search-form" class="job-form" action="{{ route('job.search') }}" method="GET">
	<div class="row">
		<div class="col-md-3">
			<input style="padding: 4px;" type="text" value="{{ request('title') }}" id="title" name="title" placeholder="Job or Company">
		</div>
		<div class="col-md-3">
			<select id="location" name="location">
				<option value="">Choose Location...</option>
				@foreach (App\Job::$country as $key => $element)
					<option value="{{ $key }}" {{ request('location') == $key ? 'selected' : ''}}>{{ $element }}</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-3">
			<select id="category" name="category">
				<option value="">Choose Job Function...</option>
				@foreach (App\Job::$category as $key => $element)
					<option value="{{ $key }}" {{ request('category') == $key ? 'selected' : ''}}>{{ $element }}</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-3">
			<input style="padding: 4px;" type="integer" value="{{ request('salary') }}" id="salary" name="salary" placeholder="Above this Salary...">
		</div>
	</div>

	<div class="row">
		<div class="col-md-3">
			<select id="experience" name="experience">
				<option value="">Years of Experience...</option>
				@foreach (App\Job::$experience as $key => $element)
					<option value="{{ $key }}" {{ request('experience') == $key ? 'selected' : ''}}>{{ $element }}</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-3">
			<select id="type" name="type">
				<option value="">All Employment Type</option>
				@foreach (App\Job::$type as $key => $element)
					<option value="{{ $key }}" {{ request('type') == $key ? 'selected' : ''}}>{{ $element }}</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-3">
			<select id="education" name="education">
				<option value="">All Education Level</option>
				@foreach (App\Job::$education as $key => $element)
					<option value="{{ $key }}" {{ request('education') == $key ? 'selected' : ''}}>{{ $element }}</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-3">
			<button type="submit" style="border-radius:2px !important; width:100%" class="container btn btn-info btn-block">Search</button>
		</div>
	</div>
</form>

