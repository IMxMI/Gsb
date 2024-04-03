<?php

/**
 * Valider les frais
 *
 * PHP Version 8
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
use Outils\Utilitaires;

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$lesVisiteurs = $pdo->getVisiteurs();
require PATH_VIEWS . "v_choixLeVisiteur.php";
switch ($action) {
    case 'selectionnerMoisVisiteur':
        $_SESSION['leMois'] = filter_input(INPUT_POST, 'leMois', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $_SESSION['leVisiteurId'] = filter_input(INPUT_POST, 'unVisiteur', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($_SESSION['leMois'] == 'none' || $_SESSION['leVisiteurId'] == 'none') {
            break;
        } elseif ($pdo->estPremierFraisMois($_SESSION['leVisiteurId'], $_SESSION['leMois'])) {
            $pdo->creeNouvellesLignesFrais($_SESSION['leVisiteurId'], $_SESSION['leMois']);
        }
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($_SESSION['leVisiteurId'], $_SESSION['leMois']);
        $lesFraisForfait = $pdo->getLesFraisForfait($_SESSION['leVisiteurId'], $_SESSION['leMois']);
        $nbJustificatifs = $pdo->getNbjustificatifs($_SESSION['leVisiteurId'], $_SESSION['leMois']);
        include PATH_VIEWS . 'v_elementsForfaitises.php';
        include PATH_VIEWS . 'v_elementsHorsForfait.php';
        break;

    //permet de mettre a jour les données dans la base de donnée
    case 'majFraisForfait' :
        $lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTRE_DEFAULT, FILTRE_FORCE_ARRAY);
        if (Utilitaires::lesQteFraisValides($lesFrais)) {
            $pdo->majFraisForfait($_SESSION['leVisiteurId'], $_SESSION['leMois'], $lesFrais);
        } else {
            Utilitaires::ajouterErreur('Les valeurs doivent être numérique');
            include PATH_VIEWS . 'v_erreurs.php';
        }
        break;

    case 'majFraisHF':
        $fraisHF = filter_input(INPUT_POST, 'lesFraisHF', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
        if (isset($fraisHF) && is_array($fraisHF)) {
            foreach ($fraisHF as $id => $data) {
                $date = $data['date'];
                $libelle = $data['libelle'];
                $montant = $data['montant'];
                try {
                    $pdo->majFraisHF($date, $libelle, $montant, $id);
                } catch (Exception $ex) {
                    Utilitaires::ajouterErreur('Les données ne sont pas valides');
                    include PATH_VIEWS . 'v_erreurs.php';
                }
            }
        }
        break;

    case 'majNbJustificatifs':
        $nbJustificatifs = filter_input(INPUT_POST, 'nbJustificatifs', FILTER_DEFAULT, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        try {
            $pdo->majNbJustificatifs($_SESSION['leVisiteurId'], $_SESSION['leMois'], $nbJustificatifs);
        } catch (Exception $ex) {
            Utilitaires::ajouterErreur("Le nombre de justificatifs n'est pas bon");
            include PATH_VIEWS . 'v_erreurs.php';
        }
        break;

    case 'refuserFraisHorsForfait':
        $idFrais = filter_input(INPUT_GET, 'idFrais', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pdo->refuserFraisHorsForfait($idFrais);
        break;

}
        

