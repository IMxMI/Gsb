document.addEventListener("DOMContentLoaded", function () {

    var table = document.getElementById('mxtable');
    var tableLignes = document.getElementById('mxtable').children[1].children;
    var paginationSelect = document.getElementById("itemsPerPage");
    var selectionAll = document.getElementById("buttonSelectionAll");

    var itemsPage = 20; //Nombre d'éléments afficher par pages (20 de base).
    var page = 0; //Page actuelle (0 de base).
    var nbLignes = tableLignes.length; //nombre de TD dans le tableau.
    var maxPage = maxPageF(nbLignes, itemsPage); // Nombre de pages maximum.

    showItems();

    function ifSelectionPage(){
        nb = document.getElementsByClassName("visible").length;
        visible = document.getElementsByClassName("visible");
        cpt = 0;
        for (var i = 0; i < nb; i++) {
            if (visible[i].children[5].children[0].children[0].checked === true){
                cpt++;
            }
        }
        if(cpt === nb){
            selectionAll.classList.remove("active");
            selectionAll.innerHTML = "Tout désélectionner";
        }
        else{
            selectionAll.classList.add("active");
            selectionAll.innerHTML = "Tout sélectionner";
        }
    }

    document.getElementById("previous").addEventListener("click", function () {
        if (page > 0){
            page--;
            showItems();
        }
    });
    document.getElementById("next").addEventListener("click", function () {
        if (page < maxPage - 1){
            page++;
            showItems();
        }
    });


    selectionAll.addEventListener("click", function () {
        if(selectionAll.classList.contains("active")) {
            selectionnerAll();
        }
        else{
            deselectionnerAll();
        }
    });

    function selectionnerAll() {
        var elementsSelection = document.getElementsByClassName("visible");
        var cpt = 0;
        for (var i = 0; i < elementsSelection.length; i++) {
            elementsSelection[i].children[5].children[0].children[0].checked = true;
        }
        selectionAll.classList.remove("active");
        selectionAll.innerHTML = "Tout désélectionner";
    }

    function deselectionnerAll() {
        var elementsSelection = document.getElementsByClassName("visible");
        for (var i = 0; i < elementsSelection.length; i++) {
            elementsSelection[i].children[5].children[0].children[0].checked = false;
        }
        selectionAll.classList.add("active");
        selectionAll.innerHTML = "Tout sélectionner";
    }


    /*
     * @return integer nb page max
     */
    function maxPageF(nbLignes, itemsPage) {
        return Math.ceil(nbLignes / itemsPage);
    }

    paginationSelect.addEventListener("change", function () {
        paginationSelectChange();
    });

    function paginationSelectChange() {
        if (paginationSelect.value === 'All') {
            itemsPage = nbLignes;
            page=0;
        } else {
            itemsPage = parseInt(paginationSelect.value);
            page = 0;
        }
        maxPage = maxPageF(nbLignes, itemsPage);
        showItems();
    }

    /*
     * Affiche le nombre voulu  de lignes.
     */
    function showItems() {
        for (var i = 0; i < tableLignes.length; i++) {
            tableLignes[i].style.display = 'none';
            tableLignes[i].classList.remove("visible");
        }
        var startIndex = page * itemsPage;
        var endIndex = Math.min(startIndex + itemsPage, nbLignes);

        for (var i = startIndex; i < endIndex; i++) {
            tableLignes[i].style.display = '';
            tableLignes[i].classList.add("visible");
        }
        document.getElementById("page").innerHTML = page + 1;
        document.getElementById("maxPage").innerHTML = maxPage;
        paginationNav();
    }

    function paginationNav() {
        ifSelectionPage();
        if (page === 0) {
            document.getElementById("previous").classList.add("disabled");
        }
        else {
            document.getElementById("previous").classList.remove("disabled");
        }
        if (page === maxPage - 1) {
            document.getElementById("next").classList.add("disabled");
        }
        else {
            document.getElementById("next").classList.remove("disabled");
        }
    }

    document.getElementById("sendData").addEventListener("click", function () {
        miseEnPaiement();
    });
});