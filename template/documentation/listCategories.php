<?php
    $sqlCategoryName = "SELECT `categoryName` FROM `category`";
    $query = $db->prepare($sqlCategoryName);
    $query->execute();
    $categoryName = $query->fetchAll();

    $countCategories = count($categoryName);
?>

<main>
    <div class="content">
        <?php
            for ($i=0; $i < $countCategories; $i++) { 
                echo '
                    <a href="/documentation/'.$categoryName[$i]["categoryName"].'" class="doc-btn">
                        <button>'.$categoryName[$i]["categoryName"].'</button>
                    </a>
                ';
            }
        ?>
        <a href="/documentation/creation-categorie" class="doc-btn">
            <button>
                +
            </button>
        </a>
    </div>
</main>