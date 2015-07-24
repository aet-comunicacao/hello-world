$(function() {

	$("#computador_nome").focus();

});

function inativar(id){
		bootbox.dialog({
		message: "Você deseja <strong>INATIVAR</strong> o computador?",
		title: "VOCÊ TEM CERTEZA?",
		buttons: {
			success: {
			label: "Sim, tenho certeza!",
			className: "btn-danger",
			callback: function() {
			      	//parametros 
					var base_url = $(".base_url").val();
					var controller = 'computador';
					var action = 'status';
					//requisicao ajax enviando os parâmetros via POST
					$.ajax({
					   'url' : base_url + controller + '/' + action,
					   'type' : 'POST', 
					   'data' : {'id' : id, 'status':0},
					    'success' : function(data){
					    	bootbox.alert("computador <strong>INATIVO</strong> com sucesso!", function() {
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
		message: "Você deseja <strong>ATIVAR</strong> o computador?",
		title: "VOCÊ TEM CERTEZA?",
		buttons: {
			success: {
			label: "Sim, tenho certeza!",
			className: "btn-success",
			callback: function() {
			      	//parametros 
					var base_url = $(".base_url").val();
					var controller = 'computador';
					var action = 'status';
					//requisicao ajax enviando os parâmetros via POST
					$.ajax({
					   'url' : base_url + controller + '/' + action,
					   'type' : 'POST', 
					   'data' : {'id' : id, 'status':1},
					    'success' : function(data){
					    	bootbox.alert("computador <strong>ATIVADO</strong> com sucesso!", function() {
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