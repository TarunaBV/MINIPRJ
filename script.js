document.getElementById('switchToSignUp').addEventListener('click', function() {
    document.getElementById('signin').style.display = 'none';
    document.getElementById('signup').style.display = 'block';
});

document.getElementById('switchToSignIn').addEventListener('click', function() {
    document.getElementById('signup').style.display = 'none';
    document.getElementById('signin').style.display = 'block';
});
