<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Create Store Category</h6>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Store</label>
                                <select class="form-control form-select" id="storeID">
                                    <option value="">Select Store</option>

                                </select>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Store Category Name</label>
                                <input type="text" class="form-control" id="category_name">
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

StoreDropDownList();

    async function StoreDropDownList(){

        let res = await axios.get("/store-list", HeaderToken());
        res.data.forEach(function(item, index){
            
            let option = `<option value="${item['id']}">${item['name']}</option>`

            $("#storeID").append(option);
        })
       

    }

   async function Save(){
        

        let storeID = document.getElementById('storeID').value;
        let categoryName = document.getElementById('category_name').value;

        $('#modal-close').click();

        showLoader();
        let res = await axios.post('/create-store-category',{store_id:storeID, category_name:categoryName},HeaderToken());
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

