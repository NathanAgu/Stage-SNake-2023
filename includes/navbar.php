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
<header class="active">
    <nav>
        <ul>
            <li class="navButton title"><button id="burgerMenu"><img class="icon" src="./assets/svg/menu-burger.svg" alt="Icon Menu">    <span>SNake</span>          </button></a></li>
            <li class="navButton"><a href="/"><button> <img class="icon" src="./assets/svg/accueil.svg" alt="Icon Accueil">     <span>Accueil</span>        </button></a></li>
            <li class="navButton"><a href="/a-propos"><button> <img class="icon" src="./assets/svg/a-propos.svg" alt="Icon À-propos">   <span>À&nbsp;propos</span>  </button></a></li>
            <li class="navButton"><a href="/documentation"><button> <img class="icon" src="./assets/svg/documents.svg" alt="Icon documents"> <span>Documents</span>      </button></a></li>
            <li class="navButton"><a href="/activites"><button> <img class="icon" src="./assets/svg/activités.svg" alt="Icon Activités"> <span>Activités</span>      </button></a></li>
        </ul>
        <?php
            if (count($fragUrl) >= 3 && $fragUrl[1] == "documentation" && $fragUrl[2] != "creation-categorie")
            {
                echo '
                    <div class="navDoc">
                        <ul>
                            <li class="navButton navDocBtn">
                                <a href="/documentation/'. $category["categoryName"] .'"><button class="name docTitle">'. $category["categoryName"] .'</button></a>
                                <a href=""><button class="settings"><img src="./assets/svg/reglages.svg" alt=""></button></a>
                            </li>
                            <li class="navButton navDocBtn">
                                <a href="/documentation/'. $category["categoryName"] .'/creation-repertoire"><button class="name">Ajout répertoire</button></a>
                                <a href="/documentation/'. $category["categoryName"] .'/creation-repertoire"><button class="settings"><img src="./assets/svg/plus.svg" alt=""></button></a>
                            </li>
                        </ul>
                        <ul>
                ';

                $countDir = count($directory);
                for ($i=0; $i < $countDir; $i++) 
                { 
                    $dirName = $directory[$i]["directoryName"];
                    echo '
                    <li>
                        <ul>
                            <li class="navButton navDocBtn">
                                <button class="name docTitle" id="dir1" onclick="directoryToggle()">'. $dirName .'</button>
                                <a href="" class="set"><button class="settings"><img src="./assets/svg/reglages.svg" alt=""></button></a>
                            </li>
                    ';
                
                    $sqlDocument = "SELECT `ID`, `documentName`, `directoryID` FROM `document` WHERE `directoryID` = :directoryID";
                
                    $query = $db->prepare($sqlDocument);
                    $query->bindValue(":directoryID", $directory[$i]["ID"]);
                    $query->execute();
                
                    $document = $query->fetchAll();
                
                    $countDoc = count($document); 
                    for ($a=0; $a < $countDoc; $a++) 
                    { 
                        echo '
                        <li class="navButton navDocBtn docBtn docActive">
                            <a href="/documentation/'. $category["categoryName"] .'/'. $dirName .'/'. $document[$a]["documentName"] .'"><button class="name">'. $document[$a]["documentName"] .'</button></a>
                            <a href=""><button class="settings"><img src="../assets/svg/reglages.svg" alt=""></button></a>
                        </li>
                        ';
                    }

                    echo '
                                <li class="navButton navDocBtn docBtn docActive">
                                    <a href="/documentation/'. $category["categoryName"] .'/'. $dirName .'/creation-document"><button class="name">Ajout document</button></a>
                                    <a href="/documentation/'. $category["categoryName"] .'/'. $dirName .'/creation-document"><button class="settings"><img src="./assets/svg/plus.svg" alt=""></button></a>
                                </li>
                            </ul>
                        </li>
                    ';
                }

                echo '
                            </li>
                        </ul>
                    </div>
                ';
            }
        ?>
    </nav>
    <div>
        <ul>
            <li class="navButton"><a href=""><button><img class="icon" src="./assets/svg/utilisateur.svg" alt=""><span>Connexion</span></button></a></li>
        </ul>
    </div>
</header>