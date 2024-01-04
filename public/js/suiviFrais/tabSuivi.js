document.addEventListener("DOMContentLoaded", function () {

    var button = document.getElementById('buttonSelectionAll');
    button.addEventListener("click", buttonControl);

    var sendData = document.getElementById("sendData");
    sendData.addEventListener("click", miseEnPaiement);
    sendData.style.display = "none";

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
        console.log("Montant total: " + totalMV + "€");
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
                if (cpt <= 0) {
                    sendData.style.display = "none";
                }
                totalMV = 0;
            }
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
        }

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/index.php?uc=suiviFicheFrais&action=miseEnPaiement", true);
        xhr.setRequestHeader("Content-Type", "application/json");
        var parametres = JSON.stringify(visiteurs);
        xhr.send(parametres);
    }


});