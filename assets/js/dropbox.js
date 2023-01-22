const showDrop=()=> {
  let courses = document.getElementById("drop_list");
    if (courses.style.display == "block") {
        courses.style.display = "none";
    } else {
        courses.style.display = "block";
    }
}
