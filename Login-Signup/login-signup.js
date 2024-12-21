document.getElementById('nationalID').addEventListener('input', function() {
    var nationalID = this.value;
    if (nationalID.length > 14) {
        this.value = nationalID.slice(0, 14);
    }
  });
  
  function signupValidate() {
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
  
  function loginValidate() {
    var nationalID = document.getElementById('nationalID').value;
  
    if (nationalID.length !== 14) {
        alert('National ID must be exactly 14 characters long.');
        return false;
    }
  
    return true;
  }
  
  
  