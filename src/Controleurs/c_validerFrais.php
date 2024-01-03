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
include PATH_VIEWS . "v_choixLeVisiteur.php";
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
        // $nbJustificatifs = $pdo->getNbjustificatifs($_SESSION['leVisiteurId'], $_SESSION['leMois']);
        include PATH_VIEWS . "v_elementsForfaitises.php";
        break;

        //var_dump($nbJustificatifs);

        break;
}
        

