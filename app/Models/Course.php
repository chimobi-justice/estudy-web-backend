<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Course\CourseTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory, HasUuid, CourseTraits;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'price',
        'video',
        'category',
        'thumbnail',
        'description',
        'title',
    ];

    protected $casts = [
        'video' => 'array',
        'title' => 'array',
    ];

    protected $with = ['user', 'courseEnroll'];
}
