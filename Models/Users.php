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

    public function __construct()
    {
        $this ->username ='';
        $this ->password ='';
        $this ->confirm_password ='';
        $this -> role = 0;

        
    }
}