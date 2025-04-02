// resources/js/eventos.js
document.addEventListener('DOMContentLoaded', function() {
    // Previsualización de imagen al seleccionar un archivo
    const imagenInput = document.getElementById('imagen');
    if (imagenInput) {
        imagenInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    let preview = document.getElementById('imagen-preview');
                    if (!preview) {
                        preview = document.createElement('img');
                        preview.id = 'imagen-preview';
                        preview.className = 'img-thumbnail mt-2';
                        preview.style.maxHeight = '150px';
                        imagenInput.parentNode.appendChild(preview);
                    }
                    preview.src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }
    
    // Validación del formulario
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('Por favor complete todos los campos requeridos.');
            }
        });
    });
});