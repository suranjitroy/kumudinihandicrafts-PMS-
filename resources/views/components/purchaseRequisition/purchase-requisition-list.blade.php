<style>
    .active{
        color:#f5f6fa;
        background: #218c74;
        padding: 5px 8px;
        border-radius: 5px;
    }

    .pending{
        color:#f5f6fa;
        background: #b71540;
        padding: 5px 8px;
        border-radius: 5px;
    }
    .recomending{
        color:#f5f6fa;
        background: #f39c12;
        padding: 5px 8px;
        border-radius: 5px;
    }
    .n-recomending{
        color:#f5f6fa;
        background: #ff4757;
        padding: 5px 8px;
        border-radius: 5px;
    }
    .approved{
        color:#f5f6fa;
        background: #27ae60;
        padding: 5px 8px;
        border-radius: 5px;
    }
    .btn-outline-dark {
    border: 0px;
}
</style>
<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h4>Purchase Requisition List</h4>
                </div>
                <div class="align-items-center col">
                    {{-- <button data-bs-toggle="modal" data-bs-target="#create-modal" class=" createBtn float-end btn m-0 bg-gradient-primary">Create Requsition</button>
                    <a href=""><button data-bs-toggle="modal" data-bs-target="#create-modal" class="createBtn float-end btn m-0 bg-gradient-primary">Create Requsition</button></a> --}}
                </div>
            </div>
            <hr class="bg-secondary"/>
            <div class="table-responsive">
            <table class="table" id="tableData">
                <thead>
                <tr class="bg-light">
                    <th>No</th>
                    <th>Requisition Date</th>
                    <th>Requisition No</th>
                    <th>Request From</th>
                    <th>Total</th>
                    <th>Status</th>
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
        let res = await axios.get("/purchase-req-list", HeaderToken());
        hideLoader();

       let tableData = $('#tableData');
       let tableList = $('#tableList');

       tableData.DataTable().destroy();
       tableList.empty();



        res.data.forEach(function(item, index){
            let row = `<tr>
                    <td>${index+1}</td>
                    <td>${item['req_date']}</td>
                    <td>${item['purchase_req_no']}</td>
                    <td>${item['section']['name']}</td>
                    <td>${item['grand_total']}</td>

                    <td>
                       ${
                        (item['is_approve'] == 3) ? '<span class="n-recomending">Not Recommended</span>':
                        (item['is_approve'] == 2) ? '<span class="recomending">Recommended</span>':
                        (item['is_approve'] == 1) ? '<span class="pending">Pending</span>':
                        (item['is_approve'] == 0) ? '<span class="approved">Approve</span>':
                        ''
                        }

                    </td>

                    <td>
                        <button data-idup="${item['id']}" data-secup="${item['section_id']}" data-reqnoup="${item['purchase_req_no']}" data-userup="${item['user_id']}" class="btn text-sm viewBtnn" style="color"><i class="text-sm fa fa-pencil-alt"></i></button>
                        <button data-id="${item['id']}" data-sec="${item['section_id']}" data-reqno="${item['purchase_req_no']}" data-user="${item['user_id']}" class="btn text-sm viewBtn" style="color"><i class="fa text-sm fa-eye"></i></button>
                        <button data-id="${item['id']}" data-pureqno="${item['purchase_req_no']}" class="btn text-sm deleteBtn"><i class="fa text-sm fa-trash-alt"></i></button>
                    </td>
                    </tr>`;
            tableList.append(row);
        });

        // $('.createBtn').on('click', async function(){
        //     jQuery('.select2-container').show();
        //     $('#create-modal').modal('show');


        // });

        $('.viewBtnn').on('click', async function(){
            let idUp = $(this).data('idup');
            let secUp = $(this).data('secup');
            let reqnoUp = $(this).data('reqnoup');
            let userUp = $(this).data('userup');
            $('#edit-modal').modal('show');
            await RequsitionDetailsUp(idUp, secUp, reqnoUp, userUp);
        });

        $('.viewBtn').on('click', async function(){
            let id = $(this).data('id');
            let sec = $(this).data('sec');
            let reqno = $(this).data('reqno');
            let user = $(this).data('user');
            await RequsitionDetails(id, sec, reqno, user);
        });


        // $('.editBtn').on('click', async function(){
        //     let id = $(this).data('id');
        //     window.location.href = `{{ url('store-requsition-update') }}/${id}`;
        //     await RequsitionDetailsUpdate(id);
        //     // await StoreReqUpdateByID(id, sec, reqno);
        //     console.log(id);

        // });


        // $('.editBtn').on('click', async function(){
        //     let id = $(this).data('id');

        //     //window.location.href = `{{ url('store-requsition-update') }}/${id}`;
        //     await RequsitionDetailsUpdate(id);
        //     //await StoreReqUpdateByID(id, sec, reqno);
        //     console.log(id);

        // });

        $('.deleteBtn').on('click', function(){
            let id      = $(this).data('id');
            let pureqno = $(this).data('pureqno');
            $('#delete-modal').modal('show');
            $('#deleteID').val(id);
            $('#PURreqNo').val(pureqno);
            console.log(id);

        });

        tableData.DataTable({
            responsive: true,
            lengthMenu:[5,10,15,20,25,30],
            order:[[0, 'desc']]
        });

    }


</script>

