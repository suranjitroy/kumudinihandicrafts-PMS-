<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">

                <label class="form-label">Store Category</label>
                <select class="form-control form-select" id="storeCatWiseRepID">
                    <option value="">Select Store</option>

                </select>
                <div class="align-items-center col">
            <button onclick="StoreCatWiseStockReport()" class="btn mt-3 bg-gradient-primary ">Show Report</button>
            </div>

            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h4>Store Category Wise Product Stock</h4>
                </div>
                <div class="align-items-center col">
                    <button onclick="DownloadReport()" class="float-end btn mt-3 bg-gradient-primary">Download</button>
                </div>
            </div>
           
            <hr class="bg-secondary"/>
            <div class="table-responsive">
            <table class="table" id="tableData">
                <thead>
                <tr class="bg-light">
                    <th>No</th>
                    <th>Store</th>
                    <th>Store Category</th>
                    <th>Product</th>
                    <th>Receive Quantity</th>
                    <th>Out Quantity</th>
                    <th>Current Stock</th>
                </tr>
                </thead>
                <tbody id="tableList">
                    
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
</div>

<script>

StoreCatWiseDropDownList();

    async function StoreCatWiseDropDownList(){

        let res = await axios.get("/store-category-list", HeaderToken());
        res.data.forEach(function(item, index){
            
            let option = `<option value="${item['id']}">${item['category_name']}</option>`

            $("#storeCatWiseRepID").append(option);
        })
       

    }

    async function StoreCatWiseStockReport() {

//let id = document.getElementById('storeWiseRepID').value;
let storeCatWiseRepID = document.getElementById('storeCatWiseRepID').value;

    showLoader();
    let res = await axios.post('/stock-by-category-list',{store_category_id: storeCatWiseRepID},HeaderToken());
    hideLoader();

if(res.status == 200){
    
let tableData = $('#tableData');
let tableList = $('#tableList');

tableData.DataTable().destroy();
tableList.empty();


//alert(res.data['products']);

res.data.forEach(function(item, index){
    let row = `<tr>
            <td>${index+1}</td>
            <td>${item['name']}</td>
            <td>${item['category_name']}</td>
            <td>${item['product_name']}</td>
            <td>${item['total_received']} ${item['unit_name']} </td>
            <td>${item['total_distributed']} ${item['unit_name']}</td>
            <td>${item['current_stock']} ${item['unit_name']}</td>
            </tr>`;
    tableList.append(row);
});

tableData.DataTable({
    responsive: true,
    lengthMenu:[5,10,15,20,25,30],
    order:[[0, 'desc']]
});

}else{
errorToast(res.data['message']);   
}


}    

async function DownloadReport(){

    let storeCatWiseRepIDDown = document.getElementById('storeCatWiseRepID').value;
            showLoader();
            let response = await axios.post("/stock-by-category-list-download", {store_category_id: storeCatWiseRepIDDown} , HeaderTokenWithBlob());
            hideLoader();
            const url = window.URL.createObjectURL(new Blob([response.data]));
            //debugger;
            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', 'Store-Category-Wise-Stock-Report.pdf'); // or another filename
            document.body.appendChild(link);
            link.click();
            link.remove();

    }

// getList();
//     async function getList() {

//         showLoader();
//         let res = await axios.get("/stock-by-category-list", HeaderToken());
//         hideLoader();

//        let tableData = $('#tableData');
//        let tableList = $('#tableList');

//        tableData.DataTable().destroy();
//        tableList.empty();


//        //alert(res.data['products']);

//         res.data.forEach(function(item, index){
//             let row = `<tr>
//                     <td>${index+1}</td>
//                     <td>${item['name']}</td>
//                     <td>${item['category_name']}</td>
//                     <td>${item['product_name']}</td>
//                     <td>${item['total_received']} ${item['unit_name']} </td>
//                     <td>${item['total_distributed']} ${item['unit_name']}</td>
//                     <td>${item['current_stock']} ${item['unit_name']}</td>
//                     <!--<td>
//                         <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
//                         <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
//                     </td>-->
//                     </tr>`;
//             tableList.append(row);
//         });

//         // $('.createBtn').on('click', async function(){
//         //     jQuery('.select2-container').show();
//         //     $('#create-modal').modal('show');
            
            
//         // });

//         $('.editBtn').on('click', async function(){
//             let id = $(this).data('id');
//             await FillUpProductReceiveUpdateForm(id);
//             $('#update-modal').modal('show');
//             console.log(id);
            
//         });

//         $('.deleteBtn').on('click', function(){ 
//             let id = $(this).data('id');
//             $('#delete-modal').modal('show');
//             $('#deleteID').val(id);
//             console.log(id);
            
//         });

//         tableData.DataTable({
//             responsive: true,
//             lengthMenu:[5,10,15,20,25,30],
//             order:[[0, 'desc']]
//         });

     
        
//     }
    

</script>

