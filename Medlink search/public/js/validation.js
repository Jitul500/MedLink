
function validateForm() {
    let name = document.querySelector("[name=patient]").value;
    if (name.trim().length < 3) {
        alert("Name must be at least 3 characters long");
        return false;
    }
    return true;
}
function validateBooking() {

    let fields = ["patient", "blood", "gender", "phone", "reason"];

    for (let f of fields) {
        let value = document.querySelector("[name="+f+"]").value;
        if (value.trim() === "") {
            alert("Please fill all fields");
            return false;
        }
    }
    return true;
}
function limitPhone(input) {
    // Remove non-numeric characters
    input.value = input.value.replace(/[^0-9]/g, '');
    
    // Limit to 11 digits
    if (input.value.length > 11) {
        input.value = input.value.slice(0, 11);
    }
}

// Validate booking form with detailed checks
function validateBooking() {

    let patient = document.querySelector("[name=patient]").value;
    let blood = document.querySelector("[name=blood]").value;
    let gender = document.querySelector("[name=gender]").value;
    let phone = document.querySelector("[name=phone]").value;
    let reason = document.querySelector("[name=reason]").value;

    // Validate patient name
    if (patient.trim().length < 3) {
        alert("Patient name must be at least 3 characters long");
        return false;
    }

    // Validate blood group
    if (blood === "") {
        alert("Please select blood group");
        return false;
    }

    // Validate gender
    if (gender === "") {
        alert("Please select gender");
        return false;
    }

    // Validate phone number
    if (phone.trim() === "") {
        alert("Please enter phone number");
        return false;
    }

    if (isNaN(phone) || phone.trim().length !== 11) {
        alert("Phone number must be exactly 11 digits and numeric only");
        return false;
    }

    // Validate reason
    if (reason.trim().length < 5) {
        alert("Please provide a detailed reason (at least 5 characters)");
        return false;
    }

    return true;
}
