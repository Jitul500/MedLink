<h2 style="color:#0d6efd">Available Doctors</h2>

<div class="grid">
<?php foreach ($doctors as $doc): ?>
    <div class="card">
        <h3><?= $doc['name'] ?></h3>
        <p><strong>Specialty:</strong> <?= $doc['specialty'] ?></p>
        <p><strong>Fee:</strong> ৳<?= $doc['fee'] ?></p>

        <form method="post" action="index.php?c=doctor&a=select">
            <input type="hidden" name="name" value="<?= $doc['name'] ?>">
            <input type="hidden" name="specialty" value="<?= $doc['specialty'] ?>">
            <input type="hidden" name="fee" value="<?= $doc['fee'] ?>">
            <button class="btn">Book Appointment</button>
        </form>
    </div>
<?php endforeach; ?>
</div>
