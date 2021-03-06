<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function zenodo_token()
    {
        return $this->hasOne('App\Models\ZenodoToken');
    }

    public function depositions()
    {
        return $this->hasMany('App\Models\Deposition');
    }

    public function developer_tokens()
    {
        return $this->hasMany('App\Models\DeveloperToken');
    }

    public function community_admin()
    {
        return $this->hasOne('App\Models\CommunityAdmin');
    }

    public function community_member()
    {
        return $this->hasOne('App\Models\CommunityMember');
    }

    public function community_dataset_owner()
    {
        return $this->hasOne('App\Models\CommunityDatasetOwner');
    }

    public function has_role($rol_param): bool
    {
        try {
            foreach ($this->roles as $rol) {
                if ($rol->rol == $rol_param) {
                    return true;
                }
            }
        }catch(\Exception $e){

        }
        return false;
    }
}
