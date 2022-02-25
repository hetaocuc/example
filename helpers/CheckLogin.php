<?php


namespace app\helpers;

class CheckLogin{

    public static function isLogin(){
                // Initialize the session
                session_start();
 
                // Check if the user is logged in, otherwise redirect to login page
                if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                    return false;
                }
                else{

                    return true;
                }   
     }


}