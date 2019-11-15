<?php
require 'upload.php';
?>
<!doctype html>
<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="form.css">
    <title>Uploader de fichier</title>
</head>
<body>
<h1>Upload Files</h1>
<form class="row col-8 offset-2 form-upload" action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="file"></label>
        <input type="file" class="form-control-file" multiple="multiple"  id="file" name="files[]">
    </div>
    <?php
    if (isset($error)) {
    ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php
    }
    ?>
    <button type="submit" class="btn btn-primary submit-form">Submit</button>
</form>

<?php
if (isset($results)) {
?>
<div class="result-box col-8">
    <?php
    foreach ($results as $result)
    {
        echo $result;
    }
    ?>
</div>
<?php
}
?>
<div class="container">
    <div class="row justify-content-around">
        <?php

        $y = 0;

        foreach ($it as $fileInfo)
        {
            $y += 1;
        ?>

            <div class="col-xs-6 col-md-3 container-card">
                <div class="card-box">
                    <div class="info-img-box" >
                        <p class="nbr-img"><?= $y ?></p>
                        <p class="title-img"><?php echo $fileInfo->getFilename() ?></p>
                    </div>
                    <img class="img-file" src="upload_files/<?php echo $fileInfo->getFilename() ?>" alt="Image N°<?= $y ?>">
                    <a href="?delete=<?php echo $fileInfo->getFilename()?>" title="Effacer cette image" class="delete-button" title="">X</a>
                </div>
            </div>

        <?php
        }
        ?>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
