<div class="wrapper">
    <h2>Reset Password</h2>
    <p>Please fill out this form to reset your password.</p>
    <!-- <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> -->
    <form action="/users/resetpassword" method="post">
        <div class="form-group">
            <label>New Password</label>
            <input type="password" name="new_password" class="form-control <?php echo (!empty($errors['new_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
            <span class="invalid-feedback"><?php echo $errors['new_password_err']; ?></span>
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($errors['confirm_password_err'])) ? 'is-invalid' : ''; ?>">
            <span class="invalid-feedback"><?php echo $errors['confirm_password_err']; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <a class="btn btn-link ml-2" href="/users/welcome">Cancel</a>
        </div>
    </form>
</div>