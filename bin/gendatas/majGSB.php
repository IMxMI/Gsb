<?php

/**
 * Génération d'un jeu d'essai
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
 * @example   /path/to/php.exe majGSB.php
 */

$moisDebut = '202209';
require './fonctions.php';

$pdo = new PDO('mysql:host=localhost;dbname=gsb_frais', 'userGsb', 'secret');
$pdo->query('SET CHARACTER SET utf8');

set_time_limit(0);
creationFichesFrais($pdo);
creationFraisForfait($pdo);
creationFraisHorsForfait($pdo);
majFicheFrais($pdo);
echo getNbTable($pdo, 'fichefrais') . " fiches de frais créées !\n";
echo getNbTable($pdo, 'lignefraisforfait') . " lignes de frais au forfait créées !\n";
echo getNbTable($pdo, 'lignefraishorsforfait') . " lignes de frais hors forfait créées !\n";
