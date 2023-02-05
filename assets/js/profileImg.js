let showBox = document.getElementById("showEditBox");
showBox.onclick = () => {
  let modal = document.getElementById("myBoxedit");
  if (modal.style.display == "block") {
    modal.style.display = "none";
  } else {
    modal.style.display = "block";
  }
};

let closebtn = document.getElementById("boxClose");
closebtn.onclick = () => {
  document.getElementById("myBoxedit").style.display = "none";
};
const closeModal = () => {
  document.getElementById("myBoxedit").style.display = "none";
};
