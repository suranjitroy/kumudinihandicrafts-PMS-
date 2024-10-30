<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Product Distribution</h6>
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
                        
                            {{-- <div class="col-12 p-1">
                                <label class="form-label">Product ID</label>
                                <input type="text" class=" d-none form-control" id="proID">
                            </div> --}}

                            <div class="col-12 p-1">
                                <label class="form-label">Product</label>
                                <select type="text" class="form-control form-select" id="proDisID">
                                    <option value="">Select Product</option>

                                </select>
                            </div>

                            <div class="col-12 p-1">
                                <label class="form-label">Quantity</label>
                                <input type="text" class="calcutate form-control" id="quantity">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Unit</label>
                                <select type="text" class="form-control form-select" id="unitID">
                                    <option value="">Select Unit</option>

                                </select>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Unit Price</label>
                                <input type="text" class="calcutate form-control" id="unit_price">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Total</label>
                                <input type="text" class="form-control" id="total" readonly>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Purpose</label>
                                <textarea rows="3" cols="5" class="form-control" id="purpose">
                                </textarea>
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

ProductDropDownList();

    async function ProductDropDownList(){

        let res = await axios.get("/pro-setup-list", HeaderToken());
        res.data.forEach(function(item, index){
            
            let option = `<option value="${item['id']}">${item['product_name']}</option>`

            $("#proDisID").append(option);
        })
       
    
    } 


ProductUnitDropDownList();

async function ProductUnitDropDownList(){

    let res = await axios.get("/unit-list", HeaderToken());
    res.data.forEach(function(item, index){
        
        let option = `<option value="${item['id']}">${item['unit_name']}</option>`

        $("#unitID").append(option);
    })
   

}

$('.calcutate').on('input', function(){

        let quantity   = document.getElementById('quantity').value;
        let unitPrice  = document.getElementById('unit_price').value;
        document.getElementById('total').value = quantity*unitPrice


    });

   async function Save(){
        

        let storeID         = document.getElementById('storeID').value;
        let storeCategoryID = document.getElementById('storeCategoryID').value;
        let productDisID    = document.getElementById('proDisID').value;
        let quantity        = document.getElementById('quantity').value;
        let unitID          = document.getElementById('unitID').value;
        let unitPrice       = document.getElementById('unit_price').value;
        let total           = document.getElementById('total').value;
        let purpose         = document.getElementById('purpose').value;

        $('#modal-close').click();

        showLoader();

        let postBody = {
            store_id:storeID,
            store_category_id:storeCategoryID,
            product_id:productDisID,
            quantity:quantity,
            unit_id:unitID,
            unit_price:unitPrice,
            total:total,
            purpose:purpose

        }

        let res = await axios.post('/create-product-distribution',postBody,HeaderToken());

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

