document.addEventListener("DOMContentLoaded", function() {
    var boutonVoirGroupe = document.getElementById("groupe");
    var bandeDroite = document.getElementById("bandeDroite");

    boutonVoirGroupe.addEventListener("click", function() {
        if (bandeDroite.classList.contains("bande-cachee")) {
            bandeDroite.classList.remove("bande-cachee");
            bandeDroite.classList.add("bande-affichee");
        } else {
            bandeDroite.classList.remove("bande-affichee");
            bandeDroite.classList.add("bande-cachee");
        }
    });
});
