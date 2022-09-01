<div class="modal-header">
    <h5 class="modal-title" id="modal-title">Post</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body" id="modal-body">
    <h2 id="content-modal-title"></h2>
    <p id="content-modal-body"></p>

    <div class="container" id="comments">
        
            
        
    </div>
</div>
<script>
    getApi("views/json/post.php?id=<?php echo $_GET['id']?>").then((msj)=>{
        let html ="";
        msj = JSON.parse(msj)
        
        $.each(msj.data,(i,v)=>{
            html+= `
            <div class="row" >
            <div class="col-8">
            <div class="card card-white post">
                <div class="post-heading">
                    <div class="float-left meta">
                        <div class="title h5">
                            <a href="#"><b>`+v.name+`</b></a>
                        </div>
                        <h6 class="text-muted time">`+v.email+`</h6>
                    </div>
                </div> 
                <div class="post-description"> 
                    <p>`+v.body+`</p>

                </div>
            </div>
        </div>
        </div>
        <br>
            `
        })

        $("#comments").html(html)
    })
</script>