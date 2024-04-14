<?php

function initCss($pdf): void {
    $pdf->SetFont('helvetica', '', 10);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFillColor(255, 255, 255);
}

$idVisiteur = filter_input(INPUT_GET, 'idVisiteur', FILTER_SANITIZE_SPECIAL_CHARS);
$mois = filter_input(INPUT_GET, 'mois', FILTER_SANITIZE_SPECIAL_CHARS);
$nomPdf = 'etat_de_frais_' . $idVisiteur . "_" . $mois . '.pdf';
$cheminComplet = $_SERVER['DOCUMENT_ROOT'] . '/pdf/' . $nomPdf;

if(file_exists($cheminComplet)){
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $nomPdf . '"');
    header('Content-Length: ' . filesize($cheminComplet));
    ob_clean();
    flush();
    readfile($cheminComplet);
}else{
    $identiteVisiteur = $pdo->getNomVisiteur($idVisiteur);
    $lesFraisForfaits = $pdo->getLesFraisForfait($idVisiteur, $mois);
    $leFraisKilometrique = $pdo->getLeFraisKm($idVisiteur, $mois);
    $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);



    // Crée une nouvelle instance PDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Définit les informations du document
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('GSB');
    $pdf->SetTitle('État de frais engagés');
    $pdf->SetSubject('Frais Engagés');
    $pdf->SetKeywords('TCPDF, PDF, exemple, état des frais, GSB');

    // Supprimer les en-têtes et pieds de page par défaut
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // Définit les marges
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

    // Ajoute une page
    $pdf->AddPage();

    // Chemin vers le logo
    $logoPath = '../public/images/logo.jpg'; // Assurez-vous que le chemin d'accès est correct
    // Insérer le logo
    $pdf->Image($logoPath, '88', '', 40, 20, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

    // Définit la police
    $pdf->SetFont('helvetica', '', 10);

    // Titre
    $pdf->Ln(25); // Déplacez le curseur vers le bas pour vous éloigner du logo
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->SetTextColor(34, 66, 124);
    $pdf->Cell(0, 0, 'ÉTAT DE FRAIS ENGAGÉS', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
    initCss($pdf);
    $pdf->Cell(0, 0, 'A retourner accompagné des justificatifs au plus tard le 10 du mois qui suit l’engagement des frais', 0, 1, 'C', 0, '', 0, false, 'T', 'M');

    $pdf->Ln(6);

    $moisStr = [
        '01' => 'Janvier',
        '02' => 'Février',
        '03' => 'Mars',
        '04' => 'Avril',
        '05' => 'Mai',
        '06' => 'Juin',
        '07' => 'Juillet',
        '08' => 'Août',
        '09' => 'Septembre',
        '10' => 'Octobre',
        '11' => 'Novembre',
        '12' => 'Décembre'
    ];
    $partieAnnee = substr($mois, 0, 4);
    $partieMois = substr($mois, 4);

    // Tableau pour les informations du visiteur
    $html = '
    <table cellpadding="4">
        <tr>
            <td>Visiteur</td>
            <td>' . $idVisiteur . '</td>
            <td>' . $identiteVisiteur[0]['prenom'] . " " . strtoupper($identiteVisiteur[0]['nom']) . '</td>
        </tr>
        <tr>
            <td>Mois</td>
            <td>' . $moisStr[$partieMois] . " " . $partieAnnee . '</td>
        </tr>
    </table>';

    $pdf->writeHTML($html, true, false, false, false, '');

    // Espacer avant le prochain tableau
    $pdf->Ln(4);

    // Tableau pour les frais forfaitaires
    $html = '
        <style>
        table {
            border-collapse: collapse;
            border: none;
        }

        td {
            border: none;
            border-right: 1px solid black;
            text-align: right;
        }

        th {
            border: none;
            border-right: 1px solid black;
            text-align: center;
        }

        .tableContainer {
            border-left: 0.5px solid black;
            border-right: 0.5px solid black;
            position: relative;
        }

        .gauche {
            text-align: left;
        }

        .fin {
            border-right: none;
        }

        </style>

    <div class="tableContainer"> 
        <table cellpadding="4">
            <tr>
                <th>Frais Forfaitaires</th>
                <th>Quantité</th>
                <th>Montant unitaire</th>
                <th class="fin">Total</th>
            </tr>';

    // affichage de chaque ligne des frais forfaits
    foreach ($lesFraisForfaits as $unFraiForfait) {
        $html .= '<tr>'
            . '        <td class="gauche">' . $unFraiForfait['libelle'] . '</td>'
            . '        <td>' . $unFraiForfait['quantite'] . '</td>'
            . '        <td>' . $unFraiForfait['montant'] . '€' . '</td>'
            . '        <td class="fin">' . round(((float) $unFraiForfait['quantite'] * (float) $unFraiForfait['montant']), 2) . '€' . '</td>'
            . '     </tr>';
    }
    $html .= '<tr>'
        . '        <td class="gauche">' . $leFraisKilometrique['libelle'] . '</td>'
        . '        <td>' . $leFraisKilometrique['quantite'] . '</td>'
        . '        <td>' . $leFraisKilometrique['montant'] . '€' . '</td>'
        . '        <td class="fin">' . round(((float) $leFraisKilometrique['quantite'] * (float) $leFraisKilometrique['montant']), 2) . '€' . '</td>'
        . '     </tr>';

    // Fin et affichage du tableau
    $html .= '    
    </table>
    <h2 style="text-align: center;">Autres frais</h2>';

    // Espacer avant le prochain tableau
    $pdf->Ln(4);

    // Tableau pour les autres frais
    $html .= '
    <table cellpadding="4">
        <tr>
            <th>Date</th>
            <th>Libellé</th>
            <th class="fin">Montant</th>
        </tr>';

    // affichage de chaque ligne des frais forfaits
    foreach ($lesFraisHorsForfait as $unFraiHorsForfait) {
        $html .= '<tr>'
            . '        <td class="gauche">' . $unFraiHorsForfait['date'] . '</td>'
            . '        <td class="gauche">' . $unFraiHorsForfait['libelle'] . '</td>'
            . '        <td class="fin">' . $unFraiHorsForfait['montant'] . '€' . '</td>'
            . '     </tr>';
    }

    // Fin et affichage du tableau
    $html .= '</table>'
        . '</div>';
    $pdf->writeHTML($html, true, false, false, false, '');

    // Ajouter un espace pour le total
    $pdf->Ln(10);

    // calcul du total
    $total = 0;
    foreach ($lesFraisForfaits as $unFraiForfait) {
        $total += round(((float) $unFraiForfait['quantite'] * (float) $unFraiForfait['montant']), 2);
    }
    foreach ($lesFraisHorsForfait as $unFraiHorsForfait) {
        $total += (int) $unFraiHorsForfait['montant'];
    }

    $pdf->SetX($pdf->GetPageWidth()-75);
    $html = '  
    <style>

        .total {
            border-collapse: collapse;
            border: none;
            border-left: 0.5px solid black;
            border-right: 0.5px solid black;
        }

        td {
            border: none;
            border-right: 1px solid black;
            text-align: right;
        }

        th {
            border: none;
            border-right: 1px solid black;
            text-align: center;
        }

        .gauche {
            text-align: left;
        }

        .fin {
            border-right: none;
        }

    </style>

        <table class="total">
            <tr>
                <td class="gauche">TOTAL ' . $partieMois . '/' . $partieAnnee . '</td>
                <td class="fin">' . $total . '€' . '</td>
            </tr>
        </table>
    ';
    $pdf->writeHTML($html, true, false, false, false, '');

    // Ajoutez un espace pour la signature
    $pdf->Ln(10);

    // Ligne pour la signature
    $pdf->Cell(0, 0, 'Signature', 0, 1, 'R', 0, '', 0, false, 'T', 'M');

    // Ferme et génère le document PDF
    ob_end_clean();

    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $nomPdf . '"');

    $pdf->Output($cheminComplet, 'F');
    readfile($cheminComplet);
}
?>