// Quand l'utilisateur clique n'importe où en dehors des pop-ups, les ferme
window.addEventListener("click", function (event) {
  if (event.target == document.getElementById("myModalStatut")) {
    document.getElementById("myModalStatut").style.display = "none";
  }
});

window.addEventListener("DOMContentLoaded", (event) => {
  document.querySelectorAll(".myBtnStatut").forEach(function (btn) {
    btn.addEventListener("click", function (event) {
      event.preventDefault();
      var commandId = this.getAttribute("id");
      document.getElementById("commandIdInput").value = commandId;
      var modalStatut = document.getElementById("myModalStatut");

      document.getElementById("statusChangePrompt").textContent =
        "Changer le statut de la commande n° " + commandId;
      modalStatut.style.display = "block";
      console.log(modalStatut);
    });
  });
});
