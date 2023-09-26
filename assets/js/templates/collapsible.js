window.onload = () => {
  const collapsibleItems = document.querySelectorAll(".collapsible");

  console.log("ITEMS", collapsibleItems);

  for (const item of collapsibleItems) {
    item.addEventListener("click", () => {
      const parentListItem = item.closest("li");
      const childList = parentListItem.querySelector(".nested-list");
      childList.classList.toggle("hidden");
    });
  }
};
