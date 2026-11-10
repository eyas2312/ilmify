/* =========================================================
   Ilmify — Interactions JavaScript globales
   Vanilla JS uniquement (aucun build, aucune dépendance npm).
   Bootstrap gère déjà les menus, modales et alertes ; on
   ajoute seulement les comportements propres à Ilmify.
   ========================================================= */
(function () {
    "use strict";

    /* 1. Ombre de la barre de navigation au défilement */
    const nav = document.querySelector(".site-nav");
    if (nav) {
        const onScroll = () => nav.classList.toggle("is-scrolled", window.scrollY > 8);
        onScroll();
        window.addEventListener("scroll", onScroll, { passive: true });
    }

    /* 2. Apparition progressive des blocs [data-reveal] */
    const revealItems = document.querySelectorAll("[data-reveal]");
    if (revealItems.length) {
        if ("IntersectionObserver" in window) {
            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add("is-visible");
                            observer.unobserve(entry.target);
                        }
                    });
                },
                { rootMargin: "0px 0px -8% 0px", threshold: 0.08 }
            );
            revealItems.forEach((el) => observer.observe(el));
        } else {
            revealItems.forEach((el) => el.classList.add("is-visible"));
        }
    }

    /* 3. Fermeture automatique des alertes Bootstrap après 5 s */
    document.querySelectorAll(".alert-dismissible").forEach((alert) => {
        window.setTimeout(() => {
            if (window.bootstrap && window.bootstrap.Alert) {
                window.bootstrap.Alert.getOrCreateInstance(alert).close();
            }
        }, 5000);
    });

    /* 4. Année courante dans le pied de page */
    document.querySelectorAll("[data-current-year]").forEach((el) => {
        el.textContent = new Date().getFullYear();
    });
})();
