var modals = document.querySelectorAll(".modal");
var openModalBtns = document.querySelectorAll(".modal-open");

function openModal(modalId) {
    var modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = "block";
    }
}

function closeModal(modalId) {
    var modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = "none";
    }
}

openModalBtns.forEach(function (btn) {
    btn.addEventListener("click", function () {
        var modalId = btn.getAttribute("data-modal");
        openModal(modalId);
    });
});

modals.forEach(function (modal) {
    var closeBtn = modal.querySelector(".close");
    if (closeBtn) {
        closeBtn.addEventListener("click", function () {
            var modalId = modal.id;
            closeModal(modalId);
        });
    }
});

window.addEventListener("click", function (event) {
    modals.forEach(function (modal) {
        if (event.target === modal) {
            var modalId = modal.id;
            closeModal(modalId);
        }
    });
});
