<?php include "config.php"; ?>

<div class="register-form">
    <h2 style="text-align:center; margin-bottom:20px;">Create New Account</h2>

    <?php if (count($errors) > 0) : ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form id="signup_form" method="POST" action="register.php">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" id="reg_username" class="form-control" placeholder="Choose a username" required>
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" id="reg_email" class="form-control" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password_1" id="reg_password1" class="form-control" placeholder="Create a password" required>
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="password_2" id="reg_password2" class="form-control" placeholder="Repeat your password" required>
        </div>
        <div id="signup_msg"></div>
        <div class="form-group">
            <button type="submit" name="reg_user" class="primary-btn" style="width:100%;">
                <i class="fa fa-user-plus"></i> Register
            </button>
        </div>
        <p style="text-align:center;">
            Already have an account? 
            <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#Modal_login">Login here</a>
        </p>
    </form>
</div>
