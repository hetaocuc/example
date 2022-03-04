<?php

namespace app\Models;

use app\Database;
use app\helpers\UtiHelper;
use DateTime;

class Order
{
    public ?string $order_id = '';
    public ?int $user_id = 0;
    public ?float $total_price = 0.0;
    public ?bool $payed = false;
    public DateTime $created_at;



    public function __construct()
    {
        $this->order_id = '';
        $this->user_id = 0;
        $this->payed = false;
        $this->total_price = 0.;
    }
}
