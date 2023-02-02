// Get the modal
let btn1 = document.getElementById("openEdit");
btn1.onclick =()=> {
  let modal = document.getElementById("myModal");
  if (modal.style.display == "block") {
    modal.style.display = "none";
  } else {
    modal.style.display = "block";
  }
};
// Get the <span> element that closes the modal
let span = document.getElementById("closeMe");
span.onclick = () => {
  document.getElementById("myModal").style.display = "none";
};
