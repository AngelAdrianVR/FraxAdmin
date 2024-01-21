<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Calendar extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'repeater', //repeat es una palabra reservada de SQL por eso lo cambié a repeater
        'reminder',
        'participants',
        'description',
        'location',
        'status',
        'is_full_day',
        'start_date',
        'finish_date',
        'start_time',
        'end_time',
        'user_id',  
    ];

    protected $casts = [
        'start_date' => 'date',
        'finish_date' => 'date',
        'participants' => 'array',
    ];

    //relaionships
    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
