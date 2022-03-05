<?php

namespace app;

use app\models\Product;
use app\models\Users;
use app\models\Cart;
use app\models\Order;

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


    public function getProductTotal(){

            $statement = $this->pdo->prepare('SELECT COUNT(*) FROM products' );
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);


    }

    public function getPagedProduct($limit,$offset){
    // Prepare the paged query
    $statement = $this->pdo->prepare('SELECT * FROM products ORDER BY create_date DESC  LIMIT :limit  OFFSET :offset' );

    // Bind the query params
    $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
    $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);

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
        $statement = $this->pdo->prepare('INSERT INTO users (username, password, role) VALUES (:username, :password, :role)');

        $param_password = password_hash($user ->password, PASSWORD_DEFAULT); // Creates a password hash

        $statement->bindValue(':username', $user->username);
        $statement->bindValue(':password', $param_password);
        $statement->bindValue(':role', $user->role);

        return $statement->execute();


        }



        public function getUserPassword(Users $user){

            // Prepare a select statement
            $statement = $this->pdo->prepare('SELECT id, username, password, role FROM users WHERE username = :username');
            // Bind variables to the prepared statement as parameters

            $statement->bindValue(':username', $user->username);
           
            // Attempt to execute the prepared statement
            $statement->execute();

            return $statement->fetch(PDO::FETCH_ASSOC);


        }

        public function updateUserPasswordbyId($id, $new_password){



            // Prepare a select statement
            $statement = $this->pdo->prepare('UPDATE users SET password = :password WHERE id = :id');

            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            // Bind variables to the prepared statement as parameters

            $statement->bindValue(':password', $param_password);
            $statement->bindValue(':id', $id);

           
            // Attempt to execute the prepared statement
            return $statement->execute();


        }

        public function updateUserInformation($user){

     
            // Prepare a select statement
            $statement = $this->pdo->prepare('UPDATE users SET       
            
            full_name = :full_name,
            address = :address,
            mobile = :mobile ,
            email =:email ,
            city = :city WHERE id = :id');

            // Bind variables to the prepared statement as parameters


            $statement->bindValue(':id', $user->id);
            $statement->bindValue(':full_name', $user->full_name);
            $statement->bindValue(':email', $user->email);
            $statement->bindValue(':mobile', $user->mobile);
            $statement->bindValue(':address', $user->address);
            $statement->bindValue(':city', $user->city);


            // Attempt to execute the prepared statement
            return $statement->execute();


        }
        public function getUserInformation($id)
        {
            $statement = $this->pdo->prepare('SELECT * FROM users WHERE id = :id');
            $statement->bindValue(':id', $id);
            $statement->execute();
    
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        public function getUsers($keyword = '')
        {
            if ($keyword) {
                $statement = $this->pdo->prepare('SELECT * FROM users WHERE full_name like :keyword and where role = 0 ORDER BY created_at DESC');
                $statement->bindValue(":keyword", "%$keyword%");
            } else {
                $statement = $this->pdo->prepare('SELECT * FROM users where role = 0 ORDER BY created_at DESC');
            }
            $statement->execute();
    
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function deleteUser($id){

            $statement = $this->pdo->prepare('DELETE FROM users WHERE id = :id');
            $statement->bindValue(':id', $id);

            return $statement->execute();

        }

        //////////// Cart 
        public function getCartLists(Cart $cart){

            $statement = $this->pdo->prepare('SELECT c.product_id, c.user_id, c.quantity, p.* 
            
            FROM cart c,  products p
            WHERE user_id = :user_id and checkout = :checkout and c.product_id = p.id
            ORDER BY created_at DESC');


            $statement->bindValue(":user_id", $cart->user_id);
            $statement->bindValue(":checkout", $cart->checkout);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);


        }

        public function getCartTotalPrice(Cart $cart){

            $statement = $this->pdo->prepare('SELECT c.product_id, c.user_id, c.quantity, p.* 
            
            FROM cart c,  products p
            WHERE user_id = :user_id and checkout = :checkout and c.product_id = p.id and c.sn = :sn
            ORDER BY created_at DESC');


            $statement->bindValue(":user_id", $cart->user_id);
            $statement->bindValue(":checkout", $cart->checkout);
            $statement->bindValue(":sn", $cart->sn);
            $statement->execute();
            $temp = [];
            $temp = $statement->fetchAll(PDO::FETCH_ASSOC);


            $price = 0.;
            foreach($temp as $t){

               $price = $price= $t['price']*$t['quantity'];

            }

     //       echo var_dump($price);

            return $price;


        }






        public function addCart(Cart $cart){

 
          // Prepare an insert statement
          $statement = $this->pdo->prepare('INSERT INTO cart (user_id, product_id, quantity, total_price, checkout, sn, created_at ) 
          
          VALUES (:user_id, :product_id, :quantity, :total_price, :checkout, :sn, :created_at)');
                     
            $statement->bindValue(":user_id", $cart->user_id);
            $statement->bindValue(":product_id",$cart->product_id);
            $statement->bindValue(":quantity", $cart->quantity);
            $statement->bindValue(":total_price",$cart->total_price);
            $statement->bindValue(":checkout", $cart->checkout);
            $statement->bindValue(":sn", $cart->sn);
            $statement->bindValue(":created_at", date('Y-m-d H:i:s'));
 
            return $statement->execute();
        }


        public function deleteCart(Cart $cart){

            // Prepare an insert statement
            $statement = $this->pdo->prepare('DELETE FROM cart 
            
            WHERE user_id = :user_id and product_id = :product_id and checkout = :checkold and sn = :snold');
                       
              $statement->bindValue(":user_id", $cart->user_id);
              $statement->bindValue(":product_id",$cart->product_id);
              $statement->bindValue(":checkold",0);
              $statement->bindValue(":snold", 'null');

              return $statement->execute();
          }


          public function updateCartQuantity(Cart $cart){

            // Prepare an insert statement
            $statement = $this->pdo->prepare('UPDATE cart SET  
            quantity = :quantity
            WHERE user_id = :user_id and product_id = :product_id and checkout = :checkout ');
                       
              $statement->bindValue(":user_id", $cart->user_id);
              $statement->bindValue(":product_id",$cart->product_id);
              $statement->bindValue(":quantity",$cart->quantity);
              $statement->bindValue(":checkout",$cart->checkout);

              return $statement->execute();
          }


          public function getCartQuantity(Cart $cart){

            // Prepare an insert statement



            $statement = $this->pdo->prepare(' SELECT quantity FROM cart 
            WHERE user_id = :user_id and checkout = :checkout and product_id = :product_id')  ;
           

              $statement->bindValue(":user_id",  $cart->user_id);
              $statement->bindValue(":product_id",$cart->product_id);
              $statement->bindValue(":checkout", $cart->checkout);
              $statement->execute();

             $temp = $statement->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($temp)){
                return $temp[0]['quantity'];

            }
            else{

                return 0;
            }


          }

          public function cartCheckout(Cart $cart){

            // Prepare an insert statement
            $statement = $this->pdo->prepare('UPDATE cart SET  
            checkout = :checkout,
            sn = :sn
            WHERE user_id = :user_id and product_id = :product_id and checkout = :checkold and sn = :snold');
                       
              $statement->bindValue(":user_id", $cart->user_id);
              $statement->bindValue(":product_id",$cart->product_id);
              $statement->bindValue(":checkout",$cart->checkout);
              $statement->bindValue(":sn", $cart->sn);
              $statement->bindValue(":checkold",0);
              $statement->bindValue(":snold", 'null');

              return $statement->execute();
          }


          public function getCartOrderDetail(Cart $cart){

            $statement = $this->pdo->prepare('SELECT c.product_id, c.user_id, c.quantity, p.* 
            
            FROM cart c,  products p
            WHERE user_id = :user_id and SN = :sn and c.product_id = p.id
            ORDER BY created_at DESC');


            $statement->bindValue(":user_id", $cart->user_id);
            $statement->bindValue(":sn", $cart->sn);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);



        }
          

          ///////////////////////////////////////////////////////////////////////

          public function addOrder(Order $order){

            // Prepare an insert statement
          $statement = $this->pdo->prepare('INSERT INTO orders (order_id,user_id, total_price, payed, created_at) 
          
          VALUES (:order_id, :user_id, :total_price, :payed, :created_at)');
                     
            $statement->bindValue(":order_id", $order->order_id);
            $statement->bindValue(":user_id",$order->user_id);
            $statement->bindValue(":total_price", $order->total_price);
            $statement->bindValue(":payed",$order->payed);
            $statement->bindValue(":created_at", date('Y-m-d H:i:s'));
 
            return $statement->execute();


          }

          public function getOrderLists(Order $order){

            $statement = $this->pdo->prepare('SELECT * FROM orders WHERE user_id = :user_id ORDER BY created_at DESC');
            $statement->bindValue(":user_id", $order->user_id);
  
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);


        }

        public function getAllOrdersUser($keyword = ''){
            if ($keyword) {

                $statement = $this->pdo->prepare('SELECT o.*, u.username, u.full_name, u.mobile 
                
                FROM orders o,  users u
                WHERE o.user_id = u.id and o.order_id like :keyword
                ORDER BY o.created_at DESC');
                $statement->bindValue(":keyword", "%$keyword%");
    
            } 
            else {
                $statement = $this->pdo->prepare('SELECT o.*, u.username, u.full_name, u.mobile 
                
                FROM orders o,  users u
                WHERE o.user_id = u.id
                ORDER BY o.created_at DESC');
            }
    
            $statement->execute();
    
            return $statement->fetchAll(PDO::FETCH_ASSOC);


        }


          

}
