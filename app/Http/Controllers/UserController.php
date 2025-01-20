<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\View\View as View;
use View;


class UserController extends Controller
{
    //

    public function showUsers(){
        
        $usersData = User::all()->toArray();
        return json_encode($usersData);
    }

    public function loadCreateView(){
        $formView = View::make('form')->render();
        return response($formView);
    }

    public function submitDetail(){


        if(!empty($_POST['user_id']) && isset($_POST['user_id'])){

            $user = User::whereId($_POST['user_id'])->update(["name"=>$_POST['name'],"email"=>$_POST['email'],"role"=>$_POST['role']]);
            if($user){
                return "updated";
            }else{
                return "Something went wrong";
            }
        }else{
            $user = User::create(["name"=>$_POST['name'],"email"=>$_POST['email'],"role"=>$_POST['role']]);
            if($user){
                return "Inserted";
            }else{
                return "Something went wrong";
            }
        }

    }

    public function deleteUser(Request $request){

        $user = User::whereId($request->user_id)->delete();

        if($user){
            return "deleted";
        }else{
            return "error in db";
        }

    }

    public function editUser(Request $request)
    {
    

        $userData = User::whereId($request->user_id)->get()->toArray();
        // echo "<pre>";
        // print_r($userData);
        // exit;

        $formView = View::make('form',['userData' => $userData])->render();

        // echo $formView;
        // exit;
        return response($formView);

    }
}
