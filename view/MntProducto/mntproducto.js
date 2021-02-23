function init(){

}

$(document).ready(function(){
	vertodo();
});

$(document).on("click","#btnvertodo", function(){
    vertodo();
});

$(document).on("click","#btnnuevo", function(){
    limpiar();
    $("#modalmantenimiento").modal('show');
});

$(document).on("click","#btnbuscar", function(){
    var categoria = $('#txtcategoria').val();

    tabla= $('#producto_table').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5'
        ],
        "ajax":{
            url: 'ServicioProducto.php?op=buscarcategoria',
            type : "post",
            dataType : "json",
            data : {categoria:categoria},
            error: function(e){
                console.log(e.responseText);
            }
        },
        "ordering": false,
        'rowsGroup': [0,1],
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 100,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
    });
});

$(document).on("click","#btnguardar", function(){
    var id = $('#id').val();
    var nombrep = $('#nombrep').val();
    var descripcion = $('#descripcion').val();
    var categoria = $('#categoria').val();
    var precio = $('#precio').val();

    if(id==''){
        $.post("ServicioProducto.php?op=guardar",{nombrep:nombrep,descripcion:descripcion,categoria:categoria,precio:precio},function(data, status){

        });
    }else{
        $.post("ServicioProducto.php?op=actualizar",{id:id,nombrep:nombrep,descripcion:descripcion,categoria:categoria,precio:precio},function(data, status){

        });
    }

    $('#producto_table').DataTable().ajax.reload();

    $("#modalmantenimiento").modal('hide');
});

function editar(id){
    $.post("ServicioProducto.php?op=mostrar",{id:id},function(data, status){
        data = JSON.parse(data);
        $('#id').val(data.id);
        $('#nombrep').val(data.nombrep);
        $('#descripcion').val(data.descripcion);
        $('#categoria').val(data.categoria);
        $('#precio').val(data.precio);
    });

    $("#modalmantenimiento").modal('show');
}

function limpiar(){
    $('#id').val('');
    $('#nombrep').val('');
    $('#descripcion').val('');
    $('#categoria').val('');
    $('#precio').val('');
}

function eliminar(id){
    Swal.fire({
        title: 'Desea Eliminar el Registro?',
        showCancelButton: true,
        cancelButtonText: `Cerrar`,
        confirmButtonText: `Eliminar`,
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("ServicioProducto.php?op=eliminar",{id:id},function(data, status){

            });

            Swal.fire('Eliminado!', '', 'success')

            $('#producto_table').DataTable().ajax.reload();

        }
    })
}

function activar(id){
    $.post("ServicioProducto.php?op=activar",{id:id,estado:1},function(data, status){

    });

    $('#producto_table').DataTable().ajax.reload();
}

function desactivar(id){
    $.post("ServicioProducto.php?op=activar",{id:id,estado:0},function(data, status){

    });

    $('#producto_table').DataTable().ajax.reload();
}

function vertodo(){
    tabla= $('#producto_table').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5'
        ],
        "ajax":{
            url: 'ServicioProducto.php?op=listar',
            type : "post",
            dataType : "json",
            error: function(e){
                console.log(e.responseText);
            }
        },
        "ordering": false,
        'rowsGroup': [0,1],
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 100,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
    });
}


init();