<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Create Master</h6>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Master Name </label>
                                <input type="text" class="form-control" id="master_name">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Mobile No</label>
                                <input type="text" class="form-control" id="mob_no">
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

        let name = document.getElementById('master_name').value;
        let phn = document.getElementById('mob_no').value;

        $('#modal-close').click();

        showLoader();
        let res = await axios.post('/create-master',{master_name:name, mob_no:phn},HeaderToken());
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

