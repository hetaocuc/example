<?php


namespace app\Controllers;
use app\Router;
use app\Models\Product;
use app\Models\Users;


class CustomerController{

    
    public function index(Router $router)
    {
        if(!$router->session->loggedin || ($router->session->role===0)){ // Administrator role=1; Guest role = 0;


            // Redirect to login page
            header("location: /users/login?url=/products");

             exit;
        }

        $keyword = $_GET['search'] ?? '';

        $users = $router->database->getUsers($keyword);




        $title = "Customer";
        $router->renderView('customer/index', [

            'users' => $users,
            'keyword' => $keyword,
            'title' => $title,
            'session' => $router->session

        ]);


    }

    public function update(Router $router)
    {
        if(!$router->session->loggedin || ($router->session->role===0)){ // Administrator role=1; Guest role = 0;


            // Redirect to login page
            header("location: /users/login?url=/products");

             exit;
        }



  // Define variables and initialize with empty values

        $errors = [

            'full_name_err' => '',
            'email_err' => '',
            'mobile_err' => '',
            'address_err' => '',
            'city_err' => ''

        ];

        $user = new Users();
   

    
        // echo var_dump($id);

        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            $id = $_GET['id'] ?? null;

            if (!$id) {
                header('Location: /customers');
                exit;
            }
    

            $userData = $router->database->getUserInformation($id);
      
            $user->full_name = $userData['full_name'];
            $user->email = $userData['email'];
            $user->mobile = $userData['mobile'];
            $user->address = $userData['address'];
            $user->city = $userData['city'];
            $user->id = $userData['id'];



        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $user->full_name = trim($_POST['full_name']);
            $user->email = trim($_POST['email']);
            $user->mobile = trim($_POST['mobile']);
            $user->address = trim($_POST['address']);
            $user->city = trim($_POST['city']);
            $user->id = trim($_POST['id']);


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
                    header("location: /customers");
                    exit;
                } else {

                    echo "Oops! Something went wrong. Please try again later.";
                }
            }


        }
            

         $title = 'User';
         $router->renderView('customer/update', [

            'user' => $user,
            'errors' => $errors,
            'title' => $title,
            'session' => $router->session
     

       ]);


    }


    public  function delete(Router $router){



        if(!$router->session->loggedin){

            // Redirect to login page
             header("location: /users/login");
             exit;
        }


        $id = $_POST['id'] ?? null;
        if (!$id) {
            header('Location: /customers');
            exit;
        }

        if ($router->database->deleteUser($id)) {
            header('Location: /customers');
            exit;
        }
    }

}