<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

    protected $fillable = ['path', 'size'];

    public function getPathAttribute($value){
        return  asset('/storage/upload').'/'.$value;
    }
}
