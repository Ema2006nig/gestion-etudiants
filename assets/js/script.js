// Validation du formulaire d'ajout
const addForm = document.getElementById('addForm');
if (addForm) {
    addForm.addEventListener('submit', function(e) {
        const nom = this.querySelector('[name="nom"]').value.trim();
        const prenom = this.querySelector('[name="prenom"]').value.trim();
        if (nom === '' || prenom === '') {
            alert('Veuillez remplir le nom et le prénom.');
            e.preventDefault();
        }
    });
}

// Validation du formulaire de modification
const updateForm = document.getElementById('updateForm');
if (updateForm) {
    updateForm.addEventListener('submit', function(e) {
        const nom = this.querySelector('[name="nom"]').value.trim();
        const prenom = this.querySelector('[name="prenom"]').value.trim();
        if (nom === '' || prenom === '') {
            alert('Veuillez remplir le nom et le prénom.');
            e.preventDefault();
        }
    });
}

// Confirmation avant suppression
document.querySelectorAll('.delete-link').forEach(link => {
    link.addEventListener('click', function(e) {
        if (!confirm('Voulez-vous vraiment supprimer cet étudiant ?')) {
            e.preventDefault();
        }
    });
});