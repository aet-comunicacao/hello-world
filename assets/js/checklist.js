$(function() {

	$("#btnDataHoje").click(function(){
		$("#checklist_data_dia").attr('readonly', true);
	});

	$( ".checklist_data_inicio" ).blur(function(){
		//variaveis
		var inicio = $(this).val();
		var vid = $(this).attr('vid');
		var hoje = $("#checklist_data_dia").val();
		//parametros
		var base_url = $(".base_url").val();
		var controller = 'checklist';
		var action = 'insertDataInicio';
		//requisicao ajax enviando os parâmetros via POST
		$.ajax({
			'url' : base_url + controller + '/' + action,
			'type' : 'POST', 
			'data' : {'inicio':inicio, 'veiculo_id':vid, 'hoje':hoje},
			'success' : function(data){
				console.log(data);
				//location.reload();
			}
		});
	});

	$( ".checklist_status_camera" ).blur(function(){
		//variaveis
		var status = $(this).val();
		var vid = $(this).attr('vid');
		var hoje = $("#checklist_data_dia").val();
		//parametros
		var base_url = $(".base_url").val();
		var controller = 'checklist';
		var action = 'insertCameraStatus';
		//requisicao ajax enviando os parâmetros via POST
		$.ajax({
			'url' : base_url + controller + '/' + action,
			'type' : 'POST', 
			'data' : {'status':status, 'veiculo_id':vid, 'hoje':hoje},
			'success' : function(data){
				//console.log(data);
				//location.reload();
			}
		});
	});	

});

function excluir(dataDia){
		bootbox.dialog({
		message: "Você deseja <strong>EXCLUIR</strong> a lista de checklist?",
		title: "VOCÊ TEM CERTEZA?",
		buttons: {
			success: {
			label: "Sim, tenho certeza!",
			className: "btn-danger",
			callback: function() {
			      	//parametros 
					var base_url = $(".base_url").val();
					var controller = 'checklist';
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