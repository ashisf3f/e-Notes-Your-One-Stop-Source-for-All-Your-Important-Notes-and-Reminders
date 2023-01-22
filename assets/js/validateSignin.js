window.onload = () => {
  // focuses the email input box on window loading
  document.getElementById("email").focus();
};

const validateSys = () => {
  let error = "";
  let showError = document.getElementById("passError");
  let email = document.getElementById("email").value;
  let password = document.getElementById("password").value;

  // check if the email is valid
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
    // check if the passowrd is at least 8 character or not
    if (password.length < 8) {
      error = "Password must be at least 8 character long";
      showError.innerHTML = error;
      document.getElementById("password").focus();
      return false;
    }
  } else {
    error = "Please enter a valid email";
    showError.innerHTML = error;
    document.getElementById("email").focus();
    return false;
  }
};
