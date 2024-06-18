document.addEventListener('DOMContentLoaded', function() {
    let checkboxes = document.querySelectorAll('.removeCheckbox');
    
    checkboxes.forEach(function(checkbox) {
        let label = document.querySelector('label[for="' + checkbox.id + '"]');
        if (label) {
            label.addEventListener('click', function() {
                checkbox.value = checkbox.value === "0" ? "1" : "0";

                let section = label.closest('.afleveringEdit'); 
                let table = section.querySelector('.maxWidth');

                if (checkbox.value === "1") {
                    table.classList.add('highlight');
                } else {
                    table.classList.remove('highlight');
                }

            });
        }
    });
});
