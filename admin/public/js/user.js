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

const deleteUser = async (e) => {
  e.preventDefault();
  const url = e.target.action;
  const method = e.target.getAttribute("method");
  const currentLocation = window.location.href;

  const res = await fetch(url, { method });
  if (res.ok) {
    if (res.status === 204) {
      toast("Utilisateur supprimé 👍", "success");
      return setTimeout(() => window.location.href = currentLocation, 2000);
    }
  } else {
    console.error(res);
    errorHTTPRequest();
  }
};
