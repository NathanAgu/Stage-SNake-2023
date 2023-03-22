<main>
    <div class="content">
        <?php
            if (count($fragUrl) === 3)
            {
                echo "<p>".$categoryName[$i]["categoryDescription"]."</p>";
                echo "
                <a href='/documentation/".$categoryName[$i]["categoryName"]."/creation-repertoire' class='doc-btn'>
                    <button>
                        +
                    </button>
                </a>
                ";
            }
            elseif (count($fragUrl) === 4)
            {
                echo "<p>".$directoryName[$a]["directoryDescription"]."</p>";
                echo "
                <a href='/documentation/".$categoryName[$i]["categoryName"]."/".$directoryName[$a]["directoryName"]."/creation-document' class='doc-btn'>
                    <button>
                        +
                    </button>
                </a>
                ";
            }
            elseif (count($fragUrl) === 5)
            {
                echo "<p>".$directoryName[$a]["directoryName"]." ".$documentName[$b]["documentName"]."</p>
                    <br>
                    <p>".$documentName[$b]["documentDescription"]."</p>
                    <br>
                    <p>".$documentName[$b]["documentContent"]."</p>
                    <br>
                    <p>".$documentName[$b]["documentImages"]."</p>";
            }
        ?>
    </div>
</main>