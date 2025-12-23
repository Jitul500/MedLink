<?php include '../partials/header.php'; ?>

<h1>Register</h1>
<form method="POST" action="../../controllers/authController.php" onsubmit="return validateRegister()">
    Name: <input type="text" name="name" id="name"><br>
    Email: <input type="text" name="email" id="email"><br>
    Password: <input type="password" name="password" id="password"><br>
    Role: 
    <select name="role">
        <option value="">Select Role</option>
        <option value="doctor">Doctor</option>
        <option value="patient">Patient</option>
    </select><br>
    <button type="submit" name="register">Register</button>
</form>

<p>Already have an account? <a href="login.php">Login here</a></p>

<?php include '../partials/footer.php'; ?>
