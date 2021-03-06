<?php

namespace App\Http\Controllers;

use App\User;
use App\App;
use App\Job;
use App\Resume;
use App\ResumeImg;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mail\OrderAccepted;
use Storage;
use File;
use Image;
use App\Mail\JobAppliedAdmin;
use App\Mail\JobAppliedUser;

class AppController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apps = auth()->user()->apps->sortByDesc('created_at');

        $resume = auth()->user()->resume;

        $haveResumeImg = false;
        if ($resume->resumeImg != null) {
            $haveResumeImg = true;
        }

        return view('app.index', compact('apps', 'resume', 'haveResumeImg'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $job = Job::find(request('job_id'));
        $resume = auth()->user()->resume;

        $haveResumeImg = false;
        if ($resume->resumeImg != null) {
            $haveResumeImg = true;
        }

        return view('app.create', compact('job', 'resume', 'haveResumeImg'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resume = auth()->user()->resume;
        $resume->name = request('name');
        $resume->title = request('title');
        $resume->email = request('email');
        $resume->phone = request('phone');
        $resume->location = request('location');
        $resume->wechat = request('wechat');
        $resume->qq = request('qq');
        $resume->edu_title = request('edu_title');
        $resume->edu_gpa = request('edu_gpa');
        $resume->edu_university = request('edu_university');
        $resume->edu_start = request('edu_start');
        $resume->edu_end = request('edu_end');
        $resume->work_title = request('work_title');
        $resume->work_company = request('work_company');
        $resume->work_start = request('work_start');
        $resume->work_end = request('work_end');
        $resume->work_description = request('work_description');
        $resume->language_one = request('language_one');
        $resume->language_one_level = request('language_one_level');
        $resume->language_two = request('language_two');
        $resume->language_two_level = request('language_two_level');
        $resume->language_three = request('language_three');
        $resume->language_three_level = request('language_three_level');
        $resume->other_description = request('other_description');
        $resume->save();

        $file = request('resumeImgs')[0];
        if ($file) {
            if ($resume->resumeImg != null) {
                Storage::disk('s3')->delete('resumes/'.$resume->id.'/'.$resume->resumeImg->filename.'.pdf');
                $resume->resumeImg->delete();
            }

            Storage::disk('s3')->put('resumes/'.$resume->id.'/'.$file->getFilename().'.pdf', File::get($file));

            ResumeImg::create([
                'resume_id' => $resume->id,
                'filename' => $file->getFilename(),
                'mime' => $file->getClientMimeType(),
                'original_filename' => $file->getClientOriginalName(),
            ]);
        }

        $job = Job::find(request('job_id'));
        if (App::where('user_id', auth()->user()->id)->where('job_id', $job->id)->count() != 0) {
            return redirect()->back();
        } else {
            $entry = App::create([
                'user_id' => auth()->user()->id,
                'job_id' => $job->id,
            ]);
            \Mail::to(User::where('email', 'u3514481@connect.hku.hk')->first())->send(new JobAppliedAdmin(auth()->user(), $job));
            \Mail::to(auth()->user())->send(new JobAppliedUser(auth()->user(), $job));
        }

        return redirect()->action('AppController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\App  $app
     * @return \Illuminate\Http\Response
     */
    public function show(App $app)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\App  $app
     * @return \Illuminate\Http\Response
     */
    public function edit(App $app)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\App  $app
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, App $app)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\App  $app
     * @return \Illuminate\Http\Response
     */
    public function destroy(App $app)
    {
        //
    }
}
