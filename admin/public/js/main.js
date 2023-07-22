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

if (deleteUserButton) {
  deleteUserButton.forEach((u) => {
    u.addEventListener("click", (event) => {
      const button =
        event.target.tagName === "I" ? event.target.closest("a") : event.target;
      const url = button.href;
      const form = document.querySelector('[name="deleteUserForm"]');
      form.action = url;
    });
  });
}

const deleteUser = (e) => {
  e.preventDefault();
  const url = e.target.action;
  const method = e.target.getAttribute("method");
  const currentLocation = window.location.href;

  // try {
    
  // } catch (error) {
  //   toaster
  // }
  
};
