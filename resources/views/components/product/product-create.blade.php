<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Product Setup</h6>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Store</label>
                                <select type="text" placeholder="Select Store" class="form-control form-select" id="storeID">
                                    <option value="">Select Store</option>

                                </select>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Store Category</label>
                                <select type="text" class="form-control form-select" id="storeCategoryID">
                                    <option value="">Select Category Store</option>

                                </select>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="productName">
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

    StoreCategoryDropDownList();

    async function StoreCategoryDropDownList(){

    let res = await axios.get("/store-category-list", HeaderToken());
    res.data.forEach(function(item, index){
        
        let option = `<option value="${item['id']}">${item['category_name']}</option>`

        $("#storeCategoryID").append(option);
    })
   

}    

   async function Save(){
        

        let storeID = document.getElementById('storeID').value;
        let storeCategoryID = document.getElementById('storeCategoryID').value;
        let productName = document.getElementById('productName').value;

        $('#modal-close').click();
        
       

        showLoader();

        let postBody = {
            store_id:storeID,
            store_category_id:storeCategoryID,
            product_name:productName
        }

        let res = await axios.post('/create-pro-setup',postBody,HeaderToken());

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

