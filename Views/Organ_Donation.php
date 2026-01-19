<?php
session_start();
require_once '../Models/db.php';
require_once '../Controllers/organCheck.php';

if (!isset($_SESSION['loggedin']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'doctor' && $_SESSION['role'] !== 'receptionist')) {
  echo "<h2 style='color: red; text-align: center; margin-top: 50px;'>Access Denied!</h2>";
  exit();
}

$dashboardLink = "doctordashboard.php"; 

if ($_SESSION['role'] === 'admin') {
    $dashboardLink = "admindashboard.php";
} elseif ($_SESSION['role'] === 'receptionist') {
   
    $dashboardLink = "receptionistdashboard.php"; 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>MEDLink - Organ Management</title>
  <link rel="stylesheet" href="../Assets/Organ_Donation.css">

  <style>
    .crud-panel {
      border-left: 5px solid #28a745;
    }

    .btn-edit {
      background: #ffc107;
      color: #000;
      padding: 5px 10px;
      text-decoration: none;
      border-radius: 4px;
      font-size: 12px;
      margin-right: 5px;
    }

    .btn-del {
      background: #dc3545;
      color: white;
      padding: 5px 10px;
      text-decoration: none;
      border-radius: 4px;
      font-size: 12px;
    }

    .form-row {
      display: flex;
      gap: 10px;
    }

    .form-row input,
    .form-row select {
      flex: 1;
    }

    .matched-row {
      background-color: #d1e7dd !important;
      transition: background-color 0.3s ease;
    }

    .match-badge {
      background-color: #198754;
      color: white;
      padding: 2px 8px;
      border-radius: 10px;
      font-size: 12px;
      margin-left: 5px;
    }
  </style>
</head>

<body>
  <header>
    <h1>MedLink Organ Management</h1>
    <a href="<?php echo $dashboardLink; ?>" style="color: white; font-weight: bold;">Back to Dashboard</a>
  </header>

  <div class="main-container">

    <section class="panel input-panel">
      <h2>Find Match (Algorithm)</h2>
      <div class="form-group">
        <label>Donor Organ</label>
        <select id="donorOrgan">
          <option value="Kidney">Kidney</option>
          <option value="Liver">Liver</option>
          <option value="Heart">Heart</option>
          <option value="Lungs">Lungs</option>
        </select>
      </div>
      <div class="form-group">
        <label>Donor Blood Type</label>
        <select id="donorBlood">
          <option value="A+">A+</option>
          <option value="A-">A-</option>
          <option value="B+">B+</option>
          <option value="B-">B-</option>
          <option value="AB+">AB+</option>
          <option value="AB-">AB-</option>
          <option value="O+">O+</option>
          <option value="O-">O-</option>
        </select>
      </div>
      <button id="findMatchBtn">Check Matches</button>
    </section>

    <section class="panel crud-panel">
      <h2><?php echo $edit_state ? 'Edit Recipient' : 'Add New Recipient'; ?></h2>

      <form method="post" action="Organ_Donation.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="form-group">
          <label>Patient Name</label>
          <input type="text" name="name" value="<?php echo $name; ?>" required style="width: 100%; padding: 8px;">
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Organ Needed</label>
            <select name="organ">
              <option value="Kidney" <?php if ($organ == "Kidney")
                echo "selected"; ?>>Kidney</option>
              <option value="Liver" <?php if ($organ == "Liver")
                echo "selected"; ?>>Liver</option>
              <option value="Heart" <?php if ($organ == "Heart")
                echo "selected"; ?>>Heart</option>
              <option value="Lungs" <?php if ($organ == "Lungs")
                echo "selected"; ?>>Lungs</option>
            </select>
          </div>
          <div class="form-group">
            <label>Blood</label>
            <select name="blood">
              <option value="A+" <?php if ($blood == "A+")
                echo "selected"; ?>>A+</option>
              <option value="A-" <?php if ($blood == "A-")
                echo "selected"; ?>>A-</option>
              <option value="B+" <?php if ($blood == "B+")
                echo "selected"; ?>>B+</option>
              <option value="B-" <?php if ($blood == "B-")
                echo "selected"; ?>>B-</option>
              <option value="AB+" <?php if ($blood == "AB+")
                echo "selected"; ?>>AB+</option>
              <option value="AB-" <?php if ($blood == "AB-")
                echo "selected"; ?>>AB-</option>
              <option value="O+" <?php if ($blood == "O+")
                echo "selected"; ?>>O+</option>
              <option value="O-" <?php if ($blood == "O-")
                echo "selected"; ?>>O-</option>
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Urgency</label>
            <select name="urgency">
              <option value="Normal" <?php if ($urgency == "Normal")
                echo "selected"; ?>>Normal</option>
              <option value="Critical" <?php if ($urgency == "Critical")
                echo "selected"; ?>>Critical
              </option>
            </select>
          </div>
          <div class="form-group">
            <label>Status</label>
            <select name="status">
              <option value="Waiting" <?php if ($status == "Waiting")
                echo "selected"; ?>>Waiting</option>
              <option value="Matched" <?php if ($status == "Matched")
                echo "selected"; ?>>Matched</option>
            </select>
          </div>
          <input type="hidden" name="gender" value="Male">
        </div>

        <div class="form-group">
          <?php if ($edit_state): ?>
            <button type="submit" name="update_recipient" style="background: #ffc107; color: black;">Update
              Data</button>
            <a href="Organ_Donation.php" style="display:block; text-align:center; margin-top:5px; color: #333;">Cancel</a>
          <?php else: ?>
            <button type="submit" name="save_recipient" style="background: #28a745;">Add Recipient</button>
          <?php endif; ?>
        </div>
      </form>
    </section>

    <section class="panel results-panel" style="flex: 100%;">
      <h2>Recipient Database List</h2>
      <div class="results-table-container">
        <table id="recipientTable">
          <thead>
            <tr>
              <th>Name</th>
              <th>Organ Needed</th>
              <th>Blood Type</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="recipientListBody">
            <?php foreach ($recipient_list as $row): ?>
              <tr class="data-row">
                <td><?php echo $row['name']; ?></td>
                <td class="rec-organ"><?php echo $row['organ_needed']; ?></td>
                <td class="rec-blood"><?php echo $row['blood_type']; ?></td>
                <td>
                  <?php if ($row['status'] == 'Matched'): ?>
                    <span class="badge">Matched</span>
                  <?php else: ?>
                    Waiting
                  <?php endif; ?>
                </td>
                <td>
                  <a href="Organ_Donation.php?edit=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
                  <a href="Organ_Donation.php?del=<?php echo $row['id']; ?>" class="btn-del"
                    onclick="return confirm('Delete this record?');">Del</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>
  </div>

  <script>
    const bloodCompatibilityRules = {
      'O-': ['O-', 'O+', 'A-', 'A+', 'B-', 'B+', 'AB-', 'AB+'],
      'O+': ['O+', 'A+', 'B+', 'AB+'],
      'A-': ['A-', 'A+', 'AB-', 'AB+'],
      'A+': ['A+', 'AB+'],
      'B-': ['B-', 'B+', 'AB-', 'AB+'],
      'B+': ['B+', 'AB+'],
      'AB-': ['AB-', 'AB+'],
      'AB+': ['AB+']
    };

    const findMatchBtn = document.getElementById('findMatchBtn');

    findMatchBtn.addEventListener('click', function () {
      const donorOrgan = document.getElementById('donorOrgan').value;
      const donorBlood = document.getElementById('donorBlood').value;
      const rows = document.querySelectorAll('#recipientListBody tr');

      rows.forEach(row => {
        const recOrgan = row.querySelector('.rec-organ').innerText.trim();
        const recBlood = row.querySelector('.rec-blood').innerText.trim();

        let isMatch = false;

        if (recOrgan === donorOrgan) {

          const compatibleList = bloodCompatibilityRules[donorBlood];
          if (compatibleList && compatibleList.includes(recBlood)) {
            isMatch = true;
          }
        }

        if (isMatch) {
          row.classList.add('matched-row');
        } else {
          row.classList.remove('matched-row');
        }
      });
    });
  </script>

</body>

</html>