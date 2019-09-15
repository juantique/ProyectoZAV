<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
    <title>Ajax CRUD CodeIgniter ZAV</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="js/bootstrap.min.js">


</head>
<body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <a href="https://www.webdamn.com" class="navbar-brand">ZAP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="container">	
        <div class="row">
            <div class="col-md-12">
                    <div class="col-md-8 text-center">
                    <br>
                    <h1>Ajax CRUD CodeIgniter ZAV<br>
                        <!--<div class="float-right">
                        <a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#addClienteModal">
                        <span class="fa fa-plus"></span> Crear Cliente
                        </a>
                        </div>
                        <br>--> 
                    </h1>
                    
                    <!-- Script -->
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                        <script type='text/javascript'>
                        $(document).ready(function(){
                            listClientes();
                            function listClientes(){
                            $.ajax({
                                url:'<?=base_url()?>index.php/CrudController/show',
                                method: 'get',
                                dataType: 'json',
                                success: function(response){
                                var len = response.length;
                                if(len > 0){
                                    var html = '';
                                    var i;
                                    for(i=0; i<response.length; i++){
                                    html += '<tr id="'+response[i].idcliente+'">'+
                                        '<td>'+response[i].Nombre+'</td>'+
                                        '<td>'+response[i].Correo+'</td>'+
                                        '<td>'+response[i].Celular+'</td>'+		                        
                                        '<td>'+response[i].Motivo+'</td>'+
                                        '<td>'+response[i].Comentario+'</td>'+
                                        '<td style="text-align:right;">'+
                                        '<a href="javascript:void(0);" class="btn btn-info btn-sm editRecord" data-id="'+response[i].idcliente+'" data-nombre="'+response[i].nombrecliente+'" data-correo="'+response[i].correocliente+'" data-celular="'+response[i].celularcliente+'" data-motivo="'+response[i].motivocliente+'" data-comentario="'+response[i].comentariocliente+'">Editar</a>'+' '+
                                        '<a href="javascript:void(0);" class="btn btn-danger btn-sm deleteRecord" data-id="'+response[i].idcliente+'">Eliminar</a>'+
                                        '</td>'+
                                        '</tr>';
                                    }
                                    $('#ctrlListadoClientes').html(html);
                                }else{
                                    //$('#suname').text('');
                                    //$('#sname').text('');
                                    //$('#semail').text('');
                                } 
                                }
                            });
                            }
                            // GUARDAR CLIENTE DEL FORMULARIO
                            $('#GuardarClienteForm').submit('click',function(){
                            var nuevoNombre = $('#txtGuardarNombre').val();
                            var nuevoCorreo = $('#txtGuardarCorreo').val();
                            var nuevoCelular = $('#txtGuardarCelular').val();
                            var nuevoMotivo = $('#ddlGuardarMotivo').val();
                            var nuevoComentario = $('#txtGuardarComentario').val();
                            $.ajax({
                                type : "POST",
                                url  : "<?=base_url()?>index.php/CrudController/save",
                                dataType : "JSON",
                                data : {Nombre:nuevoNombre, Correo:nuevoCorreo, Celular:nuevoCelular, Motivo:nuevoMotivo, Comentario:nuevoComentario},
                                success: function(data){
                                $('#txtGuardarNombre').val("");
                                $('#txtGuardarCorreo').val("");
                                $('#txtGuardarCelular').val("");
                                $('#txtGuardarMotivo').val("");
                                $('#txtGuardarComentario').val("");
                                $('#addCrudModel').modal('hide');
                                listClientes();
                                }
                            });
                            return false;
                            });

                            // Carga el Form Modal Edicion con los datos
                            $('#ctrlListadoClientes').on('click','.editRecord',function(){
                            $('#editCrudModel').modal('show');
                            $("#hideIdCliente").val($(this).data('id'));
                            $("#txtUpdateNombre").val($(this).data('nombre'));
                            $("#txtUpdateCorreo").val($(this).data('correo'));
                            $("#txtUpdateCelular").val($(this).data('celular'));
                            $("#ddlUpdateMotivo").val($(this).data('motivo'));
                            $("#txtUpdateComentario").val($(this).data('comentario'));
                            });

                            $('#ActualizaClienteForm').on('submit',function(){
                            var updateIdCliente = $('#hideIdCliente').val();
                            var updateNombreCliente = $('#txtUpdateNombre').val();
                            var updateCorreoCliente = $('#txtUpdateCorreo').val();
                            var updateCelularCliente = $('#txtUpdateCelular').val();
                            var updateMotivoCliente = $('#ddlUpdateMotivo').val();
                            var updateComentarioCliente = $('#txtUpdateComentario').val();
                            $.ajax({
                                type : "POST",
                                url  : "<?=base_url()?>index.php/CrudController/update",
                                dataType : "JSON",
                                data : {idcliente:updateIdCliente, nombre:updateNombreCliente, correo:updateCorreoCliente, celular:updateCelularCliente, motivo:updateMotivoCliente, comentario:updateComentarioCliente},
                                success: function(data){
                                $("#hideIdCliente").val("");
                                $("#txtUpdateNombre").val("");
                                $('#txtUpdateCorreo').val("");
                                $("#txtUpdateCelular").val("");
                                $('#txtUpdateMotivo').val("");
                                $("#txtUpdateComentario").val("");
                                $('#editCrudModal').modal('hide');
                                listClientes();
                                }
                            });
                            return false;
                            });

                            // show delete form
                            $('#ctrlListadoClientes').on('click','.deleteRecord',function(){
                            var clienteId = $(this).data('id');
                            $('#deleteClienteModal').modal('show');
                            $('#deleteHideIdCliente').val(clienteId);
                            });

                            $('#EliminarClienteForm').on('submit',function(){
                            var eliminarIdCliente = $('#deleteHideIdCliente').val();
                            $.ajax({
                                type : "POST",
                                url  : "<?=base_url()?>index.php/CrudController/delete",
                                dataType : "JSON",
                                data : {idcliente:eliminarIdCliente},
                                success: function(data){
                                $("#"+eliminarIDCliente).remove();
                                $("#deleteHideIdCliente").val("");
                                $('#deleteClienteModal').modal('hide');
                                listClientes();
                                }
                            });
                            });
                        });
                        </script>
                    <!-- FIN del Script -->


                    <table class="table table-striped" id="tblViewClientes">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Celular</th>
                                    <th>Motivo de Visita</th>
                                    <th>Comentario</th>
                                    <th style="text-align: right;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="ctrlListadoClientes"></tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="col-md-12 text-center">
                                <h3>Formulario de Visitas</h3>
                            </div>
                            <div class="col-md-12">
                                <form class="form_reg" method="post" id="GuardarClienteForm">
                                    <div class="col-md-12">
                                        <label for=“” class=“input-group-addon”>Nombre Visitante: </label>
                                        <input class="form-control" name="txtGuardarNombre" type=“text” placeholder="&#128100;Nombre" required autofocus>
                                    </div>
                                    <div class="col-md-12">
                                        <label for=“” class=“input-group-addon”>Correo Electronico: </label>
                                        <input class="form-control" type=“text” name="txtGuardarCorreo" placeholder="&#9993;Email" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for=“” class=“input-group-addon”>Numero Celular: </label>
                                        <input class="form-control" type=“tel” name="txtGuardarCelular" placeholder="&#128222;Celular" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for=“” class=“input-group-addon”>Motivo de la Visita: </label>
                                        <textarea class="form-control" name="ddlGuardarMotivo" id="ddlGuardarMotivo" placeholder="Motivo por el cual nos visitas" required></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label for=“” class=“input-group-addon”>Comentarios: </label>
                                        <textarea class="form-control" name="txtGuardarComentario" id="txtGuardarComentario" class=“input” placeholder="Aquí tus comentarios:" required></textarea>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <br>
                                        <button type="button" class="btn btn-primary">Guardar</button>
                                        <!--<a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#addClienteModal">
                                            <span class="fa fa-plus"></span> Crear Cliente
                                        </a>--> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>        
    </div>
  
