<h1> Home </h1>

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

<div class="album py-5 bg-light">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php foreach ($products as $i => $product) { ?>
            <div class="col">
                <div class="card shadow-sm">
                <?php if ($product['image']): ?>

                    
                    <a href="/products/details?id=<?php echo $product['id'] ?>"><img src="/<?php echo $product['image'] ?>" alt="<?php echo $product['title'] ?>" class="home-product-img"></a>
                <?php endif; ?>


                    <div class="card-body">
                        <p class="card-text">
                        <p><?php echo $product['title'] ?></p>
                        <p><?php echo $product['price'] ?></p>

                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="/products/details?id=<?php echo $product['id'] ?>" type="button" class="btn btn-sm btn-outline-secondary">View</a>
                                <!-- <a href="/products/update?id=<?php echo $product['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a> -->
                                <button type="button" class="btn btn-sm btn-outline-secondary">Add to Cart</button>
                            </div>
                            <small class="text-muted">9 mins</small>
                        </div>
                    </div>
                </div>
            </div>

            <?php } ?>


        </div>

</div>
