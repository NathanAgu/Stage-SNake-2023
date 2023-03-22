<?php
    // Vérification utilisateur connecté
    if (isset($_SESSION['user'])) 
    {
        header('Location: /compte');    // Redirection
        exit();
    }

    // Vérification si le formulaire n'est pas vide
    if (!empty($_POST)) 
    {
        $valid = (boolean) true;    // Création variable de vérification

        // Vérification formulaire complet
        if (isset($_POST["userPseudo"], $_POST["userEmail"], $_POST["userPassword"], $_POST["userConfPassword"]) && !empty($_POST["userPseudo"]) && !empty($_POST["userEmail"]) && !empty($_POST["userPassword"]) && !empty($_POST["userConfPassword"])) 
        {  
            // Création de variables de récupération de données du formulaire
            // PS : strip-tags sert a supprimer les balises html, php, ett... 
            $userPseudo = strip_tags($_POST["userPseudo"]); 
            $userEmail = strip_tags($_POST["userEmail"]);
            $userPassword = strip_tags($_POST["userPassword"]);
            $userConfPassword = strip_tags($_POST["userConfPassword"]);

            // $sql = "SELECT * FROM `user` WHERE `userPseudo`";
            // $req = $db->query($sql);
            // $req->execute(array($userPseudo));

            // Vérification mots de passe (identiques ou non)
            if ($userPassword <> $userConfPassword)                 // Mot de passe non-identiques
            {               
                $valid = false;                                     // Variable "valid" est égal à faux
                echo "Les mots de passe ne sont pas les mêmes !";
            }

            // Vérification email (valide ou non)
            if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL))     // Email non-conforme 
            {
                $valid = false;                                     // Variable "valid" est égal à faux
                echo "Adresse email non-conforme !";
            } 
            else 
            {
                // Requête SQL : Recherche utilisateur via email
                $sql = "SELECT * FROM `user` WHERE `userEmail` = :email";
                $query = $db->prepare($sql);
                $query->bindValue(":email", $userEmail);
                $query->execute();
                $user = $query->fetch();

                // Si utilisateur connu
                if ($user)
                {
                    $valid = false;
                    echo "Email indisponnible !";
                }
            }

            // Après vérification de toutes les informations
            if ($valid) 
            {
                // Hash du mot de passe (sécutité)
                $userHashPassword = password_hash($userPassword, PASSWORD_ARGON2ID);

                // Requête SQL : Ajout des informations dans la base de données
                $sql = "INSERT INTO `user` (`userPseudo`, `userEmail`, `userPassword`) VALUES ($userPseudo, $userEmail, '$userHashPassword')";
                $query = $db->prepare($sql);
                $query->execute();

                // Requête SQL : Récupérations des données de l'utilisateur
                $sqlUser = "SELECT * FROM `user` WHERE `userEmail` = :email";
                $query = $db->prepare($sqlUser);
                $query->bindValue(":email", $userEmail);
                $query->execute();
                $user = $query->fetch();

                // Création de la session avec les informations utilisateur
                $_SESSION["user"] = [
                    "id" => $user["ID"],
                    "userPseudo" => $user["userPseudo"],
                    "userEmail" => $user["userEmail"],
                    "userRole" => $user["userRole"],
                    "userCreateAt" => $user["userCreateAt"]
                ];

                // Redirection vers le Dashboard
                header("Location: /compte");  
            }
        } 
        else 
        {
            echo "Fromulaire incomplet !";      // Message erreur car le formulaire est incomplet
        }
    } 
?>

<main>
    <div class="content formPage">
        <div class="form">
            <form action="" method="post">
                <div class="item">
                    <div class="inputBox">
                        <input type="text" name="userPseudo" required>
                        <i>Pseudo</i>
                    </div>
                </div>
                <div class="item">
                    <div class="inputBox">
                        <input type="email" name="userEmail" required>
                        <i>Email</i>
                    </div>
                </div>
                <div class="item">
                    <div class="inputBox">
                        <input type="password" name="userPassword" required>
                        <i>Mot de passe</i>
                    </div>
                </div>
                <div class="item">
                    <div class="inputBox">
                        <input type="password" name="userConfPassword" required>
                        <i>Confirmation mot de passe</i>
                    </div>
                </div>
                <div class="item">
                    <div class="submitBox">
                        <input type="submit" value="Inscription">
                    </div>
                </div>
            </form>
        </div>
        <div class="svg">
            <img src="./assets/img/Virtual reality-amico.svg" alt="">
        </div>
    </div>
</main>