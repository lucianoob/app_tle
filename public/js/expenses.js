var url_api = 'http://localhost:8000/api/expenses/';
var user_id;
var dtTable;
var id_selected = 0;

$(document).ready(function($){
    $('.money').mask("000.00", {reverse: true});
    //$('.date').mask('00/00/0000');
    $('.time').mask('00:00:00');
});

$(document).ready(function(){
    user_id = $('#user_id').val();

    cfgDtTable();

    refreshDtTable();

    $('#btnNew').click(function () {
        refreshFrm();
        $('#mdEditTitle').html("New");
        $('#mdEdit').modal('show');
    });

    $('#btnEdit').click(function () {
        if(id_selected > 0) {
            $.getJSON(url_api+id_selected, function (data) {
                console.log(data);
                $.each(data, function(key, item) {
                    //console.log(key, item);
                    $('#'+key).val(item);
                });
                $('#mdEditTitle').html("Edit");
                $('#mdEdit').modal('show');
            });
        }
    });

    $('#btnCopy').click(function () {
        if(id_selected > 0) {
            $.getJSON(url_api+id_selected, function (data) {
                refreshFrm();
                $.each(data, function(key, item) {
                    //console.log(key, item);
                    if(key != "id") {
                        $('#' + key).val(item);
                    }
                });
                $('#mdEditTitle').html("Copy");
                $('#mdEdit').modal('show');
            });
        }
    });

    $('#btnDelete').click(function () {
        if (id_selected > 0) {
            $('#txtDeleteId').html(id_selected);
            $('#mdDelete').modal('show');
        }
    });

    $('#btnDeleteConfirm').click(function () {
        if (id_selected > 0) {
            $.ajax({
                url: url_api+id_selected,
                type: 'DELETE',
            }).done(function () {
                refreshDtTable();
                refreshFrm();
                $('#mdEdit').modal('hide');
                $('#mdInfoBody').html("The expense was deleted with success.");
                $('#mdInfo').modal('show');
            }).fail(function (data) {
                console.log(data);
                $('#mdErrorBody').html(JSON.stringify(data));
                $('#mdError').modal('show');
            });
        }
    });

    $('#formExpense').submit(function (event) {
        event.preventDefault();
        if (id_selected > 0) {
            $.ajax({
                url: url_api+id_selected,
                type: 'PUT',
                data: $("#formExpense").serialize(),
            }).done(function () {
                refreshDtTable();
                refreshFrm();
                $('#mdEdit').modal('hide');
                $('#mdInfoBody').html("The expense was updated with success.");
                $('#mdInfo').modal('show');
            }).fail(function (data) {
                console.log(data);
                $('#mdErrorBody').html(JSON.stringify(data));
                $('#mdError').modal('show');
            });
        } else {
            $.post(url_api, $("#formExpense").serialize(), function (data) {
                console.log(data);
                refreshDtTable();
                refreshFrm();
                $('#mdEdit').modal('hide');
                $('#mdInfoBody').html("The expense was recorded with success.");
                $('#mdInfo').modal('show');
            }).fail(function (data) {
                console.log(data);
                $('#mdErrorBody').html(JSON.stringify(data));
                $('#mdError').modal('show');
            });
        }
    });
});

function cfgDtTable () {
    dtTable = $('#tblExpenses').DataTable({
        columns: [
            { data: 'id' },
            { data: 'description' },
            { data: 'date' },
            { data: 'time' },
            { data: 'price'  , render: function (data, type, row) {
                    return '$'+data;
                }
            },
            { data: 'tags' , render: function (data, type, row) {
                    data = data.split(' ');
                    var format = '';
                    for(var i=0; i<data.length; i++) {
                        format += '<span class="badge badge-pill badge-secondary">'+data[i]+'</span> ';
                    }
                    return format;
                }
            }
        ]
    });

    $('#tblExpenses tbody').on( 'click', 'tr', function () {
        var data_row = dtTable.row(this).data();
        id_selected = data_row["id"];
        $('#tblExpenses tbody tr').removeClass('datatable-row_selected');
        $(this).addClass('datatable-row_selected');
        $('#btnEdit,#btnCopy,#btnDelete').removeAttr('disabled');
    });
}

function refreshDtTable() {
    $('#tblExpenses').dataTable().fnClearTable();
    $.getJSON(url_api+'user/'+user_id, function (data) {
        console.log(data);
        dtTable.rows.add(data).draw();
    });
}

function refreshFrm() {
    id_selected = 0;
    $('#formExpense')[0].reset();
    $('#btnEdit,#btnCopy,#btnDelete').attr('disabled', true);
    $('#tblExpenses tbody tr').removeClass('datatable-row_selected');
}
