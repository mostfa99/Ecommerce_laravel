<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function hasAbility($ability)
    {
        $roles = Role::whereRaw('roles.id IN (SELECT role_id FROM role_user WHERE user_id = ? )', [
            $this->id,
        ])->get();
        // SELECT * FROM roles WHERE id IN(SELECT role_id FROM role_user WHERE user_id =? )
        //SELECT * FROM roles INNER JOIN role_user ON roles.id = role_user.role_id WHERE role_id.user_id = ?
        foreach ($roles as $role) {
            $abilities = explode(',', $role->abilities);
            if (in_array($ability, $abilities)) {
                return true;
            }
        }
        return false;
    }

    public function deviceTokens()
    {
        return $this->hasMany(deviceToken::class);
    }

    public function profile()
    {
        return  $this->hasOne(Profile::class, 'user_id', 'id')->withDefault([
            'address' => 'Not Enterd',
        ]);
    }
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }
    public function carts()
    {
        return $this->hasMany(Wishlist::class);
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
    public function routeNotificationForFcm($notificaction = null)
    {
        // return $this->fcm_token;
        // return $this->getDeviceTokens();
        return $this->deviceTokens()->pluck('token')->toArray();
    }
    public function  routeNotificationForTweetSms($notificaction = null)
    {
        return $this->mobile;
    }
    // change broadcast name
    public function receivesBroadcastNotificationsOn($notificaction = null)
    {
        return 'Notifications.' . $this->id;
    }
}
