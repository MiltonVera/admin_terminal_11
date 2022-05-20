$(function() {
    $('.sidebar-menu').tree()


    $('#registros').DataTable({
        'paging': true,
        'pageLenght': 10,
        'lengthChange': false,
        'searching': true,
        'ordering': false,
        'info': true,
        'autoWidt': false,
        'language': {
            paginate: {
                next: 'Siguiente',
                previous: 'Anterior',
                last: 'Ultimo',
                first: 'Primero'
            },
            info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
            emptyTable: 'No hay registros',
            infoEmpty: '0 Registros',
            search: 'Buscar: '
        }
    });

   
});