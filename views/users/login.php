<div class="wrapper">
    <h2>Login</h2>
    <p>Please fill in your credentials to login.</p>

    <?php
    if (!empty($errors['login_err'])) {
        echo '<div class="alert alert-danger">' . $errors['login_err'] . '</div>';
    }
    ?>

    <!-- <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> -->
    <form action="/users/login" method="post">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control <?php echo (!empty($errors['username_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $user->username; ?>">
            <span class="invalid-feedback"><?php echo $errors['username_err']; ?></span>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control <?php echo (!empty($errors['password_err'])) ? 'is-invalid' : ''; ?>">
            <span class="invalid-feedback"><?php echo $errors['password_err']; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login">
        </div>
        <p>Don't have an account? <a href="/users/signup">Sign up now</a>.</p>
    </form>
</div>