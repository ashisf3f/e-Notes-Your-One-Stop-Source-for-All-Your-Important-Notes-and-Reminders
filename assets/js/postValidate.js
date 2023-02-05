const regExp = new RegExp("^[a-zA-Z0-9 ]+$");
const form = document.getElementById("myForm");
let showNot = document.getElementById("notInfo");
let notMsg = document.getElementById("notMsg");
let symbol = document.getElementById("notSymbol");
let box = document.getElementById("notBox");
let close = document.getElementById("notClose");

function resetNotification() {
  showNot.style.display = "none";
  notMsg.innerHTML = "";
  symbol.style.color = "";
  symbol.classList.remove("fa-circle-exclamation", "fa-circle-check");
  box.style.backgroundColor = "";
}

form.addEventListener("submit", (event) => {
  event.preventDefault();
  let postTitle = form.postTitle.value;
  let postDetails = form.postDetails.value;

  if (!postTitle) {
    resetNotification();
    showNot.style.display = "block";
    error = "Empty title";
    notMsg.innerHTML = error;
    symbol.style.color = "red";
    symbol.classList.add("fa-circle-exclamation");
    document.getElementById("postTitle").focus();
    setTimeout(resetNotification, 2000);
  } else if (!postDetails) {
    resetNotification();
    error = "no any post details";
    showNot.style.display = "block";
    notMsg.innerHTML = error;
    symbol.style.color = "red";
    symbol.classList.add("fa-circle-exclamation");
    document.getElementById("postDetails").focus();
    setTimeout(resetNotification, 2000);
  } else if (!regExp.test(postTitle)) {
    resetNotification();
    error = "Only alphabets and numbers are allowed in title.";
    showNot.style.display = "block";
    notMsg.innerHTML = error;
    symbol.style.color = "red";
    symbol.classList.add("fa-circle-exclamation");
    document.getElementById("postTitle").focus();
    setTimeout(resetNotification, 2000);
  } else if (postTitle.length > 48) {
    resetNotification();
    error = "Title should be short and sweet! (48 characters)";
    showNot.style.display = "block";
    notMsg.innerHTML = error;
    symbol.style.color = "red";
    symbol.classList.add("fa-circle-exclamation");
    document.getElementById("postTitle").focus();
    setTimeout(resetNotification, 2000);
  } else if (postDetails.length > 420) {
    resetNotification();
    error = "Your description is too long shorten abit!";
    showNot.style.display = "block";
    notMsg.innerHTML = error;
    symbol.style.color = "red";
    symbol.classList.add("fa-circle-exclamation");
    document.getElementById("postDetails").focus();
    setTimeout(resetNotification, 2000);
  } else {
    const data = {
      postTitle,
      postDetails,
    };
    fetch("./uploadPost", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    })
      .then((response) => {
        if (
          // check if the data received header is valid or not
          response.headers.get("Content-Type").indexOf("application/json") ===
          -1
        ) {
          throw new Error("invalid header");
        }
        return response.json();
      })
      .then((data) => {
        if (data.success) {
          resetNotification();
          showNot.style.display = "block";
          box.style.backgroundColor = "#4BB543";
          notMsg.innerHTML = data.success;
          symbol.style.color = "skyblue";
          symbol.classList.add("fa-circle-check");
          setTimeout(resetNotification, 2000); // call the function after 2 seconds
          event.target.reset();
        }
        if (data.error) {
          resetNotification();
          showNot.style.display = "block";
          box.style.backgroundColor = "#ff0e0e";
          notMsg.innerHTML = data.error;
          symbol.style.color = "white";
          symbol.classList.add("fa-circle-exclamation");
          setTimeout(resetNotification, 2000);
        }
      });
  }
});

const form1 = document.getElementById("myFormModal");

form1.addEventListener("submit", (event) => {
  event.preventDefault();
  let postTitle = form1.postTitle1.value;
  let postDetails = form1.postDetails1.value;

  if (!postTitle) {
    resetNotification();
    showNot.style.display = "block";
    error = "Empty title";
    notMsg.innerHTML = error;
    symbol.style.color = "red";
    symbol.classList.add("fa-circle-exclamation");
    document.getElementById("postTitle1").focus();
    setTimeout(resetNotification, 2000);
  } else if (!postDetails) {
    resetNotification();
    error = "no any post details";
    showNot.style.display = "block";
    notMsg.innerHTML = error;
    symbol.style.color = "red";
    symbol.classList.add("fa-circle-exclamation");
    document.getElementById("postDetails1").focus();
    setTimeout(resetNotification, 2000);
  } else if (!regExp.test(postTitle)) {
    resetNotification();
    error = "Only alphabets and numbers are allowed in title.";
    showNot.style.display = "block";
    notMsg.innerHTML = error;
    symbol.style.color = "red";
    symbol.classList.add("fa-circle-exclamation");
    document.getElementById("postTitle1").focus();
    setTimeout(resetNotification, 2000);
  } else if (postTitle.length > 48) {
    resetNotification();
    error = "Title should be short and sweet! (48 characters)";
    showNot.style.display = "block";
    notMsg.innerHTML = error;
    symbol.style.color = "red";
    symbol.classList.add("fa-circle-exclamation");
    document.getElementById("postTitle1").focus();
    setTimeout(resetNotification, 2000);
  } else if (postDetails.length > 420) {
    resetNotification();
    error = "Your description is too long shorten abit!";
    showNot.style.display = "block";
    notMsg.innerHTML = error;
    symbol.style.color = "red";
    symbol.classList.add("fa-circle-exclamation");
    document.getElementById("postDetails1").focus();
    setTimeout(resetNotification, 2000);
  } else {
    const data = {
      postTitle,
      postDetails,
    };
    fetch("./uploadPost", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    })
      .then((response) => {
        if (
          // check if the data received header is valid or not
          response.headers.get("Content-Type").indexOf("application/json") ===
          -1
        ) {
          throw new Error("invalid header");
        }
        return response.json();
      })
      .then((data) => {
        if (data.success) {
          resetNotification();
          showNot.style.display = "block";
          box.style.backgroundColor = "#4BB543";
          notMsg.innerHTML = data.success;
          symbol.style.color = "skyblue";
          symbol.classList.add("fa-circle-check");
          document.getElementById("myModal").style.display = "none";
          setTimeout(resetNotification, 2000); // call the function after 2 seconds
        }
        if (data.error) {
          resetNotification();
          showNot.style.display = "block";
          box.style.backgroundColor = "#ff0e0e";
          notMsg.innerHTML = data.error;
          symbol.style.color = "white";
          symbol.classList.add("fa-circle-exclamation");
          setTimeout(resetNotification, 2000);
        }
      });
  }
});

// for auto dismissal of notificaiton
close.onclick = () => {
  showNot.style.display = "none";
};
