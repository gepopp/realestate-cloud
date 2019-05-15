<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use IImg;

class Image extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function uploadedTo(){
        return $this->morphTo('uploadable');
    }

    public function sizes(){
        return $this->hasMany(Image::class, 'image_id');
    }


    public function createSizeFromBlob(Image $image, $blob){

        $img = IImg::make($blob)->store($image->name);
        dd($img);

    }




}
