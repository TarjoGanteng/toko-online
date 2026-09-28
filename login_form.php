<?php include "config.php"; ?>

<div class="login-form">
    <h2 style="text-align:center; margin-bottom:20px;">Login to Your Account</h2>
    
    <?php if (count($errors) > 0) : ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form id="login" method="POST">
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" id="login_email" class="form-control" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" id="login_password" class="form-control" placeholder="Enter your password" required>
        </div>
        <div id="e_msg"></div>
        <div class="form-group">
            <button type="submit" name="login_user" class="primary-btn" style="width:100%;">
                <i class="fa fa-sign-in"></i> Login
            </button>
        </div>
        <p style="text-align:center;">
            Don't have an account? 
            <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#Modal_register">Register here</a>
        </p>
    </form>
</div>
