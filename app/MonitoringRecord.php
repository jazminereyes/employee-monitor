<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonitoringRecord extends Model
{
    protected $fillable = [
        'image_type', 'date_time_taken', 'photo_url', 'expiration', 'is_deleted', 'user_id'
    ];
}
