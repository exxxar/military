<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class People extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'fname',
        'sname',
        'tname',
        'birth',
        'age_from',
        'age_to',
        'sex',
        'photos',
        'phones',
        'user_id',
        'people_id',
        'city',
        'region',
        'address',
        'story',
        'description',
        'status',
        'for',
        'searched_from',
        'is_active',
        "phoenix_num",
        "email",
        "type",
        "passport",
        "evacuation_place",

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'phones' => 'array',
        'photos' => 'array',
        'user_id' => 'integer',
        'people_id' => 'integer',
        'type' => 'integer',
        'searched_from' => 'timestamp',
        'is_active' => 'boolean',
        'deleted_at' => 'timestamp',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function people()
    {
        return $this->belongsTo(People::class);
    }
}
