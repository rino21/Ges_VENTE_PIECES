function seConnecter(){
    var pseudo = $("#pseudo").val();
    var pwd = $("#pwd").val();
    if(pseudo=="" || pwd==""){
        if(pseudo=="" && pwd!=""){
            $("#error_pseudo").addClass('error_log')
            $("#error_pseudo").css('display', 'block')
           
        }else if(pseudo!="" && pwd==""){
            $("#error_pwd").addClass('error_log')
            $("#error_pwd").css('display', 'block')
        }else{
            $("#error_pseudo").addClass('error_log')
            $("#error_pwd").addClass('error_log')
            $("#error_pwd").css('display', 'block')
            $("#error_pseudo").css('display', 'block')
        }

    }else{
        $.ajax({
            url:'../modele/login/seConnecter.php',
            method:'POST',
            data:{pseudo,pwd},
            dataType:'JSON',
            success:function(data){
                if(data[0]==1)
                {
                    $("#error_pseudo").addClass('error_log')
                    $("#error_pwd").addClass('error_log')
                    $("#error_pwd").css('display', 'block')
                    $("#error_pseudo").css('display', 'block')
                }
                else
                {
                    // $("#erreur_log").text("");
                    window.location="../vue/accueil.php";
                    // $("#form_login").trigger("reset");
                    // $("#erreur_log").removeClass("alert alert-danger");
                }
            }
        })
    }
  
}