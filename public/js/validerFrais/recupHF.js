document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('choixVisiteur').addEventListener('change', function () {
        var nomVisiteur = this.value;
        var mois = document.getElementById('lstMois').value;

        // Créez un objet XMLHttpRequest.
        var xhr = new XMLHttpRequest();

        // Configurez la requête.
        xhr.open('POST', 'index.php?uc=validerFrais&action=getVisiteurData', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Définissez la fonction de rappel pour gérer la réponse.
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Parsez la réponse JSON.
                var data = JSON.parse(xhr.responseText);

                // Mettez à jour les champs de votre formulaire avec les données récupérées.
                document.getElementById('inputForfaitStage').value = data.forfaitEtape;
                document.getElementById('inputFraisKm').value = data.forfaitKm;
                document.getElementById('inputNuitHotel').value = data.nuitHotel;
                document.getElementById('inputRepasResto').value = data.repasResto;

            }
        };

        // Envoyez la requête avec les données du formulaire.
        xhr.send('nom=' + encodeURIComponent(nomVisiteur) + '&mois=' + encodeURIComponent(mois));
    });
});
