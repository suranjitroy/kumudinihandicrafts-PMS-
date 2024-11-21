<div class="modal animated zoomIn" id="edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
        <div class="modal-dialog modal-fullscreen modal-dialog-centered">
            <div class="container-fluid">
                <form id="save-form">
                <div class="modal-content"> 
                    <div class="modal-body p-3" style="max-height: 700px; overflow-y: auto;">
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
                                            <span id="STRNoUp">  </span> </span> <br/>
                                        <span class=" text-dark text-bold text-xs">Request From : <span id="SNameUp"> </span> <br/>
                                        {{-- <span class=" text-dark text-bold text-xs">Request From : <span id="SNameUpView"> </span> <br/> --}}
                                        {{-- <input class="text" id="SIdUp">
                                        <input class="text" id="IdUp"> --}}
                                        <span type="text" id="SIdUp" class="d-none"></span>
                                        <span type="text" id="IdUp" class="d-none"></span>
                                        {{-- <br/><span class=" text-dark text-bold text-xs"> User ID <span type="text" id="UserId"> {{ $user }}</span></span> </span> --}}
                                        
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <input type="text" id="STRDateUp" name="req_date"
                                        placeholder="Select Date" onfocus="(this.type='date')">
                                    </div>
                                </div>
                                <hr class="mx-0 my-2 p-0 bg-secondary"/>
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table w-100" id="invoiceTableEdit">
                                            <thead class="w-100">
                                            <tr class="text-xs">
                                                <td>Name</td>
                                                <td>Qty</td>
                                                <td>Remove</td>
                                            </tr>
                                            </thead>
                                            <tbody  class="w-100" id="invoiceListEdit">
            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr class="mx-0 my-2 p-0 bg-secondary"/>
                                <div class="row">
                                <div class="col-12">
                                    <p>
                                        <button onclick="updateInvoice()" class="btn  my-3 bg-gradient-primary w-40">Update</button>
                                    </p>
                                </div>
                                    <div class="col-12 p-2">
            
                                    </div>
            
                                </div>
                            </div>
                        </div>
            
                        <div class="col-md-8 col-lg-3 p-2">
                            <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                                <table class="table table-sm w-100" id="">
                                    <thead class="w-100">
                                        <p>All Ready Selected Data</p>
                                    <tr class="text-xs text-bold">
                                        <td>Name</td>
                                        <td>Qty</td>
                                        <td>Pick</td>
                                    </tr>
                                    </thead>
                                    <tbody  class="w-100" id="invoiceListUp">
            
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-5 col-lg-5 p-2">
                            <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                                <table class="table  w-100" id="productTableEdit">
                                    <thead class="w-100">
                                    <tr class="text-xs text-bold">
                                        <td>Product</td>
                                        <td>Stock</td>
                                        <td>Before Date</td>
                                        <td>Before Qty</td>
                                        <td>Pick</td>
                                    </tr>
                                    </thead>
                                    <tbody  class="w-100" id="ProductListEdit">
            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                       
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-lg-3 p-2">
                            <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                                <table class="table table-sm w-100" id="sectionTableEdit">
                                    <thead class="w-100">
                                    <tr class="text-xs text-bold">
                                        <td>Section</td>
                                        <td>Pick</td>
                                    </tr>
                                    </thead>
                                    <tbody  class="w-100" id="SectionListEdit">
            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer"></div>
                </div>
                </form>
        </div>
    </div>


</div>

<div class="modal animated zoomIn" id="edit-modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Add Produ</h6>
            </div>
            <div class="modal-body">
                <form id="add-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Product ID *</label>
                                <input type="hidden" class="form-control" id="PIdUp">
                                <label class="form-label mt-2">Product Name *</label>
                                <input type="text" class="form-control" id="PNameUp" readonly>
                                <input type="hidden" class="form-control" id="UIdUp">
                                <label class="form-label mt-2">Unit *</label>
                                <input type="text" class="form-control" id="PUnitUp" readonly>
                                <label class="form-label mt-2">Product Qty *</label>
                                <input type="text" class="form-control" id="PQtyUp">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="addE()" id="save-btn" class="btn bg-gradient-success" >Add</button>
            </div>
        </div>
    </div>
</div>



<script> 




