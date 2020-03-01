<?php
/**
 * Created by PhpStorm.
 * User: BlueSky
 * Date: 2018-02-18
 * Time: 06:27 PM
 */

namespace App\Http\Controllers;


use App\Model\UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    public function login() {

        $email = request('email');
        $password = request('password');

        if ($email == null || $email == "" ||
            $password == null || $password == "") {
            return redirect('error');
        }

        $userModel = new UserModel();
        $user = $userModel->getUserByEmail($email);

        if ($user == null) return redirect('error');

        if (Hash::check($password, $user->password)) {

            session()->put(SESSION_UID, $user->id);
            session()->put(SESSION_EMAIL, $user->email);

            return redirect('index');

        } else {
            return redirect('error');
        }

    }

    public function register() {

        $email = request('email');
        $password = request('password');

        if ($email == null || $email == "" ||
            $password == null || $password == "") {
            return view('register', ['error' => 'Parameter invalid']);
        }

        $userModel = new UserModel();
        $user = $userModel->getUserByEmail($email);

        if ($user != null) {
            return view('register', ['error' => 'User already exist.']);
        }

        if ($userModel->register($email, $password) > 0) {
            return redirect('login');
        } else {
            return view('register', ['error' => 'User register failed.']);
        }

    }

    public function logout() {

        session()->forget(SESSION_UID);
        session()->forget(SESSION_EMAIL);

        return redirect('/');

    }

}