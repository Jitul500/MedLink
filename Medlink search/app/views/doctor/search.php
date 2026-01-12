
<form method="get" action="index.php" style="margin-bottom:15px;">
    <input type="hidden" name="c" value="doctor">
    <input type="hidden" name="a" value="list">

    <input
        type="text"
        name="search"
        placeholder="Search by doctor name or specialty"
        style="padding:8px;width:60%;"
        value="<?= $_GET['search'] ?? '' ?>"
    >

    <button class="btn" type="submit">Search</button>

    <?php if (isset($_GET['search']) && $_GET['search'] != ""): ?>
    
    <a href="index.php" class="btn" style="text-decoration:none;">Home</a>
    <?php endif; ?>
</form>

<div class="grid">

<?php if (count($doctors) == 0): ?>
    <div class="card">
        <p style="color:red;text-align:center;">
            No doctor found
        </p>
    </div>
<?php endif; ?>

<?php foreach ($doctors as $d): ?>
<div class="card">
    <h3><?= $d['name'] ?></h3>
    <p><?= $d['specialty'] ?></p>

    <button class="btn" onclick="selectDoctor('<?= addslashes($d['name']) ?>', '<?= addslashes($d['specialty']) ?>', '<?= $d['fee'] ?? '0' ?>')">Book</button>
</div>
<?php endforeach; ?>

</div>

<script>
async function selectDoctor(name, specialty, fee) {
    try {
        const response = await fetch('index.php?c=doctor&a=select', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                name: name,
                specialty: specialty,
                fee: fee
            })
        });
        
        const result = await response.json();
        
        if (result.success) {
            window.location.href = result.redirect;
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        alert('An error occurred: ' + error.message);
    }
}
</script>
