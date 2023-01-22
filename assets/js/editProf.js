// Get the modal
let modal = document.getElementById("myModal");

// Get the button that opens the modal
let btn1 = document.getElementById("editp");

// Get the <span> element that closes the modal
let span = document.getElementById("closeMe");
// When the user clicks the button, open the modal

btn1.onclick = () => {
  modal.style.display = "block";
};

span.onclick = () => {
  modal.style.display = "none";
};
// When the user clicks on <span> (x), close the modal

// const validateProfile = () => {
//   let error = "";
//   let fb = document.getElementById("facebook").value;
//   let ig = document.getElementById("instagram").value;
//   let tweet = document.getElementById("twitter").value;
//   let showError = document.getElementById("formError");

//   if (!fb) {
//     error = "Empty facebook field";
//     document.getElementById("facebook").focus();
//     showError.innerHTML = error;
//     return false;
//   } else if (!ig) {
//     error = "Empty instagram field";
//     document.getElementById("instagram").focus();
//     showError.innerHTML = error;
//     return false;
//   } else if (!tweet) {
//     error = "Empty twitter field";
//     document.getElementById("twitter").focus();
//     showError.innerHTML = error;
//     return false;
//   }
// };
