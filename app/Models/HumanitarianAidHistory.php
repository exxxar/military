<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HumanitarianAidHistory extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'index',
        'full_name',
        't_name',
        'f_name',
        's_name',
        'has_children',
        'children',
        'types',
        'count',

        'passport',
        'passport_issue_at',
        'description',
        'issue_at',
        'issue_date_history',
        'city',
        'address',

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'children' => 'array',
        'issue_date_history' => 'array',
        'types' => 'array',
        'has_children' => 'boolean',
        'issue_at' => 'timestamp',
        'deleted_at' => 'timestamp',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];
}
