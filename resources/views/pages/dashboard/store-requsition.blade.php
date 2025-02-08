@extends('layout.sidenav-layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-lg-4 p-2">
                <div class="shadow-sm h-100 bg-white rounded-3 p-3">

                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-bold mx-0 my-3 text-dark text-center "><u>Store Requsition</u></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <span class=" text-dark text-bold text-xs">Requsition No:
                                <span id="STRNo">  {{ $id }} </span> </span> <br/>
                            <span class=" text-dark text-bold text-xs">Request From : <span id="SName"> </span> <br/>
                            <input type="hidden" id="SId" />
                            {{-- <br/><span class=" text-dark text-bold text-xs"> User ID <span type="text" id="UserId"> {{ $user }}</span></span> </span> --}}

                        </div>

                        <div class="col-md-6">
                            <input type="text" id="STRDate" name="req_date"
                            placeholder="Select Date" onfocus="(this.type='date')" >
                        </div>
                    </div>
                    <hr class="mx-0 my-2 p-0 bg-secondary"/>
                    <div class="row">
                        <div class="col-12">
                            <table class="table w-100" id="invoiceTable">
                                <thead class="w-100">
                                <tr class="text-xs">
                                    <td>Name</td>
                                    <td>Qty</td>
                                    <td>Remove</td>
                                </tr>
                                </thead>
                                <tbody  class="w-100" id="invoiceList">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="mx-0 my-2 p-0 bg-secondary"/>
                    <div class="row">
                       <div class="col-12">
                           <p>
                              <button onclick="createInvoice()" class="btn  my-3 bg-gradient-primary w-40">Confirm</button>
                           </p>
                       </div>
                        <div class="col-12 p-2">

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-5 col-lg-5 p-2">
                <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                    <table class="table  w-100" id="productTable">
                        <thead class="w-100">
                        <tr class="text-xs text-bold">
                            <td>Product</td>
                            <td>Stock</td>
                            <td>Before Date</td>
                            <td>Before Qty</td>
                            <td>Pick</td>
                        </tr>
                        </thead>
                        <tbody  class="w-100" id="productList">

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-3 col-lg-3 p-2">
                <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                    <table class="table table-sm w-100" id="sectionTable">
                        <thead class="w-100">
                        <tr class="text-xs text-bold">
                            <td>Section</td>
                            <td>Pick</td>
                        </tr>
                        </thead>
                        <tbody  class="w-100" id="sectionList">

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>




    <div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Add Product</h6>
                </div>
                <div class="modal-body">
                    <form id="add-form">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 p-1">
                                    {{-- <label class="form-label">Product ID *</label> --}}
                                    <input type="hidden" class="form-control" id="PId">
                                    <label class="form-label mt-2">Product Name *</label>
                                    <input type="text" class="form-control" id="PName" readonly>
                                    <input type="hidden" class="form-control" id="UId">
                                    <label class="form-label mt-2">Unit *</label>
                                    <input type="text" class="form-control" id="PUnit" readonly>
                                    <label class="form-label mt-2">Product Qty *</label>
                                    <input type="text" class="form-control" id="PQty">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- <div class="modal-footer">
                    <button id="modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="add()" id="save-btn" class="btn bg-gradient-success" >Add</button>
                </div> --}}
                <div class="modal-footer">
                    <button id="modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="add()" id="save-btn" class="btn bg-gradient-success" >Add</button>
                </div>
            </div>
        </div>
    </div>


    <script>


        (async ()=>{
          showLoader();
          await  SectionList();
          await ProductList();
          hideLoader();
        })()


        let InvoiceItemList=[];


        function ShowInvoiceItem() {

            let invoiceList=$('#invoiceList');

            invoiceList.empty();

            InvoiceItemList.forEach(function (item,index) {
                let row=`<tr class="text-xs">
                         <td>${item['product_name']}</td>
                        <td>${item['quantity']} ${item['unit_name']}</td>
                        <td><a data-index="${index}" class="btn removeBtn text-xxs px-2 py-1  btn-sm m-0">Remove</a></td>
                     </tr>`
                invoiceList.append(row)
            })

            document.querySelectorAll(".removeBtn").forEach(button => {
                button.addEventListener("click", function() {
                // Remove the parent <tr> element of the clicked button
                this.closest("tr").remove();
                });
            });

        }

        function add() {
           let PId= document.getElementById('PId').value;
           let PName= document.getElementById('PName').value;
           let UId= document.getElementById('UId').value;
           let PUnit= document.getElementById('PUnit').value;
           let PQty= document.getElementById('PQty').value;
           if(PId.length===0){
               errorToast("Product ID Required");
           }
           else if(PName.length===0){
               errorToast("Product Name Required");
           }
           else if(UId.length===0){
               errorToast("Unit ID Required");
           }
           else if(PUnit.length===0){
               errorToast("Product Price Required");
           }
           else if(PQty.length===0){
               errorToast("Product Quantity Required");
           } else{
               let item={
                product_name:PName,
                product_id:PId,
                unit_id:UId,
                unit_name: PUnit,
                quantity:PQty
            };
               InvoiceItemList.push(item);
               console.log(InvoiceItemList);
               $('#create-modal').modal('hide')
               ShowInvoiceItem();
           }
        }

        function addModal(id,name, unitId, unit) {
            document.getElementById('PId').value=id
            document.getElementById('PName').value=name
            document.getElementById('UId').value=unitId
            document.getElementById('PUnit').value=unit
            $('#create-modal').modal('show')
        }


        async function SectionList(){
            let res=await axios.get("/section-list",HeaderToken());
            let sectionList=$("#sectionList");
            let sectionTable=$("#sectionTable");
            sectionTable.DataTable().destroy();
            sectionList.empty();

            res.data.forEach(function (item,index) {
                let row=`<tr class="text-xs">
                        <td><i class="bi bi-person"></i> ${item['name']}</td>
                        <td><a data-name="${item['name']}" data-id="${item['id']}" class="btn btn-outline-dark addSection  text-xxs px-2 py-1  btn-sm m-0">Add</a></td>
                     </tr>`
                     sectionList.append(row)
            })


            $('.addSection').on('click', async function () {

                let SName= $(this).data('name');
                let SId= $(this).data('id');

                $("#SName").text(SName)
                $("#SId").text(SId)

            })

            new DataTable('#sectionTable',{
                order:[[0,'desc']],
                scrollCollapse: false,
                info: false,
                lengthChange: false
            });
        }


        async function ProductList(){
            let res=await axios.get("/stock-list", HeaderToken());
            let productList=$("#productList");
            let productTable=$("#productTable");
            productTable.DataTable().destroy();
            productList.empty();

            res.data.forEach(function (item,index) {
                let row=`<tr class="text-xs">
                        <td> ${item['product_name']}</td>
                        <td> ${item['current_stock']} ${item['unit_name']}</td>
                        <td> ${item['receive_date']}</td>
                        <td> ${item['quantity']} ${item['unit_name']}</td>
                        <td><a data-name="${item['product_name']}" data-unit="${item['unit_name']}" data-id="${item['product_id']}" data-unitid="${item['unit_id']}" class="btn btn-outline-dark text-xxs px-2 py-1 addProduct btn-sm m-0">Add</a></td>
                     </tr>`
                productList.append(row)
            })


            $('.addProduct').on('click', async function () {
                let id= $(this).data('id');
                let name= $(this).data('name');
                let unitId= $(this).data('unitid');
                let unit= $(this).data('unit');
                addModal(id,name,unitId,unit)
            })


            new DataTable('#productTable',{
                order:[[0,'desc']],
                scrollCollapse: false,
                info: false,
                lengthChange: false
            });
        }



      async function createInvoice()
      {
            let STRDate=document.getElementById('STRDate').value;
            let SName=document.getElementById('SName').innerText;
            let STRNo=document.getElementById('STRNo').innerText;
            let SId=document.getElementById('SId').innerText;

           // console.log('today');

            let Data={
                "req_date":STRDate,
                "store_req_no":STRNo,
                "section_id":SId,
                "products":InvoiceItemList
            }

            if(SName.length===0){
                errorToast("Section Required !")
            }
            else if(STRDate.length===0){
                errorToast("Date Field is Required !")
            }
            else if(InvoiceItemList.length===0){
                errorToast("Product Required !")
            }
            else{

                showLoader();
                let res=await axios.post("/create-store-req",Data,HeaderToken())
                hideLoader();
                if(res.status == 200 && res.data['status'] == "Success"){
                    window.location.href='/store-requsition-list';
                    successToast(res.data['message']);
                }
                else{
                    errorToast(res.data['message']);
                }
            }

        }

    </script>




@endsection
