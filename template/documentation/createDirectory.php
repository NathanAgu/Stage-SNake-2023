<?php
    // Vérifie si la session est créée
    if  (!isset($_SESSION['user'])) 
    {
        header('Location: /connexion'); // Redirection
        exit();
    }

    if (!empty($_POST)) 
    {
        $valid = (boolean) true; // Création de la variable pour la vérification des éléments

        if (isset($_POST["directoryName"], $_POST["directoryDescription"]) && !empty($_POST["directoryName"])) 
        {
            // Création de variables de récupération de données du formulaire
            // PS : strip-tags sert a supprimer les balises html, php, ett...
            $directoryName = strip_tags($_POST["directoryName"]);
            $directoryDescription = strip_tags($_POST["directoryDescription"]);

            // Requête SQL : Recherche répertoire via nom
            $sql = "SELECT * FROM `directory` WHERE `directoryName` = :directoryName";
            $query = $db->prepare($sql);
            $query->bindValue(":directoryName", $directoryName);
            $query->execute();
            $directory = $query->fetch();

            // Répertoire déjà existant
            if ($directory) 
            {
                $valid = false;
            }

            // Remplissage description
            if (empty($directoryDescription)) 
            {
                $directoryDescription = "Aucune Description";
            }

            // Après vérification de toutes les informations
            if ($valid) 
            {
                $categoryId = $categoryName[$i]['ID'];

                // Requête SQL : Ajout dans la base de données
                $sql = "INSERT INTO `directory` (`directoryName`, `directoryDescription`, `categoryID`) VALUES ('$directoryName', '$directoryDescription', '$categoryId')";
                $query = $db->prepare($sql);
                $query->execute();
                $directory = $query->fetch();

                header("Location: /documentation/".$categoryName[$i]['categoryName']."/".$directoryName);
            }
        }
    }
?>

<main>
    <div class="content formPage">
        <div class="form">
            <form action="" method="post">
                <div class="item">
                    <div class="inputBox">
                        <input type="text" name="directoryName" required>
                        <i>Nom répertoire</i>
                    </div>
                </div>
                <div class="item">
                    <div class="inputBox">
                        <textarea type="text" name="directoryDescription" required></textarea>
                        <i>Description</i>
                    </div>
                </div>
                <div class="item">
                    <div class="submitBox">
                        <input type="submit" value="Créer">
                    </div>
                </div>
            </form>
        </div>
        <div class="svg">
            <img src="./assets/img/Virtual reality-amico.svg" alt="">
        </div>
    </div>
</main>