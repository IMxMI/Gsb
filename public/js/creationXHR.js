function creationXHR() {
    var resultat = null;
    try {
        resultat = new XMLHttpRequest();
    } catch (Erreur) {
        try {
            resultat = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (Erreur) {
            try {
                resultat = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (Erreur) {
                resultat = null;
            }
        }
    }
    return resultat;
}