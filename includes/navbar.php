<?php
    if (count($fragUrl) >= 3 && $fragUrl[2] != "creation-categorie")
    {
        $sqlCategory = "SELECT `ID`, `categoryName` FROM `category` WHERE `categoryName` = :categoryName";

        $query = $db->prepare($sqlCategory);
        $query->bindValue(":categoryName", $fragUrl[2]);
        $query->execute();

        $category = $query->fetch();

        $sqlDirectory = "SELECT `ID`, `directoryName`, `categoryID` FROM `directory` WHERE `categoryID` = :categoryID";
        
        $query = $db->prepare($sqlDirectory);
        $query->bindValue(":categoryID", $category["ID"]);
        $query->execute();

        $directory = $query->fetchAll();
    }
?>

<!----------------------------- Barre navigation ----------------------------->
<nav>
        <div class="content">
            <header>
                <div class="logo">
                    <!-- <img src="./assets/img/ddd.png" alt="DocDuDev"> -->
                </div>
                <a href="/" class="navG-btn">
                    <p>Accueil</p>
                </a>
                <a href="/documentation" class="navG-btn">
                    <p>Documentation</p>
                </a>
                <hr>
            </header>
            <div class="docNav">
                <?php
                    if (count($fragUrl) >= 3 && $fragUrl[2] != "creation-categorie")
                    {
                        $countDir = count($directory);
                        for ($i=0; $i < $countDir; $i++) 
                        { 
                            $dirName = $directory[$i]["directoryName"];
                            echo '<a href="/documentation/'. $category["categoryName"] .'/'. $dirName .'" class="navG-btn">
                                <p>'. $dirName .'</p>
                            </a>';
                        
                            $sqlDocument = "SELECT `ID`, `documentName`, `directoryID` FROM `document` WHERE `directoryID` = :directoryID";
                        
                            $query = $db->prepare($sqlDocument);
                            $query->bindValue(":directoryID", $directory[$i]["ID"]);
                            $query->execute();
                        
                            $document = $query->fetchAll();
                        
                            $countDoc = count($document); 
                            for ($a=0; $a < $countDoc; $a++) 
                            { 
                                echo '<a href="/documentation/'. $category["categoryName"] .'/'. $dirName .'/'. $document[$a]["documentName"] .'" class="navG-btn">
                                    <p>'. $document[$a]["documentName"] .'</p>
                                </a>';
                            }

                            echo "<br>";
                        }
                    }
                    
                ?>
            </div>
            <footer>
                <hr>
                <?php
                if (!$_SESSION) // Si aucune session en cours
                {
                    echo '
                    <a href="/inscription" class="navG-btn">
                        <p>Inscription</p>
                    </a>
                    <a href="/connexion" class="navG-btn">
                        <p>Connexion</p>
                    </a>
                    ';
                }
                else    // Si une session est en cours
                {
                    echo '
                    <a href="/compte" class="navG-btn">
                        <p>Compte</p>
                    </a>
                    ';
                }
                ?>
            </footer>
        </div>
    </nav>