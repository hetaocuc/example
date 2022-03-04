<h3>Order detail</h3>


<?php

// echo var_dump($user);
// echo '<br>';
// echo var_dump($products);


?>


            <div class="">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fa fa-list"></i> Shipping
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-responsive" >
                            <thead class='text-truncate'>
                                <th><i class="fa fa-user"></i> Username</th>
                                <th><i class="fa fa-user"></i> Address</th>
                                <th><i class="fa fa-mobile"></i> Mobile</th>
                                <th><i class="fa fa-envelope"></i> Email</th>
                            </thead>
                            <tbody>
                                <td><?php echo $user['full_name']?></td>
                                <td>
                                <?php echo $user['address'] ?>, 
                                    <?php echo $user['city'] ?>
                                </td>
                                <td><?php echo $user['mobile'] ?></td>
                                <td><?php echo $user['email'] ?></td>
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>


<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Unit Price</th>
            <th scope="col">Item Price</th>
        </tr>
    </thead>

    <tbody>


        <?php foreach ($products as $i => $p) { ?>
            <tr>
                <th scope="row"><?php echo $i + 1 ?></th>
                <td>
                    <?php if ($p['image']) : ?>
                        <img src="/<?php echo $p['image'] ?>" alt="<?php echo $p['title'] ?>" class="product-img">
                    <?php endif; ?>
                </td>
                <td><?php echo $p['title'] ?></td>
                <td><?php echo $p['quantity'] ?></td>
                <td><?php echo $p['price'] ?></td>
                <td><?php echo $p['price'] * $p['quantity'] ?></td>
            </tr>
        <?php } ?>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Total:
            <?php

            $total = 0.0;
            foreach ($products as $i => $p) {

                $total += $p['price'] * $p['quantity'];
            }
            echo $total;

            ?>

        </td>

    </tbody>
</table>