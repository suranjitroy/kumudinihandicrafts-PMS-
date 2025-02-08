<style>
    .btn-outline-dark {
    border: 1px solid #344767; !important
}
</style>
<div class="modal animated zoomIn" id="edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-fullscreen modal-dialog-centered">
            <div class="container-fluid">
                <div id="save-formm">
                <div class="modal-content">
                    <div class="modal-body p-3" style="max-height: 700px; overflow-y: auto;">
                    <div class="row">
                        <div class="col-md-4 col-lg-4 p-2">
                            <div class="shadow-sm h-100 bg-white rounded-3 p-3">

                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="text-bold mx-0 my-3 text-dark text-center "><u>Purchase Requsition</u></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class=" text-dark text-bold text-xs">Requsition No:
                                            <span id="PURNoUp">  </span> </span> <br/>
                                        <span class=" text-dark text-bold text-xs">Request From : <span id="SNameUp"> </span> <br/>
                                        {{-- <span class=" text-dark text-bold text-xs">Request From : <span id="SNameUpView"> </span> <br/> --}}
                                        {{-- <input class="text" id="SIdUp">
                                        <input class="text" id="IdUp"> --}}
                                        <span type="text" id="SIdUp" class="d-none"></span>
                                        <span type="text" id="IdUp" class="d-none"></span>
                                        {{-- <br/><span class=" text-dark text-bold text-xs"> User ID <span type="text" id="UserId"> {{ $user }}</span></span> </span> --}}

                                    </div>

                                    <div class="col-md-6">
                                        <input type="text" id="PURDateUp" name="req_date"
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
                                                <td>Unit Price</td>
                                                <td>Total</td>
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
                                    <p class="text-bold text-xs my-1 text-dark"> TOTAL: <span id="GTotalUpCre"></span></p>
                                    <p>
                                        <button type="submit" onclick="updateInvoicePur()" class="btn  my-3 bg-gradient-primary w-40">Update</button>
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
                                        <p class="text-bold">All Ready Selected Data</p>
                                        <p>Requsition Date:  <span id="STRDateUpView"> </span></p>
                                    <tr class="text-xs text-bold">
                                        <td>Name</td>
                                        <td>Qty</td>
                                        <td>Unit Price</td>
                                        <td>Total</td>
                                        <td>Pick</td>
                                    </tr>
                                    </thead>
                                    <tbody  class="w-100" id="invoiceListUp">

                                    </tbody>
                                </table>
                                <div class="col-12">
                                    <p class="text-bold text-xs my-1 text-dark"> TOTAL:
                                        <span id="GTotalUp"></span></p>
                                </div>
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
                                            <td>Last Unit Price</td>
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
                </div>
        </div>
    </div>


</div>

<div class="modal animated zoomIn" id="edit-modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Add Productt</h6>
            </div>
            <div class="modal-body">
                <form id="add-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                {{-- <label class="form-label">Product ID *</label> --}}
                                <input type="hidden" class="form-control" id="PIdUp">
                                <label class="form-label mt-2">Product Name *</label>
                                <input type="text" class="form-control" id="PNameUp" readonly>
                                <input type="hidden" class="form-control" id="UIdUp">
                                <label class="form-label mt-2">Unit *</label>
                                <input type="text" class="form-control" id="PUnitUp" readonly>
                                <label class="form-label mt-2">Last Unit Price</label>
                                <input type="text" class="form-control" id="PUnitPriceUp">
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
let res=await axios.post("/purchase-req-details-up",{section_id:secUp, purchase_requsition_id:idUp,purchase_req_no:reqnoUp},HeaderToken())
hideLoader();

document.getElementById('IdUp').innerText = res.data['purReq']['id'];
document.getElementById('SIdUp').innerText = res.data['purReq']['section_id'];
// document.getElementById('STRDateUp').value = res.data['purReq']['req_date'];
document.getElementById('STRDateUpView').innerText = res.data['purReq']['req_date'];
document.getElementById('PURNoUp').innerText = res.data['purReq']['purchase_req_no'];
document.getElementById('SNameUp').innerText = res.data['purReq']['section']['name'];
document.getElementById('GTotalUp').innerText = res.data['purReq']['grand_total'];
//document.getElementById('PUnitPriceUp').innerText = res.data['purReq']['unit_price'];

//document.getElementById('SNameUpView').innerText = res.data['storeReq']['section']['name'];
// document.getElementById('URID').innerText = res.data['storeReq']['user_id'];


let invoiceListUp=$('#invoiceListUp');

invoiceListUp.empty();

res.data['purReqDetail'].forEach(function (item,index) {
    let row=`<tr class="text-xs">
                <td>${item['product']['product_name']}</td>
                <td>${item['quantity']} ${item['unit']['unit_name']}</td>
                <td>${item['unit_price']}</td>
                <td>${item['total']}</td>
                <td><a data-nameup="${item['product']['product_name']}" data-unitup="${item['unit']['unit_name']}" data-idup="${item['product_id']}" data-unitidup="${item['unit_id']}" data-unitpriceup="${item['unit_price']}" class="btn btn-outline-dark text-xxs px-2 py-1
                addProductEdit btn-sm m-0">Add</a></td>

                <!--<td><a data-index="${index}" class="btn removeBtn text-xxs px-2 py-1  btn-sm m-0">Remove</a>-->
                </td>
             </tr>`
    invoiceListUp.append(row)
})

        //();

        $('.remove').on('click', async function () {
            let index= $(this).data('   ');
            removeItem(index);
        })

