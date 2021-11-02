var isPopup = false;

function popupModal() {
  let modal = document.getElementById("modal");
  if (!isPopup) {
    modal.classList.remove("hidden");
    isPopup = true;
  } else {
    modal.classList.add("hidden");
    isPopup = false;
  }
}

var step = 1;
function changeStep() {
  let step1 = document.querySelectorAll(".chooseImg");
  let step2 = document.getElementById("previewImg");
  if (step == 2) {
    step1.forEach((element) => {
      element.classList.remove("hidden");
    });
    step2.classList.add("hidden");
    step = 1;
  } else {
    step1.forEach((element) => {
      element.classList.add("hidden");
    });
    step2.classList.remove("hidden");
    step = 2;
  }
}

function displayImage(e) {
  changeStep();
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      document
        .querySelector("#profileDisplay")
        .setAttribute("src", e.target.result);
    };
    reader.readAsDataURL(e.files[0]);
  }
}

function onSubmit(event) {
  let file = document.getElementById("profileImg").files[0];
  if (file) {
    let formData = new FormData();
    formData.append("profileImg", file);

    let ajax = new XMLHttpRequest();
    ajax.open("POST", "upload.php", true);
    ajax.send(formData);

    ajax.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        document.getElementById("profileImg").value = null;
        popupModal();
        changeStep();
        document
          .getElementById("profileDisplay")
          .setAttribute("src", "./asset/default.png");
      }
    };
  }

  return false;
}
