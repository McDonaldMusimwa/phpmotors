function myFunction() {
  let x = document.getElementById('clientPassword');
  if (x.type === 'password') {
    x.type = 'text';
  } else {
    x.type = 'password';
  }
}
