window.onload = () => {
  const storageKey = "menuItemsCollapsedState";
  const collapsibleItems = document.querySelectorAll(".collapsible");

  let menuState = JSON.parse(sessionStorage.getItem(storageKey));

  for (let i = 0; i < collapsibleItems.length; i++) {
    const item = collapsibleItems[i];

    const parentListItem = item.closest("li");
    const childList = parentListItem.querySelector(".nested-list");
    if (menuState !== null) {
      if (menuState?.[i]) {
        childList.classList.add("hidden");
        item.classList.add("rotate-90");
      } else {
        childList.classList.remove("hidden");
        item.classList.remove("rotate-90");
      }
    }

    item.addEventListener("click", () => {
      const parentListItem = item.closest("li");
      const childList = parentListItem.querySelector(".nested-list");
      item.classList.add("animate-rotate");
      childList.classList.toggle("hidden");
      item.classList.toggle("rotate-90");
      toggleSessionStorageState(i);
    });
  }

  const toggleSessionStorageState = (i) => {
    let currentState = sessionStorage.getItem(storageKey);
    if (!currentState) {
      currentState = Array.from(collapsibleItems).map((item) => {
        const parentListItem = item.closest("li");
        const childList = parentListItem.querySelector(".nested-list");
        return childList.classList.contains("hidden");
      });
    } else {
      currentState = JSON.parse(currentState);
      currentState[i] = !currentState[i];
    }
    sessionStorage.setItem(storageKey, JSON.stringify(currentState));
  };
};
