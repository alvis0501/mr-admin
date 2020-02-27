<?php
/**
 * Created by PhpStorm.
 * User: BlueSky
 * Date: 2018-02-18
 * Time: 06:26 PM
 */

namespace App\Model;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserModel extends BaseModel
{

    public function getUserByEmail($email) {
        return DB::table('t_user')
            ->where('email', $email)
            ->first();
    }

    public function register($email, $password) {

        $id = DB::table('t_user')
            ->insertGetId([
                'email' => $email,
                'password' => Hash::make($password)
            ]);

        return $id;
    }

}