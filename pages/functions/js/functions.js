function excluir() {

  $(document).ready(function () {
    $(".excluir").click(function () {
      //$(".img").remove();
      $.ajax({
        url: '\shakers\pages\arquivos\642b184839f65.jpeg',
        method: 'POST',

      }).done(function (url) {
        alert(url);
        /*success: function(result) {
            console.log("Arquivo removido com sucesso!");
        }*/
      });
    });
  });
}
/* $(document).ready(function() {
   $(".btn").click(function() {
       $(".container-image").remove();
   });
});*/
