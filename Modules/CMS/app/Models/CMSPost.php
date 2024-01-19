<?php

namespace Modules\CMS\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\CMS\Database\factories\CMSPostFactory;

class CMSPost extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'description',
        'created_at',
        'updated_at',
    ];
    
   
}
