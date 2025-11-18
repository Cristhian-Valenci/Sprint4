document.addEventListener('DOMContentLoaded', () => {
    let ingredienteIndex = document.querySelectorAll('.ingrediente-row').length;


    document.getElementById('add-ingrediente').addEventListener('click', function() {
        const container = document.getElementById('ingredientes-container');
        const newRow = document.querySelector('.ingrediente-row').cloneNode(true);
        // actualizar los nombres de los inputs
        newRow.querySelectorAll('select, input').forEach(input => {
            const name = input.getAttribute('name');
            const newName = name.replace(/\d+/, ingredienteIndex);
            input.setAttribute('name', newName);
            if(input.tagName === 'SELECT') input.selectedIndex = 0;
            else input.value = '';
        });

        container.appendChild(newRow);
        ingredienteIndex++;
    });
      // eliminar fila
    document.getElementById('ingredientes-container').addEventListener('click', function(e) {
        const btn = e.target.closest('.remove-ingrediente'); // Buscar el botón más cercano al elemento clickeado
        if (!btn) return;

        const row = btn.closest('.ingrediente-row');
        const rows = document.querySelectorAll('.ingrediente-row');
        if (rows.length > 1 && row) row.remove();
    });
});
