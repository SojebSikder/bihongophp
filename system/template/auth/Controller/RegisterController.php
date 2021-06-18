<?php

use App\Controllers\Controller;
use System\Core\Request;

class RegisterController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }


    public function register(Request $request)
    {

        $userModel = model("Register");

        if ($request->input->post("submit")) {
            $username =  xss($request->input->post("username"));
            $email = xss($request->input->post("email"));
            $password = password_hash(xss($this->input->post("password")), PASSWORD_DEFAULT);

            $exe = $userModel->register($username, $email, $password);

            if ($exe) {
                return response()->redirect("/login");
            }
        }

        return view("register.te");
    }

    public function login(Request $request)
    {
        $userModel = model("Register");

        if ($request->input->post("submit")) {
            $username = xss($request->input->post("username"));
            $password = xss($request->input->post("password"));

            $exe = $userModel->login($username, $password);

            echo "Login successfully";
            return response()->redirect("/home");
        }

        return view("login.te");
    }

    public function logout()
    {
        session_destroy();
        return response()->redirect("/home");
    }
}
