<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Create New Consumption Setup</h6>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Material Name</label>
                                <input type="text" class="form-control" id="material_name">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Size</label>
                                <input type="text" class="form-control" id="size">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Bahar</label>
                                <input type="text" class="form-control" id="bahar">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Yard</label>
                                <input type="text" class="form-control" id="yard">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Inch</label>
                                <input type="text" class="form-control" id="inch">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="Save()" id="save-btn" class="btn bg-gradient-success" >Save</button>
                </div>
            </div>
    </div>
</div>



<script>



   async function Save(){


        let materialName  = document.getElementById('material_name').value;
        let size          = document.getElementById('size').value;
        let bahar         = document.getElementById('bahar').value;
        let yard          = document.getElementById('yard').value;
        let inch          = document.getElementById('inch').value;


        $('#modal-close').click();

        showLoader();

       let postBody = {

           material_name:materialName,
           size:size,
           bahar:bahar,
           yard:yard,
           inch:inch
       }

        let res = await axios.post('/create-consumption-setting',postBody,HeaderToken());

        hideLoader();

        if(res.status == 200 && res.data['status'] == "Success"){
            successToast(res.data['message']);
            document.getElementById('save-form').reset();
            await getList();
        }else{
            errorToast(res.data['message']);
        }
   }


</script>