async function RequsitionDetailsUp(idUp,secUp,reqnoUp,userUp) {

showLoader()
let res=await axios.post("/store-req-details-up",{section_id:secUp, store_requsition_id:idUp,store_req_no:reqnoUp},HeaderToken())
hideLoader();

document.getElementById('IdUp').innerText = res.data['storeReq']['id'];
document.getElementById('SIdUp').innerText = res.data['storeReq']['section_id'];
document.getElementById('STRDateUp').value = res.data['storeReq']['req_date'];
document.getElementById('STRNoUp').innerText = res.data['storeReq']['store_req_no'];
document.getElementById('SNameUp').innerText = res.data['storeReq']['section']['name'];
//document.getElementById('SNameUpView').innerText = res.data['storeReq']['section']['name'];
// document.getElementById('URID').innerText = res.data['storeReq']['user_id'];


let invoiceListUp=$('#invoiceListUp');

invoiceListUp.empty();

res.data['storeReqDetail'].forEach(function (item,index) {
    let row=`<tr class="text-xs">
                <td>${item['product']['product_name']}</td>
                <td>${item['quantity']} ${item['unit']['unit_name']}</td>
                <td><a data-nameup="${item['product']['product_name']}" data-unitup="${item['unit']['unit_name']}" data-idup="${item['product_id']}" data-unitidup="${item['unit_id']}" class="btn btn-outline-dark text-xxs px-2 py-1 addProductEdit btn-sm m-0">Add</a></td>
                <!--<td><a data-index="${index}" class="btn removeBtn text-xxs px-2 py-1  btn-sm m-0">Remove</a>
                </td>-->
             </tr>`
    invoiceListUp.append(row)
});

$('.addProductEdit').on('click', async function () {
                let idUp= $(this).data('idup');
                let nameUp= $(this).data('nameup');
                let unitIdUp= $(this).data('unitidup');
                let unitUp= $(this).data('unitup');
                addModalE(idUp,nameUp,unitIdUp,unitUp)
            })


$("#edit-modal").modal('show');

// document.addEventListener("DOMContentLoaded", function() {
//     // Select all remove buttons
//     const removeButtons = document.querySelectorAll(".removeBtn");

//     // Loop through each button and add a click event listener
//     removeButtons.forEach(button => {
//         button.addEventListener("click", function() {
//             // Remove the parent item div when the button is clicked
//             this.closest("tr").remove();
//         });
//     });
// });

document.querySelectorAll(".removeBtn").forEach(button => {
        button.addEventListener("click", function() {
            // Remove the parent <tr> element of the clicked button
            this.closest("tr").remove();
        });
    });


}


