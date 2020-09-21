<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\User
 *
 * @property int                                                        $id
 * @property string                                                     $name
 * @property string|null                                                $email
 * @property string                                                     $password
 * @property string                                                     $displayname
 * @property int                                                        $rnk
 * @property int                                                        $department
 * @property int                                                        $filial
 * @property int                                                        $process_type
 * @property int                                                        $region_id
 * @property string|null                                                $last_login
 * @property string|null                                                $remember_token
 * @property Carbon|null                                                $created_at
 * @property Carbon|null                                                $updated_at
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null                                              $notifications_count
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereDepartment($value)
 * @method static Builder|User whereDisplayname($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereFilial($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereLastLogin($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereProcessType($value)
 * @method static Builder|User whereRegionId($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereRnk($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin Eloquent
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            "displayname" => $this->displayname
        ];
    }
}
