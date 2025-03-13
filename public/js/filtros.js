$(document).ready(function() {
    // Detectar cambios en el campo de búsqueda o el select de estado
    $('#search, #filter').on('input change', function() {
        fetchIncidencies();
    });

    function fetchIncidencies() {
        const search = $('#search').val();
        const filter = $('#filter').val();

        $.ajax({
            url: "/tecnico/incidencia/filter",
            method: "GET",
            data: { search: search, filter: filter },
            success: function(response) {
                $('#incidencies-container').html(response);
            },
            error: function() {
                alert("Error al cargar las incidencias.");
            }
        });
    }

});