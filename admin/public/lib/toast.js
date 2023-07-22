const toast = (message = "", type = "danger", autohide = true) => {
  const style = `
        style="
            position: fixed!important;
            bottom: 20px;
            right: 20px;
            z-index: 100;
        "
    `;
  const toast = `
    <div 
        class="toast align-items-center text-white bg-${type} border-0 show" 
        ${style} 
        role="alert" 
        aria-live="assertive" 
        aria-atomic="true" 
        data-bs-autohide="${autohide}"
    >
        <div class="d-flex">
            <div class="toast-body">
                ${message}
            </div>
            <button 
                type="button" 
                class="btn-close btn-close-white me-2 m-auto" 
                data-bs-dismiss="toast" 
                aria-label="Close"
            ></button>
        </div>
    </div>
    `;

  return document.body.insertAdjacentHTML("beforeend", toast);
};
