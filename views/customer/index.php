    <h1>Customer</h1>
<!-- <p>
    <a href="/users/create" type="button" class="btn btn-sm btn-success">Add User</a>
</p> -->
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
        <th scope="col">Userame</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Address</th>
        <th scope="col">Mobile</th>
        <th scope="col">City</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $i => $user) { ?>
        <tr>
            <th scope="row"><?php echo $i + 1 ?></th>
            <td><?php echo $user['username'] ?></td>
            <td><?php echo $user['full_name'] ?></td>
            <td><?php echo $user['email'] ?></td>
            <td><?php echo $user['address'] ?></td>
            <td><?php echo $user['mobile'] ?></td>
            <td><?php echo $user['city'] ?></td>
            <td>
                <a href="/customers/update?id=<?php echo $user['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                <form method="post" action="/customers/delete" style="display: inline-block">
                    <input  type="hidden" name="id" value="<?php echo $user['id'] ?>"/>
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>