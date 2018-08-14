<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';

    protected $fillable = [
    	'id_image', 'id_fb', 'name_fb', 'message', 'link', 'type', 'full_picture', 'updated_time', 'created_at', 'updated_at'
    ];
}
