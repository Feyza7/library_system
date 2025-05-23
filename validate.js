function validateForm() {
    const email = document.querySelector("input[name='email']").value;
    const password = document.querySelector("input[name='password']").value;

    const emailRegex = /\S+@\S+\.\S+/;
    if (!emailRegex.test(email)) {
        alert("Please enter a valid email.");
        return false;
    }

    if (password.length < 6) {
        alert("Password must be at least 6 characters.");
        return false;
    }

    return true;
}
