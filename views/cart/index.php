<h2>Cart</h2>

<?php

// echo var_dump($carts);

?>



<!-- <p>
    <a href="/products/create" type="button" class="btn btn-sm btn-success">Add Product</a>
</p> -->
<!-- <form action="" method="get">
    <div class="input-group mb-3">
      <input type="text" name="search" class="form-control" placeholder="Search" value="<?php echo $keyword ?>">
      <div class="input-group-append">
        <button class="btn btn-success" type="submit">Search</button>
      </div>
    </div>
</form> -->
<form method="post" action="/cart/checkout">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <!-- <th scope="col">Quantity</th> -->
                <th scope="col">Quantity</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Item Price</th>
                <th scope="col">Actions</th>
                <th scope="col">checkout</th>
            </tr>
        </thead>

        <tbody>


            <?php foreach ($carts as $i => $cart) { ?>
                <tr>
                    <th scope="row"><?php echo $i + 1 ?></th>
                    <td>
                        <?php if ($cart['image']) : ?>
                            <img src="/<?php echo $cart['image'] ?>" alt="<?php echo $cart['title'] ?>" class="product-img">
                        <?php endif; ?>
                    </td>
                    <td><?php echo $cart['title'] ?></td>
                    <!-- <td><?php echo $cart['quantity'] ?></td> -->
                    <td>
                        <div class="cart-info quantity">
                            <div class="btn-increment-decrement" onclick="decrement_quantity(<?php echo $cart['product_id'] ?>)">-</div>
                            <input class="input-quantity" id="input-quantity-<?php echo $cart['product_id'] ?>" value="<?php echo $cart['quantity'] ?>">
                            <div class="btn-increment-decrement" onclick="increment_quantity(<?php echo $cart['product_id'] ?>)">+</div>
                        </div>
                    </td>

                    <td>
                        <div class="product-price" id="product-price-<?php echo $cart['product_id'] ?>"><?php echo $cart['price'] ?></div>
                    </td>

                    <td>
                        <div class="cart-info price" id="cart-price-<?php echo $cart['product_id'] ?>"><?php echo $cart['price'] * $cart['quantity'] ?></div>
                    </td>
                    <td>
                        <form method="post" action="/cart/delete" style="display: inline-block">
                            <input type="hidden" name="id" value="<?php echo $cart['product_id'] ?>" />
                            <button type="submit" name="delete" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>

                    </td>
                    <td><input type="checkbox" name="product_id[]" value="<?php echo $cart['product_id'] ?>" /></td>

                </tr>
            <?php } ?>

        </tbody>
    </table>
    <button type="submit" name='checkout' class="btn btn-sm btn-outline-danger" <?php echo (empty($carts)) ? 'disabled' : ''; ?>>CheckOut</button>
</form>
<?php 

    $total_quantity = 0;
    $total_price = 0.0;

    foreach ($carts as $i => $cart){

        $total_quantity = $cart['quantity'] + $total_quantity ;
        $total_price = $total_price+ $cart['price'] * $cart['quantity'];
    }

?>
<div class="cart-status">
    <div>Total Quantity: <span id="total-quantity"><?php echo $total_quantity ?></span></div>
    <div>Total Price: <span id="total-price"><?php echo $total_price ?></span></div>
</div>