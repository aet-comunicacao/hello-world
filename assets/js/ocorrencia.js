$(function() {

	$(".msgErro").hide();

	/*$("#computador_id").change(function(){

		//parametros 
		var base_url = $(".base_url").val();
		var controller = 'ocorrencia';
		var action = 'getByComputador';
		//requisicao ajax enviando os parâmetros via POST
		$.ajax({
			'url' : base_url + controller + '/' + action,
			'type' : 'POST', 
			'data' : {'computador_id' : $(this).val()},
			'success' : function(data){
				if(data != null){
					var obj = $.parseJSON(data);
					var buffer = null;
					$.each( obj, function( key, value ) {
						buffer += "<option value='"+value.ocorrencia_id+"'>"+value.ocorrencia_nome+"</option>";
					});
					$("#ocorrencia_id").html(buffer);
				}
			}
		});

	});*/

});

function validForm(){

	//var computador_id = $("#computador_id").val();
	var ocorrencia_id = $("#ocorrencia_id").val();

	if(ocorrencia_nome == 0 || ocorrencia_nome == null || ocorrencia_nome == ''){
		$(".msgErro").html('Digite ');
		$(".msgErro").show();
		$("#computador_id").focus();
		return false;
	}

	/*if(computador_id == 0){
		$(".msgErro").html('Escolha o computador');
		$(".msgErro").show();
		$("#computador_id").focus();
		return false;
	}*/

	if(ocorrencia_id == 0){
		$(".msgErro").html('Escolha o veículo');
		$(".msgErro").show();
		$("#ocorrencia_id").focus();
		return false;
	}

	return true;

}

function inativar(id){
		bootbox.dialog({
		message: "Você deseja <strong>INATIVAR</strong> a ocorrência?",
		title: "VOCÊ TEM CERTEZA?",
		buttons: {
			success: {
			label: "Sim, tenho certeza!",
			className: "btn-danger",
			callback: function() {
			      	//parametros 
					var base_url = $(".base_url").val();
					var controller = 'ocorrencia';
					var action = 'status';
					//requisicao ajax enviando os parâmetros via POST
					$.ajax({
					   'url' : base_url + controller + '/' + action,
					   'type' : 'POST', 
					   'data' : {'id' : id, 'status': 'I'},
					    'success' : function(data){
					    	bootbox.alert("ocorrência <strong>INATIVA</strong> com sucesso!", function() {
					    		//alert(data);
							  	location.reload();
							});		    	
					    }
					});
			      }
			    },
			    danger: {
			      label: "Cancelar",
			      className: "btn-default",
			      callback: function() {
			        return null;
			    }
			}
		}
	});
}

function reprovar(id){
		bootbox.dialog({
		message: "Você deseja <strong>REPROVAR</strong> a ocorrência?",
		title: "VOCÊ TEM CERTEZA?",
		buttons: {
			success: {
			label: "Sim, tenho certeza!",
			className: "btn-danger",
			callback: function() {
			      	//parametros 
					var base_url = $(".base_url").val();
					var controller = 'ocorrencia';
					var action = 'status';
					//requisicao ajax enviando os parâmetros via POST
					$.ajax({
					   'url' : base_url + controller + '/' + action,
					   'type' : 'POST', 
					   'data' : {'id' : id, 'status': 'R'},
					    'success' : function(data){
					    	bootbox.alert("ocorrência <strong>INATIVA</strong> com sucesso!", function() {
					    		//alert(data);
							  	location.reload();
							});		    	
					    }
					});
			      }
			    },
			    danger: {
			      label: "Cancelar",
			      className: "btn-default",
			      callback: function() {
			        return null;
			    }
			}
		}
	});
}

function ativar(id){
		bootbox.dialog({
		message: "Você deseja <strong>ATIVAR</strong> a ocorrência?",
		title: "VOCÊ TEM CERTEZA?",
		buttons: {
			success: {
			label: "Sim, tenho certeza!",
			className: "btn-success",
			callback: function() {
			      	//parametros 
					var base_url = $(".base_url").val();
					var controller = 'ocorrencia';
					var action = 'status';
					//requisicao ajax enviando os parâmetros via POST
					$.ajax({
					   'url' : base_url + controller + '/' + action,
					   'type' : 'POST', 
					   'data' : {'id' : id, 'status': 'A'},
					    'success' : function(data){
					    	bootbox.alert("ocorrência <strong>ATIVADA</strong> com sucesso!", function() {
					    		//alert(data);
							  	location.reload();
							});		    	
					    }
					});
			      }
			    },
			    danger: {
			      label: "Cancelar",
			      className: "btn-default",
			      callback: function() {
			        return null;
			    }
			}
		}
	});
}