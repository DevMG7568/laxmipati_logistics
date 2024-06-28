var save_method; //for save method string
var table;
var add_url;
var edit_url;
var update_url;
var delete_url;

function add_formData()
{
    save_method = 'add';
    $('#m-form')[0].reset(); // reset form on modals
    $('#myModal').modal('show');
    $('#m-title').html('Add'); // Set Title to Bootstrap modal title
}

function edit_formData(id)
{
    save_method = 'update';
    $('#m-form')[0].reset(); // reset form on modals

    //Ajax Load data from ajax
    $.ajax({
        url : edit_url+"/"+ id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            for (var key in data) {
                $('[name="'+key+'"]').val(data[key]).change();
            }
            $('#myModal').modal('show');
            $('#m-title').html('Edit'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
function save()
{
    var btn = $(".btn-primary");
    btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
    var url;
    if(save_method == 'add')
    {
        url = add_url;
    }
    else
    {
        url = update_url;
    }
    var form = $('#m-form');
    var formData = new FormData();
    var formParams = form.serializeArray();

    $.each(form.find('input[type="file"]'), function(i, tag) {
        $.each($(tag)[0].files, function(i, file) {
            formData.append(tag.name, file);
        });
    });

    $.each(formParams, function(i, val) {
    formData.append(val.name, val.value);
    });

   
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: formData,//$('#m-form').serialize(),
        dataType: "JSON",
        processData: false,
        contentType: false,
        success: function(data)
        {
            //if success close modal and reload ajax table
            if(data.status==true)
            {
                $('#myModal').modal('hide');
                reload_table(table);
                if(save_method == 'add')
                {
                    btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                    noticustom('Record added Successfully','success');
                }
                else
                {
                    btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                    noticustom('Record changed Successfully','success');
                }
                
            }
            else{
                //alert(data.error);
                btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                 noticustom(data.error,'error');
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
            alert('Error adding / update data');
        }
    });
}
function delete_formData(id)
{
swal.fire({
    title: "Are you sure?",
    text: "Once deleted, you will not be able to recover this record!",
    type: "question",
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!',
    buttons: true,
    dangerMode: true,
})
.then(function(result) {
    if (result.value) {
    $.ajax({
            url : delete_url+"/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#myModal').modal('hide');
                reload_table(table);
                noticustom("Poof! Your record has been deleted!","success");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    } else {
        noticustom("Your record is safe!","info")
    }
});

}
function noticustom(msg,type)
{
  swal.fire(type, msg, type);
}
//var table;
function datatableCall(url)
{
  var table1=$('#kt_table_1').DataTable( {
    "sDom": "<'row float-right'<'col-12'f l>><'table-responsive't><'row'<p i>>", 
    buttons: [
        'copyHtml5',
        'excelHtml5',
        'csvHtml5',
        'pdfHtml5'
    ],
            "destroy": true,
            "scrollCollapse": true,
            "oLanguage": {
                "sLengthMenu": "_MENU_ ",
                "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries",
            },
            // "iDisplayLength": 10,
            "aLengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            // "drawCallback": function( settings ) {
            //     feather.replace();
            // },
        processing: true,
        serverSide: true,
        responsive: true,
        // stateSave: true,
        ordering: false,
       
        stateSaveParams: function (settings, data) {
        delete data.search;
        },
        ajax: {
            "url":url,
            "type": "POST",
            "data": function(d){
                d.form = $("#company-form1").serializeArray();
            },
        },
        type: 'POST',
        // language: {
        //             emptyTable: "No data available in table",
        //             info: "Showing _START_ to _END_ of _TOTAL_ entries",
        //             infoEmpty: "No entries found",
        //             infoFiltered: "(filtered1 from _MAX_ total entries)",
        //             lengthMenu: "_MENU_ ",
        //             search: "_INPUT_",
        //             searchPlaceholder: "Search",
        //             zeroRecords: "No matching records found"
        //         },
    
        });

        $('#export_copy').on('click', function(e) {
            e.preventDefault();
            table1.button(0).trigger();
        });
        
        $('#export_excel').on('click', function(e) {
            e.preventDefault();
            table1.button(1).trigger();
        });
        
        $('#export_csv').on('click', function(e) {
            e.preventDefault();
            table1.button(2).trigger();
        });
        
        $('#export_pdf').on('click', function(e) {
            e.preventDefault();
            table1.button(3).trigger();
        });
        return table1;

}
// $('#search-table').keyup(function() {
//     table.fnFilter($(this).val());
// });
function reload_table(table)
{
  table.ajax.reload( null, false );
}