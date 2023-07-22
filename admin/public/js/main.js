const $ = (selector) => {
  const elements = Array.from(document.querySelectorAll(selector));
  if (elements.lenght === 0) {
    return undefined;
  }
  return elements.length === 1 ? elements[0] : elements;
};

const dataHref = $("[data-href]");

if (dataHref) {
  dataHref.forEach((a) => {
    a.addEventListener(
      "click",
      (event) => (window.location = event.target.dataset.href)
    );
  });
}

const deleteUserButton = $("[data-user-delete]");

if (deleteUserButton) {
  deleteUserButton.forEach((btn) => {
    btn.addEventListener("click", (event) => {
      const button =
        event.target.tagName === "I" ? event.target.closest("a") : event.target;
      const url = button.href;
      const form = $('[name="deleteUserForm"]');
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
