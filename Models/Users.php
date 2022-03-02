<?php

namespace app\Models;
use app\Database;
use app\helpers\UtiHelper;
use DateTime;

class Users{

    public ?int $id = null;
    public ?string $username = null;
    public ?string $password = null;
    public ?string $confirm_password = null;
    public DateTime $created_at ;
    public ?int $role = 0; 
    public ?string $full_name = null;
    public ?string $email = null;
    public ?string $mobile = null;
    public ?string $address = null;
    public ?string $city = null;



    public function __construct()
    {
        $this ->username ='';
        $this ->password ='';
        $this ->confirm_password ='';
        $this -> role = 0;
        $this -> full_name = '';
        $this ->email = '';
        $this ->mobile = '';
        $this ->address = '';
        $this ->city = '';
    

        
    }
}