$('.addProductEdit').on('click', async function () {
                let idUp= $(this).data('idup');
                let nameUp= $(this).data('nameup');
                let unitIdUp= $(this).data('unitidup');
                let unitUp= $(this).data('unitup');
                let unitPriceUp= $(this).data('unitpriceup');
                addModalE(idUp,nameUp,unitIdUp,unitUp,unitPriceUp)
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
                        <td>${item['unit_price']}</td>
                        <td>${item['total']}</td>
                        <td><a data-index="${index}" class="btn remove text-xxs px-2 py-1  btn-sm m-0">Remove</a></td>
                     </tr>`
            invoiceListEdit.append(row)
            })

            CalculateGrandTotalUp();

            $('.remove').on('click', async function () {
                let index= $(this).data('index');
                removeItem(index);
            })

        }


        function removeItem(index) {
            InvoiceItemListEdit.splice(index,1);
            ShowInvoiceItemE()
        }

        function CalculateGrandTotalUp(){

        let GTotalUpCre = 0;

        InvoiceItemListEdit.forEach(function (item,index) {
            GTotalUpCre = GTotalUpCre + parseFloat(item['total']);

        });

        document.getElementById('GTotalUpCre').innerText=GTotalUpCre.toFixed(2);

        }

        function addE() {
           let PIdUp= document.getElementById('PIdUp').value;
           let PNameUp= document.getElementById('PNameUp').value;
           let UIdUp= document.getElementById('UIdUp').value;
           let PUnitUp= document.getElementById('PUnitUp').value;
           let PUnitPriceUp= document.getElementById('PUnitPriceUp').value;
           let PQtyUp= document.getElementById('PQtyUp').value;
           let PTotalUp= (parseFloat(PUnitPriceUp)*parseFloat(PQtyUp)).toFixed(2);
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
           else if(PUnitPriceUp.length===0){
               errorToast("Product Last Price Required");
           }
           else if(PQtyUp.length===0){
               errorToast("Product Quantity Required");
           }else{
           let item={
            product_name:PNameUp,
            product_id:PIdUp,
            unit_price:PUnitPriceUp,
            unit_id:UIdUp,
            unit_name: PUnitUp,
            quantity:PQtyUp,
            total:PTotalUp,
        };

        InvoiceItemListEdit.push(item);
        console.log(InvoiceItemListEdit);
        $('#edit-modal-edit').modal('hide');
        ShowInvoiceItemE();
        }
        }




        function addModalE(idUp,nameUp,unitIdUp,unitUp,unitPriceUp) {
            document.getElementById('PIdUp').value=idUp
            document.getElementById('PNameUp').value=nameUp
            document.getElementById('UIdUp').value=unitIdUp
            document.getElementById('PUnitUp').value=unitUp
            document.getElementById('PUnitPriceUp').value=unitPriceUp
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
                        <td> ${item['unit_price']}</td>
                        <td><a data-nameup="${item['product_name']}" data-unitup="${item['unit_name']}" data-idup="${item['product_id']}" data-unitidup="${item['unit_id']}" data-unitpriceup="${item['unit_price']}" class="btn btn-outline-dark text-xxs px-2 py-1 addProductEdit btn-sm m-0">Add</a></td>
                     </tr>`
                ProductListEdit.append(row)
            })


            $('.addProductEdit').on('click', async function () {
                let idUp= $(this).data('idup');
                let nameUp= $(this).data('nameup');
                let unitIdUp= $(this).data('unitidup');
                let unitUp= $(this).data('unitup');
                let unitPriceUp= $(this).data('unitpriceup');

                addModalE(idUp,nameUp,unitIdUp,unitUp,unitPriceUp)
            })

            new DataTable('#productTableEdit',{
                order:[[0,'desc']],
                scrollCollapse: false,
                info: false,
                lengthChange: false
            });
        }



      async function updateInvoicePur() {

        let IdUp = document.getElementById('IdUp').innerText || null ;
        let PURDateUp=document.getElementById('PURDateUp').value || null;
        let PURNoUp=document.getElementById('PURNoUp').innerText || null;
        let SIdUp=document.getElementById('SIdUp').innerText || null;
        let GTotalUpCre=document.getElementById('GTotalUpCre').innerText || null;

            let Data={
                "id":IdUp,
                "req_date":PURDateUp,
                "purchase_req_no":PURNoUp,
                "section_id":SIdUp,
                "grand_total":GTotalUpCre,
                "products":InvoiceItemListEdit
            }


            if(SNameUp.length===0){
                errorToast("Customer Required !")
            }
            else if(InvoiceItemListEdit.length===0){
                errorToast("Product Required !")
            }
            else{

                showLoader();
                let res=await axios.post("/update-purchase-req",Data,HeaderToken())
                hideLoader();
                if(res.data === 1){
                    successToast("Purchase Requisition Updated");
                    setTimeout(() => location.reload(true), 800); // Refresh the page

                // setTimeout(() => {
                // successToast("Purchase Requsition Updated"); // Refresh the page
                // }, 400);
                // setTimeout(() => {
                //     location.reload(true);
                // }, 800);

                //$("#edit-modal").modal('hide');
                }
                else{
                    errorToast("Something Went Wrong")
                }


            }

}






</script>


