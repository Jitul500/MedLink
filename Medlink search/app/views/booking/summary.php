<?php $b = $_SESSION['booking']; ?>

<h3>Appointment Summary</h3>

<p><strong>Patient Name:</strong> <?= $b['patient'] ?></p>
<p><strong>Blood Group:</strong> <?= $b['blood'] ?></p>
<p><strong>Gender:</strong> <?= $b['gender'] ?></p>
<p><strong>Phone:</strong> <?= $b['phone'] ?></p>
<p><strong>Appointment Date:</strong> <?= date('F j, Y', strtotime($b['date'])) ?></p>
<p><strong>Reason:</strong> <?= $b['reason'] ?></p>

<hr>

<p><strong>Doctor:</strong> <?= $b['doctor']['name'] ?></p>
<p><strong>Specialty:</strong> <?= $b['doctor']['specialty'] ?></p>

<a href="index.php" class="btn">Home</a>
