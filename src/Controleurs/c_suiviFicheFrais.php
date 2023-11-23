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
$testFiche = $pdo->getFicheFraisValid();
foreach ($testFiche as $test) {
    $ligneFraisHorsForfait = $pdo->getLesFraisHorsForfait($test['idvisiteur'], $test['mois']);
    if(!empty($ligneFraisHorsForfait)) {
        foreach ($ligneFraisHorsForfait as $totalHF) {
            $a = 0;
            $a += $totalHF;
        }
        $test['totalHorsFrais'] = $totalFraisHorsForfait['montant'];
    }
}
include_once PATH_VIEWS . 'v_suiviFrais.php';
