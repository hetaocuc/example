<h1> Home</h1>

<p>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos, culpa! Cumque tenetur odit, laudantium dignissimos suscipit id totam voluptates amet, debitis ullam at tempora sit similique provident harum nesciunt deserunt.


</p>
<p>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos, culpa! Cumque tenetur odit, laudantium dignissimos suscipit id totam voluptates amet, debitis ullam at tempora sit similique provident harum nesciunt deserunt.


</p>
<p>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos, culpa! Cumque tenetur odit, laudantium dignissimos suscipit id totam voluptates amet, debitis ullam at tempora sit similique provident harum nesciunt deserunt.


</p>
<!-- <?php echo var_dump($products); ?> -->

<div class="album py-2 bg-light">

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php foreach ($products as $i => $product) { ?>
            <div class="col">
                <div class="card shadow-sm">
                    <?php if ($product['image']) : ?>


                        <a href="/home/details?id=<?php echo $product['id'] ?>"><img src="/<?php echo $product['image'] ?>" alt="<?php echo $product['title'] ?>" class="home-product-img"></a>
                    <?php endif; ?>


                    <div class="card-body">
                        <p class="card-text">
                        <p><?php echo $product['title'] ?></p>
                        <p><?php echo $product['price'] ?></p>

                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="/home/details?id=<?php echo $product['id'] ?>" type="button" class="btn btn-sm btn-outline-secondary">View</a>
                                <!-- <a href="/products/update?id=<?php echo $product['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a> -->
                                <form method="post" action="/cart/add" style="display: inline-block">
                                    <input type="hidden" name="id" value="<?php echo $product['id'] ?>" />
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Add to Cart</button>
                                </form>
                            </div>
                            <small class="text-muted">9 mins</small>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>


    </div>
    <?php

    // echo var_dump($pager);
    // The "back" link 
    $prevlink = ($pager['page'] > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($pager['page'] - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';
    // The "forward" link -->
    $nextlink = ($pager['page'] < $pager['pages']) ? '<a href="?page=' . ($pager['page'] + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pager['pages'] . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';
    // Display the paging information 

    ?>
    <div id="paging" class="text-center my-2 pager">
        <p> <?php echo $prevlink; ?> Page <?php echo $pager['page']; ?> of <?php echo $pager['pages']; ?> pages, displaying <?php echo $pager['start']; ?> - <?php echo $pager['end']; ?> of <?php echo $pager['total']; ?> results <?php echo $nextlink; ?></p>
    </div>
</div>