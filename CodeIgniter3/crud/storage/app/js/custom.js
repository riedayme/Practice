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
            window.location.href = $(this).data('href');
        }
    })
});
