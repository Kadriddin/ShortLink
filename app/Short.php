<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Short extends Model
{
    protected  $table="link";
    protected $fillable=['code', 'link'];
}
