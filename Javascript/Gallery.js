document.addEventListener("DOMContentLoaded", () => {
    const gallery = document.querySelector(".gallery");
    const type = gallery?.dataset?.galleryType;
    const lightbox = document.getElementById("lightbox");
    const lightboxImg = document.getElementById("lightbox-img");
    const caption = document.getElementById("caption");
    const closeBtn = document.getElementById("close");
    const prevBtn = document.getElementById("prev");
    const nextBtn = document.getElementById("next");

    let currentIndex = 0;
    let imageList = [];

    // Fonction d’affichage
    function renderGallery(images) {
        images.forEach((img, index) => {
            const container = document.createElement("div");
            container.classList.add("gallery-item");

            const imageElement = document.createElement("img");
            imageElement.src = img.path;
            imageElement.alt = img.name;
            imageElement.dataset.index = index;
            imageElement.dataset.name = img.name;

            container.appendChild(imageElement);
            gallery.appendChild(container);

            imageList.push({ src: img.path, name: img.name });
        });

        setupLightboxEvents();
    }

    function setupLightboxEvents() {
        const allImages = gallery.querySelectorAll("img");

        allImages.forEach((img, index) => {
            img.addEventListener("click", () => {
                currentIndex = parseInt(img.dataset.index);
                showImage();
            });
        });

        closeBtn.addEventListener("click", () => {
            lightbox.style.display = "none";
        });

        lightbox.addEventListener("click", (e) => {
            if (e.target === lightbox) {
                lightbox.style.display = "none";
            }
        });

        prevBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            currentIndex = (currentIndex - 1 + imageList.length) % imageList.length;
            showImage();
        });

        nextBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            currentIndex = (currentIndex + 1) % imageList.length;
            showImage();
        });

        window.addEventListener("keydown", (e) => {
            if (lightbox.style.display === "flex") {
                if (e.key === "ArrowLeft") prevBtn.click();
                if (e.key === "ArrowRight") nextBtn.click();
                if (e.key === "Escape") closeBtn.click();
            }
        });
    }

    function showImage() {
        const img = imageList[currentIndex];
        lightboxImg.src = img.src;
        caption.textContent = img.name;
        lightbox.style.display = "flex";
    }

    // Démarrage selon le type de page
    if (type === "accueil") {
        console.log("Tentative de chargement des images…");
        fetch("../Php/fetchGallery.php?limit=6")
            .then(res => res.json())
            .then(images => renderGallery(images))
            .catch(err => console.error("Erreur lors du chargement :", err));
    } else {
        const images = gallery.querySelectorAll("img");
        imageList = Array.from(images).map((img, i) => ({
            src: img.src,
            name: img.dataset.name || `Image ${i + 1}`
        }));

        images.forEach((img, i) => img.dataset.index = i);
        setupLightboxEvents();
    }
});