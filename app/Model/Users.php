<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = "users";

    public function loginValidate($username,$password) {
        return $this->where(['username'=>$username])->first();
    }
}
