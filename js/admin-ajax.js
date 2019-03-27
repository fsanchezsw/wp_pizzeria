$ = jQuery.noConflict();

$(document).ready(() => {
  //Obtener la URL de admin-ajax.php
  $('.delete_register').on('click', (e) => {
    e.preventDefault();
    var id = $(this).attr('data-reservations');
    swal({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if(result.value) {
        $.ajax({
          type: 'post',
          data: {
            'action': 'lapizzeria_delete',
            'id': id,
            'type': 'delete'
          },
          url: url_delete.ajaxurl,
          success: (data) => {
            var result = JSON.parse(data);
            if(result.response == 1) {
              jQuery("[reservations-data='" + result.id + "']").parent().parent().remove();
              swal({
                position: 'top-end',
                type: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1500
              });
            } else if(result.response == 'error') {
              swal({
                type: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                footer: '<a href>Why do I have this issue?</a>'
              });
            }
          }
        })
      }
    });
  });
});
