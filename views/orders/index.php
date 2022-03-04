    <h1>Order</h1>

<?php 

    // echo var_dump($orders);
?>

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Order Number</th>
        <th scope="col">Price</th>
        <th scope="col">Date</th>
        <th scope="col">Payed</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($orders as $i => $order) { ?>
        <tr>
            <th scope="row"><?php echo $i + 1 ?></th>

            <td><a href="/order/detail?id=<?php echo $order['order_id'] ?>"><?php echo $order['order_id'] ?></a></td>

            <td><?php echo $order['total_price'] ?></td>
            <td><?php echo $order['created_at'] ?></td>
            <td><?php echo $order['payed'] ?></td>

            <td>
                <!-- <a href="/order/pay?id=<?php echo $order['order_id'] ?>" class="btn btn-sm btn-outline-primary">Pay</a> -->
                <a  class="btn btn-sm btn-outline-primary">Pay</a>
                <!-- <form method="post" action="/products/delete" style="display: inline-block">
                    <input  type="hidden" name="id" value="<?php echo $product['id'] ?>"/>
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form> -->
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

</div>
