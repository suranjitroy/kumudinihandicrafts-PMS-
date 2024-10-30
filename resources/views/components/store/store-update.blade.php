<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Store</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Store Name *</label>
                                <input type="text" class="form-control" id="UpdateName">
                                <input class="d-none" id="updateID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="Update()" id="update-btn" class="btn bg-gradient-success" >Update</button>
            </div>
        </div>
    </div>
</div>


<script>
async function FillUpUpdateForm(id){

    document.getElementById('updateID').value=id;

    showLoader();
    let res = await axios.post("/store-by-id",{id:id},HeaderToken());
    hideLoader();

    //alert(res.data['name']);

    document.getElementById('UpdateName').value = res.data['name'];

}

async function Update(){

    let name = document.getElementById('UpdateName').value;
    let id   = document.getElementById('updateID').value;

    document.getElementById('update-modal-close').click();

    showLoader();
    let res = await axios.post("/store-update",{name:name, id:id},HeaderToken());
    hideLoader();

    if(res.status == 200 && res.data['status'] == 'Success'){
        successToast(res.data['message']);
        await getList();
    }else{
        errorToast(res.data['message']);
    }

}

 


</script>
