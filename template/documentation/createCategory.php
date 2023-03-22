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

        if (isset($_POST["categoryName"], $_POST["categoryDescription"]) && !empty($_POST["categoryName"])) 
        {
            // Création de variables de récupération de données du formulaire
            // PS : strip-tags sert a supprimer les balises html, php, ett...
            $categoryName = strip_tags($_POST["categoryName"]);
            $categoryDescription = strip_tags($_POST["categoryDescription"]);

            // Requête SQL : Recherche catégorie via nom
            $sql = "SELECT `categoryName` FROM `category` WHERE `categoryName` = :categoryName";
            $query = $db->prepare($sql);
            $query->bindValue(":categoryName", $categoryName);
            $query->execute();
            $category = $query->fetch();

            // Catégorie déjà existant
            if ($category) 
            {
                $valid = false;
            }

            // Remplissage description
            if (empty($categoryDescription)) 
            {
                $categoryDescription = "Aucune Description";
            }

            // Après vérification de toutes les informations
            if ($valid) 
            {
                // Requête SQL : Ajout dans la base de données
                $sql = "INSERT INTO `category` (`categoryName`, `categoryDescription`) VALUES ('$categoryName', '$categoryDescription')";
                $query = $db->prepare($sql);
                $query->execute();
                $category = $query->fetch();

                header("Location: /documentation/".$categoryName);
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
                        <input type="text" name="categoryName" required>
                        <i>Nom catégorie</i>
                    </div>
                </div>
                <div class="item">
                    <div class="inputBox">
                        <textarea type="text" name="categoryDescription" required></textarea>
                        <i>Description catégorie</i>
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