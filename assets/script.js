/**
 * 🎓 Gestion des étudiants – Scripts de validation et de confirmation
 *
 * Ce fichier centralise toutes les interactions utilisateur :
 * - Validation des formulaires d'ajout et de modification
 * - Confirmation avant suppression d'un étudiant
 *
 * Aucune dépendance externe n'est requise.
 */

/* ───────────────────────────────────────────────
   Initialisation au chargement complet du DOM
   ─────────────────────────────────────────────── */
document.addEventListener('DOMContentLoaded', () => {

    /* ══════════════════════════════════════════════
       Formulaires de saisie (ajout & modification)
       ══════════════════════════════════════════════ */
    const setupValidation = (formElement) => {
        if (!formElement) return;

        formElement.addEventListener('submit', function (event) {
            const nom = this.querySelector('[name="nom"]').value.trim();
            const prenom = this.querySelector('[name="prenom"]').value.trim();

            if (nom === '' || prenom === '') {
                alert('Veuillez remplir le nom et le prénom.');
                event.preventDefault();
            }
        });
    };

    // Application aux deux formulaires
    setupValidation(document.getElementById('addForm'));
    setupValidation(document.getElementById('updateForm'));

    /* ══════════════════════════════════════════════
       Liens de suppression – demande de confirmation
       ══════════════════════════════════════════════ */
    const deleteLinks = document.querySelectorAll('.delete-link');

    deleteLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            const confirmation = confirm('Voulez-vous vraiment supprimer cet étudiant ?');
            if (!confirmation) {
                event.preventDefault();
            }
        });
    });

});