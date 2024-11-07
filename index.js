document.querySelector('input[type="number"]').addEventListener('input', function (e) {
    if (this.value.length > 14) {
      this.value = this.value.slice(0, 14);
      alert("Please input numbers")
    }
  });