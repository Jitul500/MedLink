<?php include '../partials/header.php'; ?>
<h1>Login</h1>
<form method="POST" action="../../controllers/authController.php" onsubmit="return validateLogin()">
    Email: <input type="text" name="email" id="email"><br>
    Password: <input type="password" name="password" id="password"><br>
    Role: 
    <select name="role">
        <option value="doctor">Doctor</option>
        <option value="patient">Patient</option>
    </select><br>
    <button type="submit" name="login">Login</button>
</form>
<?php include '../partials/footer.php'; ?>
