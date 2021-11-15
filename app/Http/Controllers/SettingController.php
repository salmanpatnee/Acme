<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Support\Facades\File;
use Image;

class SettingController extends Controller
{
    protected $settings;

    public function __construct()
    {
        $this->settings = Setting::first();
    }


    public function index()
    {
        return view('admin.settings.index', [
            'settings' => $this->settings
        ]);
    }

    public function update()
    {

        $attributes = $this->validateAttributes();

        $attributes['logo'] = $attributes['old_logo'];

        if (request()->has('logo')) {

            $file = 'images/logo.png';

            File::delete(public_path($attributes['logo']));

            Image::make(request()->file('logo'))->save($file);

            $attributes['logo'] = $file;
        }

        $this->settings->update($attributes);

        $notification = [
            'message' => 'Settings updated.',
            'type' => 'info'
        ];

        return redirect(route('settings.index'))->with($notification);
    }

    protected function validateAttributes()
    {

        return request()->validate(
            [
                'old_logo'       => 'nullable|string',
                'logo'       => 'nullable|image|mimes:jpg,jpeg,webp,png|max:1024',
                'site_title' => 'nullable|string|max:255',
                'google_map' => 'nullable',
                'address'    => 'nullable|string|max:255',
                'email'      => 'nullable|email|max:255',
                'phone'      => 'nullable|string|max:20',
                'copyright'  => 'nullable|string|max:255'
            ]
        );
    }
}
