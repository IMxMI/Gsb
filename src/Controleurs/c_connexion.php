<?php

/**
 * Gestion de la connexion
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
if (!$uc) {
    $uc = 'demandeconnexion';
}

switch ($action) {
    case 'demandeConnexion':
        include PATH_VIEWS . 'v_connexion.php';
        break;
    case 'valideConnexion':
        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $userLogin = $pdo->getLoginUser($login, $mdp);
        if (!is_array($userLogin)) {
            Utilitaires::ajouterErreur('Login ou mot de passe incorrect');
            include PATH_VIEWS . 'v_erreurs.php';
            include PATH_VIEWS . 'v_connexion.php';
        } else {
            $idLogin = $userLogin['id'];
            $metier = $userLogin['metier'];
            if($metierid = 'VI'){
                $user = $pdo->getInfoVisiteur($idLogin);
                $metierSession = 'visiteur';
            }
            else{
                $user = $pdo->getInfoComptable($idLogin);
                $metierSession = 'comptable';
            };
            if (!is_array($user)){
                Utilitaires::ajouterErreur('Erreur de connexion');
                include PATH_VIEWS . 'v_erreurs.php';
                include PATH_VIEWS . 'v_connexion.php';
            }else{
                $id = $user['id'];
                $nom = $user['nom'];
                $prenom = $user['prenom'];
                Utilitaires::connecter($id, $nom, $prenom, $metierSession);
                header('Location: index.php');
            }
        }
        break;
    default:
        include PATH_VIEWS . 'v_connexion.php';
        break;
}
