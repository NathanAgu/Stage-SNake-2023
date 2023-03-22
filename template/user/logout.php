<?php
    unset($_SESSION["user"]);   // Suppression session utilisateur
    header("Location: /")      // Redirection vers accueil
?>