<?php


namespace app\helpers;

class CheckLogin{

    public $username = '';
    public $id = '';
    public $loggedin = false;

    public function __construct(){

        session_start();
        $this -> username = $_SESSION["username"] ?? null;
        $this -> id= $_SESSION["id"] ?? null;;
        $this -> loggedin =  $_SESSION["loggedin"] ?? null;

    }

    // public static function isLogin(){
    //             // Initialize the session
    //             session_start();
 
    //             // Check if the user is logged in, otherwise redirect to login page
    //             if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    //                 return false;
    //             }
    //             else{

    //                 return true;
    //             }   
    //  }


}



