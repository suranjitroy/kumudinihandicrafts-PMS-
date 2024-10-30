<style>
.active{
    color:#f5f6fa;
    background: #218c74;
    padding: 5px 8px; 
    border-radius: 5px;
}
.deactive{
    color:#f5f6fa; 
    background: #b71540; 
    padding: 5px 8px; 
    border-radius: 5px;
}
</style>
<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h4>Supplier List</h4>
                </div>
                <div class="align-items-center col">
                    <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0 bg-gradient-primary">Create</button>
                </div>
            </div>
            <hr class="bg-secondary"/>
            <div class="table-responsive">
            <table class="table" id="tableData">
                <thead>
                <tr class="bg-light">
                    <th>No</th>
                    <th>Supplier Name</th>
                    <th>Supplier Address</th>
                    <th>Supplier Mobile No</th>
                    <th>Supplier Email</th>
                    <th>Status</th>
                    <th>Action</th>
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
getList();
    async function getList() {

        showLoader();
        let res = await axios.get("/supplier-list", HeaderToken());
        hideLoader();

       let tableData =  $('#tableData');
       let tableList = $('#tableList');

       tableData.DataTable().destroy();
       tableList.empty();


        res.data.forEach(function(item, index){
            let row = `<tr>
                    <td>${index+1}</td>
                    <td>${item['name']}</td>
                    <td>${item['address']}</td>
                    <td>${item['mobile_no']}</td>
                    <td>${item['email']} </td>
                    <td>${item['status'] == 1 ? '<span class="active">Active</span>' : '<span class="deactive">Deactive</span>' } </td>
               
                   
                    <td>
                        <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                        <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                    </td>
                    </tr>`;
            tableList.append(row);
        });

        $('.editBtn').on('click', async function(){
            let id = $(this).data('id');
            await FillUpSupplierUpdateForm(id);
            $('#update-modal').modal('show');
            
            
        });

        $('.deleteBtn').on('click', function(){ 
            let id = $(this).data('id');
            $('#delete-modal').modal('show');
            $('#deleteID').val(id);
            //console.log(id);
            
        });

        tableData.DataTable({
            responsive: true,
            lengthMenu:[5,10,15,20,25,30],
            order:[[0, 'desc']]
        });
        
    }


</script>

