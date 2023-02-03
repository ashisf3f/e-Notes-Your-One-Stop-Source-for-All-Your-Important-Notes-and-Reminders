window.onload = () => {
  // focuses the email input box on window loading
  document.getElementById("email").focus();
};
const form = document.getElementById("myForm");

form.addEventListener("submit", (event) => {
  event.preventDefault();
  let errorMessage = document.getElementById("errorMessage");
  let error = "";

  // gathering the required value from input box to validate the form
  let email = form.email.value;
  let username = form.username.value;
  let password = form.password.value;
  let password1 = form.password1.value;

  if (!email) {
    //check if empty email
    error = "Empty Email";
    errorMessage.innerHTML = error;
    document.getElementById("email").focus();
  } else if (!username) {
    //check if username is empty or not
    error = "Empty username";
    errorMessage.innerHTML = error;
    document.getElementById("username").focus();
  }
  // for password
  else if (!password) {
    //check if password field is empty or not
    error = "Password must be filled out";
    errorMessage.innerHTML = error;
  } else if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
    if (password.length < 8) {
      // check if the password is greater than six character or not
      error = "Password must be at least 8 character";
      document.getElementById("password").focus();
      errorMessage.innerHTML = error;
    } else if (password !== password1) {
      error = "Password didn`t match";
      errorMessage.innerHTML = "Password didn`t match";
      document.getElementById("password1").focus();
    } else {
      const data = {
        email,
        username,
        password,
        password1,
      };
      fetch("./signup", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      })
        .then((response) => {
          if (
            // check if the data received header is valid or not
            response.headers.get("Content-Type").indexOf("application/json") !==
            -1
          ) {
            return response.json();
          }
        })
        .then((data) => {
          // process the response
          if (data.error) {
            errorMessage.innerHTML = data.error;
          }
          if (data.redirect) {
            window.location.href = "../";
          }
        });
    }
  } else {
    errorMessage.innerHTML = "Enter a valid email address";
    document.getElementById("email").focus();
  }
});
