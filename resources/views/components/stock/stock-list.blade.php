<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h4>Product Stock</h4>
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
                   
                    {{-- <th>Action</th> --}}
                </tr>
                </thead>
                <tbody id="tableList">
            
                    {{-- @foreach ( $unions as $union )
                    <tr>
                    <td>{{$union->id}}</td>
                    <td>{{$union->store->name}}</td>
                    <td>{{$union->storeCategory->category_name}}</td>
                    <td>{{$union->product->product_name}}</td>
                    <td>{{$union->quantity}} {{ $union->unit->unit_name}}</td>
                    <td>{{$union->disQuantity}} {{ $union->unit->unit_name}} </td>
                   
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
        let res = await axios.get("/stock-list", HeaderToken());
        hideLoader();

       let tableData = $('#tableData');
       let tableList = $('#tableList');

       tableData.DataTable().destroy();
       tableList.empty();


       //alert(res.data['products']);

        res.data.forEach(function(item, index){

            let CurrentStock = item['current_stock'];
            let unit = item['unit_name'] ;

            function test(CurrentStock){

                if(CurrentStock <= 30){
                    return '<span class="text-danger text-bold">' + CurrentStock + '&nbsp' + unit +'</span>';
                }else{
                    return '<span class="">' + CurrentStock + '&nbsp' + unit +'</span>';
                }

            }
            //console.log(unit);

            let row = `<tr>
                    <td>${index+1}</td>
                    <td>${item['name']}</td>
                    <td>${item['category_name']}</td>
                    <td>${item['product_name']}</td>
                    <td>${item['total_received']} ${item['unit_name']} </td>


                   <td>${item['total_distributed']} ${item['unit_name']}</td>

                   <td> ${test(CurrentStock)}</td>


                        
                    <!-- <td>${item['current_stock']} ${item['unit_name']}</td> -->
                    
                    </tr>`;
            tableList.append(row);
        });

        // $('.createBtn').on('click', async function(){
        //     jQuery('.select2-container').show();
        //     $('#create-modal').modal('show');
            
            
        // });

        $('.editBtn').on('click', async function(){
            let id = $(this).data('id');
            await FillUpProductReceiveUpdateForm(id);
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

    async function DownloadReport(){



   showLoader();
   let response = await axios.get("/stock-list-down", HeaderTokenWithBlob());
   hideLoader();


   const url = window.URL.createObjectURL(new Blob([response.data]));

//    debugger;
   const link = document.createElement('a');
   link.href = url;
   link.setAttribute('download', 'Stock-Report.pdf'); // or another filename
   document.body.appendChild(link);
   link.click();
   link.remove();

}

</script>

