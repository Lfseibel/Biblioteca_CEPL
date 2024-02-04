document.addEventListener('DOMContentLoaded', function() {
  let returnButtons = document.querySelectorAll('.edit-button');
  returnButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      let form = button.closest('form');
      let id = form.id;
      let name = form.dataset.user_name;
      console.log(name);
      Swal.fire({
        title: "Voce quer devolver a reserva de "+name+"?",
        showCancelButton: true,
        confirmButtonText: 'Sim',
        denyButtonText: 'Não',
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });
  });
});