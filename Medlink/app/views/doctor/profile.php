<div class="card form-card">

    <img
        src="/Medlink/public/images/<?= $doctor['photo'] ?>"
        alt="Doctor Photo"
        style="width:150px;border-radius:50%;display:block;margin:0 auto 15px;"
    >

    <h3 style="text-align:center;color:#0d6efd">
        <?= $doctor['name'] ?>
    </h3>

    <p><strong>Specialty:</strong> <?= $doctor['specialty'] ?></p>
    <p><strong>Qualification:</strong> <?= $doctor['qualification'] ?></p>
    <p><strong>Experience:</strong> <?= $doctor['experience'] ?></p>
    <p><strong>Consultation Fee:</strong> ৳<?= $doctor['fee'] ?></p>

    <form method="post" action="index.php?c=doctor&a=select">
        <input type="hidden" name="name" value="<?= $doctor['name'] ?>">
        <input type="hidden" name="specialty" value="<?= $doctor['specialty'] ?>">
        <input type="hidden" name="fee" value="<?= $doctor['fee'] ?>">
        <button class="btn">Book Appointment</button>
    </form>

    <a href="index.php" class="btn" style="text-decoration:none;text-align:center;display:block;">
        Back to Doctor List
    </a>

</div>
