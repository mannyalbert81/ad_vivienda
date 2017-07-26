
	$(document).ready(function() {
		$("#ok").hide();
		//Validacion con BootstrapValidator
		fl = $('#form-Roles');
	    fl.bootstrapValidator({ 
	        message: 'El valor no es valido.',
	        //fields: name de los inputs del formulario, la regla que debe cumplir y el mensaje que mostrara si no cumple la regla
	        feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
	        fields: {
	        	
	        	nombre_rol: {
	        		message: 'El Nombre no es valido',
	                        validators: {
	                                notEmpty: {
	                                        message: 'El Nombre es Requerido.'
	                                }
	            				 
	                        }
	                }
	        	
	        	
	        	
	        }
	        
	    
	    });
	});
	
