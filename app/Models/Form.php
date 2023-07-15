<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'submission_limit',
        'allow_notifications',
        'published',
        'published_at',
        'expires_at',
        'elements',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'allow_notifications' => 'boolean',
        'published' => 'boolean',
        'published_at' => 'datetime',
        'expires_at' => 'datetime',
        'elements' => 'array',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function form_items()
    {
        return $this->hasMany(Submission::class);
    }
}
