window.onload = () => {
  // focuses the email input box on window loading
  document.getElementById("email").focus();
};
const validateMe = () => {
  // validate the form using return type()
  let error = "";
  let showError = document.getElementById("passError");
  // gathering the required value from input box to validate the form
  let email = document.forms["myForm"]["email"].value;
  let username = document.forms["myForm"]["username"].value;
  let password = document.forms["myForm"]["password"].value;
  let confPassword = document.forms["myForm"]["password1"].value;
  if (!email) {
    //check if empty email
    error = "Empty Email";
    showError.innerHTML = error;
    document.getElementById("email").focus();
    return false;
  } else if (!username) {
    //check if username is empty or not
    error = "Empty username";
    showError.innerHTML = error;
    document.getElementById("username").focus();
    return false;
  }
  // for password
  else if (!password) {
    //check if password field is empty or not
    error = "Password must be filled out";
    showError.innerHTML = error;
    return false;
  } else if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
    if (password.length < 8) {
      // check if the password is greater than six character or not
      error = "Password must be at least 8 character";
      document.getElementById("password").focus();
      showError.innerHTML = error;
      return false;
    } else if (password !== confPassword) {
      error = "Password didn`t match";
      document.getElementById("password1").focus();
      showError.innerHTML = error;
      return false;
    }
  } else {
    error = "Invalid email address";
    document.getElementById("email").focus();
    showError.innerHTML = error;
    return false;
  }
};
