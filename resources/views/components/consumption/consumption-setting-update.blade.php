<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Consumption Setup</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <input class="d-none" id="updateIDCons">
                                <label class="form-label">Material Name</label>
                                <input type="text" class="form-control" id="materialNameUp">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Size</label>
                                <input type="text" class="form-control" id="sizeUp">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Bahar</label>
                                <input type="text" class="form-control" id="baharUp">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Yard</label>
                                <input type="text" class="form-control" id="yardUp">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Inch</label>
                                <input type="text" class="form-control" id="inchUp">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Meter/Pound</label>
                                <input type="text" class="form-control" id="meterPoundUp">
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
async function FillUpUnitUpdateForm(id){

    document.getElementById('updateIDCons').value=id;

    showLoader();
    let res = await axios.post("/consumption-setting-by-id",{id:id},HeaderToken());
    hideLoader();

    //alert(res.data['unit_name']);

    document.getElementById('materialNameUp').value = res.data['material_name'];
    document.getElementById('sizeUp').value = res.data['size'];
    document.getElementById('baharUp').value = res.data['bahar'];
    document.getElementById('yardUp').value = res.data['yard'];
    document.getElementById('inchUp').value = res.data['inch'];
    document.getElementById('meterPoundUp').value = res.data['meter_pound'];

}

async function Update(){

    let updateIDCons   = document.getElementById('updateIDCons').value;
    let materialNameUp = document.getElementById('materialNameUp').value;
    let sizeUp         = document.getElementById('sizeUp').value;
    let baharUp        = document.getElementById('baharUp').value;
    let yardUp         = document.getElementById('yardUp').value;
    let inchUp         = document.getElementById('inchUp').value;
    let meterPoundUp   = document.getElementById('meterPoundUp').value;

    document.getElementById('update-modal-close').click();

    showLoader();
    let updatePostBody = {
        id:updateIDCons,
        material_name:materialNameUp,
        size:sizeUp,
        bahar:baharUp,
        yard:yardUp,
        inch:inchUp,
        meter_pound:meterPoundUp
    }
    let res = await axios.post("/update-consumption-setting",updatePostBody,HeaderToken());
    hideLoader();

    if(res.status == 200 && res.data['status'] == 'Success'){
        successToast(res.data['message']);
        document.getElementById('save-form').reset();
        await getList();
    }else{
        errorToast(res.data['message']);
    }

}

</script>
