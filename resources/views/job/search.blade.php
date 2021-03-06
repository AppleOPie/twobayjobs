<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-78314014-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-78314014-1');
    </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="nav-search" style="margin-bottom: 73px;">@include('layouts.nav')</div>

        <div class="hidden-xs" id="left" style="margin-top: -12px; padding-bottom: 60px; background-color: white;">
            <div class="container" style="width: 100%">
                <div class="visible-xs-block" style="margin-top: 30px"></div>
                @if ($currentJob != null)
                    @foreach ($jobs as $job)
                        <div style="position: relative;" class="row selectJobContainer">
                            <form id="selectJob{{ $job->id }}" action="{{route('job.select', ['job' => $job->id])}}" method="POST">
                                {{ csrf_field() }}
                                <button id="selectJobBtn{{ $job->id }}" type="submit" style="cursor:pointer; width:100%; padding:15px 30px; text-align:left; border:none; border-bottom: 1px solid #E6E6E6; {{ $currentJob->id == $job->id ? 'background-color:#d84b6b; color:white':'' }}">
                                    <div><a id="selectJobTitle{{ $job->id }}" style="{{ $currentJob->id == $job->id ? 'color:white;':'color:#d84b6b;' }}font-size: 18px;" href="{{ route('job.show', ['job' => $job->id]) }}" target="_blank">{{ str_limit($job->title, 32) }}</a></div>
                                    <div> {{ $job->company->name }}</div>
                                    <div> {{ $job->location }} </div>
                                    <div> {{ $job->created_at->diffForHumans() }} </div>
                                    <input type="hidden" id="currentId" name="currentId" value="{{$currentJob->id}}">
                                </button>
                            </form>
                            <form id="saveJob{{ $job->id }}" style="display:{{ auth()->check() && $currentJob->id != $job->id && App\SavedJob::where('user_id', auth()->user()->id)->where('job_id', $job->id)->count() == 0 ? 'none':'initial' }}" action="{{route('job.save', ['job' => $job->id])}}" method="POST">
                                {{ csrf_field() }}
                                <button style="position:absolute; top:17px; right:20px; cursor:pointer; background-color:transparent; padding: 0px; border:0px" type="submit"><i id="saveJobIcon{{ $job->id }}" style="color:{{ auth()->check() && App\SavedJob::where('user_id', auth()->user()->id)->where('job_id', $job->id)->count() != 0 ? '#f8d23a':'white' }};" class="material-icons saveJobIcon">favorite</i></button>
                            </form>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="search-pagination container" style="width: 90%; text-align: center">
                <div style="display: none">{{ $jobs->appends(['title' => request('title'), 'category' => request('category'), 'location' => request('location'), 'salary' => request('salary'), 'endDate' => request('endDate'), 'experience' => request('experience'), 'level' => request('level'), 'type' => request('type'), 'education' => request('education')])->links() }}</div>

                @if ($jobs->hasPages())
                    <ul class="pagination pagination">
                        {{-- Previous Page Link --}}
                        @if ($jobs->onFirstPage())
                            <li class="disabled"><span>«</span></li>
                        @else
                            <li><a href="{{ $jobs->previousPageUrl() }}" rel="prev">«</a></li>
                        @endif

                        @if($jobs->lastPage() <= 5)
                            @foreach(range(1, $jobs->lastPage()) as $i)
                                @if ($i == $jobs->currentPage())
                                    <li class="active"><span>{{ $i }}</span></li>
                                @else
                                    <li><a href="{{ $jobs->url($i) }}">{{ $i }}</a></li>
                                @endif
                            @endforeach
                        @elseif($jobs->currentPage() <= 3)
                            @foreach(range(1, 5) as $i)
                                @if ($i == $jobs->currentPage())
                                    <li class="active"><span>{{ $i }}</span></li>
                                @else
                                    <li><a href="{{ $jobs->url($i) }}">{{ $i }}</a></li>
                                @endif
                            @endforeach
                        @elseif($jobs->currentPage() > 3 && $jobs->currentPage() <= $jobs->lastPage() - 2)
                            @foreach(range($jobs->currentPage() - 2, $jobs->currentPage() + 2) as $i)
                                @if ($i == $jobs->currentPage())
                                    <li class="active"><span>{{ $i }}</span></li>
                                @else
                                    <li><a href="{{ $jobs->url($i) }}">{{ $i }}</a></li>
                                @endif
                            @endforeach
                        @elseif($jobs->currentPage() > $jobs->lastPage() - 2)
                            @foreach(range($jobs->lastPage() - 4, $jobs->lastPage()) as $i)
                                @if ($i == $jobs->currentPage())
                                    <li class="active"><span>{{ $i }}</span></li>
                                @else
                                    <li><a href="{{ $jobs->url($i) }}">{{ $i }}</a></li>
                                @endif
                            @endforeach
                        @endif

                        {{-- Next Page Link --}}
                        @if ($jobs->hasMorePages())
                            <li><a href="{{ $jobs->nextPageUrl() }}" rel="next">»</a></li>
                        @else
                            <li class="disabled"><span>»</span></li>
                        @endif
                    </ul>
                @endif
            </div>
		</div>

		<div id="right" style="margin-top: -12px; padding-top: 15px;">
            @include('job.search-top')
            <div style="padding-top:30px; background-color:#E6E6E6;">
                <div id="showJob" class="container card-shadow" style="background-color:white; width:80%;padding-left: 80px; padding-right: 80px; padding-top: 50px; padding-bottom: 90px;">
                    @if ($currentJob != null)
                        <div style="font-size: 25px" id="job-company-name"> {{ $currentJob->company->name }} </div>
                        <div style="font-size: 15px" id="job-company-description"> {{ $currentJob->company->description }} </div>
                        <hr>
                        <div style="font-size: 25px; text-align: center" id="job-title"> {{ $currentJob->title }} </div>
                        <hr>
                        <div style="font-size: 15px; font-weight: 600">Responsibilities:</div>
                        <div id="job-responsibility"> {{ $currentJob->responsibility }} </div>
                        <br>
                        <div style="font-size: 15px; font-weight: 600">Requirements:</div>
                        <div id="job-requirement"> {{ $currentJob->requirement }} </div>
                        <br>
                        <div style="font-size: 15px; font-weight: 600">All Personal data collected will be used for recruitment purpose only. </div>
                        <br>

                        <div class="row sidenav" style="margin-top: 5px">
                            <div class="col-md-4 col-md-offset-4">
                                <form action="{{ route('app.create') }}" method="GET">
                                    <input type="hidden" name="job_id" id="job_id" value="{{ $currentJob->id }}">
                                    <button id="applyBtn" {{ $disabled }} type="submit" target="_blank" class="btn btn-info btn-block">
                                        {{ $btn_text }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div style="font-size: 20px; line-height: 40px;">
                            <h2>No jobs matching your keyword: <span style="font-weight: 600">{{ request('title') }}</span></h2>
                            <br>
                            <div style="font-weight: 600">Suggestions:</div>
                            <div>- Make sure all words are spelled correctly</div>
                            <div>- Try more general keywords</div>
                            <div>- Try different keywords</div>
                        </div>
                        <br><br><br><br><br><br>
                    @endif
                </div>
                <br><br>
            </div>
            <nav class="visible-xs-block navbar navbar-default navbar-fixed-top" style="border-top: solid 1px #E6E6E6; border-bottom: solid 1px #E6E6E6; height: 30px; margin-top: 60px;">
                @include('job.search-left-mobile')
            </nav>
		</div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
