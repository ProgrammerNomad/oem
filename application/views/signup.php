<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <h2>Sign Up</h2>
    <?php echo validation_errors(); ?>
    <?php echo isset($success) ? $success : ''; ?>
    <?php echo form_open('auth/signup'); ?>
        <label>Email:</label>
        <input type="text" name="email">
        <label>Password:</label>
        <input type="password" name="password">
        <label>Confirm Password:</label>
        <input type="password" name="confirm_password">
        <button type="submit">Sign Up</button>
    <?php echo form_close(); ?>
    <p>Already have an account? <a href="<?php echo site_url('Controller_Login/login'); ?>">Login</a></p>
</body>
</html>
