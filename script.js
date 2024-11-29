const switchToSignInButton = document.getElementById("switchToSignIn");
const switchToSignUpButton = document.getElementById("switchToSignUp");
const signinForm = document.getElementById("signin");
const signupForm = document.getElementById("signup");

switchToSignUpButton.addEventListener('click', function() {
    signinForm.style.display = "none";
    signupForm.style.display = "block";
});

switchToSignInButton.addEventListener('click', function() {
    signinForm.style.display = "block";
    signupForm.style.display = "none";
});
