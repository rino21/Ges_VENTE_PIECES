$(document).ready(function(){
    ajouter_piece();
    affiche_piece();
	modifierPiece();
	// modifierClient();
})

/**************************************partie client ***************************************************** */
function ajouter_piece()
{
	var ajtPc = document.getElementById('ajtPc');
    var myModal = new bootstrap.Modal("#modalAjtPc");
    ajtPc.addEventListener('click',function(){
        myModal.show();
    })

	$(document).on("click","#btn_ajt_pc",function(){
		var des = $("#des").val();
		var UTE = $("#UTE").val();
		var pu = $("#pu").val();
		if(des=="" || UTE=="" || pu==""){
			if(des=="" && UTE!="" && pu!=""){
				$("#des").addClass('is-invalid')
				$("#UTE").removeClass('is-invalid')
				$("#pu").removeClass('is-invalid')
			}else if(des!="" && UTE=="" && pu!=""){
				$("#des").removeClass('is-invalid')
				$("#UTE").addClass('is-invalid')
				$("#pu").removeClass('is-invalid')
			}else if(des!="" && UTE!="" && pu==""){
				$("#des").removeClass('is-invalid')
				$("#UTE").removeClass('is-invalid')
				$("#pu").addClass('is-invalid')
			}
			else if(des=="" && UTE=="" && pu!=""){
				$("#des").addClass('is-invalid')
				$("#UTE").addClass('is-invalid')
				$("#pu").removeClass('is-invalid')
			}
			else if(des=="" && UTE!="" && pu==""){
				$("#des").addClass('is-invalid')
				$("#UTE").removeClass('is-invalid')
				$("#pu").addClass('is-invalid')
			}
			else if(des!="" && UTE=="" && pu==""){
				$("#des").removeClass('is-invalid')
				$("#UTE").addClass('is-invalid')
				$("#pu").addClass('is-invalid')
			}
			else{
				$("#des").addClass('is-invalid')
				$("#UTE").addClass('is-invalid')
				$("#pu").addClass('is-invalid')
			}
		}else{
				$("#des").removeClass('is-invalid')
				$("#UTE").removeClass('is-invalid')
				$("#pu").removeClass('is-invalid')
			$.ajax({
				url:"../modele/piece/ajouterPiece.php",
				method:"post",
				data:{
				   des, 
				   UTE,
				   pu
				},
				success:function(data){
					Swal.fire({
						icon: 'success',
						html: '<h4>Piece a été bien enregistré </h4>',
						timer: 1500,
						showConfirmButton: false
					});
					myModal.hide();
					affiche_piece();
					$("#form-piece").trigger("reset");
				}
			});
		}
		
	});
    
	$("#btn_najt_pc").click(function(){
		$("#form-piece").trigger("reset");
	});
}

function affiche_piece()
{
	$.ajax({
		url:"../modele/piece/affichePiece.php",
		method:"get",
		success:function(data)
		{
			data = $.parseJSON(data);
			if(data.status == "success")
			{
				var divPiece = $("#divPiece");
				divPiece.html(data.html);
                $(document).ready(function () {
                    $('#tablePiece').DataTable({
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

var modalModPc = new bootstrap.Modal("#modalModPc");
function ShowModalModPiece(id)
{	
	modalModPc.show();
	$.ajax({
		url:"../modele/piece/infoPiece.php",
		method:"POST",
		data:{id},
		dataType:'JSON',
		success:function(data){
			// console.log(data)
			$("#m_des").val(data[0]);
			$("#m_UTE").val(data[1]);
			$("#idPc").val(data[2]);
			$("#m_pu").val(data[3]);
			modalModPc.show();
		}
	});
}

function modifierPiece()
{	
	$('#btn_mod_pc').click(function(){
		
		var des = $("#m_des").val();
		var UTE = $("#m_UTE").val();
		var idPc = $("#idPc").val();
		var pu = $("#m_pu").val();
		if(des=="" || UTE=="" || pu==""){
			if(des==""){
				$("#m_des").addClass('is-invalid')
				$("#m_UTE").removeClass('is-invalid')
				$("#m_pu").removeClass('is-invalid')
			}else if(UTE==""){
				$("#m_des").removeClass('is-invalid')
				$("#m_UTE").addClass('is-invalid')
				$("#m_pu").removeClass('is-invalid')
			}else if(pu==""){
				$("#m_des").removeClass('is-invalid')
				$("#m_UTE").addClass('is-invalid')
				$("#m_pu").removeClass('is-invalid')
			}else{
				$("#m_des").addClass('is-invalid')
				$("#m_UTE").addClass('is-invalid')
				$("#m_pu").addClass('is-invalid')
			}

		}else{
			$("#m_des").removeClass('is-invalid')
			$("#m_UTE").removeClass('is-invalid')
			$("#m_pu").removeClass('is-invalid')
			$.ajax({
				url:"../modele/piece/modifierPiece.php",
				method:"POST",
				data:{des, UTE, idPc, pu},
				success:function(data){
					Swal.fire({
						icon: 'success',
						html: '<h4>Piece a été bien modifié </h4>',
						timer: 1500,
						showConfirmButton: false
					});
					affiche_piece();
					modalModPc.hide();
				}
			});
		}
	})
}

var modalSupPc = new bootstrap.Modal("#modalSupPc");
function ShowModalSupPiece(id){
	$('#msg-sup-pc').text('Voulez vous vraiment supprimer la piéce : P' + id );
	$('#msg-sup-pc').attr('data-id', id);
	modalSupPc.show();
}

function hideModalSupPiece(){
	modalSupPc.hide();
}

function supprimerPiece(){
	var id = $('#msg-sup-pc').attr('data-id');
	$.ajax({
		url:"../modele/piece/supprimerPiece.php",
		method:"POST",
		data:{id},
		success:function(data){
			// console.log(data);
			affiche_piece();
			modalSupPc.hide();
		}
	});	
}

var modalStock = new bootstrap.Modal("#modalStock");
function ajouterStock(id) {
    modalStock.show();
	$.ajax({
		url:"../modele/piece/obtenirInfoStock.php",
		method:"POST",
		data:{id},
		success:function(data){
			data = $.parseJSON(data);
			$('#s_des').val(data.des);
		}
	});	
	$('#idArt').val(id);
}

function ajoutStockerEnt()
{		
	var idArt = $("#idArt").val();
	var qteEnt = $("#qteEnt").val();
	var dateEnt = $("#dateEnt").val();
	if(qteEnt=="" || dateEnt==""){
		if(qteEnt=="" && dateEnt!=""){
			$("#qteEnt").addClass('is-invalid')
			$('#dateEnt').removeClass('is-invalid')
	}else if(qteEnt!="" && dateEnt==""){
		$("#qteEnt").removeClass('is-invalid')
		$('#dateEnt').addClass('is-invalid')
	}else{
		$("#qteEnt").addClass('is-invalid')
		$('#dateEnt').addClass('is-invalid')
	}
	}else{
		$("#qteEnt").removeClass('is-invalid')
		$('#dateEnt').removeClass('is-invalid')
		$.ajax({
			url:"../modele/piece/ajouterStock.php",
			method:"POST",
			data:{idArt, qteEnt, dateEnt},
			success:function(data){
				// console.log(data)
				Swal.fire({
					icon: 'success',
					html: '<h4>Ajout succès ! </h4>',
					timer: 1500,
					showConfirmButton: false
				});
				affiche_piece();
				modalStock.hide();
				$("#form-stock").trigger("reset");
	
			}
		});
	}

}

function hideModalStock()
{
    modalStock.hide();
    $("#form-stock").trigger("reset");

}