(async ()=>{
          showLoader();
          await  SectionListEdit();
          //await  existList();
          await ProductListEdit();
          hideLoader();
        })()


        let InvoiceItemListEdit=[];


        function ShowInvoiceItemE() {

            let invoiceListEdit=$('#invoiceListEdit');

            invoiceListEdit.empty();

            InvoiceItemListEdit.forEach(function (item,index) {
                let row=`<tr class="text-xs">
                        <td>${item['product_name']}</td>
                        <td>${item['quantity']} ${item['unit_name']}</td>
                        <td><a data-index="${index}" class="btn remove text-xxs px-2 py-1  btn-sm m-0">Remove</a></td>
                     </tr>`
            invoiceListEdit.append(row)
            })

            $('.remove').on('click', async function () {
                let index= $(this).data('index');
                removeItem(index);
            })

        }


        function removeItem(index) {
            InvoiceItemListEdit.splice(index,1);
            ShowInvoiceItemE()
        }

        function addE() {
           let PIdUp= document.getElementById('PIdUp').value;
           let PNameUp= document.getElementById('PNameUp').value;
           let UIdUp= document.getElementById('UIdUp').value;
           let PUnitUp= document.getElementById('PUnitUp').value;
           let PQtyUp= document.getElementById('PQtyUp').value;
           if(PIdUp.length===0){
               errorToast("Product ID Required");
           }
           else if(PNameUp.length===0){
               errorToast("Product Name Required");
           }
           else if(UIdUp.length===0){
               errorToast("Unit ID Required");
           }
           else if(PUnitUp.length===0){
               errorToast("Product Price Required");
           }
           else if(PQtyUp.length===0){
               errorToast("Product Quantity Required");
           }else{
               let item={
                product_name:PNameUp,
                product_id:PIdUp,
                unit_id:UIdUp,
                unit_name: PUnitUp,
                quantity:PQtyUp
                };

                InvoiceItemListEdit.push(item);
               console.log(InvoiceItemListEdit);
               $('#edit-modal-edit').modal('hide');
               ShowInvoiceItemE();

            //     let existingItemIndex = InvoiceItemListEdit.findIndex(i => i.product_id === PIdUp);

            //     if (existingItemIndex >= 0) {
            //         // Update quantity if item exists
            //         InvoiceItemListEdit[existingItemIndex].quantity = parseFloat(InvoiceItemListEdit[existingItemIndex].quantity) + parseFloat(PQtyUp);
            //     } else{
            //         InvoiceItemListEdit.push(item);
            //    console.log(InvoiceItemListEdit);
            //    $('#create-modal').modal('hide')
            //   ShowInvoiceItemE();
            //     }


             
           }
        }




        function addModalE(idUp,nameUp,unitIdUp,unitUp) {
            document.getElementById('PIdUp').value=idUp
            document.getElementById('PNameUp').value=nameUp
            document.getElementById('UIdUp').value=unitIdUp
            document.getElementById('PUnitUp').value=unitUp
            $('#edit-modal-edit').modal('show')
        }

        async function SectionListEdit(){
            let res=await axios.get("/section-list",HeaderToken());
            let SectionListEdit=$("#SectionListEdit");
            let sectionTableEdit=$("#sectionTableEdit");
            sectionTableEdit.DataTable().destroy();
            SectionListEdit.empty();

            res.data.forEach(function (item,index) {
                let row=`<tr class="text-xs">
                        <td><i class="bi bi-person"></i> ${item['name']}</td>
                        <td><a data-name="${item['name']}" data-id="${item['id']}" class="btn btn-outline-dark addSection  text-xxs px-2 py-1  btn-sm m-0">Add</a></td>
                     </tr>`
                     SectionListEdit.append(row)
            })


            $('.addSection').on('click', async function () {

                let SNameUp= $(this).data('name');
                let SIdUp= $(this).data('id');

                $("#SNameUp").text(SNameUp)
                $("#SIdUp").text(SIdUp)

            })

            new DataTable('#sectionTableEdit',{
                order:[[0,'desc']],
                scrollCollapse: false,
                info: false,
                lengthChange: false
            });
        }

        // async function existList(){
        //     let res=await axios.post("/store-req-details-up",HeaderToken());
        //     let existList=$("#existList");
        //     let existTable=$("#existTable");
        //     existTable.DataTable().destroy();
        //     existList.empty();

        //     res.data['storeReqDetail'].forEach(function (item,index) {
        //     let row=`<tr class="text-xs">
        //                 <td>${item['product']['product_name']}</td>
        //                 <td>${item['quantity']} ${item['unit']['unit_name']}</td>
        //                 <td><a data-index="${index}" class="btn removeBtn text-xxs px-2 py-1  btn-sm m-0">Remove</a>
        //                 </td>
        //             </tr>`
        //             existList.append(row)
        // });

        //     res.data.forEach(function (item,index) {
        //         let row=`<tr class="text-xs">
        //                 <td><i class="bi bi-person"></i> ${item['name']}</td>
        //                 <td><a data-name="${item['name']}" data-id="${item['id']}" class="btn btn-outline-dark addSection  text-xxs px-2 py-1  btn-sm m-0">Add</a></td>
        //              </tr>`
        //              existList.append(row)
        //     })


        //     $('.addSection').on('click', async function () {

        //         let SNameUp= $(this).data('name');
        //         let SIdUp= $(this).data('id');

        //         $("#SNameUp").text(SNameUp)
        //         $("#SIdUp").text(SIdUp)

        //     })

        //     new DataTable('#existTable',{
        //         order:[[0,'desc']],
        //         scrollCollapse: false,
        //         info: false,
        //         lengthChange: false
        //     });
        // }


        async function ProductListEdit(){
            let res=await axios.get("/stock-list", HeaderToken());
            let ProductListEdit=$("#ProductListEdit");
            let productTableEdit=$("#productTableEdit");
            productTableEdit.DataTable().destroy();
            ProductListEdit.empty();

            res.data.forEach(function (item,index) {
                let row=`<tr class="text-xs">
                        <td> ${item['product_name']}</td>
                        <td> ${item['current_stock']} ${item['unit_name']}</td>
                        <td> ${item['receive_date']}</td>
                        <td> ${item['quantity']} ${item['unit_name']}</td>
                        <td><a data-nameup="${item['product_name']}" data-unitup="${item['unit_name']}" data-idup="${item['product_id']}" data-unitidup="${item['unit_id']}" class="btn btn-outline-dark text-xxs px-2 py-1 addProductEdit btn-sm m-0">Add</a></td>
                     </tr>`
                ProductListEdit.append(row)
            })


            $('.addProductEdit').on('click', async function () {
                let idUp= $(this).data('idup');
                let nameUp= $(this).data('nameup');
                let unitIdUp= $(this).data('unitidup');
                let unitUp= $(this).data('unitup');
                addModalE(idUp,nameUp,unitIdUp,unitUp)
            })


            new DataTable('#productTableEdit',{
                order:[[0,'desc']],
                scrollCollapse: false,
                info: false,
                lengthChange: false
            });
        }



      async function updateInvoice() {
            let IdUp = document.getElementById('IdUp').innerText;
            let STRDateUp=document.getElementById('STRDateUp').value;
            let STRNoUp=document.getElementById('STRNoUp').innerText;
            let SIdUp=document.getElementById('SIdUp').innerText;
           
           // console.log('today');

            let Data={
                "id":IdUp,
                "req_date":STRDateUp,
                "store_req_no":STRNoUp,
                "section_id":SIdUp,
                "products":InvoiceItemListEdit
            }


            if(SName.length===0){
                errorToast("Customer Required !")
            }
            else if(InvoiceItemListEdit.length===0){
                errorToast("Product Required !")
            }
            else{

                showLoader();
                let res=await axios.post("/update-store-req",Data,HeaderToken())
                hideLoader();
                if(res.data===1){
                    window.location.href='/store-requsition-list'
                    successToast("Requsition Updated");
                }
                else{
                    errorToast("Something Went Wrong")
                }
            }

}






</script>


