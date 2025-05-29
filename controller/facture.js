$(document).ready(function () {
    $('#tableFacture').DataTable({
        //language: {  url: "//cdn.datatables.net/plug-ins/1.13.1/i18n/fr-FR.json" },
        "pagingType": "simple_numbers",
        "lengthMenu":[5,6,7],
        "pageLength": 7,
        "aaSorting": []
    });
});