<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galerie Photos — Monica Hards</title>
    <link rel="stylesheet" href="Gallery.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>

    <div class="header">
        <a href="../index.html">
            <img class="Logo" src="../Images/Logo.png" alt="Logo Monica Hards">
        </a>
    </div>

    <div id="sideMenu" class="side-menu">
        <button class="close-menu" id="closeMenuBtn" aria-label="Fermer">&times;</button>
        <nav class="menu-links">
            <a href="#accueil">Accueil</a>
            <a href="#livre">Le livre</a>
            <a href="#auteur">L'auteur</a>
            <a href="#contact">Contact</a>
        </nav>
    </div>

    <h1 class="page-title">Galerie Photo</h1>

    <div class="bg-gallery">
        <div class="gallery" data-gallery-type="galerie">
            <?php
            $dir = "../Galerie/";
            $files = glob($dir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

            usort($files, function($a, $b) {
                return filemtime($b) - filemtime($a);
            });

            foreach ($files as $index => $file) {
                $filename = pathinfo(basename($file), PATHINFO_FILENAME);
                echo "<div class='image-container'>
                    <img src='$file' data-index='$index' data-name='$filename' alt='$filename' loading='lazy'>
                </div>";
            }
            ?>
        </div>
    </div>

    <!-- Lightbox -->
    <div id="lightbox">
        <button id="close" aria-label="Fermer">×</button>
        <button id="prev" aria-label="Précédent">&lsaquo;</button>
        <img id="lightbox-img" src="" alt="">
        <button id="next" aria-label="Suivant">&rsaquo;</button>
        <div id="caption"></div>
    </div>

    <script src="../Javascript/Gallery.js"></script>
    <script src="../Javascript/SideMenu.js"></script>
    <script src="../Javascript/darkmode.js"></script>
</body>
</html>
