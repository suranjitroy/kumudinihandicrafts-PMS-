<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h4>Unit</h4>
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
                    <th>Unit Name</th>
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
        let res = await axios.get("/unit-list", HeaderToken());
        hideLoader();

       let tableData =  $('#tableData');
       let tableList = $('#tableList');

       tableData.DataTable().destroy();
       tableList.empty();


        res.data.forEach(function(item, index){
            let row = `<tr>
                    <td>${index+1}</td>
                    <td>${item['unit_name']}</td>
                    <td>
                        <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                        <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                    </td>
                    </tr>`;
            tableList.append(row);
        });

        $('.editBtn').on('click', async function(){
            let id = $(this).data('id');
            await FillUpUnitUpdateForm(id);
            $('#update-modal').modal('show');
            
            
        });

        $('.deleteBtn').on('click', function(){ 
            let id = $(this).data('id');
            $('#delete-modal').modal('show');
            $('#deleteID').val(id);
            console.log(id);
            
        });

        tableData.DataTable({
            responsive: true,
            lengthMenu:[5,10,15,20,25,30],
            order:[[0, 'desc']]
        });
        
    }


</script>

