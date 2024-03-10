$(document).ready(function () {
    
    
    
    
    // Appel Ajax
    $.ajax({
        url: 'c_suivifrais/miseEnPaiement', // URL de votre contrôleur et fonction
        type: 'POST', // Méthode HTTP (POST, GET, etc.)
        data: {tableau: tableauData}, // Les données à envoyer
        success: function (response) {
            // La fonction à exécuter si l'appel est réussi
            console.log('Appel réussi.');
            console.log('Réponse du serveur : ' + response);
        },
        error: function (xhr, status, error) {
            // La fonction à exécuter en cas d'erreur
            console.error('Erreur lors de l\'appel Ajax : ' + error);
        }
    });
});


