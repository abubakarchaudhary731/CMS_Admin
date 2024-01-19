<?php

namespace Modules\CMS\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CMSComment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'post_id',
        'user_id',
        'comment',
        'created_at',
        'updated_at',
    ];
    
}
