<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EnrollCourse extends Model
{
    use HasFactory, HasUuid;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;


    protected $fillable = [
        'course_id',
        'user_id',
    ];
}
