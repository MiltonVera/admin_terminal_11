$(document).ready(function() {
    
    $('#guardar-registro').on('submit', function(e) {
        e.preventDefault();
        let datos = $(this).serializeArray();
        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data) {
                let resultado = data;
                console.log(resultado);
                if (resultado.respuesta == "exito") {
                    Swal.fire(
                        'Correcto',
                        'Se guardo correctamente',
                        'success'
                    )
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hubo un error',
                        text: 'Prueba un nombre de ususario diferente',
                        footer: ''
                    })
                }

            }
        })
    });
    $('#guardar-registro-archivo').on('submit', function(e) {
        e.preventDefault();
        let datos = new FormData(this);
        
        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            contentType: false,
            processData: false,
            async: true,
            cache: false,
            success: function(data) {
                let resultado = data;
                console.log(resultado);
                if (resultado.respuesta == "exito") {
                    Swal.fire(
                        'Correcto',
                        'Se guardo correctamente',
                        'success'
                    )
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hubo un error',
                        text: 'Prueba un nombre de ususario diferente',
                        footer: ''
                    })
                }

            }
        })
    });
    $('.borrar_registro').on('click', function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        let tipo = $(this).attr('data-tipo');
        Swal.fire({
            title: '¿Estas seguro?',
            text: "Esta accion no se puede revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Borrar'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Borrado!',
                    'Ha sido borrado',
                    'success'
                )
                $.ajax({
                    type: 'post',
                    data: {
                        'id': id,
                        'registro': 'eliminar'

                    },
                    url: 'modelo-' + tipo + '.php',
                    success: function(data) {                       
                        let resultado = JSON.parse(data);
                        jQuery('[data-id="' + id + '"]').parents('tr').remove();
                        Swal.fire(
                            'Correcto',
                            'Se elimino correctamente',
                            'success'
                        )
                    }
                })
            }
        })
    });
    $('#login-admin').on('submit', function(e) {
        e.preventDefault();
        let datos = $(this).serializeArray();
        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data) {
                let resultado = data;
                if (resultado.respuesta == "exito") {
                    setTimeout(() => {
                        window.location.href = 'admin-area.php';
                    }, 1000);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Credenciales incorrectas',
                        text: 'Revisa tus credenciales',
                        footer: ''
                    })
                }
            }
        })
    });
    $('.borrar_todo').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            data: {
                'accion': 'eliminar'
            },
            url: 'modelo-admin.php',
            success: function(data) {
                $('.borrar-solicitudes').remove();
                Swal.fire(
                    'Correcto',
                    'Se borraron todas las solicitudes',
                    'success'
                )
            }
        })
    });

    $('.marcar_registro').on('click', function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        let tipo = $(this).attr('data-tipo');
        Swal.fire({
            title: '¿Estas seguro?',
            text: "Esta accion no se puede revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Cambiar'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Listo',
                    'El Barco se ha marcado como facturado',
                    'success'
                )
                $.ajax({
                    type: 'post',
                    data: {
                        'id': id,
                        'registro': 'cambio'

                    },
                    url: 'modelo-' + tipo + '.php',
                    success: function(data) {                       
                        let resultado = JSON.parse(data);
                        jQuery('[estatus_id="' + id + '"]').text("Facturado");
                        Swal.fire(
                            'Listo',
                            'El barco se ha marcado como facturado',
                            'success'
                        )
                    }
                })
            }
        })
    });

    


});