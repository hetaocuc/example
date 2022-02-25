<div class="wrapper">
    <h2>Sign Up</h2>
    <p>Please fill this form to create an account.</p>
    <!-- <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> -->
    <form action="/users/signup" method="post">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control <?php echo (!empty($errors['username_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $user->username; ?>">
            <span class="invalid-feedback"><?php echo $errors['username_err']; ?></span>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control <?php echo (!empty($errors['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $user->password; ?>">
            <span class="invalid-feedback"><?php echo $errors['password_err']; ?></span>
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($errors['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $user->confirm_password; ?>">
            <span class="invalid-feedback"><?php echo $errors['confirm_password_err']; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-secondary ml-2" value="Reset">
        </div>
        <p>Already have an account? <a href="/users/login">Login here</a>.</p>
    </form>
</div>

