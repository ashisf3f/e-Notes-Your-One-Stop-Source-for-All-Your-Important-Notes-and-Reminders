const regExp = new RegExp("^[a-zA-Z0-9 ]+$");
const postValidate = () => {
  let error = "";
  let postTitle = document.getElementById("postTitle").value;
  let postDetails = document.getElementById("postDet").value;

  if (!postTitle) {
    error = "Empty title";
    alert(`${error}`);
    document.getElementById("postTitle").focus();
    return false;
    // postTitle.focus();
  } else if (!postDetails) {
    error = "no any post details";
    alert(`${error}`);
    document.getElementById("postDet").focus();
    return false;
  } else if (!regExp.test(postTitle)) {
    error = "Only alphabets and numbers are allowed in title.";
    alert(`${error}`);
    document.getElementById("postTitle").focus();
    return false;
  } else if (postTitle.length > 30) {
    error = "Title should be short and sweet!";
    alert(`${error}`);
    document.getElementById("postTitle").focus();
    return false;
  }
};

const postValidate1 = () => {
  let error = "";
  let postTitle1 = document.getElementById("postTitle1").value;
  let postDetails1 = document.getElementById("postDet1").value;

  if (!postTitle1) {
    error = "Empty title";
    alert(`${error}`);
    document.getElementById("postTitle1").focus();
    return false;
    // postTitle1.focus();
  } else if (!postDetails1) {
    error = "no any post details";
    alert(`${error}`);
    document.getElementById("postDet1").focus();
    return false;
  } else if (!regExp.test(postTitle1)) {
    error = "Only alphabets and numbers are allowed in title.";
    alert(`${error}`);
    document.getElementById("postTitle1").focus();
    return false;
  } else if (postTitle1.length > 30)   {
    error = "Title should be short and sweet!";
    alert(`${error}`);
    document.getElementById("postTitle1").focus();
    return false;
  }
};
