<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h4>Product Setup</h4>
                </div>
                <div class="align-items-center col">
                    <button data-bs-toggle="modal" data-bs-target="#create-modal" class="createBtn float-end btn m-0 bg-gradient-primary">Create</button>
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
                    <th>Product Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="tableList">
                    {{-- <tr>
                     @foreach($products as $product)
                    <td>{{$product->id}}</td>
                    <td>{{$product->store->name}}</td>
                    <td>{{$product->storeCategory->category_name}}</td>
                    <td>{{$product->name}}</td>
                    <td>
                        <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                        <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                    </td>
                </tr>
                    @endforeach --}}
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
        let res = await axios.get("/pro-setup-list", HeaderToken());
        hideLoader();

       let tableData = $('#tableData');
       let tableList = $('#tableList');

       tableData.DataTable().destroy();
       tableList.empty();


        res.data.forEach(function(item, index){
            let row = `<tr>
                    <td>${index+1}</td>
                    <td>${item['store']['name']}</td>
                    <td>${item['store_category']['category_name']}</td>
                    <td>${item['product_name']}</td>
                    <td>
                        <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                        <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                    </td>
                    </tr>`;
            tableList.append(row);
        });

        // $('.createBtn').on('click', async function(){
        //     jQuery('.select2-container').show();
        //     $('#create-modal').modal('show');
            
            
        // });

        $('.editBtn').on('click', async function(){
            let id = $(this).data('id');
            await FillUpProductSetupUpdateForm(id);
            $('#update-modal').modal('show');
            console.log(id);
            
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

