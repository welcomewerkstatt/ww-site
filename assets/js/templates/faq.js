const detailElements = document.querySelectorAll(".faq details");
const button = document
  .querySelector("#toggleDetailsButton");

button.addEventListener("click", toggleDetails);

let allDetailsVisible = false;
const captions = ["Alle aufklappen", "Alle einklappen"];

function toggleDetails() {
  allDetailsVisible = !allDetailsVisible;
  detailElements.forEach((element) => (element.open = allDetailsVisible));
  button.innerHTML = captions[allDetailsVisible ? 1 : 0];
}
