const fetchData = () => {
  fetch("./fetchposts", {
    method: "POST",
  })
    .then((response) => response.json())
    .then((data) => {
      // compare the new data with the old data
      if (JSON.stringify(data) !== JSON.stringify(oldData)) {
        // update the oldData with the new data
        oldData = data;
        let postContainer = document.getElementById("postContainer");
        postContainer.innerHTML = "";
        data.posts_data.forEach((post) => {
          let email = post.email;
          let postData = data.user_data?.find((user) => user.email === email);
          let imgLoc =
            postData.img_name === null
              ? "./assets/img/customer-80.png"
              : "./backend/uploads/" + postData.img_name;
          let postElement = document.createElement("div");
          postElement.classList.add("post");
          postElement.innerHTML = `
            <div class="post-info">
              <div class="auth-pic">
                <img src="${imgLoc}" alt="" />
                <div class="auth-details">
                  <form action="./profile" method="get">
                    <input type="hidden" name="id" value="${postData.user_id}">
                    <span class="auth-name">
                      <input type="submit" name="author" value="${post.author}" />
                    </span>
                  </form>
                  <div class="post-time">${post.date}</div>
                </div>
              </div>
              <div class="post-manager">
                <div class="dwnld">
                  <a href="downloadpost?${post.post_id}">
                    <i class='fa-solid fa-cloud-arrow-down' id='downloadButton'></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="auth-title">
              ${post.title}
            </div>
            <div class="auth-post">
              ${post.postDet}
            </div>
          `;
          postContainer.appendChild(postElement);
        });
      }
      setTimeout(fetchData, 2000);
    });
};

let oldData;
fetchData();
