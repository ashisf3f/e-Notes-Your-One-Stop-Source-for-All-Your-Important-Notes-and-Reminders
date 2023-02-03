window.onload = () => {
  // focuses the email input box on window loading
  document.getElementById("email").focus();
};
const form = document.getElementById("signinForm");

form.addEventListener("submit", (event) => {
  let errorMessage = document.getElementById("errorMessage");
  event.preventDefault();

  let email = form.email.value;
  let password = form.password.value;

  // check if the email is valid
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
    const data = {
      email,
      password,
    };
    fetch("./signin", {
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
  } else {
    errorMessage.innerHTML = "Enter a valid email address";
    document.getElementById("email").focus();
  }
});
