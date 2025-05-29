$(document).ready(function(){
    ajouter_client();
    affiche_client();
	modifierClient();
	// modifierClient();
})

/**************************************partie client ***************************************************** */
function ajouter_client()
{
	var ajtCl = document.getElementById('ajtCl');
    var myModal = new bootstrap.Modal("#myModal");
    ajtCl.addEventListener('click',function(){
        myModal.show();
    })

	$(document).on("click","#btn_ajt_cl",function(){
		var nom = $("#nom").val();
		var numStat = $("#numStat").val();
		var numNIF = $("#numNIF").val();
		var adresse = $("#adresse").val();
		var ville = $("#ville").val();
        // console.log(nom, numStat, numNIF, adresse, ville);
		if(nom==""){
			$("#nom").addClass('is-invalid')
			$("#adresse").removeClass('is-invalid')
			$("#ville").removeClass('is-invalid')
		}else if(adresse==""){
			$("#nom").removeClass('is-invalid')
			$("#adresse").addClass('is-invalid')
			$("#ville").removeClass('is-invalid')
		}else if(ville==""){
			$("#nom").removeClass('is-invalid')
			$("#adresse").removeClass('is-invalid')
			$("#ville").addClass('is-invalid')
		}
		else{
			$.ajax({
				url:"../modele/client/ajouterClient.php",
				method:"post",
				data:{
				   nom:nom, 
				   numStat:numStat, 
				   numNIF:numNIF, 
				   adresse:adresse, 
				   ville:ville
				},
				success:function(data){
					console.log(data);
					myModal.hide();
					affiche_client();
					$("#form-client").trigger("reset");
					Swal.fire({
						icon: 'success',
						html: '<h4>Client a été bien enregistré </h4>',
						timer: 1500,
						showConfirmButton: false
					});
				}
			});
		}
	});
    
	$("#btn_najt_cl").click(function(){
		$("#form-client").trigger("reset");
	});
}

function affiche_client()
{
	$.ajax({
		url:"../modele/client/afficherClient.php",
		method:"get",
		success:function(data)
		{
			data = $.parseJSON(data);
			if(data.status == "success")
			{
				var divClient = $("#divClient");
				divClient.html(data.html);
                $(document).ready(function () {
                    $('#tableClient').DataTable({
                        //language: {  url: "//cdn.datatables.net/plug-ins/1.13.1/i18n/fr-FR.json" },
                        "pagingType": "simple_numbers",
                        "lengthMenu":[3,4,5],
                        "pageLength": 4
                    });
                });
			}
			
		}
	});
}

var modalModCl = new bootstrap.Modal("#modalModCl");
function ShowModalModClient(id)
{	
	$.ajax({
		url:"../modele/client/infoClient.php",
		method:"POST",
		data:{id},
		dataType:'JSON',
		success:function(data){
			$("#m_nom").val(data[0]);
			$("#m_numStat").val(data[1]);
			$("#m_numNIF").val(data[2]);
			$("#m_adresse").val(data[3]);
			$("#m_ville").val(data[4]);
			$("#m_idCl").val(data[5]);
			modalModCl.show();
		}
	});
}

function modifierClient()
{	
	$('#btn_mod_cl').click(function(){
		
		var nom = $("#m_nom").val();
		var numSTAT = $("#m_numStat").val();
		var numNIF = $("#m_numNIF").val();
		var adresse = $("#m_adresse").val();
		var ville = $("#m_ville").val();
		var id = $("#m_idCl").val();
		// console.log(nom, numSTAT, numNIF, adresse, ville, id);
		if(nom==""){
			$("#m_nom").addClass('is-invalid')
			$("#m_adresse").removeClass('is-invalid')
			$("#m_ville").removeClass('is-invalid')
		}else if(adresse==""){
			$("#m_nom").removeClass('is-invalid')
			$("#m_adresse").addClass('is-invalid')
			$("#m_ville").removeClass('is-invalid')
		}else if(ville==""){
			$("#m_nom").removeClass('is-invalid')
			$("#m_adresse").removeClass('is-invalid')
			$("#m_ville").addClass('is-invalid')
		}else{
			$("#m_nom").removeClass('is-invalid')
			$("#m_adresse").removeClass('is-invalid')
			$("#m_ville").removeClass('is-invalid')
			$.ajax({
				url:"../modele/client/modifierClient.php",
				method:"POST",
				data:{id, nom,numSTAT,numNIF,adresse,ville},
				success:function(data){
					Swal.fire({
						icon: 'success',
						html: '<h4>Client a été bien modifié </h4>',
						timer: 1500,
						showConfirmButton: false
					});
					affiche_client();
					modalModCl.hide();
				}
			});
		}
		
	})
}

var modalSupCl = new bootstrap.Modal("#modalSupCl");
function ShowModalSupClient(id){
	$('#msg-sup-cl').text('Voulez vous vraiment supprimer le client : CL' + id );
	$('#msg-sup-cl').attr('data-id', id);
	modalSupCl.show();
}

function hideModalSupCl(){
	modalSupCl.hide();
}

function supprimerClient(){
	var id = $('#msg-sup-cl').attr('data-id');
	$.ajax({
		url:"../modele/client/supprimerClient.php",
		method:"POST",
		data:{id},
		success:function(data){
			console.log(data);
			affiche_client();
			modalSupCl.hide();
		}
	});	
}
