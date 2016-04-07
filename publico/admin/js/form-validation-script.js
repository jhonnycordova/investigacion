var Script = function () {

    $.validator.setDefaults({
        submitHandler: function() { form.submit(); }
    });

    $().ready(function() {
        // validate the comment form when it is submitted
        $("#commentForm").validate();

        $('#nom_usu').validCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
        $('#ape_usu').validCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
         $('#nom_inv').validCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
        $('#ape_inv').validCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
         $('#nom_aut').validCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
        $('#ape_aut').validCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
        $('#nom_autor').validCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
        $('#ape_autor').validCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
        $('#director_centro').validCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
        $('#nom_solicitante').validCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
        $('#ape_solicitante').validCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
        $('#ced_solicitante').validCampo('0123456789');
        $('#tel_solicitante').validCampo('0123456789');
        $('#inversion').validCampo('0123456789');
        $('#nom_lin').validCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
        $('#nom_centro').validCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
        $('#tit_pro').validCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');

        // validate signup form on keyup and submit
        $("#reg-usuario").validate({
            rules: {
                nom_usu: {
                    required: true,
                    maxlength:40,
                },
                ape_usu: {
                    required: true,
                    maxlength:40
                },
                usuario: {
                    
                    
                },
                clave: {
                    required: true,
                    minlength: 5
                },
                confirm_clave: {
                    required: true,
                    minlength: 5,
                    equalTo: "#clave"
                },
                'email_usu[]': {
                    email: true
                },
                'tel_usu[]':{
                    minlength:11,
                    maxlength:11,
                    number:true
                }
            },
            messages: {
                nom_usu: {
                    required: "Por Favor Ingresa los Nombres",
                    maxlength: "Nombres demasiado largos"
                },
                ape_usu: {
                    required: "Por Favor Ingresa los Apellidos",
                    maxlength: "Apellidos demasiado largos"
                },
                usuario: {
                    
                    
                },
                clave: {
                    required: "Por Favor Proporcione la Clave",
                    minlength: "La Clave debe Contener más de 5 caracteres"
                },
                confirm_clave: {
                    required: "Por Favor Proporcione la Clave",
                    minlength: "La Clave debe Contener más de 5 caracteres",
                    equalTo: "Las Claves no Coinciden"
                },
                'email_usu[]':  "Por Favor Ingrese un Correo Válido",

                'tel_usu[]':{
                    minlength:"Ingrese Número Válido. Ej: 04127778787",
                    maxlength: "Ingrese Número Válido Ej: 04127778787",
                    number: "Debe ser Numérico"
                }
                
                
            }
        });

         $("#reg-autoridades").validate({
            rules: {
                nom_aut: {
                    required: true,
                    maxlength:40,
                },
                ape_aut: {
                    required: true,
                    maxlength:40
                },
                'email_aut[]': {
                    email: true,

                },
                'tel_aut[]':{
                    minlength:11,
                    maxlength:11,
                    number:true
                },
                'id_cargo':{
                    required: true
                },
                foto_aut:{
                    required:true
                }
            },
            messages: {
                nom_aut: {
                    required: "Por Favor Ingresa los Nombres",
                    maxlength: "Nombres demasiado largos"
                },
                ape_aut: {
                    required: "Por Favor Ingresa los Apellidos",
                    maxlength: "Apellidos demasiado largos"
                },
                
                'email_aut[]':  "Por Favor Ingrese un Correo Válido",

                'tel_aut[]':{
                    minlength:"Ingrese Número Válido. Ej: 04127778787",
                    maxlength: "Ingrese Número Válido Ej: 04127778787",
                    number: "Debe ser Numérico"
                },
                id_cargo:{
                    required: "Por Favor Selecciona un Cargo"
                },
                foto_aut:{
                    required: "Seleccione una Foto"
                }
                
                
            }
        });

        $("#mod-autoridades").validate({
            rules: {
                nom_aut: {
                    required: true,
                    maxlength:40,
                },
                ape_aut: {
                    required: true,
                    maxlength:40
                },
                'email_aut[]': {
                    email: true,

                },
                'tel_aut[]':{
                    minlength:11,
                    maxlength:11,
                    number:true
                },
                'id_cargo':{
                    required: true
                }
            },
            messages: {
                nom_aut: {
                    required: "Por Favor Ingresa los Nombres",
                    maxlength: "Nombres demasiado largos"
                },
                ape_aut: {
                    required: "Por Favor Ingresa los Apellidos",
                    maxlength: "Apellidos demasiado largos"
                },
                
                'email_aut[]':  "Por Favor Ingrese un Correo Válido",

                'tel_aut[]':{
                    minlength:"Ingrese Número Válido. Ej: 04127778787",
                    maxlength: "Ingrese Número Válido Ej: 04127778787",
                    number: "Debe ser Numérico"
                },
                id_cargo:{
                    required: "Por Favor Selecciona un Cargo"
                }
            }
        });

            $("#info_decanato").validate({
                rules: {
                    mision: {
                        required: true,
                        minlength:40,
                    },
                    vision: {
                        required: true,
                        minlength:40
                    },
                    email_dec:{
                        required:true,
                        email: true
                    }
                },
                messages: {
                    mision: {
                        required: "Ingrese la Misión",
                        minlength: "Demasiado Corto"
                    },
                    vision: {
                        required: "Ingrese la Visión",
                        minlength: "Demasiado Corto"
                    },
                    email_dec: {
                        required: "Ingrese Correo Electrónico",
                        email: "Ingrese un Correo Electrónico Válido"
                        
                    }
                    
                    
                }
            });

     $("#autcargos").validate({
                rules: {
                    des_cargo: {
                        required: true
                        
                    }
                },
                messages: {
                    des_cargo: {
                        required: "Ingrese la Descripción del Cargo"
                    }
                    
                    
                }
            });

        $("#partipoproy").validate({
                rules: {
                    des_tipo_pro: {
                        required: true
                        
                    }
                },
                messages: {
                    des_tipo_pro: {
                        required: "Ingrese la Descripción del Tipo"
                    }
                    
                    
                }
            });

        $("#parespinv").validate({
                rules: {
                    des_esp: {
                        required: true
                        
                    }
                },
                messages: {
                    des_esp: {
                        required: "Ingrese la Descripción de la Especialidad"
                    }
                    
                    
                }
            });

        $("#mod-programas").validate({
                rules: {
                    des_prog: {
                        required: true
                        
                    },
                    mision_prog:{
                        required:true
                    },
                    vision_prog:{
                        required:true
                    }
                },
                messages: {
                    des_prog: {
                        required: "Ingrese el Nombre del Programa"
                    },
                    mision_prog:{
                        required:"Debe Ingresar una Misión"
                    },
                    vision_prog:{
                        required:"Debe Ingresar una Visión"
                    }
                    
                    
                }
            });

        $("#reg-jornadas").validate({
                rules: {
                    nom_jor: {
                        required: true
                        
                    },
                    pro_jor:{
                        required:true
                    },
                    norm_jor:{
                        required:true
                    },
                    mem_jor:{
                        required:true
                    },
                    fecha_jor:{
                        required:true
                    }
                },
                messages: {
                    nom_jor: {
                        required: "Ingrese el Nombre de la Jornada"
                    },
                    pro_jor:{
                        required:"Seleccione un PDF"
                    },
                    norm_jor:{
                        required:"Seleccione un PDF"
                    },
                    mem_jor:{
                        required:"Seleccione un PDF"
                    },
                    fecha_jor:{
                        required:"Selecciona una Fecha"
                    }
                    
                    
                }
            });

              $("#reg-imagen").validate({
                rules: {
                    imagen: {
                        required: true
                        
                    },
                    des_imagen: {
                        required:true
                    }
                },
                messages: {
                    imagen: {
                        required: "Seleccione Una Imagen"
                    },
                    des_imagen: {
                        required:"Escriba una breve Descripción"
                    }
                    
                    
                }
            });

            $("#reg-noticias").validate({
                rules: {
                    titulo: {
                        required:true
                        
                    }
                },
                messages: {
                    titulo: {
                        required: "Escriba un Título"
                    }
                    
                }
            });

             $("#reg-causas").validate({
                rules: {
                    des_causa: {
                        required:true
                        
                    }
                },
                messages: {
                    des_causa: {
                        required: "Describa la causa o motivo para no aprobación de un Evento"
                    }
                    
                }
            });

            $("#movimientos").validate({
                rules: {
                    usuario: {
                        required:true
                        
                    },
                    fec_des: {
                        required:true
                    }
                    ,
                    fec_has: {
                        required:true
                    }
                },
                messages: {
                    usuario: {
                        required: "Seleccione Un Usuario"
                    },
                    fec_des: {
                        required:"Seleccione una fecha"
                    }
                    ,
                    fec_has: {
                       required:"Seleccione una fecha"
                    }
                    
                }
            });

            $("#reg-centros").validate({
                rules: {
                    nom_centro: {
                        required:true
                        
                    },
                    director_centro:{
                        required:true
                    },
                    email_dir_cen:{
                        email:true
                    },
                    tel_dir_cen:{
                        minlength:11,
                        maxlength:11,
                        number:true
                    }
                },
                messages: {
                    nom_centro: {
                        required: "Escriba El Nombre del Centro de Investigación"
                    },
                    director_centro: {
                        required: "Escriba El Nombre del Director del Centro"
                    },
                    email_dir_cen: "Debe Ingresar un Correo Válido",

                    tel_dir_cen:{
                        minlength:"Ingrese Número Válido. Ej: 04127778787",
                        maxlength: "Ingrese Número Válido Ej: 04127778787",
                        number: "Debe ser Numérico"
                    }

                    
                    
                }
            });

            $("#reg-lineas").validate({
                rules: {
                    nom_lin: {
                        required:true
                        
                    },
                    des_lin:{
                        required:true
                    },
                    id_prog:{
                        required:true
                    },
                    id_centro:{
                        required:true
                    }
                },
                messages: {
                    nom_lin: {
                        required: "Escriba El Nombre de la Línea"
                    },
                    des_lin: {
                        required: "Escriba Una Descripción"
                    },
                    id_prog: {
                        required: "Seleccione un Programa"
                    },
                    id_centro: {
                        required: "Seleccione un Centro"
                    }

                    
                    
                }
            });

            $("#reg-autores").validate({
                rules: {
                    nom_autor: {
                        required:true
                        
                    },
                    ape_autor:{
                        required:true
                    },
                    'email_autor[]':{
                        email:true
                    },
                    'tel_autor[]':{
                        minlength:11,
                        maxlength:11,
                        number:true
                    }//,

                    //'id_esp[]':{
                     //   required:true
                    //}
                },
                messages: {
                    nom_autor: {
                        required: "Ingrese los Nombres"
                    },
                    ape_autor: {
                        required: "Ingrese los Apellidos"
                    },
                    'email_autor[]':{
                        email:"Ingrese un Correo Válido"
                    },
                    'tel_autor[]':{
                        minlength:"Ingrese Número Válido. Ej: 04127778787",
                        maxlength: "Ingrese Número Válido Ej: 04127778787",
                        number: "Debe ser Numérico"
                    }//,
                    
                }
            });

              $("#reg-investigadores").validate({
                rules: {
                    nom_inv: {
                        required:true
                        
                    },
                    ape_inv:{
                        required:true
                    },
                    foto_inv:{
                        required:true
                    },
                    id_centro:{
                        required:true
                    },
                    id_prog:{
                        required:true
                    },
                    'email_inv[]':{
                        email:true
                    },
                    'tel_inv[]':{
                        minlength:11,
                        maxlength:11,
                        number:true
                    }//,

                    //'id_esp[]':{
                     //   required:true
                    //}
                },
                messages: {
                    nom_inv: {
                        required: "Ingrese los Nombres"
                    },
                    ape_inv: {
                        required: "Ingrese los Apellidos"
                    },
                    foto_inv: {
                        required: "Seleccione una Foto"
                    },
                    id_centro: {
                        required: "Seleccione un Centro"
                    },
                    id_prog:{
                        required:"Seleccione un programa"
                    },
                    'email_inv[]':{
                        email:"Ingrese un Correo Válido"
                    },
                    'tel_inv[]':{
                        minlength:"Ingrese Número Válido. Ej: 04127778787",
                        maxlength: "Ingrese Número Válido Ej: 04127778787",
                        number: "Debe ser Numérico"
                    }//,
                    
                }
            });

        $("#mod-investigadores").validate({
                        rules: {
                            nom_inv: {
                                required:true
                                
                            },
                            ape_inv:{
                                required:true
                            },
                            id_centro:{
                                required:true
                            },
                            id_prog:{
                                required:true
                            },
                            'email_inv[]':{
                                email:true
                            },
                            'tel_inv[]':{
                                minlength:11,
                                maxlength:11,
                                number:true
                            }//,

                            //'id_esp[]':{
                             //   required:true
                            //}
                        },
                        messages: {
                            nom_inv: {
                                required: "Ingrese los Nombres"
                            },
                            ape_inv: {
                                required: "Ingrese los Apellidos"
                            },
                            id_centro: {
                                required: "Seleccione un Centro"
                            },
                            id_prog:{
                                required:"Seleccione un programa"
                            },
                            'email_inv[]':{
                                email:"Ingrese un Correo Válido"
                            },
                            'tel_inv[]':{
                                minlength:"Ingrese Número Válido. Ej: 04127778787",
                                maxlength: "Ingrese Número Válido Ej: 04127778787",
                                number: "Debe ser Numérico"
                            }//,
                            
                        }
                    });

     $("#reg-investigadores2").validate({
                rules: {
                    nom_inv: {
                        required:true
                        
                    },
                    ape_inv:{
                        required:true
                    },
                    id_centro:{
                        required:true
                    },
                    id_prog:{
                        required:true
                    },
                    'email_inv[]':{
                        email:true
                    },
                    'tel_inv[]':{
                        minlength:11,
                        maxlength:11,
                        number:true
                    }//,

                    //'id_esp[]':{
                     //   required:true
                    //}
                },
                messages: {
                    nom_inv: {
                        required: "Ingrese los Nombres"
                    },
                    ape_inv: {
                        required: "Ingrese los Apellidos"
                    },
                    id_centro: {
                        required: "Seleccione un Centro"
                    },
                    id_prog:{
                        required:"Seleccione un programa"
                    },
                    'email_inv[]':{
                        email:"Ingrese un Correo Válido"
                    },
                    'tel_inv[]':{
                        minlength:"Ingrese Número Válido. Ej: 04127778787",
                        maxlength: "Ingrese Número Válido Ej: 04127778787",
                        number: "Debe ser Numérico"
                    }//,
                    
                }
            });

         $("#reg-proyectos").validate({
                rules: {
                    tit_pro: {
                        required:true
                        
                    },
                    id_linea:{
                        required:true
                    },
                    id_centro:{
                        required:true
                    },
                    id_tipo_pro:{
                        required:true
                    },
                    id_prog:{
                        required:true
                    },
                    'id_investigador[]':{
                        required:true
                    },
                    fec_ini_pro:{
                        required:true
                    },
                    fec_cul_pro:{
                        required: true
                    }

                },
                messages: {
                    tit_pro: {
                        required: "Ingrese El Titulo"
                    },
                    id_linea: {
                        required: "Seleccione Una Linea"
                    },
                    id_centro: {
                        required: "Seleccione una Centro"
                    },
                    id_tipo_pro: {
                        required: "Seleccione un Tipo de Proyecto"
                    },
                    id_prog:{
                        required:"Seleccione un programa"
                    },
                    'id_investigador[]':{
                        required:"Seleccione almenos un Investigador"
                    },
                    fec_ini_pro:{
                        required: "Seleccione una fecha de Inicio   "
                    },
                    fec_cul_pro:{
                        required: "Seleccione una fecha de culminacion   "
                    }
                    
                }
            });

        $("#reg-areas").validate({
                rules: {
                    des_area: {
                        required: true
                        
                    }
                },
                messages: {
                    des_area: {
                        required: "Ingrese el Nombre del Área"
                    }
                    
                    
                }
            });

        $("#reg-tipopub").validate({
                rules: {
                    des_publico: {
                        required: true
                        
                    }
                },
                messages: {
                    des_publico: {
                        required: "Ingrese una Descripción del tipo"
                    }
                    
                    
                }
            });

        $("#reg-tipotra").validate({
                rules: {
                    des_trabajo: {
                        required: true
                        
                    }
                },
                messages: {
                    des_trabajo: {
                        required: "Ingrese una Descripción del tipo"
                    }
                    
                    
                }
            });

        $("#reg-tipoeve").validate({
                rules: {
                    des_tipo: {
                        required: true
                        
                    }
                },
                messages: {
                    des_tipo: {
                        required: "Ingrese una Descripción del tipo"
                    }
                    
                    
                }
            });

         $("#reg-normas").validate({
                rules: {
                    des_norma: {
                        required: true
                        
                    },
                    id_espacio:{
                        required:true
                    }
                },
                messages: {
                    des_norma: {
                        required: "Redacte la norma"
                    },
                    id_espacio:{
                        required:"Seleccione un Espacio"
                    }
                    
                    
                }
            });

         $("#reg_eventos").validate({
                rules: {
                    nom_evento: {
                        required: true
                        
                    },
                    participacion:{
                        required:true
                    },
                    inversion:{
                        required:true
                    },
                    id_tipo:{
                        required:true
                    },
                    id_publico:{
                        required:true
                    },
                    id_espacio:{
                        required:true
                    },
                    est_evento:{
                        required:true
                    }
                },
                messages: {
                    nom_evento: {
                        required: "Ingrese Nombre de Evento"
                    },
                    participacion:{
                        required:"Seleccion el Tipo de Participación"
                    },
                    inversion:{
                        required:"Ingrese Monto de Inversión"
                    },
                    id_tipo:{
                        required:"Seleccione Tipo de Evento"
                    },
                    id_publico:{
                        required:"Seleccione Tipo de Público"
                    },
                    id_espacio:{
                        required:"Seleccione el Espacio"
                    },
                    est_evento:{
                        required:"Debe Seleccionar el Status Inicial del Evento"
                    }
                    
                }
            });

        // propose username by combining first- and lastname
        $("#username").focus(function() {
            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();
            if(firstname && lastname && !this.value) {
                this.value = firstname + "." + lastname;
            }
        });

        

        //code to hide topic selection, disable for demo
        var newsletter = $("#newsletter");
        // newsletter topics are optional, hide at first
        var inital = newsletter.is(":checked");
        var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
        var topicInputs = topics.find("input").attr("disabled", !inital);
        // show when newsletter is checked
        newsletter.click(function() {
            topics[this.checked ? "removeClass" : "addClass"]("gray");
            topicInputs.attr("disabled", !this.checked);
        });
    });


}();