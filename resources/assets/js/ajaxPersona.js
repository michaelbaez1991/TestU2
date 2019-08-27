$(document).ready(function() {
    $('#activarModalPasatiempo').click(function() {
        $('#crearPersona').modal('show');
    });
});

function pasatiempoSelectAllEdit(idModal, idUser){
    $.ajax({
        url: "/userSelect",
        type: 'POST',
        data: {filtro: idUser},
        }).done(function(result) {
            $.each(result, function(index, val) {
                // console.log(val);
                $("#editAll"+idModal+" #nombreUser").val(val.name);
                $("#editAll"+idModal+" #usuarioUser").val(val.username);
                $("#editAll"+idModal+" #emailUser").val(val.email);

                $.ajax({
                    url: "/perfilSelect",
                    type: 'POST',
                    data: {filtro: val.perfil_id},
                    }).done(function(result1) {
                        $.each(result1, function(index1, val1) {
                            // console.log(val1);
                            var selectionPerfil = '<option value="'+val1.id+'" selected disabled>'+val1.namePerfil+'</option>';

                            $.ajax({
                                url: "/perfilSelected",
                                type: 'POST',
                                data: {filtro: val1.id},
                                }).done(function(result2) {
                                    $.each(result2, function(index2, val2) {
                                        // console.log(val2);
                                        selectionPerfil+= '<option value="'+val2.id+'">'+val2.namePerfil+'</option>';

                                        $("#editAll"+idModal+" #perfilUser").html(selectionPerfil);
                                    });
                                }).fail(function() {
                                    // console.log("error al cargar los perfiles diferentes al del usuario seleccionado");
                                }).always(function() {
                                    // console.log("perfiles diferentes al del usuario cargados");
                            });
                            
                        });
                    }).fail(function() {
                        // console.log("error al cargar el perfil actual");
                    }).always(function() {
                        // console.log("Perfil actual cargardo");
                });

                $.ajax({
                    url: "/ciudadSelect",
                    type: 'POST',
                    data: {filtro: val.ciudad_id},
                    }).done(function(result3) {
                        $.each(result3, function(index3, val3) {
                            // console.log(val1);
                            var selectionCiudad = '<option value="'+val3.id+'" selected disabled>'+val3.nombreCiudad+'</option>';

                            $.ajax({
                                url: "/ciudadSelected",
                                type: 'POST',
                                data: {filtro: val3.id},
                                }).done(function(result4) {
                                    $.each(result4, function(index4, val4) {
                                        // console.log(val4);
                                        selectionCiudad+= '<option value="'+val4.id+'">'+val4.nombreCiudad+'</option>';

                                        $("#editAll"+idModal+" #ciudadUser").html(selectionCiudad);
                                    });
                                }).fail(function() {
                                    // console.log("error al cargar los perfiles diferentes al del usuario seleccionado");
                                }).always(function() {
                                    // console.log("perfiles diferentes al del usuario cargados");
                            });
                            
                        });
                    }).fail(function() {
                        // console.log("error al cargar el perfil actual");
                    }).always(function() {
                        // console.log("Perfil actual cargardo");
                });
            });
        }).fail(function() {
            // console.log("error al cargar la informacion del usuario");
        }).always(function() {
            // console.log("Informacion del usuario cargada");
    });
}

function pasatiempoSelectEdit(idModal){

    $('#pasatiempoIdUpdate').change(function() {
        var idPasatiempo = $('#editPasatiempo'+idModal+' #pasatiempoIdUpdate').val();

        $.ajax({
            url: "/pasatiempoSelect",
            type: 'POST',
            data: {filtro: idPasatiempo},
            }).done(function(result) {
                $.each(result, function(index, val) {
                    $("#pasatiempoUpdate").val(val.pasatiempo);
                    $("#pasatiempoUpdate").removeAttr("disabled");
                    $("#idUpdatePasatiempo").val(val.id);
                });
            }).fail(function() {
                console.log("error al cargar la informacion del pasatiempo");
            }).always(function() {
                console.log("Informacion del pasatiempo cargado exitosamente");
        });
    });

    $('#editPersona'+idModal+' #clearSelects').click(function() {
        $('#editPersona'+idModal+' #areaIdUpdate').html('');
        $('#editPersona'+idModal+' #paisIdUpdate').html('');
        $('#editPersona'+idModal+' #departamentoIdUpdate').html('');
        $('#editPersona'+idModal+' #ciudadIdUpdate').html('');
    });
}