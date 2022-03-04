<?php

namespace app\Models;

use app\Database;
use app\helpers\UtiHelper;
use DateTime;

class Cart
{

    public ?int $user_id  = null;
    public ?int $product_id  = 0;
    public ?int $quantity = null;
    public ?float $total_price = null;
    public ?bool $checkout = null;
    public ?string $sn = null;
    public DateTime $created_at ;




    public function __construct($cart)
    {
        $this->user_id = $cart['user_id'] ?? 0;
        $this->product_id = $cart['product_id'] ?? 0;
        $this->quantity = $cart['quantity'] ?? 0;
        $this->total_price = $cart['total_price'] ?? 0;
        $this->checkout = $cart['checkout'] ?? false;
        $this->sn = $cart['sn'] ?? "";


    }
}
