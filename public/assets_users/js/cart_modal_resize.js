var myModal = document.getElementById("addtocart");

if (myModal) {
    myModal.addEventListener("shown.bs.modal", function () {
        $(window).trigger("resize");
    });
}
