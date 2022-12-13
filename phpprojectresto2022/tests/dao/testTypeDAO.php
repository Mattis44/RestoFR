<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>TypeDAO : tests unitaires</title>
    </head>

    <body>

        <?php

        use modele\dao\TypeDAO;
        use modele\dao\Bdd;

        require_once '../../includes/autoload.inc.php';
        
        // Pour augmenter les limites de var_dump
        ini_set('xdebug.var_display_max_depth', '10');
        ini_set('xdebug.var_display_max_children', '256');
        ini_set('xdebug.var_display_max_data', '1024');


        try {
            Bdd::connecter();
            ?>
            <h2>Test TypeDAO</h2>

            <?php
            $lesTypes = TypeDAO::getAllTypes();
            echo $lesTypes;
            
                      
            Bdd::deconnecter();
        } catch (Exception $ex) {
            ?>
            <h4>*** Erreur récupérée : <br/> <?= $ex->getMessage() ?> <br/>***</h4>
            <?php
        }
        ?>
            
    </body>
</html>
