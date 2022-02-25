<?php

namespace app;

use app\models\Product;
use app\models\Users;

use PDO;


class Database
{
    public $pdo = null;
    public static ?Database $db = null;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_crud', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$db = $this;
    }

    public function getProducts($keyword = '')
    {
        if ($keyword) {
            $statement = $this->pdo->prepare('SELECT * FROM products WHERE title like :keyword ORDER BY create_date DESC');
            $statement->bindValue(":keyword", "%$keyword%");
        } else {
            $statement = $this->pdo->prepare('SELECT * FROM products ORDER BY create_date DESC');
        }
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM products WHERE id = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteProduct($id)
    {
        $statement = $this->pdo->prepare('DELETE FROM products WHERE id = :id');
        $statement->bindValue(':id', $id);

        return $statement->execute();
    }

    public function updateProduct(Product $product)
    {
        $statement = $this->pdo->prepare("UPDATE products SET title = :title, 
                                        image = :image, 
                                        description = :description, 
                                        price = :price WHERE id = :id");
        $statement->bindValue(':title', $product->title);
        $statement->bindValue(':image', $product->imagePath);
        $statement->bindValue(':description', $product->description);
        $statement->bindValue(':price', $product->price);
        $statement->bindValue(':id', $product->id);

        $statement->execute();
    }

    public function createProduct(Product $product)
    {
        $statement = $this->pdo->prepare("INSERT INTO products (title, image, description, price, create_date)
                VALUES (:title, :image, :description, :price, :date)");
        $statement->bindValue(':title', $product->title);
        $statement->bindValue(':image', $product->imagePath);
        $statement->bindValue(':description', $product->description);
        $statement->bindValue(':price', $product->price);
        $statement->bindValue(':date', date('Y-m-d H:i:s'));

        $statement->execute();
    }


////////////////////////////////////////////////////////////////////////////////////////

    public function usernameIsExist($username)
    {
        $statement = $this->pdo->prepare('SELECT id FROM users WHERE username = :username');
        $statement->bindValue(':username', $username);
       
        $statement->execute();

        return ($statement->rowCount() == 1) ;

    }


    


    public function saveUsernamePassword(Users $user){

        // Prepare an insert statement
        $statement = $this->pdo->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');

        $param_password = password_hash($user ->password, PASSWORD_DEFAULT); // Creates a password hash

        $statement->bindValue(':username', $user->username);
        $statement->bindValue(':password', $param_password);

        return $statement->execute();


        }



        public function getUserPassword(Users $user){

            // Prepare a select statement
            $statement = $this->pdo->prepare('SELECT id, username, password FROM users WHERE username = :username');
            // Bind variables to the prepared statement as parameters

            $statement->bindValue(":username", $user->username);
           
            // Attempt to execute the prepared statement
            $statement->execute();

            return $statement->fetch(PDO::FETCH_ASSOC);


        }

        public function updateUserPasswordbyId($id, $new_password){



            // Prepare a select statement
            $statement = $this->pdo->prepare('UPDATE users SET password = :password WHERE id = :id');

            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            // Bind variables to the prepared statement as parameters

            $statement->bindValue(":password", $param_password);
            $statement->bindValue(":id", $id);

           
            // Attempt to execute the prepared statement
            return $statement->execute();


        }


}