<!--<div class=“container-fluid”>
        <div class="row">
            <div class=“col-md-12”>
                <h1>Verificación de Visitas</h1>
            </div>
        </div>

        <div class=“row”>
            <div class=“col-md-4”>
                <div class=“panel panel-default”>
                    <div class=“panel-heading”>Agregar Visitante</div>
                    <div class=“panel-body”>
                        <form action=“” method=“post”>
                            <div class=“col-md-12 form-group input-group”>
                                <label for=“” class=“input-group-addon”>Nombre Visitante: </label>
                                <input type=“text” name=“visitante” class=“form-control”>
                            </div>
                            <div class=“col-md-12 form-group input-group”>
                                <label for=“” class=“input-group-addon”>Correo Electronico: </label>
                                <input type=“text” name=“correo” class=“form-control”>
                            </div>
                            <div class=“col-md-12 form-group input-group”>
                                <label for=“” class=“input-group-addon”>Numero de Celular: </label>
                                <input type=“text” name=“celular” class=“form-control”>
                            </div>
                            <div class=“col-md-12 form-group input-group”>
                                <label for=“” class=“input-group-addon”>Motivo de Visita: </label>
                                <textarea name=“motivo” class=“form-control”></textarea>
                            </div>
                                <div class=“col-md-12 form-group input-group”>
                                <label for=“” class=“input-group-addon”>Comentario: </label>
                                <textarea name=“comentarios” class=“form-control”></textarea>
                            </div>
                            
                            <button type=“submit” class=“btn btn-success”>Guardar Visitante</button>
                            <a href=“<?php echo base_url(“crudController/guardar”) ?>” class=“btn btn-primary”>Nuevo Visitante</a>
                            
                        </form>
                    </div>
                </div>
            </div>

            <div class=“col-md-8”>
                <div class=“panel panel-default”>
                    <div class=“panel-heading”>Visitantes Agregados</div>
                    <div class=“panel-body”>
                        Aquí va el cuerpo del panel
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
-->    
</body>
</html>