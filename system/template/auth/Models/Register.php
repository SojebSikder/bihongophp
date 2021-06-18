<?php

use System\Core\ORM;
use System\Database\Facade\DB;

class RegisterModel extends ORM
{
    public function __construct()
    {
        parent::__construct();
    }

    public function register($username, $email, $password)
    {
        $result = DB::insert("INSERT INTO users (username, email, password) 
        VALUES('$username', '$email', '$password')");

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function login($username, $password)
    {
        $state = DB::select("SELECT * FROM users WHERE username='$username'");

        if ($state) {
            if (mysqli_num_rows($state) > 0) {
                foreach ($state as $row) {
                    if (password_verify($password, $row['password'])) {
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['email'] = $row['email'];
                    } else {
                        return false;
                    }
                }
            }
        } else {
            return false;
        }
    }
}
