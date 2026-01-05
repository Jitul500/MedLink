<?php $b = $_SESSION['booking']; ?>

<div class="card form-card">
    <h3 style="color:#0d6efd">Appointment Summary</h3>

    <p><strong>Doctor:</strong> <?= $b['doctor']['name'] ?></p>
    <p><strong>Specialty:</strong> <?= $b['doctor']['specialty'] ?></p>
    <p><strong>Consultation Fee:</strong> ৳<?= $b['doctor']['fee'] ?></p>

    <hr>

    <p><strong>Patient Name:</strong> <?= $b['patient'] ?></p>
    <p><strong>Age:</strong> <?= $b['age'] ?></p>
    <p><strong>Gender:</strong> <?= $b['gender'] ?></p>
    <p><strong>Phone:</strong> <?= $b['phone'] ?></p>
    <p><strong>Emergency Contact:</strong> <?= $b['emergency'] ?></p>
    <p><strong>Reason for Visit:</strong> <?= $b['reason'] ?></p>

    <a href="index.php" class="btn" style="text-decoration:none;display:block;text-align:center;">
        Home
    </a>
</div>
