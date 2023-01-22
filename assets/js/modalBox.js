// Get the modal
let modal = document.getElementById("myModal");

// Get the button that opens the modal
let btn1 = document.getElementById("mobBtn");

// Get the <span> element that closes the modal
let span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal

btn1.onclick =()=>{
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }

span.onclick = function () {
  let err = "";
  let formVal1 = document.getElementById("postTitle1").value;
  let formVal2 = document.getElementById("postDet1").value;
  if (formVal1.length > 1 || formVal2.length > 1) {
    if(window.close()){
      alert("are you sure you want to close?");
    }
    if (formVal1.length > 1) {
      err = "title";
      document.getElementById("postTitle1").focus();
    }
     if (formVal2.length > 1) {
      err = "post";
      document.getElementById("postDet1").focus();
    }
  
    alert(`Clear ${err} Box`);
  } else {
    modal.style.display = "none";
  }
};
}

// When the user clicks anywhere outside of the modal, close it

