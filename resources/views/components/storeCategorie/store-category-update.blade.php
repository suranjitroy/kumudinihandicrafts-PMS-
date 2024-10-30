<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Store Category</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Store</label>
                                <select type="text" class="form-control form-select" id="updateStoreCatID">
                                    <option value="">Select Store</option>

                                </select>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Store Category Name</label>
                                <input type="text" class="form-control" id="categoryName">

                                <input class="d-none" id="storeCategoryID">
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

StoreUpdateDropDownList();

async function StoreUpdateDropDownList(){

    let res = await axios.get("/store-list", HeaderToken());
    res.data.forEach(function(item, index){
        
        let option = `<option value="${item['id']}">${item['name']}</option>`

        $("#updateStoreCatID").append(option);
    })
   

}    

async function FillUpStoreCategoryUpdateForm(id){

    //document.getElementById('storeCategoryID').value=id;

    showLoader();
    let res = await axios.post("/store-category-by-id",{id:id},HeaderToken());
    hideLoader();

    //alert(res.data['store_id']);

    document.getElementById('storeCategoryID').value = res.data['id'];
    document.getElementById('updateStoreCatID').value = res.data['store_id'];
    document.getElementById('categoryName').value = res.data['category_name'];

}

async function Update(){
        let id = document.getElementById('storeCategoryID').value;
        let updateStoreCatID = document.getElementById('updateStoreCatID').value;
        let categoryName = document.getElementById('categoryName').value;

        $('#update-modal-close').click();

        showLoader();
        let res = await axios.post('/store-category-update',{id:id, store_id:updateStoreCatID,category_name:categoryName},HeaderToken());

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
