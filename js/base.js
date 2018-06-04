
$(document).ready(function() {
    $('#example').DataTable( {
        "language": {
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "Nothing found - sorry",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)"
        }
    });
    
});


//Oculta mensagem após o cadastro
function hideMessage(){

	setTimeout( 'fechar(); ',2500); 
}

function fechar(){
	   // $("#msgOk").hide('slow');
	      $('#msgOk').fadeOut('slow');

}
//final ocultar mensagem de cadastro








