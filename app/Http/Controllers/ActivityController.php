<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{

    public function index()
    {
        return view('post.activity', ['activities' => Activity::latest()->paginate(5)]);
    }

    public function show(Activity $activity)
    {
        return view('post.activity-show', ['activity' => $activity]);
    }

    public function store()
    {
        $formFields = request()->validate([
            'title' => ['required', Rule::unique('activities', 'title')],
            'image' => ['required', 'mimes:png,jpg,jpeg'],
            'body' => 'required',
        ]);

        $path = $formFields['image']->store('images', 's3');

        $formFields['title'] = strtoupper($formFields['title']);
        $formFields['image'] = basename($path);
        $formFields['url'] = Storage::disk('s3')->url($path);
        $formFields['users_id'] = auth()->user()->id;
        $formFields['slug'] = Str::slug(request()->title);

        Activity::create($formFields);

        return back()->with('success', 'Activity created successfully!');
    }
}
