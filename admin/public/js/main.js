const dataHref = document.querySelectorAll("[data-href]");

if (dataHref) {
  dataHref.forEach((a) => {
    a.addEventListener('click', (event) => window.location = event.target.dataset.href)
  });
}
