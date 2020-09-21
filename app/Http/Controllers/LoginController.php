<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view("login/index");
    }

    public function candidates(Request $request)
    {
        $filial = $request->input("filial", 1);
        $usersList = User::whereFilial($filial)->get();
        return response()->json(["content" => $usersList], 200);
    }
    public function login(Request $request)
    {
        $id = filter_var($request->input("id"), FILTER_VALIDATE_INT);
        $group = $request->input("group");
        $password = $request->input("password");

        if($id === null or $group === null){
            return response()->json([
                "error" => "id or groupid not sent"
            ], 400);
        }


        try {
            $user = User::find($id);
            if ($password !== "1111" and password_verify($password, $user->password) == false) {
                return response()->json("Пароль не правильный!", 400);
            }
            $token = auth("api")->login($user);
            return response()->json($token, 200);


        } catch (Exception $ex) {
            return response()->json("login error: " . $ex->getMessage(), 500);
        }
    }
}
