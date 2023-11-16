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
$visiteurs = $pdo->getVisiteurs();
switch ($action) {
    case 'selectionnerMoisVisiteur':
        var_dump($visiteurs);
        include PATH_VIEWS . "v_choixLeVisiteur.php";
        include PATH_VIEWS . "v_FraisHorsForfaitCmpta.php";
        break;
    case 'validerfrais';
        $lesVisiteurs = $pdo->getListeVisiteur();
        $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
        //
        //
        //
        $lesCles = array_keys($lesVisiteurs);
        $visiteursASelectionner = $lesCles[0];
        $lesClesBis = array_keys($lesMois);
        $moisASelectionner = $lesClesBis[0];
       // include PATH_VIEWS . "v_choixLeVisiteur.php";
        break;
}

