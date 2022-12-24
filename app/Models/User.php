<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable{
    use HasFactory;
    protected $guarded = ['id'];
    public function aspiration(){
        return $this->hasMany(Aspiration::class);
    }
    public static function boot(){
        parent::boot();
        static::creating(function(User $user){
            $user->password = bcrypt($user->password);
        });

        static::updating(function(User $user){
            if($user->isDirty(['password'])){
                $user->password = bcrypt($user->password);
            }
        });
    }
}