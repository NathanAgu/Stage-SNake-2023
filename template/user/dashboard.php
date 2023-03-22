<?php
    // Vérifie si la session est créée
    if (!isset($_SESSION['user'])) 
    {
        header('Location: /connexion');     // Redirection
        exit();
    }
?>

<main>
    <div class="content">
        <a href="/deconnexion" class="cl-btn">
            <button>Déconnexion</button>
        </a>
    </div>
</main>