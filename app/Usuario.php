<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermissionContract;
use App\Traits\DateConverterTrait;

class Usuario extends Model implements AuthenticatableContract, CanResetPasswordContract, HasRoleAndPermissionContract {

    use Authenticatable, CanResetPassword, HasRoleAndPermission, DateConverterTrait;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function departamento()
    {
        return $this->belongsTo('App\Departamento');
    }

    public function cargo()
    {
        return $this->belongsTo('App\Cargo');
    }
    
    public function aeropuertos()
    {
        return $this->belongsToMany('App\Aeropuerto');
    }

    public function getCreatedAtAttribute($fecha)
    {
        return $this->getFecha($fecha);
    }

}
