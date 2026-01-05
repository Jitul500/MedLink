<?php
require_once '../Controllers/adminController.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - MedLink</title>
  <link rel="stylesheet" href="../Assets/admin-style.css">
  <style>
    /* ছবির জন্য ছোট স্টাইল */
    .profile-thumb {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #ddd;
    }
  </style>
</head>

<body>

  <div class="sidebar">
    <h2>MedLink Admin</h2>
    <a href="?page=dashboard" class="<?php echo $page == 'dashboard' ? 'active' : ''; ?>">Dashboard</a>
    <a href="?page=doctors" class="<?php echo $page == 'doctors' ? 'active' : ''; ?>">Manage Doctors</a>
    <a href="?page=patients" class="<?php echo $page == 'patients' ? 'active' : ''; ?>">Manage Patients</a>

    <a href="Organ_Donation.php">Organ Donation</a>

    <a href="../Controllers/logout.php" class="logout-btn">Logout</a>
  </div>

  <div class="main-content">

    <?php if ($page == 'dashboard'): ?>
      <div class="card">
        <h1>Welcome, Admin!</h1>
      </div>
      <div style="display: flex; gap: 20px;">
        <div class="card" style="flex: 1; text-align: center;">
          <h3>Total Doctors</h3>
          <h1 style="color: #27ae60;"><?php echo count($doctors); ?></h1>
        </div>
        <div class="card" style="flex: 1; text-align: center;">
          <h3>Total Patients</h3>
          <h1 style="color: #2980b9;"><?php echo count($patients); ?></h1>
        </div>
      </div>
    <?php endif; ?>

    <?php if ($page == 'doctors'): ?>
      <div class="card">
        <h2><?php echo $edit_data ? 'Edit Doctor' : 'Add New Doctor'; ?></h2>

        <form method="post" enctype="multipart/form-data">

          <?php if ($edit_data): ?>
            <input type="hidden" name="id" value="<?php echo $edit_data['id']; ?>">
          <?php endif; ?>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
            <input type="text" name="username" class="form-input" placeholder="Username"
              value="<?php echo $edit_data['username'] ?? ''; ?>" required>

            <input type="text" name="name" class="form-input" placeholder="Full Name"
              value="<?php echo $edit_data['name'] ?? ''; ?>" required>

            <input type="email" name="email" class="form-input" placeholder="Email"
              value="<?php echo $edit_data['email'] ?? ''; ?>" required>

            <input type="text" name="phone" class="form-input" placeholder="Phone"
              value="<?php echo $edit_data['phone'] ?? ''; ?>" required>

            <select name="gender" class="form-input" required>
              <option value="">Select Gender</option>
              <option value="Male" <?php echo ($edit_data['gender'] ?? '') == 'Male' ? 'selected' : ''; ?>>Male</option>
              <option value="Female" <?php echo ($edit_data['gender'] ?? '') == 'Female' ? 'selected' : ''; ?>>Female
              </option>
            </select>

            <input type="text" name="specialty" class="form-input" placeholder="Specialty"
              value="<?php echo $edit_data['specialty'] ?? ''; ?>" required>

            <input type="text" name="password" class="form-input" placeholder="Password"
              value="<?php echo $edit_data['password'] ?? ''; ?>" required>

            <div style="grid-column: span 2;">
              <label>Doctor's Photo:</label>
              <input type="file" name="profile_pic" class="form-input" style="padding: 5px;">
              <?php if (isset($edit_data['profile_pic']) && $edit_data['profile_pic']): ?>
                <p style="font-size: 12px; color: green;">Current Image: <?php echo $edit_data['profile_pic']; ?></p>
              <?php endif; ?>
            </div>
          </div>

          <button type="submit" name="<?php echo $edit_data ? 'update_doctor' : 'add_doctor'; ?>" class="btn-add">
            <?php echo $edit_data ? 'Update Doctor' : 'Add Doctor'; ?>
          </button>

          <?php if ($edit_data): ?>
            <a href="?page=doctors" class="btn-cancel">Cancel</a>
          <?php endif; ?>
        </form>
      </div>

      <div class="card" style="overflow-x: auto;">
        <h2>Doctor List</h2>
        <table>
          <tr>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Specialty</th>
            <th>Action</th>
          </tr>
          <?php foreach ($doctors as $doctor): ?>
            <tr>
              <td>
                <?php
                $img = !empty($doctor['profile_pic']) ? $doctor['profile_pic'] : 'default.png';
                ?>
                <img src="../uploads/<?php echo $img; ?>" alt="Doc" class="profile-thumb">
              </td>
              <td><?php echo $doctor['name']; ?></td>
              <td><?php echo $doctor['email']; ?></td>
              <td><?php echo $doctor['phone']; ?></td>
              <td><?php echo $doctor['specialty']; ?></td>
              <td>
                <a href="?page=doctors&edit=doc&id=<?php echo $doctor['id']; ?>" class="btn-edit">Edit</a>
                <a href="?action=delete_doc&id=<?php echo $doctor['id']; ?>" class="btn-delete"
                  onclick="return confirm('Are you sure?')">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
    <?php endif; ?>


    <?php if ($page == 'patients'): ?>
      <div class="card">
        <?php if ($edit_data): ?>
          <h2>Edit Patient</h2>

          <form method="post" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?php echo $edit_data['id']; ?>">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
              <input type="text" name="username" class="form-input" value="<?php echo $edit_data['username']; ?>" required>
              <input type="text" name="name" class="form-input" value="<?php echo $edit_data['name']; ?>" required>
              <input type="email" name="email" class="form-input" value="<?php echo $edit_data['email']; ?>" required>
              <input type="text" name="phone" class="form-input" value="<?php echo $edit_data['phone']; ?>" required>
              <select name="gender" class="form-input" required>
                <option value="Male" <?php echo $edit_data['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?php echo $edit_data['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
              </select>
              <input type="text" name="password" class="form-input" value="<?php echo $edit_data['password']; ?>" required>

              <div style="grid-column: span 2;">
                <label>Update Photo:</label>
                <input type="file" name="profile_pic" class="form-input">
                <?php if (isset($edit_data['profile_pic']) && $edit_data['profile_pic']): ?>
                  <img src="../uploads/<?php echo $edit_data['profile_pic']; ?>" width="40"
                    style="vertical-align: middle; margin-left: 10px;">
                <?php endif; ?>
              </div>
            </div>

            <button type="submit" name="update_patient" class="btn-add">Update Patient</button>
            <a href="?page=patients" class="btn-cancel">Cancel</a>
          </form>
        <?php else: ?>
          <h2>Manage Patients</h2>
          <p style="color: gray;">Select 'Edit' to modify patient details.</p>
        <?php endif; ?>
      </div>

      <div class="card" style="overflow-x: auto;">
        <table>
          <tr>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>Action</th>
          </tr>
          <?php foreach ($patients as $patient): ?>
            <tr>
            <td>
            <?php
            $img = !empty($patient['profile_pic']) ? $patient['profile_pic'] : 'default.png';
             ?>
          <img src="../uploads/<?php echo $img; ?>" alt="Pat" class="profile-thumb">
          </td>
          <td><?php echo $patient['name']; ?></td>
          <td><?php echo $patient['email']; ?></td>
          <td><?php echo $patient['phone']; ?></td>
          <td><?php echo $patient['gender']; ?></td>
          <td>
          <a href="?page=patients&edit=pat&id=<?php echo $patient['id']; ?>" class="btn-edit">Edit</a>
          <a href="?action=delete_pat&id=<?php echo $patient['id']; ?>" class="btn-delete"
          onclick="return confirm('Remove this patient?')">Delete</a>
            </td>
        </tr>
      <?php endforeach; ?>
    </table>
    </div>
    <?php endif; ?>

  </div>
</body>

</html>