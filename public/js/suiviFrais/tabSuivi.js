document.addEventListener("DOMContentLoaded", function () {

    var button = document.getElementById('buttonTest');
    button.addEventListener("click", buttonControl);

    var sendData = document.getElementById("sendData");
    sendData.addEventListener("click", miseEnPaiement);

    function buttonControl() {
        var button = document.getElementById('buttonTest');
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

    function selects() {
        var ele = document.getElementsByName('checkbox');
        for (var i = 0; i < ele.length; i++) {
            if (ele[i].type === 'checkbox')
                ele[i].checked = true;
            ele[i].parentNode.parentNode.parentNode.classList.add("selection");
        }
    }

    function deSelect() {
        var ele = document.getElementsByName('checkbox');
        for (var i = 0; i < ele.length; i++) {
            if (ele[i].type === 'checkbox')
                ele[i].checked = false;
            ele[i].parentNode.parentNode.parentNode.classList.remove("selection");
        }
    }

    // Sélection de toutes les cases à cocher dans le tableau
// Sélection de toutes les cases à cocher avec la classe "Checkbox"
    var checkboxes = document.querySelectorAll(".Checkbox");

// Ajout d'un écouteur d'événement 'change' à chaque case à cocher
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener("change", function () {
            // Vérification si la checkbox est cochée
            if (this.checked) {
                // Accès à la ligne parente (le <tr>) de la checkbox
                var row = this.closest("tr");

                // Ajout de la classe à la ligne parente
                row.classList.add("selection");
            } else {
                // Accès à la ligne parente (le <tr>) de la checkbox
                var row = this.closest("tr");

                // Suppression de la classe de la ligne parente
                row.classList.remove("selection");
            }
        });
    });



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