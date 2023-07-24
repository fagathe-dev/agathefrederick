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
