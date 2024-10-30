<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Create Supplier</h6>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Supplier Name</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Supplier Address</label>
                                <textarea rows="5" cols="5" class="form-control" id="address">
                                </textarea>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Supplier Mobile No</label>
                                <input type="text" class="form-control" id="mobile_no">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Supplier Email</label>
                                <input type="text" class="form-control" id="email">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Status</label>
                                <select class="form-control form-select" id="status">
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
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
        

        let name = document.getElementById('name').value;
        let address = document.getElementById('address').value;
        let mobileNo = document.getElementById('mobile_no').value;
        let email = document.getElementById('email').value;
        let status = document.getElementById('status').value;

        $('#modal-close').click();

        showLoader();
        let postBody = {
            name:name,
            address:address,
            mobile_no:mobileNo,
            email:email,
            status:status
        }
        let res = await axios.post('/create-supplier',postBody,HeaderToken());
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

