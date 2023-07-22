class ScrollTopComponent {
  constructor(options = {}) {
    this.options = options;
    this.display();
  }

  display() {
    let button, iconClass;
    let iconContainer = document.createElement("i");

    if (this.options.hasOwnProperty("container")) {
      button = document.querySelector(this.options.container);
    } else {
      button = document.createElement("div");
    }

    button.classList = this.options.customClass ?? "scrollTop";
    button.id = this.options.customId ?? "scrollTop";

    iconContainer.classList =
      this.options.customIconClass ?? "bi bi-arrow-up-short";

    if (
      this.options.hasOwnProperty("attr") &&
      typeof this.options.attr === "object"
    ) {
      for (const key in this.object.attr) {
        if (this.options.attr.hasOwnProperty(key)) {
          button.setAttribute(key, this.options.attr[key]);
        }
      }
    }

    button.appendChild(iconContainer);
    button.setAttribute("onclick", "scrollToTop(event);");
    document.body.setAttribute(
      "onscroll",
      `displayScrollTop(event, '#${button.id}');`
    );
    return document.body.insertAdjacentElement("beforeend", button);
  }
}

const displayScrollTop = (event, element) => {
  const limitY = window.innerHeight * 1.6;
  const button = $(element);
  const offsetPageY = window.scrollY;
  const header = $("header");

  if (window.location.pathname === "/") {
    if (offsetPageY > 60) {
      header.style.position = "fixed";
      header.style.top = "0";
      header.style.left = "0";
    } else {
      header.style.position = "unset";
      header.style.top = "0";
      header.style.left = "0";
    }
  }

  if (button === undefined || button === null) {
    return;
  }

  if (offsetPageY < limitY) {
    button.style.opacity = 0;
    return (button.style.display = "none");
  }

  button.style.opacity = 1;
  return (button.style.display = "flex");
};

const scrollToTop = (event) => {
  window.scrollTo({ top: 0, behavior: "smooth" });
};

window.onload = () => new ScrollTopComponent({ customClass: "scrollTop" });
