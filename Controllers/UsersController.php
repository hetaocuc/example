<?php


namespace app\Controllers;

use app\Router;
use app\Models\Product;
use app\Models\Users;
use app\CheckLogin;

class UsersController
{


    // //////////////////
    // echo '<pre>';
    // echo var_dump($router);
    // echo '</pre>';
    // //////////////////////////////

    public function signup(Router $router)
    {

        // Define variables and initialize with empty values

        $errors = [

            'username_err' => '',
            'password_err' => '',
            'confirm_password_err' => ''


        ];

        $user = new Users();


        // Processing form data when form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user->username = trim($_POST["username"]);
            $user->password = trim($_POST["password"]);
            $user->confirm_password = trim($_POST["confirm_password"]);

            // Validate username
            if (empty($user->username)) {

                $errors['username_err'] = "Please enter a username.";
            } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $user->username)) {

                $errors['username_err'] = "Username can only contain letters, numbers, and underscores.";
            } else {

                if ($router->database->usernameIsExist($user->username)) {

                    $errors['username_err'] = "This username is already taken.";
                }
            }


            // Validate password
            if (empty($user->password)) {

                $errors['password_err'] = "Please enter a password.";
            } elseif (strlen($user->password) < 6) {

                $errors['password_err'] = "Password must have atleast 6 characters.";
            }


            // Validate confirm password
            if (empty($user->confirm_password)) {


                $errors['confirm_password_err'] =  "Please confirm password.";
            } else {

                if (empty($password_err) && ($user->password != $user->confirm_password)) {


                    $errors['confirm_password_err'] =  "Password did not match.";
                }
            }

            // Check input errors before inserting in database
            if (empty($errors['username_err']) && empty($errors['password_err']) && empty($errors['confirm_password_err'])) {


                if ($router->database->saveUsernamePassword($user)) {
                    // Redirect to login page
                    header("location: /users/login");
                    exit;
                } else {

                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
        }


        $title = 'SignUp';

        $router->renderView('users/signup', [

            'user' => $user,
            'errors' => $errors,
            'title' => $title


        ]);
    }

    public function login(Router $router)
    {

       // echo var_dump($_SERVER);


        if($router->session->loggedin){


            // Redirect to login page
              header("location: /users/welcome");
             exit;
        }

        $url='';
        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            $url = $_GET['url'] ?? null;
        }


         $errors = [

            'username_err' => '',
            'password_err' => '',
            'login_err' => ''
        ];

        $user = new Users();
        $userData = [];



        // Processing form data when form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {


            $user->username = trim($_POST["username"]);
            $user->password = trim($_POST["password"]);
            $url = trim($_POST["url"]);



            // Check if username is empty
            if (empty($user->username)) {


                $errors['username_err'] = "Please enter username.";
            }

            // Check if password is empty
            if (empty($user->password)) {

                $errors['password_err'] = "Please enter your password.";
            }

            // Validate credentials
            if (empty($errors['username_err']) && empty($errors['password_err'])) {

                if($userData = $router->database->getUserPassword($user)){

                    $id = $userData["id"];
                    $username = $userData["username"];
                    $hashed_password = $userData["password"];
                    $role = $userData["role"];

                    if (password_verify($user->password, $hashed_password)) {
                        // Password is correct, so start a new session
                      //  session_start();

                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $username;
                        $_SESSION["role"] = $role;

                        // Redirect user to welcome page
                        //  header("location: /users/welcome");
                        
                         if($url){

                            header("location: $url");

                         }
                         else{

                            header("location: /users/welcome");
                         }


                        exit;


                    }else{

                        $errors['login_err'] = "Invalid username or password.";
                    }

                }else{

                    $errors['login_err'] = "Invalid username or password.";

                }
       
            }
        }

        $title = 'Login';
        $router->renderView('users/login', [

             'user' => $user,
             'errors' => $errors,
             'userData' => $userData,
             'title' => $title,
             'url' => $url,
             'session' => $router->session

        ]);
    }

    public function welcome(Router $router){


        // Define variables and initialize with empty values

        $errors = [

            'full_name_err' => '',
            'email_err' => '',
            'mobile_err' => '',
            'address_err' => '',
            'city_err' => ''

        ];

        $user = new Users();
        $user->id = $router->session->id; 

        if(!$router->session->loggedin){

            // Redirect to login page
             header("location: /users/login");
             exit;
        }

    
        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            $userData = $router->database->getUserInformation($user->id);
      
            $user->full_name = $userData['full_name'];
            $user->email = $userData['email'];
            $user->mobile = $userData['mobile'];
            $user->address = $userData['address'];
            $user->city = $userData['city'];


        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $user->full_name = trim($_POST['full_name']);
            $user->email = trim($_POST['email']);
            $user->mobile = trim($_POST['mobile']);
            $user->address = trim($_POST['address']);
            $user->city = trim($_POST['city']);

            // Check if username is empty
            if (empty($user->full_name)) {

                $errors['full_name_err'] = "Please enter name.";
            }
            if (empty($user->email)) {

                $errors['email_err'] = "Please enter email.";
            }
            if (empty($user->mobile)) {

                $errors['mobile_err'] = "Please enter mobile.";
            }
            if (empty($user->address)) {

                $errors['address_err'] = "Please enter address.";
            }
            if (empty($user->city)) {

                $errors['city_err'] = "Please enter city.";
            }


            // Check input errors before inserting in database
            if (empty($errors['full_name_err']) && empty($errors['email_err']) && empty($errors['mobile_err'])
                && empty($errors['address_err']) && empty($errors['city_err']) ){


                if ($router->database->updateUserInformation($user)) {

                    // Redirect to login page
                    // header("location: /users/login");
                    // exit;
                } else {

                    echo "Oops! Something went wrong. Please try again later.";
                }
            }


        }


         $title = 'Welcome';
        $router->renderView('users/welcome', [

            'user' => $user,
            'errors' => $errors,
            'title' => $title,
            'session' => $router->session
     

       ]);


    }

    public function logout(Router $router){

        // Initialize the session
       // session_start();
        
        // Unset all of the session variables
        $_SESSION = array();
        
        // Destroy the session.
        session_destroy();
        
        // Redirect to login page
        header("location: /users/login");
        exit;
    }




    public function resetpassword(Router $router){

 
        if(!$router->session->loggedin){

            // Redirect to login page
             header("location: /users/login");
             exit;
        }

        // Define variables and initialize with empty values
        $new_password = $confirm_password = "";

        $errors = [];

        if($_SERVER["REQUEST_METHOD"] == "POST"){

            $new_password = trim($_POST["new_password"]);
            $confirm_password = trim($_POST["confirm_password"]);

 
            // Validate new password
            if(empty($new_password)){

                $errors['new_password_err'] ="Please enter the new password."; 
                
            } elseif(strlen( $new_password ) < 6){
  
                $errors['new_password_err'] = "Password must have atleast 6 characters.";


            } 


            // Validate confirm password
            if(empty($confirm_password)){

                $errors['confirm_password_err'] ="Please confirm the password.";


            } else{

                if(empty($errors['new_password_err']) && ($new_password != $confirm_password)){

                  
                    $errors['confirm_password_err'] = "Password did not match.";

                }
            }
                
            // Check input errors before updating the database
            if(empty($errors['new_password_err']) && empty($errors['confirm_password_err'])){
                
                $id = $_SESSION["id"];

               // echo var_dump($id);

                if($router->database->updateUserPasswordbyId($id, $new_password)){
                    // Password updated successfully. Destroy the session, and redirect to login page
                    session_destroy();
                    header("location: /users/login");
                     exit();

                }else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

            }

        }

        $title = 'ResetPassword';

        $router->renderView('users/resetpassword', [

           'new_password' => $new_password,
           'errors' => $errors,
           'title' => $title,
           'session' => $router->session
     
     

       ]);
    }

///////////////////////////////////////////////////////////////////////////////////

    
}
