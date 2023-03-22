<?php
    ob_start();
    session_start();
    require("../includes/connexionDB.php");

    $url = $_SERVER["REQUEST_URI"];     // Récupération de l'url
    $fragUrl = explode("/", $url);      // Découpage de l'url en fonction des informations entre /
?>

<!------------------------------ En-tête de la page ------------------------------>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <link rel="stylesheet" href="../assets/css/style.css"> -->
    <!-- <link rel="stylesheet" href="../assets/css/patterns.css"> -->
    <?php
        include("../assets/css/style-css.php");
        include("../assets/css/patterns-css.php");
    ?>

    <!---------- Script titre onglet site ---------->
    <?php
        if ($url === "/") 
        {
            $ongletName = "Accueil";
        } 
        else 
        {
            $ongletName = ucfirst(end($fragUrl));
        }
    ?>
    <title><?= $ongletName ?> | DocDuDev</title>
</head>
<body>
    <!------------------------------- Routage pages ------------------------------>
    <?php
        if (count($fragUrl) >= 2)
        {
            // ====================================== Partie Général ====================================== \\

            include("../includes/navbar.php");

            // Si la première partie de mon URL est égale à "" alors affichage page accueil
            if ($fragUrl[1] == "") 
            { 
                include("../template/home.php"); 
            }
            
            // Sinon, si la première partie de mon URL est égale à "404" alors affichage page d'erreur 404
            elseif ($fragUrl[1] == "404")
            { 
                include("../template/error/error404.php"); 
            }

            // ==================================== Partie Utilisateur ==================================== \\

            // Sinon, si la première partie de mon URL est égale à "inscription" alors affichage page d'inscription
            elseif ($fragUrl[1] == "inscription")   
            { 
                include("../template/user/register.php"); 
            }
            
            // Sinon, si la première partie de mon URL est égale à "connexion" alors affichage page de connexion
            elseif ($fragUrl[1] == "connexion")     
            { 
                include("../template/user/login.php"); 
            }
            
            // Sinon, si la première partie de mon URL est égale à "déconnexion" alors affichage page de déconnexion
            elseif ($fragUrl[1] == "deconnexion")   
            { 
                include("../template/user/logout.php"); 
            }
            
            // Sinon, si la première partie de mon URL est égale à "compte" alors affichage page du compte utilisateur
            elseif ($fragUrl[1] == "compte")        
            { 
                include("../template/user/dashboard.php"); 
            }

            // =================================== Partie Documentation =================================== \\

            // Sinon, si la première partie de mon URL est égale à "documentation"
            elseif ($fragUrl[1] == "documentation")
            { 
                // Si le nombre d'informations dans $fragUrl est strictement égal à 2 
                if (count($fragUrl) === 2) 
                { 
                    include("../template/documentation/listCategories.php"); 
                }

                // Sinon, si le nombre d'informations dans $fragUrl est suppérieur à 2
                elseif (count($fragUrl) > 2) 
                {

                    if ($fragUrl[2] == "creation-categorie")
                    {
                        include("../template/documentation/createCategory.php");
                    }

                    // Requête SQL : Récupération de tous les noms des catégories avec leur ID respectif
                    $sqlCategoryName = "SELECT * FROM `category`";
                    $query = $db->prepare($sqlCategoryName);
                    $query->execute();
                    $categoryName = $query->fetchAll();

                    // Compte du nombre d'informations dans le tableau de la variable $categoryName
                    $countCategoryName = count($categoryName);

                    // Boucle en fonction du nombre d'informations dans $categoryName
                    for ($i=0; $i < $countCategoryName; $i++) 
                    { 
                        // Vérification que l'information numéro 2 de l'url existe
                        $categoryNameTempo = ucfirst($fragUrl[2]);
                        // if ((!in_array($fragUrl[2], $categoryName[$i]["categoryName"])) || (!in_array($categoryNameTempo, $categoryName[$i]["categoryName"]))) 
                        // { 
                        //     header("Location: /404"); 
                        // }

                        // Si l'information numéro 2 de l'url est bonne
                        if ($fragUrl[2] == $categoryName[$i]["categoryName"])
                        {
                            // Si l'url comporte strictement 3 informations alors afficher la page de la catégorie
                            if (count($fragUrl) === 3) 
                            { 
                                include("../template/documentation/documentation.php"); 
                            } 

                            // Sinon si l'url comporte plus de 3 informations
                            elseif (count($fragUrl) > 3)
                            {
                                if ($fragUrl[3] == "creation-repertoire")
                                {
                                    include("../template/documentation/createDirectory.php");
                                }

                                // Requête SQL : Récupération de tous les noms des répertoires avec leur ID respectif (en fonction de la catégorie)
                                $sqlDirectoryName = "SELECT * FROM `directory` WHERE `categoryID` = :categoryID";
                                $query = $db->prepare($sqlDirectoryName);
                                $query->bindValue(":categoryID", $categoryName[$i]["ID"]);
                                $query->execute();
                                $directoryName = $query->fetchAll();
                                
                                // Compte du nombre d'informations dans le tableau de la variable $directoryName
                                $countDirectoryName = count($directoryName);

                                // Boucle en fonction du nombre d'informations dans $directoryName
                                for ($a=0; $a < $countDirectoryName; $a++) 
                                { 
                                    // Vérification que l'information numéro 3 de l'url existe
                                    $directoryNameTempo = ucfirst($fragUrl[3]);
                                    // if ((!in_array($fragUrl[3], $directoryName[$a]["directoryName"])) || (!in_array($directoryNameTempo, $directoryName[$a]["directoryName"]))) 
                                    // { 
                                    //     header("Location: /404"); 
                                    // }

                                    // Si l'information numéro 3 de l'url est bonne
                                    if ($fragUrl[3] == $directoryName[$a]["directoryName"]) 
                                    {
                                        // Si l'url comporte strictement 4 informations alors afficher la page de du répertoire
                                        if (count($fragUrl) === 4) 
                                        { 
                                            include("../template/documentation/documentation.php"); 
                                        }

                                        // Sinon si l'url comporte plus de 4 informations
                                        elseif (count($fragUrl) > 4) 
                                        {
                                            if ($fragUrl[4] == "creation-document")
                                            {
                                                include("../template/documentation/createDocument.php");
                                            }

                                            // Requête SQL : Récupération de tous les noms des documents avec leur ID respectif (en fonction du répertoire)
                                            $sqlDocumentName = "SELECT * FROM `document` WHERE `directoryID` = :directoryID";
                                            $query = $db->prepare($sqlDocumentName);
                                            $query->bindValue(":directoryID", $directoryName[$a]["ID"]);
                                            $query->execute();
                                            $documentName = $query->fetchAll();
                                
                                            // Compte du nombre d'informations dans le tableau de la variable $documentName
                                            $countDocumentName = count($documentName);

                                            // Boucle en fonction du nombre d'informations dans $documentName
                                            for ($b=0; $b < $countDocumentName; $b++) 
                                            { 
                                                // Vérification que l'information numéro 4 de l'url existe
                                                $documentNameTempo = ucfirst($fragUrl[4]);
                                                // if ((!in_array($fragUrl[4], $documentName[$b]["documentName"])) || (!in_array($documentNameTempo, $documentName[$b]["documentName"]))) 
                                                // { 
                                                //     header("Location: /404"); 
                                                // }

                                                // Si l'information numéro 4 de l'url est bonne, affiche la page du document
                                                if ($fragUrl[4] == $documentName[$b]["documentName"])
                                                {
                                                    include("../template/documentation/documentation.php");
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            // ============================================================================================ \\

            // Sinon, affichage page d'erreur (Page introuvable)
            else 
            {
                header("Location: /404");
            }
        }
    ?>
</body>
</html>