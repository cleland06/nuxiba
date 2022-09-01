<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="src/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="src/css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="src/css/style.css">

    <title>Usuarios</title>
  </head>
  <body>
  

  <div class="content" id="content">
    
    <div class="container">
      <h2 class="mb-5">Usuarios</h2>

      <div class="table-responsive">

        <table class="table custom-table">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Nombre</th>
              <th scope="col">Usuario</th>
              <th scope="col">Email</th>
              <th scope="col">Teléfono</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody id="tbl_body">
          </tbody>
        </table>
      </div>


    </div>
    
  </div>
  <div class="modal fade bd-example-modal-lg" id="postModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="modal-content">
      
    </div>
  </div>
</div>
    

    <script src="src/js/jquery-3.3.1.min.js"></script>
    <script src="src/js/popper.min.js"></script>
    <script src="src/js/bootstrap.min.js"></script>
    <script src="src/js/main.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="src/js/funcionesg.js"></script>

    <script>
        $(document).ready(function(){
          getApi("views/json/index.php").then((msj)=>{
              msj = JSON.parse(msj);
              let html = "";
              let onClick= "";
              if(msj.status == "Ok"){
                $.each(msj.data, function(i,v){
                  html += "<tr>";
                  html += `<td>`+v.id+`</td><td>`+v.name+`</td><td>`+v.username+`</td><td>`+v.email+`</td><td><ul class="persons">`+v.phone+`</td><td><a href="#" class="btn btn-warning ver" onClick="aparecermodulos('views/usuario.php?id=`+v.id+`&type=todos','content')">Todos</a> <a href="#" class="btn btn-primary ver" onClick="aparecermodulos('views/usuario.php?id=`+v.id+`&type=post','content')">Post</a></td>`;
                  html +="</tr>"
                })
                $('#tbl_body').html(html);
              }
            })
          $('.ver').click(function(e){
            alert("aqui");
            let id = $(this).data('id');
            aparecermodulos("views/usuario.php?id="+id,"content");
            
          })
          
          $('#postModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var id = button.data('id') 
            var title = button.data('title') 
            var body = button.data('body') 
            var modal = $(this)
            var url   = button.data('murl')
            var type   = button.data('type')
            aparecermodulos(url,"modal-content").then((msj)=>{
              if(type == 'json'){
                (title != "" ) ?  $('#content-modal-title').html(title):null;
                (body != "" ) ?$('#content-modal-body').html(body):null;
              }else{
                $('#content-modal-body').html(msj)
              }
            })
          })
        })
    </script>
  </body>
</html>