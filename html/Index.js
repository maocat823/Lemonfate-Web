function adjust_video() {
  video.style.height = `${video.clientWidth * 0.5625}px`;
}

function adjust_navigation() {
  if (window.scrollY < 100) {
    navigation.id = null;
  } else {
    navigation.id = "float";
  }
}

function create_token() {
  let time = new Date();
  time = (time.getTime() / 100);
  console.log(time);
}

function request(url, callback) {
  let request = new XMLHttpRequest();
  request.open("GET", url, true);
  request.setRequestHeader("Content-Type", "application/json");
  request.onreadystatechange = function () {
    if (request.readyState === 4) {
      if (request.status === 200) {
        console.log(request.responseText);
        callback(JSON.parse(request.responseText));
      } else {
        alert(`请求错误，请刷新页面重试！错误代码 ${request.status}`);
      }
    }
  };
  request.send();
}

function initialize() {
  function messages(response) {
    let container = document.querySelector(".messages");
    for (let info of response) {
      let player = document.createElement("span");
      let message = document.createElement("p");
      player.textContent = info["name"];
      message.textContent = info["message"];
      message.prepend(player);
      container.append(message);
    }
  }

  function sponsors(response) {
    let container = document.querySelector(".sponsors");
    for (let name of response) {
      let player = document.createElement("span");
      let head_image = document.createElement("img");
      player.textContent = name;
      head_image.src = `http://lemonfate.cn:8123/tiles/faces/32x32/${name}.png`;
      player.prepend(head_image);
      container.prepend(player);
    }
  }

  adjust_video();
  adjust_navigation();
  // request("http://127.0.0.1:8000/website/sponsors", sponsors);
  // request("http://127.0.0.1:8000/website/messages", messages);
}

const video = document.querySelector("iframe");
const navigation = document.querySelector("nav");

window.addEventListener("resize", adjust_video);
window.addEventListener("scroll", adjust_navigation);
initialize();
