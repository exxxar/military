<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'telegram_chat_id',
        'password',
        'full_name',
        'phone',
        "current_people_index_all",
        "current_people_index_type_0",
        "current_people_index_type_1",
        'radius',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'settings' => 'array',
    ];

    protected $appends = [
      "is_working_now"
    ];

    public function getIsWorkingNowAttribute()
    {

        if (!is_null($this->start_at) && !is_null($this->end_at)) {
            $tmp_start = explode(':', $this->start_at);
            $tmp_end = explode(':', $this->end_at);
            $start_at_h = (int)($tmp_start[0] ?? "09");
            $start_at_m = (int)($tmp_start[1] ?? "00");

            $end_at_h = (int)($tmp_end[0] ?? "18");
            $end_at_m = (int)($tmp_end[1] ?? "00");

            $start_at = Carbon::now("+3:00")->setHour($start_at_h)->setMinute($start_at_m);
            $end_at = Carbon::now("+3:00")->setHour($end_at_h)->setMinute($end_at_m);

            return Carbon::now("+3:00") <= $end_at && Carbon::now("+3:00") >= $start_at;

        }

        return true;
    }

    public static function self()
    {
        return User::query()->where("id", Auth::user()->id)->first();
    }
}
