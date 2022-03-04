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
                    <td><?php echo $cart['quantity'] ?></td>
                    <td><?php echo $cart['price'] ?></td>
                    <td><?php echo $cart['price'] * $cart['quantity'] ?></td>
                    <td>
                        <form method="post" action="/cart/delete" style="display: inline-block">
                            <input type="hidden" name="id" value="<?php echo $cart['product_id'] ?>" />
                            <button type="submit" name = "delete" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>

                    </td>
                    <td><input type="checkbox" name="product_id[]" value="<?php echo $cart['product_id'] ?>" /></td>

                </tr>
            <?php } ?>

        </tbody>
    </table>
    <button type="submit" name='checkout' class="btn btn-sm btn-outline-danger" 
    
    <?php echo (empty($carts))? 'disabled':'';?> >CheckOut</button>
</form>