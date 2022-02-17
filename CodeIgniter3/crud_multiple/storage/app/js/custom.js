$('.action-delete').click(function(){
    Swal.fire({
        title: 'Are you sure?',
        text: "You Will delete this data !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            var form = $(this).parents('form');
            form.attr('action',$(this).attr('data-href'));
            form.submit();
        }
    })
});

$('.action-update').click(function(e){

    var arr = [];
    $('input.checkbox:checked').each(function () {
        arr.push($(this).val());
    });

    var action = $(this).attr('data-href') + '/' +arr.join("-");
    window.location.href = action;
});

//select all checkboxes
$("#select_all").change(function(){  //"select all" change 
    $(".checkbox").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
    if(false == $(this).prop("checked")){ 
        $(".action-update").prop('disabled', true);
        $(".action-delete").prop('disabled', true);
    }

    if ($('.checkbox:checked').length > 0){
        $(".action-update").prop('disabled',false);
        $(".action-delete").prop('disabled',false);
    }
});

//".checkbox" change 
$('.checkbox').change(function(){ 
    //uncheck "select all", if one of the listed checkbox item is unchecked
    if(false == $(this).prop("checked")){ //if this item is unchecked
        $("#select_all").prop('checked', false); //change "select all" checked status to false
        $(".action-update").prop('disabled', true);
        $(".action-delete").prop('disabled', true);
    }

    //check "select all" if all checkbox items are checked
    if ($('.checkbox:checked').length == $('.checkbox').length ){
        $("#select_all").prop('checked', true);
        $(".action-update").prop('disabled',false);
        $(".action-delete").prop('disabled',false);
    }

    if ($('.checkbox:checked').length > 0){
        $(".action-update").prop('disabled',false);
        $(".action-delete").prop('disabled',false);
    }
});
