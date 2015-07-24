$(function() {

	$("#btnDataHoje").click(function(){
		$("#monitoramento_dia").attr('readonly', true);
	});

	$( "input[class^='monitoramento_']" ).blur(function(){
		//variaveis
		var vid = $(this).attr('vid');
		var campo = $(this).attr('campo');
		var valor = $(this).val();
		var dia = $("#monitoramento_dia").val();
		//parametros
		var base_url = $(".base_url").val();
		var controller = 'monitoramento';
		var action = 'insert';
		//requisicao ajax enviando os parâmetros via POST
		$.ajax({
			'url' : base_url + controller + '/' + action,
			'type' : 'POST', 
			'data' : {'campo':campo, 'veiculo_id':vid, 'valor':valor, 'dia':dia},
			'success' : function(data){
				//console.log(data);
				//location.reload();
			}
		});
	});	

});

function excluir(dataDia){
		bootbox.dialog({
		message: "Você deseja <strong>EXCLUIR</strong> a lista de monitoramento?",
		title: "VOCÊ TEM CERTEZA?",
		buttons: {
			success: {
			label: "Sim, tenho certeza!",
			className: "btn-danger",
			callback: function() {
			      	//parametros 
					var base_url = $(".base_url").val();
					var controller = 'monitoramento';
					var action = 'delete';
					//requisicao ajax enviando os parâmetros via POST
					$.ajax({
					   'url' : base_url + controller + '/' + action,
					   'type' : 'POST', 
					   'data' : {'dataDia':dataDia},
					    'success' : function(data){
					    	//console.log(data);		    	
					    	location.reload();
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