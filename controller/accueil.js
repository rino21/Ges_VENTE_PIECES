
function chartLiner(){
    $.ajax({
		url:"../modele/accueil/chartLine.php",
		method:"get",
		success:function(data)
		{
			data = $.parseJSON(data);
			// console.log(data)
            const line = document.getElementById('line').getContext('2d');
            const myChart = new Chart(line, {
                type: 'bar',
                data: {
                    labels: data.label.reverse(),
                    datasets: [{
                        label: '# Nombre ',
                        data: data.dataDb.reverse(),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 206, 86, 0.8)',
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(153, 102, 255, 0.8)',
                            'rgba(255, 159, 64, 0.8)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
		}
	});
}
chartLiner();

function showModalEtat()
{
    var modal = new bootstrap.Modal('#modalEtatStock')
    modal.show()
}

function etatDeStockEntre2date(){
    var idPiece = $('#idPiece').val();
    var dateDeb = $('#dateDebEtat').val();
    var dateFin = $('#dateFinEtat').val();
    if(idPiece != "" && dateDeb != "" && dateFin !=""){
        $.ajax({
            url:"../modele/accueil/etatDeStock.php",
            method:"post",
            data: {
                idPiece,
                dateDeb,
                dateFin
            },
            success:function(data)
            {
                data = $.parseJSON(data)
                // console.log(data);
                $("#listeEtatE").html(data.htmlE);
                $("#listeEtatS").html(data.htmlS);
                $("#totalS").html(`Total Sorti : ${(data.totalSorti != null)?data.totalSorti:0}`);
                $("#totalE").html(`Total Entré :${(data.totalEntree != null)?data.totalEntree:0}`);
                $("#totalR").html(`Total Reste :${(data.totalEntree != null)?parseFloat(data.totalEntree)-parseFloat(data.totalSorti):0}`);
            }
        });
    }
    else{
        alert('diso')
    }
}

function modalListeVente(){
    var modal = new bootstrap.Modal("#modalListeVente")
    modal.show()
}

function modalImpStock(){
    var modal = new bootstrap.Modal('#modalImpStock');
    modal.show();
    $('#listeStockPiece_filter').css('display', 'none');
    $('#listeStockPiece_info').css('display', 'none');
    $('#listeStockPiece_paginate').css('display', 'none');
}

$(document).ready(function () {
    $('#listeStockPiece').DataTable({
        //language: {  url: "//cdn.datatables.net/plug-ins/1.13.1/i18n/fr-FR.json" },
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5'
        ],
    });
    $('#listeStockPiece').css('display', 'none');
});


