const createPopup = document.querySelector(".create-popup");
const createContainer = document.querySelector(".create-container");
const createBtn = document.querySelector(".create");

createBtn.onclick = (event) => {
  createPopup.style.display = "grid";
};
createPopup.onclick = (event) => {
  let isClickInside = createContainer.contains(event.target);

  if (!isClickInside) {
    createPopup.style.display = "none";
  }
};
