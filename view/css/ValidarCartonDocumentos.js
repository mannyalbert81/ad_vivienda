
	$(document).ready(function() {
		$("#ok").hide();
		//Validacion con BootstrapValidator
		fl = $('#form-BuscaxCarton');
	    fl.bootstrapValidator({ 
	        message: 'El valor no es valido.',
	        //fields: name de los inputs del formulario, la regla que debe cumplir y el mensaje que mostrara si no cumple la regla
	        feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
	        fields: {
	        	
	        	numero_carton_documentos: {
	        		message: 'El Número no es valido',
	                        validators: {
	                                notEmpty: {
	                                        message: 'El Número Carpeta es Requerido.'
	                                },
	                                regexp: {
	                                	 
	               					 regexp: /^[0-9]+$/,
	                
	               					 message: 'Ingrese números'
	                
	               				 }
	            				 
	                        }
	                }
	        	
	        	
	        	
	        }
	        
	    
	    });
	});
	
