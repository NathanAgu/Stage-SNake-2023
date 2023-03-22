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
        if (isset($_POST["userEmail"], $_POST["userPassword"]) && !empty($_POST["userEmail"]) && !empty($_POST["userPassword"])) 
        {
            // Création de variables de récupération de données du formulaire
            // PS : strip-tags sert a supprimer les balises html, php, ett... 
            $userEmail = strip_tags($_POST["userEmail"]);
            $userPassword = strip_tags($_POST["userPassword"]); 

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
                $query->bindValue(":email", "$userEmail");
                $query->execute();
                $user = $query->fetch();

                // Utilisateur inconnu
                if (!$user) 
                {
                    $valid = false;                                 // Variable "valid" est égal à faux
                    echo "Utilisateur/Mot de passe incorrect !";
                } 
                
                // Verification du mot de passe
                elseif (!password_verify($userPassword, $user["userPassword"])) 
                {
                    $valid = false;                                 // Variable "valid" est égal à faux
                    echo "Utilisateur/Mot de passe incorrect !";
                }
            }

            // Après vérification de toutes les informations
            if ($valid) 
            {
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
            echo "Fromulaire incomplet !";
        }
    }
?>

<main>
    <div class="content formPage">
        <div class="form">
            <form action="" method="post">
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
                    <div class="submitBox">
                        <input type="submit" value="Connexion">
                    </div>
                </div>
            </form>
        </div>
        <div class="svg">
            <img src="./assets/img/Virtual reality-amico.svg" alt="">
        </div>
    </div>
</main>