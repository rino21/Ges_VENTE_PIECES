affiche_vente();

var modalVente = new bootstrap.Modal('#modalEnrVente');
var Swal = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-primary',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
})
function showModalVente(){
    modalVente.show();
}

function hideModalVente(){
    var liste = $('.liste-vente-tableau');
    liste.remove();
    modalVente.hide();
    $('#form-vente').trigger('reset');
}

function affiche_client()
{
	$.ajax({
		url:"../modele/client/afficheClientVente.php",
		method:"get",
		success:function(data)
		{
			data = $.parseJSON(data);
			if(data.status == "success")
			{   
                $("#select-client").html(data.html)
                // console.log(data)
			}
			
		}
	});
}
affiche_client()

function affiche_piece()
{
	$.ajax({
		url:"../modele/piece/affichePieceVente.php",
		method:"get",
		success:function(data)
		{
			data = $.parseJSON(data);
			if(data.status == "success")
			{
				$("#select-piece").html(data.html);
				// console.log(data)
			}
			
		}
	});
}
affiche_piece();

function ajouterVente()
{
    var listePiece = document.getElementById('liste_piece')
    var designation = $("#idArt").val();
    var qte = $("#qte").val();
    if(designation != "" && qte != "")
    {
        var idArt = designation.split('-')[0]
        var des = designation.split('-')[1];
        var idBase = idArt.split('P')[1];
        qte = parseFloat(qte);

        var liste = document.getElementsByClassName('liste-vente-tableau');
        var d = 0;
        var trouve = false;
        while(d<liste.length && !trouve){
            if(parseInt(liste[d].id.split('-')[0]) == parseInt(idBase)){
                trouve = true;
            }
            d++;
        }
        if(trouve){
            // console.log('il y a une indetite !');
            Swal.fire({
                icon: 'error',
                html: '<h6>Désolé, il y a une doublant</h6>'
            });
        }
        else{
            // console.log('normal');
            $.ajax({
                url:"../modele/vente/verification_stock.php",
                method:"post",
                data: {
                    'idArt': idBase,
                    'qte': qte
                },
                success:function(data)
                {
                    data = $.parseJSON(data)
                    if(data.etat){
                        listePiece.innerHTML+=
                            `<tr class="liste-vente-tableau" id="${idBase}-${qte}">
                                <td class="text-center" data-id="${idBase}" data-id="${idBase}">${idArt}</td>
                                <td class="text-center">${des}</td>
                                <td class="text-center">${qte}</td>
                                <td class="text-center" onclick="supprimerMoi(this)"><i class="bx bxs-trash bx-tada-hover btn btn-danger"></i></td>
                            </tr>`;
                        $("#idArt").val('');
                        $("#qte").val('');
                    }
                    else {
                        Swal.fire({
                            icon: 'info',
                            html: '<h4>'+ 'Désolé, il reste '+ data.stock + ' ' + data.des+'</h4>'
                        });
                    }
                }
            });
        }
        
    }
    else {
        if(designation=="" && qte==""){
            $("#idArt").addClass('is-invalid')
            $("#qte").addClass('is-invalid')
        }else if(designation!="" && qte=="" ){
            $("#idArt").removeClass('is-invalid')
            $("#qte").addClass('is-invalid')
        }else if(designation=="" && qte!=""){
            $("#idArt").addClass('is-invalid')
            $("#qte").removeClass('is-invalid')
        }
    }
}

function supprimerMoi(e){
    e.parentElement.remove();
}

function enregistrementVente(){
    var liste = document.getElementsByClassName('liste-vente-tableau');
    var listeBase = [];
    var idCl = $('#idCl').val();
    if(idCl != '' && (liste.length > 0))
    {
        for(var i=0;i<liste.length;i++){
            listeBase.push({'idArt': liste[i].id.split('-')[0],'qte': liste[i].id.split('-')[1]});
        }
        var date = getDateNow();
        var heure = getHoursM();
    //    console.log(JSON.stringify(listeBase))
        $.ajax({
            url:"../modele/vente/ajouterVente.php",
            method:"post",
            data: {
                'liste': JSON.stringify(listeBase),
                'date': date,
                'heure': heure,
                'idCl': idCl
            },
            success:function(data)
            {
                Swal.fire({
                    icon: 'success',
                    html: '<h4>Commande a été bien enregistré </h4>',
                    timer: 1500,
					showConfirmButton: false
                });
                console.log(data);
                affiche_vente();
                hideModalVente();
            }
        });
    }
    else 
    {
        Swal.fire({
            icon: 'error',
            html: '<h4>Pas de commande  </h4>'
        });
        
    }
    
}

function getDateNow()
{
    var d = new Date();
    var mois = ((parseInt(d.getMonth())+1)<10) ? '0'+ (parseInt(d.getMonth())+1) : (parseInt(d.getMonth())+1)
    var dateNow = (parseInt(d.getDate())<10) ? '0'+parseInt(d.getDate()) : parseInt(d.getDate())
    var date = d.getFullYear()+'-'+mois+'-'+dateNow;
    return date;
}

function getHoursM(){
    var d = new Date();
    var hours = (parseInt(d.getHours())<10)? '0'+parseInt(d.getHours()) : parseInt(d.getHours())
    var minute = (parseInt(d.getMinutes())<10)? '0'+parseInt(d.getMinutes()) : parseInt(d.getMinutes())
    var seconde = (parseInt(d.getSeconds())<10)? '0'+parseInt(d.getSeconds()) : parseInt(d.getSeconds())
    return hours + ':' + minute + ':' + seconde;
}

function affiche_vente()
{
	$.ajax({
		url:"../modele/vente/afficheVente.php",
		method:"get",
		success:function(data)
		{
			data = $.parseJSON(data);
			if(data.status == "success")
			{
				var divVente = $("#divVente");
				divVente.html(data.html);
                $(document).ready(function () {
                    $('#tableVente').DataTable({
                        //language: {  url: "//cdn.datatables.net/plug-ins/1.13.1/i18n/fr-FR.json" },
                        "pagingType": "simple_numbers",
                        "lengthMenu":[3,4,5],
                        "pageLength": 4,
                        "aaSorting": []
                    });
                });
			}
			
		}
	});
}

var modalSupVt = new bootstrap.Modal('#modalSupVt');
function ShowModalSupVente(idCl, idArt, qte, date, heure){
    // console.log(idCl, idArt, qte, date, heure);
    modalSupVt.show();
    $("#msg-vente").attr('data-id',idCl+'/'+idArt+'/'+qte+'/'+date+'/'+heure)
   	
}

function supprimerVente(){
    var dateId = $("#msg-vente").attr('data-id');
    var idCl = dateId.split('/')[0]
    var idArt = dateId.split('/')[1]
    var qte = dateId.split('/')[2]
    var date = dateId.split('/')[3]
    var heure = dateId.split('/')[4]
    // console.log(idCl, idArt, qte, date, heure);
       $.ajax({
		url:"../modele/vente/supprimerVente.php",
		method:"POST",
		data:{
            idCl, 
            idArt, 
            qte, 
            date, 
            heure
        },
		success:function(data){
			console.log(data);
			affiche_vente();
			modalSupVt.hide();
		}
	});	
}

function hideModalSupVente(){
    modalSupVt.hide();
}