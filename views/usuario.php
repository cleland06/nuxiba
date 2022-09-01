<?php
$type = (isset($_GET['type'])) ? $_GET['type'] :  "error";
?>
<div class="container">
    <h2 class="mb-5">Usuario</h2>
    <h3>Nombre: <small id="name"></small></h3>
    <h3>Usuario: <small id="username"></small></h3>
    <h3>Email: <small id="email"></small></h3>
    <div class="row">
        <div class="col-md-6">
            <button class="btn btn-primary" onclick="window.location.reload()">Regresar</button>
            <?php if($type == "todos"){
            ?>
            <button  type="button" data-type="html" data-murl="views/new_todos.php?id=<?php echo $_GET['id']?>" class="btn btn-primary" data-title="Nueva tarea" data-toggle="modal" data-target="#postModal">Nueva Tarea</button>
            <?php }
            ?>
        </div>
    </div>
    
    <div class="container mt-5 mb-3">
    <div class="row" id="row-card">
        
    </div>
</div>
</div>
<script>
    $(document).ready(function(){
        let type = "<?php  echo $type;?>" ;
        getApi("views/json/usuario.php?id=<?php echo $_GET['id']?>").then((msjU)=>{
            msjU = JSON.parse(msjU);
            $('#name').html(msjU.data.name)
            $('#username').html(msjU.data.username)
            $('#email').html(msjU.data.email)
            })
            if(type == "post"){
                getApi("views/json/posts.php?id=<?php echo $_GET['id']?>").then((msj)=>{
                    msj = JSON.parse(msj);
                    console.log(msj);
                    let html = "";
                    $.each(msj.data,(i,v)=>{
                        html += `
                        <div class="col-md-4">
                            <div class="card p-3 mb-2">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center  ">
                                        <div class="icon"> <i class="bx bxl-mailchimp"></i>`+v.id+` </div>
                                    </div>
                                    <div class="badge"> <span><button  type="button" data-type="json" data-murl="views/post.php?id=`+v.id+`" class="btn btn-primary" data-title="`+v.title+`" data-body="`+v.body+`" data-id="`+v.id+`" data-toggle="modal" data-target="#postModal">Comentarios</button></span> </div>
                                </div>
                                <div class="mt-5">
                                    <h3 class="heading">`+v.title+`</h3>
                                    <h4 class="heading">`+v.status+`</h4>
                                    
                                    <div class="mt-5">
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                        })
                        $("#row-card").html(html);
                    })
            }else if(type == "todos"){
                getApi("views/json/todos.php?id=<?php echo $_GET['id']?>").then((msj)=>{
                msj = JSON.parse(msj);
                console.log(msj);
                let html = "";
                
                $.each(msj.data,(i,v)=>{
                    let completed = (v.completed == true) ? "bg-primary text-white" : "bg-warning text-dark "
                    let completed_text = (v.completed == true) ? "Completado" : "Pendiente "
                    html += `
                    <div class="col-md-4">
                        <div class="card p-3 mb-2 `+completed+`">
                            <div class="d-flex justify-content-between ">
                                <div class="d-flex flex-row align-items-center">
                                    <div class="icon"> <i class="bx bxl-mailchimp"></i>`+v.id+` `+completed_text+` </div>
                                </div>
                            </div>
                            <div class="mt-5">
                                <h3 class="heading">`+v.title+`</h3>
                                
                                <div class="mt-5">
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
                    })
                    $("#row-card").html(html);
                })
            }
            else{
                alert("lo sentimos no se encontró el tipo de ruta");

            }
            

            

    })
    </script>
