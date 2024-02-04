document.addEventListener('DOMContentLoaded', function() {
  let returnButtons = document.querySelectorAll('.delete-button');
  returnButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      let form = button.closest('form');
      let name = form.dataset.name;
      console.log(name);
      Swal.fire({
        title: "Voce quer deletar o livro "+name+"?",
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