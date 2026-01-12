<h3>Appointment Booking</h3>

<div id="formMessage" style="display:none;padding:10px;margin-bottom:10px;border-radius:4px;"></div>

<form id="bookingForm" method="post"
      action="index.php?c=booking&a=store">

    <input type="hidden" id="token" name="token" value="<?= Security::csrfToken() ?>">

    <label>Patient Name</label><br>
    <input type="text" name="patient" placeholder="Enter patient name"><br><br>

    <label>Blood Group</label><br>
    <select name="blood">
        <option value="">Select Blood Group</option>
        <option>A+</option>
        <option>A-</option>
        <option>B+</option>
        <option>B-</option>
        <option>O+</option>
        <option>O-</option>
        <option>AB+</option>
        <option>AB-</option>
    </select><br><br>

    <label>Gender</label><br>
    <select name="gender">
        <option value="">Select Gender</option>
        <option>Male</option>
        <option>Female</option>
    </select><br><br>

    <label>Phone Number</label><br>
    <input type="text" name="phone" placeholder="Enter phone number"><br><br>

    <label>Appointment Date</label><br>
    <input type="date" name="date" required><br><br>

    <label>Reason for Appointment</label><br>
    <textarea name="reason" placeholder="Describe your problem"></textarea><br><br>

    <button type="submit" class="btn">Confirm Booking</button>

</form>

<script>
document.getElementById('bookingForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    if (!validateBooking()) return;
    
    const formData = new FormData(this);
    const data = {
        patient: formData.get('patient'),
        blood: formData.get('blood'),
        gender: formData.get('gender'),
        phone: formData.get('phone'),
        date: formData.get('date'),
        reason: formData.get('reason'),
        token: formData.get('token')
    };
    
    try {
        const response = await fetch('index.php?c=booking&a=store', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        
        if (result.success) {
            showMessage('Booking confirmed successfully!', 'success');
            setTimeout(() => {
                window.location.href = result.redirect;
            }, 1500);
        } else {
            showMessage(result.message, 'error');
        }
    } catch (error) {
        showMessage('An error occurred: ' + error.message, 'error');
    }
});

function showMessage(msg, type) {
    const messageDiv = document.getElementById('formMessage');
    messageDiv.textContent = msg;
    messageDiv.style.display = 'block';
    messageDiv.style.backgroundColor = type === 'success' ? '#d4edda' : '#f8d7da';
    messageDiv.style.color = type === 'success' ? '#155724' : '#721c24';
    messageDiv.style.borderColor = type === 'success' ? '#c3e6cb' : '#f5c6cb';
}
</script>
