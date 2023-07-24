import { Dropdown } from "bootstrap";

jQuery(function(){
    $("#randomBtnSpinner").hide();
    $("#submitBtnSpinner").hide();
    $("#randomBtn").on('click', function (e) {
        e.preventDefault();
        $("#randomBtnSpinner").removeAttr('hidden').show();
        $("#randomBtnText").hide();
        $.ajax({
            url: window.location.origin + "/plat/random",
            type: "GET",
            success: function (response) {
                $("#randomBtnText").show().text('Hisafidy hafa');
                $("#randomBtnSpinner").hide();
                let result = "👉 " + response.name + " 👈";
                $("#randomResult").text(result);
                // anime({
                //     targets: $("#randomResult"),
                //     update: function (){
                //         $("#randomResult").text(result);
                //     }
                // })
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log('Ajax request failed. ');
            }
        })
    })

    $('#loginForm').on('submit', function(event) {
        event.preventDefault();
        $("#submitBtnSpinner").removeAttr('hidden').show();
        $("#submitBtnText").hide();

        $('#loginForm').trigger('submit');
    })

    var dropdowns = document.querySelectorAll('.dropdown-toggle');
    dropdowns.forEach(function(dropdown) {
        new Dropdown(dropdown);
    });

    // Menu animation
    $('#menu-bars').on('click', function(event) {
        event.preventDefault();
        console.log('Cliqué')
        anime({
            targets: $('#menu'),
            display: 'inline-block',
            easing: 'easeInOutQuad'
        })
    })


    // DataTable Plat List
    $('#datatable-plat-list').dataTable({
        "data": dataPlat,
        "columns": [
            {
                "data": "id"
            },
            {
                "data": "name"
            },
            {
                "data": "day"
            },
            {
                "data": "recipe"
            }
        ],
        "columnDefs": [
            {
               "targets": [0],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [2],
                "render": function (data) {
                    if(!data) {
                        return "Andavanandro"
                    }
                    else{
                        return "Alahady na fety"
                    }
                }
            },
            {
                "targets": [3],
                "render": function (data) {
                    if(!data) {
                        return "Tsy mbola misy recette"
                    }
                }
            },
            {
                "targets": [4],
                "visible": true,
                "render": function (data, type, row, meta)
                {
                    let $controlls;
                    $controlls = '<a href="" class="btn btn-sm btn-primary me-2" ' +
                        'title="Modifier" ' +
                        'data-toggle="modal" data-target="#editPlat" data-id="' + row.id + '" data-name="' + row.name + '">' +
                        '<i class="fas fa-edit"></i></a>';
                    $controlls += '<a href="'+ window.location.origin +'/plat/delete/'+ row.id +'" class="btn btn-sm btn-danger" ' +
                        'title="Supprimer" ' +
                        'data-toggle="modal" data-target="#deletePlat" data-id="' + row.id + '" data-name="' + row.name + '">' +
                        '<i class="fas fa-trash"></i></a>';
                    return $controlls;
                }
            }
        ],
        "order": []
    });
})
