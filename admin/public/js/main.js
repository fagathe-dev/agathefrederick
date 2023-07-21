const dataHref = document.querySelectorAll("[data-href]");

if (dataHref) {
  dataHref.forEach((a) => {
    a.addEventListener(
      "click",
      (event) => (window.location = event.target.dataset.href)
    );
  });
}

const deleteUserButton = document.querySelectorAll("[data-user-delete]");
console.log({ deleteUserButton });

if (deleteUserButton) {
  deleteUserButton.forEach((u) => {
    u.addEventListener("click", (event) => {
      const button =
        event.target.tagName === "I" ? event.target.closest("a") : event.target;
      const url = button.href;
  
      
      alert("User deleted !");
    });
  });
}
