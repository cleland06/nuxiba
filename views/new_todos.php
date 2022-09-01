<div class="modal-header">
    <h5 class="modal-title" id="modal-title">Nueva tarea</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body" id="modal-body">
    <form id="frm-todos" method="post">
        <input type="hidden" name="userId" id="userId" value="<?php echo $_GET['id']?>">
        <div class="form-group">
            <label for="title">titulo</label>
            <input name="title" required type="title" class="form-control" id="title"  placeholder="titulo">
        </div>
        <div class="form-check">
            <input name="completed" type="checkbox" class="form-check-input" id="completed">
            <label class="form-check-label" for="completed">Completada</label>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
<script>
    $("form").submit(function(e){
        
        e.preventDefault();
        let data =  {
            'userId':$('#userId').val(),
            'title':$('#title').val(),
            'completed':($("#completed").is(":checked"))?true:false
        } 
        enviarPostData('views/json/saveTodos.php', data, 'json').then((msj)=>{
            Swal.fire(
                'Bien',
                'la tarea fue realizada con éxito',
                'success'
                )
            $('#postModal').modal('hide')    
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
        });
    })
</script>