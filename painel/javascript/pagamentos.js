$(function(){
	$('[name=parcela]').mask('99');
	$('[name=tempo_parcela]').mask('99');
	$('[name=vencimento]').Zebra_DatePicker();
	$('[name=valor]').maskMoney({prefix:'R$ ',allowNegative:true,thousands:'.',decimal:',',affixes:false});
})