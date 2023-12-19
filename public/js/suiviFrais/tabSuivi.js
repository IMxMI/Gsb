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

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Afficher la réponse du serveur dans la console
                    console.log("Réponse du serveur :", xhr.responseText);

                    // Essayer de parser la réponse JSON
                    try {
                        var reponseServeur = JSON.parse(xhr.responseText);
                        console.log("Réponse parsée :", reponseServeur);

                        // Faire quelque chose avec la réponse parsée
                        alert(reponseServeur.message);
                    } catch (e) {
                        console.error('Erreur lors de la conversion JSON :', e);
                    }
                } else {
                    console.error('Erreur lors de la requête.');
                }
            }
        };


        xhr.send(parametres);
    }


});