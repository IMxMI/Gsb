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
            var ligne = [idVisiteur, idMois];
            visiteurs.push(ligne);
        }
    }
});