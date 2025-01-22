<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'permissions', 
    ];
    public function setPermissionsAttribute($values)
    {
        $permissions = array();
        if (!is_null($values)) {
            foreach ($values as $menu){$permissions[]=$menu;}
            $this->attributes['permissions'] = json_encode($permissions);
        }else{
             $this->attributes['permissions'] = Null;
        }
    }
    public function getPermissionsAttribute($values)
    {
        $output = array();
        $val =  json_decode($values);
        if (!is_null($val)) {
            foreach ($val as $key => $permission) {
                $output[$key] = $permission;
            }
        }
        return $output;
    }
}
