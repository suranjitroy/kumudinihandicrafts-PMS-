<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Product Receive</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Store</label>
                                <select type="text" placeholder="Select Store" class="form-control form-select" id="proReceiveUpdateStoreID">
                                    <option value="">Select Store</option>

                                </select>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Store Category</label>
                                <select type="text" class="form-control form-select" id="proReceiveUpdateStoreCatID">
                                    <option value="">Select Category Store</option>

                                </select>
                            </div>
                        
                            {{-- <div class="col-12 p-1">
                                <label class="form-label">Product ID</label>
                                <input type="text" class=" d-none form-control" id="proID">
                            </div> --}}

                            <div class="col-12 p-1">
                                <label class="form-label">Product</label>
                                <select type="text" class="form-control form-select" id="proRecUpdateID">
                                    <option value="">Select Product</option>

                                </select>
                            </div>

                            <div class="col-12 p-1">
                                <label class="form-label">Product Description</label>
                                <textarea rows="3" cols="5" class="form-control" id="updateDescription">
                                </textarea>
                            </div>

                            <div class="col-12 p-1">
                                <label class="form-label">Supplier</label>
                                <select type="text" class="form-control form-select" id="supplierUpdateID">
                                    <option value="">Select Supplier</option>

                                </select>
                            </div>

                            <div class="col-12 p-1">
                                <label class="form-label">Quantity</label>
                                <input type="text" class="calcutate form-control" id="updateQuantity">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Unit</label>
                                <select type="text" class="form-control form-select" id="unitUpdateID">
                                    <option value="">Select Unit</option>

                                </select>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Unit Price</label>
                                <input type="text" class="calcutate form-control" id="updateUnitPrice">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Total</label>
                                <input type="text" class="form-control" id="updateTotal" readonly>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Purpose</label>
                                <textarea rows="3" cols="5" class="form-control" id="updatePurpose">
                                </textarea>
                            </div>
                            <input type="text" class="d-none form-control" id="ProRecUpdateID">
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

$('.calcutate').on('input', function(){

let quantity   = document.getElementById('updateQuantity').value;
let unitPrice  = document.getElementById('updateUnitPrice').value;
document.getElementById('updateTotal').value = quantity*unitPrice


});


ProductReceiveStoreUpdateDropDownList();

    async function ProductReceiveStoreUpdateDropDownList(){

        let res = await axios.get("/store-list", HeaderToken());
        res.data.forEach(function(item, index){
            
            let option = `<option value="${item['id']}">${item['name']}</option>`

            $("#proReceiveUpdateStoreID").append(option);
        })
       

    }
ProductReceiveStoreCategoryUpdateDropDownList();

async function ProductReceiveStoreCategoryUpdateDropDownList(){

let res = await axios.get("/store-category-list", HeaderToken());
res.data.forEach(function(item, index){
    
    let option = `<option value="${item['id']}">${item['category_name']}</option>`

    $("#proReceiveUpdateStoreCatID").append(option);
})


}   

ProductUpdateDropDownList();

    async function ProductUpdateDropDownList(){

        let res = await axios.get("/pro-setup-list", HeaderToken());
        res.data.forEach(function(item, index){
            
            let option = `<option value="${item['id']}">${item['product_name']}</option>`

            $("#proRecUpdateID").append(option);
        })
       
    
    }

ProductReceiveUpdateSupplierDropDownList();

async function ProductReceiveUpdateSupplierDropDownList(){

    let res = await axios.get("/supplier-list", HeaderToken());
    res.data.forEach(function(item, index){
        
        let option = `<option value="${item['id']}">${item['name']}</option>`
        $("#supplierUpdateID").append(option);
    })
   

}        

ProducReceivetUnitUpdateDropDownList();

async function ProducReceivetUnitUpdateDropDownList(){

    let res = await axios.get("/unit-list", HeaderToken());
    res.data.forEach(function(item, index){
        
        let option = `<option value="${item['id']}">${item['unit_name']}</option>`

        $("#unitUpdateID").append(option);
    })
   

}

async function FillUpProductReceiveUpdateForm(id){

    //document.getElementById('proID').value=id;

    showLoader();
    let res = await axios.post("/pro-receive-by-id",{id:id},HeaderToken());
    hideLoader();

    //alert(res.data['store_id']);

     document.getElementById('ProRecUpdateID').value = res.data['id'];
     document.getElementById('proReceiveUpdateStoreID').value = res.data['store_id'];
     document.getElementById('proReceiveUpdateStoreCatID').value = res.data['store_category_id'];
     document.getElementById('proRecUpdateID').value = res.data['product_id'];
     document.getElementById('updateDescription').value = res.data['description'];
     document.getElementById('supplierUpdateID').value = res.data['supplier_id'];
     document.getElementById('updateQuantity').value = res.data['quantity'];
     document.getElementById('unitUpdateID').value = res.data['unit_id'];
     document.getElementById('updateUnitPrice').value = res.data['unit_price'];
     document.getElementById('updateTotal').value = res.data['total'];
     document.getElementById('updatePurpose').value = res.data['purpose'];

}

async function Update(){

    let id = document.getElementById('ProRecUpdateID').value;
    let proReceiveUpdateStoreID = document.getElementById('proReceiveUpdateStoreID').value;
    let proReceiveUpdateStoreCatID = document.getElementById('proReceiveUpdateStoreCatID').value;
    let proRecUpdateID = document.getElementById('proRecUpdateID').value;
    let updateDescription = document.getElementById('updateDescription').value;
    let supplierUpdateID = document.getElementById('supplierUpdateID').value;
    let updateQuantity = document.getElementById('updateQuantity').value;
    let unitUpdateID  = document.getElementById('unitUpdateID').value;
    let updateUnitPrice = document.getElementById('updateUnitPrice').value;
    let updateTotal = document.getElementById('updateTotal').value;
    let updatePurpose = document.getElementById('updatePurpose').value;

        $('#update-modal-close').click();

        showLoader();
        let updatePostBody = {
            id:id,
            store_id:proReceiveUpdateStoreID,
            store_category_id:proReceiveUpdateStoreCatID,
            product_id:proRecUpdateID,
            description:updateDescription,
            supplier_id:supplierUpdateID,
            quantity:updateQuantity,
            unit_id:unitUpdateID,
            unit_price:updateUnitPrice,
            total:updateTotal,
            purpose:updatePurpose
        }

        let res = await axios.post('/pro-receive-update',updatePostBody,HeaderToken());

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
