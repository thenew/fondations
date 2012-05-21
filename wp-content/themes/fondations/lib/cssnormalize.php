<?php
include dirname(__FILE__).'/../../../../wp-load.php';

$retour_css = '';
$fichiers = array( );

// Dossier contenant les fichiers css
$dossier_css = 'CSSNormalize/css/';
// On parcourt le dossier des css
$dir = opendir($dossier_css);

// don't load reset.css if we use Twitter Bootstrap
if(FONDATIONS_BOOTSTRAP) {
  while ( $fichier = readdir($dir) ) {
    if($fichier != "." && $fichier != ".." && $fichier != "reset.css") {
        $fichiers[] = $dossier_css . $fichier;
    }
  }
} else {
  while ( $fichier = readdir($dir) ) {
    if($fichier != "." && $fichier != "..") {
        $fichiers[] = $dossier_css . $fichier;
    }
  }
}
closedir($dir);

// Tri par ordre alphabetique *inverse* des fichiers
arsort($fichiers);

// Inclusion des fichiers dans l'ordre
foreach ( $fichiers as $fichier )
  $retour_css .= file_get_contents($fichier);

// Définition de la fonction de compression
function compress($buffer)
{
  // Suppression des commentaires
  $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);

  // Suppression des tabulations, espaces multiples, retours à la ligne, etc.
  $buffer = str_replace(array( "\r\n", "\r", "\n", "\t", '  ', '   ', '  ' ), '', $buffer);

  // Suppression des derniers espaces inutiles
  $buffer = str_replace(array( ' { ', ' {', '{ ' ), '{', $buffer);
  $buffer = str_replace(array( ' } ', ' }', '} ' ), '}', $buffer);
  $buffer = str_replace(array( ' : ', ' :', ': ' ), ':', $buffer);
  $buffer = str_replace(array( ' , ', ' ,', ', ' ), ',', $buffer);
  $buffer = str_replace(';}', '}', $buffer);
  $buffer = str_replace(':0px;', ':0;', $buffer);

  // Mise en page améliorée
  $buffer = str_replace('}', '}' . "\n", $buffer);

  return $buffer;
}

// Compression du CSS
$retour_css = compress($retour_css);
// Declaration du contenu CSS
header("Content-type: text/css; charset=utf-8");
// Envoi du retour CSS
echo $retour_css;