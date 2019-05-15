<?php

namespace App\Http\Controllers;

use App\Image;
use Image as IImage;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.profiles.create')->with('user', Auth::user());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'anrede'      => ['regex:/Herr|Frau/', 'required'],
            'prefix'      => 'string|nullable',
            'firstname'   => 'required|string',
            'lastname'    => 'required|string',
            'suffix'      => 'string|nullable',
            'phone'       => 'numeric|nullable',
            'fax'         => 'numeric|nullable',
            'mobile'      => 'numeric|required',
            'email'       => 'required|email',
            'description' => 'string|nullable',
        ]);

        $profile = UserProfile::create([
            'user_id'     => Auth::user()->id,
            'anrede'      => $request->anrede,
            'prefix'      => $request->prefix,
            'firstname'   => $request->firstname,
            'lastname'    => $request->lastname,
            'suffix'      => $request->suffix,
            'phone'       => $request->phone,
            'fax'         => $request->fax,
            'mobile'      => $request->mobile,
            'email'       => $request->email,
            'description' => $request->description,
        ]);

        if ($request->file('image')) {

            $saved = Storage::put('public/images', $request->file('image'));

            $imagedetails = getimagesize($request->file('image'));

            $width = $imagedetails[0];
            $height = $imagedetails[1];
            $image = new Image();
            $image->user_id = Auth::user()->id;
            $image->mime_type = $request->file('image')->getClientMimeType();
            $image->size = $request->file('image')->getSize();
            $image->filename = $request->file('image')->getClientOriginalName();
            $image->path = $saved;
            $image->width = $width;
            $image->height = $height;
            $image->uploadedTo()->associate($profile);

            $parent_file = $image->save();

            if($request->crop){

                $cropped = IImage::make($request->crop);
                $store = Storage::putFile('public/images', $cropped);
                dd($store);

            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\UserProfile $userProfile
     * @return \Illuminate\Http\Response
     */
    public function show(UserProfile $userProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\UserProfile $userProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProfile $userProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\UserProfile $userProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserProfile $userProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\UserProfile $userProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserProfile $userProfile)
    {
        //
    }
}
