<div class="welcome-wrapper">
    <h2>User Information</h2>
    <p>Please fill this form.</p>
    <!-- <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> -->
    <form action="/customers/update" method="post">
        <input type="hidden" name="id"   value="<?php echo $user->id; ?>">          
        <div class="form-group">
            <label>Full name</label>
            <input type="text" name="full_name" class="form-control <?php echo (!empty($errors['full_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $user->full_name; ?>">
            <span class="invalid-feedback"><?php echo $errors['full_name_err']; ?></span>
        </div>
        <div class="form-group">
            <label>Email</label>

            <input type="email" name="email" class="form-control <?php echo (!empty($errors['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $user->email; ?>">
            <span class="invalid-feedback"><?php echo $errors['email_err']; ?></span>
  
        </div>
        <div class="form-group">
            <label>Mobile</label>
            <input type="text" name="mobile" class="form-control <?php echo (!empty($errors['mobile_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $user->mobile; ?>">
            <span class="invalid-feedback"><?php echo $errors['mobile_err']; ?></span>
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" class="form-control <?php echo (!empty($errors['address_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $user->address; ?>">
            <span class="invalid-feedback"><?php echo $errors['address_err']; ?></span>
        </div>
        <div class="form-group">
            <label>City</label>
            <input type="text" name="city" class="form-control <?php echo (!empty($errors['city_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $user->city; ?>">
            <span class="invalid-feedback"><?php echo $errors['city_err']; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-secondary ml-2" value="Reset">
        </div>

    </form>
</div>