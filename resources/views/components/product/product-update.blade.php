<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Product Setup</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Store</label>
                                <select type="text" placeholder="Select Store" class="form-control form-select" id="proUpdateStoreID">
                                    <option value="">Select Store</option>

                                </select>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Store Category</label>
                                <select type="text" class="form-control form-select" id="proUpdateStoreCatID">
                                    <option value="">Select Category Store</option>

                                </select>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="productUpdateName">
                                <input class="d-none" id="proSetupID">
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

ProductSetupStoreUpdateDropDownList();

async function ProductSetupStoreUpdateDropDownList(){

    let res = await axios.get("/store-list", HeaderToken());
    res.data.forEach(function(item, index){
        
        let option = `<option value="${item['id']}">${item['name']}</option>`

        $("#proUpdateStoreID").append(option);
    })
   

}  
ProductSetupStoreUpdateCategoryDropDownList();

async function ProductSetupStoreUpdateCategoryDropDownList(){

    let res = await axios.get("/store-category-list", HeaderToken());
    res.data.forEach(function(item, index){
        
        let option = `<option value="${item['id']}">${item['category_name']}</option>`

        $("#proUpdateStoreCatID").append(option);
    })
   

}    

async function FillUpProductSetupUpdateForm(id){

    //document.getElementById('storeCategoryID').value=id;

    showLoader();
    let res = await axios.post("/pro-setup-by-id",{id:id},HeaderToken());
    hideLoader();

    //alert(res.data['store_category_id']);

    document.getElementById('proSetupID').value = res.data['id'];
    document.getElementById('proUpdateStoreID').value = res.data['store_id'];
    document.getElementById('proUpdateStoreCatID').value = res.data['store_category_id'];
    document.getElementById('productUpdateName').value = res.data['product_name'];

}

async function Update(){
        let id = document.getElementById('proSetupID').value;
        let proUpdateStoreID = document.getElementById('proUpdateStoreID').value;
        let proUpdateStoreCatID = document.getElementById('proUpdateStoreCatID').value;
        let productUpdateName = document.getElementById('productUpdateName').value;

        $('#update-modal-close').click();

        showLoader();
        let updatePostBody = {
            id:id,
            store_id:proUpdateStoreID,
            store_category_id:proUpdateStoreCatID,
            product_name:productUpdateName
        }

        let res = await axios.post('/pro-setup-update',updatePostBody,HeaderToken());

        hideLoader();

        if(res.status == 200 && res.data['status'] == "Success"){
            //alert(res.data['message']);
            successToast(res.data['message']);
            document.getElementById('update-form').reset();
            await getList();
        }else{
            errorToast(res.data['message']);
        }
   }

 


</script>
