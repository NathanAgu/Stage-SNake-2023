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

        if (isset($_POST["documentName"], $_POST["documentDescription"], $_POST["documentContent"], $_POST["documentImages"]) && !empty($_POST["documentName"]) && !empty($_POST["documentContent"])) 
        {
            // Création de variables de récupération de données du formulaire
            // PS : strip-tags sert a supprimer les balises html, php, ett...
            $documentName = strip_tags($_POST["documentName"]);
            $documentDescription = strip_tags($_POST["documentDescription"]);
            $documentContent = strip_tags($_POST["documentContent"]);
            $documentImages = strip_tags($_POST["documentImages"]);

            // Requête SQL : Recherche document via nom
            $sql = "SELECT * FROM `document` WHERE `documentName` = :documentName";
            $query = $db->prepare($sql);
            $query->bindValue(":documentName", $documentName);
            $query->execute();
            $document = $query->fetch();

            // Document déjà existant
            if ($document) {
                $valid = false;     // Variable "valid" est égal à faux
            }

            // Remplissage description
            if (empty($documentDescription)) 
            {
                $documentDescription = "Aucune Description";
            }

            // Après vérification de toutes les informations
            if ($valid) 
            {
                $directoryId = $directoryName[$a]["ID"];

                // Requête SQL : Ajout dans la base de données
                $sql = "INSERT INTO `document` (`documentName`, `documentDescription`, `documentContent`, `documentImages`, `directoryID`) VALUES ('$documentName', '$documentDescription', '$documentContent', '$documentImages', '$directoryId')";
                $query = $db->prepare($sql);
                $query->execute();
                $document = $query->fetch();

                header("Location: /documentation/".$categoryName[$i]['categoryName']."/".$directoryName[$a]['directoryName']."/".$documentName);
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
                        <input type="text" name="documentName" required>
                        <i>Nom document</i>
                    </div>
                </div>
                <div class="item">
                    <div class="inputBox">
                        <input type="text" name="documentDescription" required>
                        <i>Description</i>
                    </div>
                </div>
                <div class="item">
                    <div class="inputBox">
                        <textarea type="text" name="documentContent" required>
                        <i>Contenu</i>
                    </div>
                </div>
                <div class="item">
                    <div class="inputBox">
                        <input type="text" name="documentImages" required>
                        <i>Liens images</i>
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