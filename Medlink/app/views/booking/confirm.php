<?php $doc = $_SESSION['doctor']; ?>

<div class="card form-card">
    <h3><?= $doc['name'] ?></h3>
    <p><strong>Specialty:</strong> <?= $doc['specialty'] ?></p>
    <p><strong>Consultation Fee:</strong> ৳<?= $doc['fee'] ?></p>

    <form method="post" action="index.php?c=booking&a=store">
        <input type="hidden" name="token" value="<?= Security::csrfToken() ?>">

        <label>Patient Name</label>
        <input name="patient" required>

        <label>Age</label>
        <input type="number" name="age" min="1" max="120" required>

        <label>Gender</label>
        <select name="gender" required>
            <option value="">Select</option>
            <option>Male</option>
            <option>Female</option>
            <option>Other</option>
        </select>

        <label>Phone Number</label>
        <input name="phone" placeholder="11-digit number" required>

        <label>Emergency Contact Number</label>
        <input name="emergency" placeholder="11-digit number" required>

        <label>Reason for Visit</label>
        <textarea name="reason" rows="3" required></textarea>

        <button class="btn">Confirm Booking</button>
    </form>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="success">
            <?= $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>
</div>
