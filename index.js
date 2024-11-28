$(document).ready(function(){
    $('.slider-image').on('click', function(){
        $('.slider-image').removeClass('active');
        $(this).addClass('active');
    });
});

document.getElementById('nationalID').addEventListener('input', function() {
    var nationalID = this.value;
    if (nationalID.length > 14) {
        this.value = nationalID.slice(0, 14);
    }
});

function validateForm() {
    var nationalID = document.getElementById('nationalID').value;
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirm-password').value;

    if (nationalID.length !== 14) {
        alert('National ID must be exactly 14 characters long.');
        return false;
    }

    if (password !== confirmPassword) {
        alert('Passwords do not match.');
        return false;
    }

    return true;
}