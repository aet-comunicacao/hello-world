$(function() {

	/*padrão de máscaras para campo input text*/
	$( ".data" ).mask('00/00/0000');
	$( ".hora" ).mask('00:00');
	$('.data_hora').mask('00/00/0000 00:00:00');
	$( ".cep" ).mask('00000-000');
    $( ".telefone" ).mask('(00) 0000-0000');
    $( ".celular" ).mask('(00) 00000-0000');
    $( ".cpf" ).mask('000.000.000-00', {reverse: true});
    $( ".rg" ).mask('00.000.000', {reverse: true});
    $( ".cnpj" ).mask('00.000.000/0000-00', {reverse: true});
    $( ".valor" ).mask('000.000.000.000.000,00', {reverse: true});

});

function dateFromDb(date){
	var dateSplit = date.split(" ");
	var dateSplit2 = dateSplit[0].split("-");
	var formattedDate = dateSplit2.reverse().join('/'); 
	return formattedDate+' '+dateSplit[1];
}