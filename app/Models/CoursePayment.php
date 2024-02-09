<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'tx_ref',
        'customer_name',
        'customer_email',
        'day_created',
        'course_id',
        'status',
    ];

    protected $casts = [
        'day_created' => 'datetime'
    ];

}
