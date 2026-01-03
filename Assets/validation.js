function validateRegister() {
    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();
    
    if(name === "" || email === "" || password === ""){
        alert("All fields are required!");
        return false;
    }
    if(password.length < 4){
        alert("Password must be at least 4 characters");
        return false;
    }
    if(!email.includes("@")){
        alert("Enter a valid email!");
        return false;
    }
    return true;
}

function validateLogin() {
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();
    if(email === "" || password === ""){
        alert("Email and Password required!");
        return false;
    }
    return true;
}
