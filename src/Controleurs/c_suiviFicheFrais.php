<?php

/**
 * Gestion des frais
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
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
switch ($action) {
    case 'suivieFrais':
        $ficheFraisValid = $pdo->getFicheFraisValid();
        foreach ($ficheFraisValid as &$ficheFV) {
            $montantTotalHorsForfait = $pdo->getLesFraisHorsForfaitMontant($ficheFV['idvisiteur'], $ficheFV['mois']);
            $montantFraisForfait = $pdo->getMontantFraisForfait($ficheFV['idvisiteur'], $ficheFV['mois']);
            $ficheFV['montantHorsFrais'] = $montantTotalHorsForfait[0];
            $ficheFV['montantFrais'] = $montantFraisForfait[0];
        }
        include_once PATH_VIEWS . 'v_suiviFrais.php';

        break;

    case 'miseEnPaiement':
        $inputJSON = file_get_contents('php://input');
        $data = json_decode($inputJSON, true);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($data && is_array($data)) {
                // Affichage des données reçues
                foreach ($data as $test) {
                    echo "idVisiteur: " . $test['idVisiteur'] . "<br>";
                    echo "idMois: " . $test['idMois'] . "<br>";
                }
            }
        }
        break;

    default:
        break;
}
    