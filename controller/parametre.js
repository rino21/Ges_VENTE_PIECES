function creerCompte(){
    var pseudo = $("#pseudo").val();
	if(pseudo==""){
		$("#pseudo").addClass('is-invalid')
	}else{
		$.ajax({
			url:"../modele/login/creerCompte.php",
			method:"post",
			data:{
                pseudo
            },
			success:function(data){
				Swal.fire({
                    icon: 'success',
                    html: '<h4>Compte a été bien enregistré </h4>',
					timer: 1500,
					showConfirmButton: false
                });
                
				$("#form-creer-compte").trigger("reset");
			}
		});
	}
	
}

function modifierCompte(){
    var pseudo = $("#m_pseudo").val();
    var idU = $("#idU").val();
	if(pseudo==""){
		$("#m_pseudo").addClass('is-invalid')
	}else{
		$("#m_pseudo").removeClass('is-invalid')
		$.ajax({
			url:"../modele/login/modifierCompte.php",
			method:"post",
			data:{
                pseudo,
				idU
            },
			success:function(data){
				console.log(data);
                Swal.fire({
                    icon: 'success',
                    html: '<h4>Pseudo a été bien modifié </h4>',
					timer: 1500,
					showConfirmButton: false
                });
				$("#form-modifier-compte").trigger("reset");
			}
		});
	}
	
}

function changePwd(){
	var pwd = $("#pwd").val();
    var n_pwd = $("#n_pwd").val();
    var idU = $("#idU").val();

	if(pwd=="" || n_pwd==""){
		if(pwd=="" && n_pwd!=""){
			$("#pwd").addClass('is-invalid')
			$("#n_pwd").removeClass('is-invalid')
		}else if(pwd!="" && n_pwd==""){
			$("#pwd").removeClass('is-invalid')
			$("#n_pwd").addClass('is-invalid')
		}
		else{
			$("#pwd").addClass('is-invalid')
			$("#n_pwd").addClass('is-invalid')
		}

	}else{
		$("#pwd").removeClass('is-invalid')
		$("#n_pwd").removeClass('is-invalid')
		$.ajax({
			url:"../modele/login/changerPwd.php",
			method:"post",
			data:{
				pwd,
				n_pwd,
				idU
			},
			type:'JSON',
			success:function(data){
				data = $.parseJSON(data);
				if(data.etat){
					Swal.fire({
						icon: 'error',
						html: '<h4>Votre mot de passe est incorrect ! </h4>',
					});
				}
				else{
					Swal.fire({
						icon: 'success',
						html: '<h4>Modification succès ! </h4>',
						timer: 1500,
						showConfirmButton: false
					});
					$("#form-change-pwd").trigger("reset");
				}
				
			}
		});
	}
	
}