<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Galerie Photos</title>
    <link rel="stylesheet" href="Gallery.css">
</head>
<body>
    <div class="header">
        <a href="../index.html">
            <img class="Logo" style="padding-right: 1460px; height:57.5px;" src="../Images/Logo.png" alt="Logo">
        </a>

    </div>

    <div id="sideMenu" class="side-menu">
        <button class="close-menu" id="closeMenuBtn">&times;</button>

        <nav class="menu-links">
            <a href="#accueil">Accueil</a>
            <a href="#livre">Le livre</a>
            <a href="#auteur">L'auteur</a>
            <a href="#contact">Contact</a>
        </nav>
    </div>

    <h1 style="margin-bottom: 0px;">Galerie Photo</h1>

    <div class="bg-gallery">
        <div class="gallery" data-gallery-type="galerie">
            <?php
            $dir = "../Galerie/";
            $files = glob($dir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

            // Trier par date de modification (plus récent en premier)
            usort($files, function($a, $b) {
            return filemtime($b) - filemtime($a);
            });

            foreach ($files as $index => $file) {
            $filename = basename($file);
            $filename = pathinfo(basename($file), PATHINFO_FILENAME);
            echo "<div class='image-container'>
                <img src='$file' data-index='$index' data-name='$filename' alt='photo'>
            </div>";
            }
            ?>
        </div>
    </div>

    <!-- Lightbox -->
    <div id="lightbox">
        <button id="close">×</button>
        <button id="prev"><</button>
        <img id="lightbox-img" src="" />
        <button id="next">></button>
        <div id="caption"></div>
    </div>

    <script src="../Javascript/Gallery.js"></script>
    <script src="../Javascript/SideMenu.js"></script>
    <script src="../Javascript/darkmode.js"></script>
    <script>
        window.addEventListener("load", adjustGalleryHeight);
        window.addEventListener("resize", adjustGalleryHeight);

        function adjustGalleryHeight() {
            const bgGallery = document.querySelector(".bg-gallery");
            const gallery = document.querySelector(".gallery");
            const galleryBottom = gallery.offsetTop + gallery.offsetHeight;
            const windowHeight = window.innerHeight;

            if (galleryBottom <= windowHeight) {
                bgGallery.style.height = "100vh";
            } else {
                bgGallery.style.height = "auto";
            }
        }
    </script>
</body>
</html>