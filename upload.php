<?php

// definition d'une const array des extensions valables
const EXTENSIONS = array('.png', '.gif', '.jpg');

// Poids max du fichier autorisé
const MAX_SIZE = 1000000;

// Fonction pour réorganiser l'array de l'upload
function rearrange( array $arr ):array
{
    foreach( $arr as $key => $all ){
        foreach( $all as $i => $val ){
            $new[$i][$key] = $val;
        }
    }
    return $new;
}

// Premiere partie : teste de l'upload.
// On teste l'existance de $_FILES['file']) normalement généré par le formulaire
if (isset($_FILES['files'])) {

    // Variable pour servir de compteur
    $x = 0;

    // On filtre l'array de l'upload via la fonction rearrange
    $files = rearrange($_FILES['files']);

    // On boucle sur l'array files
    foreach ($files as $file)
    {
        // Incrementation du compteur à chaque tour.
        $x += 1;

        // On recherche uniquement l'extension ( .quelquechose )
        $extension = strrchr($file['name'], '.');
        // On passe l'extension en minuscule pour eviter que les extensions soient en maj
        $extension = strtolower($extension);


        // On teste que l'upload ne soit pas vide.
        if ($file['size'] == 0) {

            $error = 'Il n\'y a aucun fichier à upload !';

        // On teste si l'extension du fichier et presente dans l'array des extensions autorisées
        } elseif (!in_array($extension, EXTENSIONS)) {

            $error = 'Vous devez uploader un fichier de type png, gif, jpg';

        // On teste si le poids du fichier ne dépasse pas le plafond autorisé
        } elseif ($file['size'] > MAX_SIZE) {

            $error = 'Le fichier est trop gros...';
        }

        // Seconde partie traitement de l'upload.
        // On teste la non-existance de la variable error
        if (!isset($error)) {

            // On renomme le fichier avec un id unique pour eviter doublon et nom trop long
            $fileName = 'image' . uniqid() . $extension;

            $dossier = './upload_files/';
            $fichier = basename($fileName);

            // On teste le deplacement du fichier avec affichage du status final
            if (move_uploaded_file($file['tmp_name'], $dossier . $fichier)) {

                 $results[] = '<div class="alert alert-primary" role="alert">Upload effectué avec succès de l\'image ' . $x . '</div>';

            } else {

                 $results[] = '<div class="alert alert-primary" role="alert">Echec de l\'upload de l\'image ' . $x . '</div>';
            }
        }
    }
}

// Instanciation de FilesystemIterator
$it = new FilesystemIterator('./upload_files');

// Supression du fichier contenu dans $_GET['delete']
if (isset($_GET['delete'])) {

    // On supprime puis on redirige sur l'index pour eviter les erreurs
    unlink('./upload_files/' . $_GET['delete']);
    header('Location:index.php');

}


