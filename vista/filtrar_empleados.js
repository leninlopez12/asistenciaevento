// Obtener el selector de eventos
const selectEvento = document.getElementById('selectEvento');

// Cuando se cambia la selección del evento
selectEvento.addEventListener('change', function() {
    // Obtener el ID del evento seleccionado
    const eventoId = this.value;
    
    // Realizar una solicitud AJAX para filtrar los empleados por evento
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'controlador_selector_evento.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.status === 200) {
            // Insertar las filas de empleados filtrados en la tabla
            document.getElementById('empleadosTableBody').innerHTML = this.responseText;
        }
    }
    xhr.send('evento_id=' + eventoId);
});
