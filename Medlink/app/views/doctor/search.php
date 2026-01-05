<h2 style="color:#0d6efd">Search Doctor</h2>

<form method="get" action="index.php" style="margin-bottom:20px;">
    <input type="hidden" name="c" value="doctor">
    <input type="hidden" name="a" value="search">

    <input
        type="text"
        name="q"
        id="searchInput"
        placeholder="Search by doctor name or specialty"
        value="<?= $keyword ?? '' ?>"
        style="padding:10px;width:100%;max-width:400px;"
    >
</form>

<div class="grid" id="doctorGrid">
<?php if (empty($doctors)): ?>
    <p>No doctors found.</p>
<?php endif; ?>

<?php foreach ($doctors as $doc): ?>
    <div class="card doctor-card">
        <h3><?= $doc['name'] ?></h3>
        <p><strong>Specialty:</strong> <?= $doc['specialty'] ?></p>
        <p><strong>Fee:</strong> ৳<?= $doc['fee'] ?></p>

       <form method="get" action="index.php" style="margin-bottom:8px;">
    <input type="hidden" name="c" value="doctor">
    <input type="hidden" name="a" value="profile">
    <input type="hidden" name="id" value="<?= $doc['id'] ?>">
    <button class="btn" type="submit">View Profile</button>
</form>

<form method="post" action="index.php?c=doctor&a=select">
    <input type="hidden" name="name" value="<?= $doc['name'] ?>">
    <input type="hidden" name="specialty" value="<?= $doc['specialty'] ?>">
    <input type="hidden" name="fee" value="<?= $doc['fee'] ?>">
    <button class="btn">Book Appointment</button>
</form>

    </div>
<?php endforeach; ?>
</div>

<script>
/* Client-side instant filter (UX only) */
document.getElementById("searchInput").addEventListener("keyup", function () {
    const value = this.value.toLowerCase();
    const cards = document.querySelectorAll(".doctor-card");

    cards.forEach(card => {
        const text = card.innerText.toLowerCase();
        card.style.display = text.includes(value) ? "block" : "none";
    });
});
</script>
