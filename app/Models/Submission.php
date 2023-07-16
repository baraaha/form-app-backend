<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'form_id',
        'user_id',
        'data',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'data' => 'array',
    ];


    public function user()
    {
        // return [1, 2, 3];
        return $this->belongsTo(User::class);
    }
    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
