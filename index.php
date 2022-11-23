<?php
require_once('modele/medicament.modele.inc.php');
require_once('modele/medecin.modele.inc.php');
require_once('modele/rapport.modele.inc.php');
require_once('modele/connexion.modele.inc.php');

if (!isset($_REQUEST['uc']) || empty($_REQUEST['uc']))
    $uc = 'accueil';
else {
    $uc = $_REQUEST['uc'];
}

//capture contenue retourner
ob_start();
switch ($uc) {
    case 'accueil': {
            include("vues/v_accueil.php");
            break;
        }
    case 'medicaments': {
            if (!empty($_SESSION['login'])) {
                include("controleur/c_medicaments.php");
            } else {
                include("vues/v_accesInterdit.php");
            }
            break;
        }
    case 'praticiens': {
            if (!empty($_SESSION['login'])) {
                include("controleur/c_praticiens.php");
            } else {
                include("vues/v_accesInterdit.php");
            }
            break;
        }
    case 'medecin': {
            if (!empty($_SESSION['login']) && $_SESSION['habilitation'] == 2) {
                include("controleur/c_medecins.php");
            } else {
                include("vues/v_accesInterdit.php");
            }
            break;
        }
    case 'rapport': {
            if (!empty($_SESSION['login'])) {
                include("controleur/c_rapport.php");
            } else {
                include("vues/v_accesInterdit.php");
            }
            break;
        }
    case 'connexion': {
            include("controleur/c_connexion.php");
            break;
        }
    default: {

            include("vues/v_accueil.php");
            break;
        }
}
//fin de la capture de contenue retourner
$content = ob_get_clean();

//affichage de la page
if (!isset($_SESSION['login'])) {
    include("vues/v_headerDeconnexion.php");
} else {
    include("vues/v_header.php");
}
echo $content;
include("vues/v_footer.php"); 
