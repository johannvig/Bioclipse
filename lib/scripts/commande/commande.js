function save_pdf(){
    // Cacher le bouton
    document.getElementById('saveButton').style.display = 'none';
    document.getElementById('accueil').style.display = 'none';
    window.print();
    // Optionnel: réafficher le bouton après l'impression
    // Vous pouvez choisir de le garder caché si vous ne voulez pas qu'il réapparaisse
    document.getElementById('saveButton').style.display = 'block';
    document.getElementById('accueil').style.display = 'block';
}
