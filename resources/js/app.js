import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

//psw validation
document.getElementById('registerForm').addEventListener('submit', function(event) {
    // Reset error messages
    document.getElementById('passwordError').textContent = '';

    // Get form values
    const password = document.getElementById('password').value;
    const passwordConfirm = document.getElementById('password-confirm').value;

    var isValid = true;

    // Validate password
    if (password !== passwordConfirm) {
        isValid = false;
        document.getElementById('passwordError').textContent = 'There\'s no match between these passwords, try again';
    }

    // If the form is not valid, prevent submission
    if (!isValid) {
        event.preventDefault();
    }
});
