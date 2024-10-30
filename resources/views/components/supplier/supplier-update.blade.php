<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Supplier</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Supplier Name</label>
                                <input type="text" class="form-control" id="updateName">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Supplier Address</label>
                                <input type="text" class="form-control" id="updateAddress">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Supplier Mobile No</label>
                                <input type="text" class="form-control" id="updateMobileNo">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Supplier Email</label>
                                <input type="text" class="form-control" id="updateEmail">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Status</label>
                                <select class="form-control form-select" id="updateStatus">
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                            <input type="text" class="d-none" id="suppilerUpdateId">
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
async function FillUpSupplierUpdateForm(id){

    document.getElementById('suppilerUpdateId').value=id;

    showLoader();
    let res = await axios.post("/supplier-by-id",{id:id},HeaderToken());
    hideLoader();

    //alert(res.data['name']);

    document.getElementById('updateName').value = res.data['name'];
    document.getElementById('updateAddress').value = res.data['address'];
    document.getElementById('updateMobileNo').value = res.data['mobile_no'];
    document.getElementById('updateEmail').value = res.data['email'];
    document.getElementById('updateStatus').value = res.data['status'];
    

}

async function Update(){

    let id =  document.getElementById('suppilerUpdateId').value;
    let name = document.getElementById('updateName').value;
    let address = document.getElementById('updateAddress').value;
    let mobileNo = document.getElementById('updateMobileNo').value;
    let email = document.getElementById('updateEmail').value;
    let status =  document.getElementById('updateStatus').value;
    

    document.getElementById('update-modal-close').click();

    showLoader();
    let postBody = {
        id:id,
        name:name,
        address:address,
        mobile_no:mobileNo,
        email:email,
        status:status
    }
    let res = await axios.post("/supplier-update",postBody,HeaderToken());
    hideLoader();

    if(res.status == 200 && res.data['status'] == 'Success'){
        successToast(res.data['message']);
        await getList();
    }else{
        errorToast(res.data['message']);
    }

}

 


</script>
