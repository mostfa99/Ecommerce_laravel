<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Profile;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
// implements MustVerifyEmail
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
        'password',
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
    ];

    public function hasAbility($ability)
    {
        $roles = Role::whereRaw('roles.id IN (SELECT role_id FROM role_user WHERE user_id = ? )', [
            $this->id,
        ])->get();
        // SELECT * FROM roles WHERE id IN(SELECT role_id FROM role_user WHERE user_id =? )
        //SELECT * FROM roles INNER JOIN role_user ON roles.id = role_user.role_id WHERE role_id.user_id = ?
        foreach ($roles as $role) {
            if (in_array($ability, $role->abilities)) {
                return true;
            }
        }
        return false;
    }

    public function profile()
    {
        return  $this->hasOne(Profile::class, 'user_id', 'id')->withDefault([
            'address' => 'Not Enterd',
        ]);
    }

    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'role_user',
            'user_id',
            'role_id',
            'id',
        );
    }

    public function country()
    {
        return $this->belongsTo(Country::class)->withDefault('');
    }
    public function products()
    {
        return $this->hasMany(Prouct::class);
    }
    // to custome mail if i change default name for email like email_adress
    public function routeNotificationForMail($notificaction = null)
    {
        return $this->email;
    }
    // in nexmo i need phone number for end sms massage i went to craet custome methods
    public function  routeNotificationForVonage($notificaction = null)
    {
        return $this->mobile;
    }
    public function  routeNotificationForTweetSms($notificaction = null)
    {
        return $this->mobile;
    }
    // change broadcast name
    public function receivesBroadcastNotificationsOn()
    {
        return 'Notifications.' . $this->id;
    }
}
