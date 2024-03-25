document.addEventListener("DOMContentLoaded", function () {
    
    //Pagination
    var itemsPerPage = 20; // Nombre d'éléments par page
    var currentPage = document.getElementById('itemsPerPage').value; // Page actuelle

    var rowsTable = document.querySelectorAll('table tbody tr');
    var maxRows = rowsTable.length / itemsPerPage;
    
    showItems();
    
    //Tableau
    var button = document.getElementById('buttonSelectionAll');
    button.addEventListener("click", buttonControl);

    var sendData = document.getElementById("sendData");
    sendData.addEventListener("click", miseEnPaiement);
    sendData.style.display = "none";

    var totalNbFiches = document.getElementById('card-info').getAttribute("totalMontant");

    var cpt = 0;
    var totalMV = 0;

    function buttonControl() {
        var button = document.getElementById('buttonSelectionAll');
        if (button.classList.contains('selectionner')) {
            button.classList.remove('selectionner');
            button.innerHTML = 'Tout sélectionner';
            deSelect();
        } else {
            button.classList.add('selectionner');
            button.innerHTML = 'Tout désélectionner';
            selects();
        }
    }

    function mettreAJourMontantValide(row, isChecked) {
        var montantValide = parseFloat(row.querySelector("td:nth-child(5)").innerText);
        if (isChecked) {
            totalMV += montantValide;
            cpt++;
            sendData.style.display = "block";
        } else {
            totalMV -= montantValide;
            cpt--;
            if (cpt <= 0) {
                sendData.style.display = "none";
                totalMV = 0;
            }
        }
    }

    var checkboxes = document.querySelectorAll('.Checkbox');
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener("change", function () {
            var row = this.closest("tr");
            mettreAJourMontantValide(row, this.checked);
        });
    });

    function selects() {
        var ele = document.getElementsByName('checkbox');
        for (var i = 0; i < ele.length; i++) {
            if (ele[i].type === 'checkbox') {
                ele[i].checked = true;
                var row = ele[i].parentNode.parentNode.parentNode;
                row.classList.add("selection");
                cpt++;
                sendData.style.display = "block";
                mettreAJourMontantValide(row, true); // Mettre à jour le montant valide
            }
        }
    }

    function deSelect() {
        var ele = document.getElementsByName('checkbox');
        for (var i = 0; i < ele.length; i++) {
            if (ele[i].type === 'checkbox') {
                ele[i].checked = false;
                var row = ele[i].parentNode.parentNode.parentNode;
                row.classList.remove("selection");
                cpt--;
                sendData.style.display = "none";
                totalMV = 0;
            }
        }
    }

    function afficheNbFichesFrais() {

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

    // Fonction pour afficher les éléments de la page actuelle
    function showItems() {
        if (maxRows < currentPage) {
            currentPage = 1;
        }
        var startIndex = (currentPage - 1) * itemsPerPage;
        var endIndex = startIndex + itemsPerPage;

        // Masquer toutes les lignes
        rowsTable.forEach(row => row.style.display = 'none');

        // Afficher les éléments de la page actuelle
        for (let i = startIndex; i < endIndex && i < rowsTable.length; i++) {
            rowsTable[i].style.display = '';
        }
    }

});