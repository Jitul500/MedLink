<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: ../../Views/patientlogin.php");
    exit();
}

require_once "../../Controllers/patientController.php"; 

$patients = getPatientsController(); 

?>

<!DOCTYPE html>
<html>
<head>
    <title>Patients</title>
    <link rel="stylesheet" href="../../Assets/list_DOC_PT.css">
    <style>
        .message.success { color: green; }
        .message.error   { color: red; }
    </style>
    </head>

<body>

<div class="page-wrapper">

    <header class="page-header">
        <h1>Patients</h1>
        <a href="../doctor/dashboard.php" class="back-btn">Back</a>
    </header>

<h2>Add New Patient</h2>

<div id="message"></div>

<form id="addPatientForm">
  <div class="form-row">
    <div class="left-column">
      <label for="name">Name</label>
      <input type="text" id="name" name="name">
      <p id="nameError" class="error"></p>

      <label for="email">Email</label>
      <input type="email" id="email" name="email">
      <p id="emailError" class="error"></p>
    </div>

    <div class="right-column">
      <label for="phone">Phone</label>
      <input type="text" id="phone" name="phone">
      <p id="phoneError" class="error"></p>

      <label for="gender">Gender</label>
      <select name="gender" id="gender">
        <option value="">Select Gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>
    </div>
  </div>

  <div class="form-row">
    <button type="submit">Add Patient</button>
  </div>
</form>

<script>
function validatePatientForm() {
    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let phone = document.getElementById("phone").value.trim();
    let gender = document.getElementById("gender").value;

    let valid = true;

    // Name validation
    if (name === "") { 
        document.getElementById("nameError").textContent = "Name is required"; 
        valid = false; 
    } else { 
        document.getElementById("nameError").textContent = ""; 
    }


    if (!email) {
        document.getElementById("emailError").textContent = "Email is required";
        valid = false;
    } else if (!email.includes("@") || !email.includes(".")) {
        document.getElementById("emailError").textContent = "Invalid email";
        valid = false;
    } else {
        document.getElementById("emailError").textContent = "";
    }

    if (phone === "") { 
        document.getElementById("phoneError").textContent = "Phone is required"; 
        valid = false; 
    } else if (isNaN(phone) || phone.length < 10 || phone.length > 11) { 
        document.getElementById("phoneError").textContent = "Invalid phone number"; 
        valid = false; 
    } else { 
        document.getElementById("phoneError").textContent = ""; 
    }

    if (gender === "") { 
        alert("Please select gender"); 
        valid = false; 
    }

    return valid;
}

document.getElementById("addPatientForm").addEventListener("submit", function(e) {
    e.preventDefault(); 

    if (!validatePatientForm()) return;

    let formData = new FormData(this);

    fetch("addPatientAction.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById("message").innerHTML = data;

        // Reset form after success
        if (data.includes("success")) {
            document.getElementById("addPatientForm").reset();
        }
    })
    .catch(err => console.error(err));
});
</script>





    <div class="card2">
        <input type="text" id="searchInput" placeholder="Search patient...">

        <div class="patient-list">

<?php foreach($patients as $patient): ?>
    <div class="patient-card">
        <div class="avatar">
            <?= strtoupper(substr($patient['name'], 0, 1)) ?>
        </div>

        <div class="patient-details">
            <h4><?php echo $patient['name'] ?></h4>
            <p><?php echo $patient['email'] ?></p>
            <p><?php echo $patient['phone'] ?></p>
            <p><strong>Gender:</strong> <?php echo $patient['gender'] ?></p>

            <a href="viewPatient.php?id=<?= $patient['id'] ?>" class="view-btn">
                View Profile
            </a>
        </div>
    </div>
<?php endforeach; ?>

        </div>
    </div>

</div>

<script>
document.getElementById("searchInput").addEventListener("keyup", function () {
    let value = this.value.toLowerCase();
    document.querySelectorAll(".patient-card").forEach(card => {
        card.style.display = card.textContent.toLowerCase().includes(value)
            ? "inline-block"
            : "none";
    });
});
</script>

</body>
</html>
