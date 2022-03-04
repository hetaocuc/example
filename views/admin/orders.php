<h1>Orders</h1>
<?php 

// echo var_dump($orderUser);

?>

<form action="" method="get">
    <div class="input-group mb-3">
      <input type="text" name="search" class="form-control" placeholder="Search" value="<?php echo $keyword ?>">
      <div class="input-group-append">
        <button class="btn btn-success" type="submit">Search</button>
      </div>
    </div>
</form>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">OrderNumber</th>
        <th scope="col">Name</th>
        <th scope="col">Username</th>
        <th scope="col">Price</th>
        <th scope="col">Payed</th>
        <th scope="col">Date</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($orderUser as $i => $o) { ?>
        <tr>
            <th scope="row"><?php echo $i + 1 ?></th>
            <td><?php echo $o['order_id'] ?></td>
            <td><?php echo $o['full_name'] ?></td>
            <td><?php echo $o['username'] ?></td>
            <td><?php echo $o['total_price'] ?></td>
            <td><?php echo $o['payed'] ?></td>
            <td><?php echo $o['created_at'] ?></td>

        </tr>
    <?php } ?>
    </tbody>
</table>