document.addEventListener("DOMContentLoaded", function () {
    
    var table = document.getElementById('mxtable');
    var tableLignes = document.getElementById('mxtable').children[1].children;
    var paginationSelect = document.getElementById("itemsPerPage");
    
    var itemsPage = 20; //Nombre d'éléments afficher par pages (20 de base).
    var page = 0; //Page actuelle (0 de base).
    var nbLignes = tableLignes.length; //nombre de TD dans le tableau.
    var maxPage = maxPageF(nbLignes, itemsPage); // Nombre de pages maximum.
    
    showItems();
    
    /*
     * @return integer nb page max
     */
    function maxPageF(nbLignes, itemsPage) {
        return Math.ceil(nbLignes / itemsPage);
    }
    
    paginationSelect.addEventListener("change", function(){
        if(paginationSelect.value === 'All'){
            itemsPage = nbLignes;
        }
        else{
            itemsPage =  parseInt(paginationSelect.value);
        }
        maxPage = maxPageF(nbLignes, itemsPage);
        showItems();
    });
    
    /*
     * Affiche le nombre voulu  de lignes.
     */
    function showItems(){
        for(var i = 0; i < tableLignes.length; i++) {
            tableLignes[i].style.display = 'none';
        }
        var startIndex = page * itemsPage;
        var endIndex = Math.min(startIndex + itemsPage, nbLignes);
        
        for(var i = startIndex; i < endIndex; i++) {
            tableLignes[i].style.display = '';
        }
    }
    
    
    
    function miseEnPaiement() {
        var elementsSelection = document.getElementsByClassName("selection");
        var visiteurs = [];
        for (var i = 0; i < elementsSelection.length; i++) {
            var idVisiteur = elementsSelection[i].getAttribute("idlignevisiteur");
            var idMois = elementsSelection[i].getAttribute("idlignemois");
            var ligne = {
                idVisiteur: idVisiteur,
                idMois: idMois
            };
            elementsSelection[i].style.display = "none";
            visiteurs.push(ligne);
            totalNbFiches = totalNbFiches - cpt;
            cpt = 0;
        }

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/index.php?uc=suiviFicheFrais&action=miseEnPaiement", true);
        xhr.setRequestHeader("Content-Type", "application/json");
        var parametres = JSON.stringify(visiteurs);
        xhr.send(parametres);
    }
});