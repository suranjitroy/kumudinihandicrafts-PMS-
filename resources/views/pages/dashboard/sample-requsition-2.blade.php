@extends('layout.sidenav-layout')
@section('content')
<div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-lg-10 p-2">
                <div class="shadow-sm h-100 bg-white rounded-3 p-3">

                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-bold mx-0 my-3 text-dark text-center "><u>Sample Requsitionn</u></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <span class=" text-dark text-bold text-xs">Sample Requsition No:
                                <span id="PURNo">  </span> </span> <br/>
                            <span class=" text-dark text-bold text-xs">Order To : <span id="SName"> </span> <br/>
                            {{-- <span class=" text-dark text-bold text-xs">Request From : <span id="SNameUpView"> </span> <br/> --}}
                            <input type="hidden" id="SId" />
                            {{-- <br/><span class=" text-dark text-bold text-xs"> User ID <span type="text" id="UserId"> {{ $user }}</span></span> </span> --}}

                        </div>

                        <div class="col-md-6">

                            <input type="text" id="PURDate" name="req_date"
                            placeholder="Select Date" onfocus="(this.type='date')">
                        </div>
                    </div>
                    <hr class="mx-0 my-2 p-0 bg-secondary"/>
                    <div class="row">
                        <div class="col-12">
                            <table class="table w-100" id="invoiceTable">
                                <thead class="w-100">
                                <tr class="text-xs">
                                    <td>Material Name</td>
                                    <td>Size</td>
                                    <td>Yard</td>
                                    <td>Meter/Pound</td>
                                    <td>Item/Pcs</td>
                                    <td>Size Label Pcs</td>
                                    <td>Other Pcs</td>
                                    <td>Thread Qty</td>
                                    <td>Total Yard</td>
                                    <td>Total Thread</td>
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

                        <p class="text-bold text-xs my-1 text-dark"> Grand Total Yard: <span id="GTotal"></span></p>
                        <p class="text-bold text-xs my-1 text-dark"> Total Item/Pcs: <span id="GTotal"></span></p>
                        <p class="text-bold text-xs my-1 text-dark"> Total Size Label Pcs: <span id="GTotal"></span></p>
                        <p class="text-bold text-xs my-1 text-dark"> Total: <span id="GTotal"></span></p>
{{--                        <p>--}}
{{--                            <button onclick="createInvoice()" class="btn  my-3 bg-gradient-primary w-40">Confirm</button>--}}
{{--                        </p>--}}
                    </div>

                        <div class="col-12">

                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Purpose</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                                <button onclick="createInvoice()" class="btn  my-3 bg-gradient-primary w-40">Confirm</button>
                            </p>
                        </div>

                        <div class="col-12 p-2">

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-5 col-lg-6 p-2">
                <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                    <table class="table  w-100" id="productTable">
                        <thead class="w-100">
                        <tr class="text-xs text-bold">
                            <td>Material Name</td>
                            <td>Size</td>
                            <td>Bahar</td>
                            <td>Yard</td>
                            <td>Inch</td>
                            <td>Meter/Pound</td>
                            <td>Pick</td>
                        </tr>
                        </thead>
                        <tbody  class="w-100" id="productList">

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-8 col-lg-3 p-2">
                <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                    <table class="table table-sm w-100" id="sectionTable">
                        <thead class="w-100">
                        <tr class="text-xs text-bold">
                            <td>Master</td>
                            <td>Pick</td>
                        </tr>
                        </thead>
                        <tbody  class="w-100" id="sectionList">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer"></div>
</div>

<div class="modal animated zoomIn" id="create-modal-pro" tabindex="-1" aria-labelledby="exampleModalLabelC" aria-hidden="true">
<div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabelC">Add Item</h6>
        </div>
        <div class="modal-body">
            <form id="add-form">
                <div class="container">
                    <div class="row">
                        <div class="col-12 p-1">
                             <label class="form-label">Material ID *</label>
                            <input type="text" class="form-control" id="MId">
                            <label class="form-label mt-2">Material Name</label>
                            <input type="text" class="form-control" id="MName" readonly>
                            <label class="form-label mt-2">Size</label>
                            <input type="text" class="form-control" id="Size" readonly>
                            <label class="form-label mt-2">Bahar</label>
                            <input type="text" class="form-control" id="Bahar" readonly>
                            <label class="form-label mt-2">Yard</label>
                            <input type="text" class="form-control" id="Yard" readonly>
                            <label class="form-label mt-2">Inch</label>
                            <input type="text" class="form-control" id="Inch" readonly>
                            <label class="form-label mt-2">Meter/Pound</label>
                            <input type="text" class="form-control" id="MeterPound" readonly>
                            <label class="form-label mt-2">Item / Pcs</label>
                            <input type="text" class="form-control" id="FQty">
                            <label class="form-label mt-2">Size Label Pcs</label>
                            <input type="text" class="form-control" id="SQty">
                            <label class="form-label mt-2">Other Pcs</label>
                            <input type="text" class="form-control" id="Qty">
                            <label class="form-label mt-2">Thread Qty</label>
                            <input type="text" class="form-control" id="TQty">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button id="modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
            <button onclick="addC()" id="save-btn" class="btn bg-gradient-success" >Add</button>
        </div>
    </div>
</div>
</div>



<script>


(async ()=>{
  showLoader();
  await SectionList();
  await ProductList();
  hideLoader();
})()


let InvoiceItemListCre=[];

function ShowInvoiceItemC() {

    let invoiceList=$('#invoiceList');

    invoiceList.empty();

    InvoiceItemListCre.forEach(function (item,index) {
        let row=`<tr class="text-xs">
                <td> ${item['material_name']}</td>
                <td> ${item['size']}</td>
                <td> ${item['yard']}</td>
                <td> ${item['meter_pound']}</td>
                <td> ${item['fqty']}</td>
                <td> ${item['sqty']}</td>
                <td>${item['qty']}</td>
                <td>${item['tqty']}</td>
                <td>${item['total']}</td>
                <td>${item['total_t']}</td>

                <td><a data-index="${index}" class="btn remove text-xxs px-2 py-1  btn-sm m-0">Remove</a></td>
             </tr>`
        invoiceList.append(row)
    })

    CalculateGrandTotal();

    $('.remove').on('click', async function () {
        let index= $(this).data('   ');
        removeItem(index);
    })

}

function removeItem(index) {
    InvoiceItemListCre.splice(index,1);
    ShowInvoiceItemC()
}

function CalculateGrandTotal(){

    let GTotal = 0;

    InvoiceItemListCre.forEach(function (item,index) {
        GTotal = GTotal + parseFloat(item['total']);

    });

    document.getElementById('GTotal').innerText=GTotal.toFixed(2);

}

function addC() {

    let MId = document.getElementById('MId').value
    let MName = document.getElementById('MName').value
    let Size = document.getElementById('Size').value
    let Bahar = document.getElementById('Bahar').value
    let Yard = document.getElementById('Yard').value
    let Inch = document.getElementById('Inch').value
    let MeterPound = document.getElementById('MeterPound').value
    let FQty= document.getElementById('FQty').value;
    let SQty= document.getElementById('SQty').value;
    let Qty= document.getElementById('Qty').value;
    let TQty= document.getElementById('TQty').value;
    let Total= (parseFloat(Yard)*parseFloat(FQty)).toFixed(2);
    let TotalThread= (parseFloat(MeterPound)*parseFloat(TQty)).toFixed(2);
   if(MId.length===0){
       errorToast("Product ID Required");
   }
   else if(MName.length===0){
       errorToast("Product Name Required");
   }
   else if(Size.length===0){
       errorToast("Unit ID Required");
   }
   else if(Bahar.length===0){
       errorToast("Product Price Required");
   }
   else if(Yard.length===0){
       errorToast("Product Price Required");
   }
   else if(Yard.length===0){
       errorToast("Product Price Required");
   }
   else if(Inch.length===0){
       errorToast("Product Quantity Required");
   }
   else if(FQty.length===0){
       errorToast("Product Quantity Required");
   }
   else if(SQty.length===0){
       errorToast("Product Quantity Required");
   }
   else if(Qty.length===0){
       errorToast("Product Quantity Required");
   }
   else if(TQty.length===0){
       errorToast("Thread Quantity Required");
   }
   else{
       let item={
        id:MId,
        material_name:MName,
        size:Size,
        bahar:Bahar,
        yard:Yard,
        inch:Inch,
        meter_pound:MeterPound,
        fqty:FQty,
        sqty:SQty,
        qty:Qty,
        tqty:TQty,
        total:Total,
        total_t:TotalThread,
    };
       InvoiceItemListCre.push(item);
       console.log(InvoiceItemListCre);
       $('#create-modal-pro').modal('hide');
       ShowInvoiceItemC();
   }
}

function addModalC(id,mname,size,bahar,yard,inch,meterpound) {
    document.getElementById('MId').value=id
    document.getElementById('MName').value=mname
    document.getElementById('Size').value=size
    document.getElementById('Bahar').value=bahar
    document.getElementById('Yard').value=yard
    document.getElementById('Inch').value=inch
    document.getElementById('MeterPound').value=meterpound
    $('#create-modal-pro').modal('show')
}

async function SectionList(){
    let res=await axios.get("/master-list",HeaderToken());
    let sectionList=$("#sectionList");
    let sectionTable=$("#sectionTable");
    sectionTable.DataTable().destroy();
    sectionList.empty();

    res.data.forEach(function (item,index) {
        let row=`<tr class="text-xs">
                <td><i class="bi bi-person"></i> ${item['master_name']}</td>
                <td><a data-name="${item['master_name']}" data-id="${item['id']}" class="btn btn-outline-dark addSection  text-xxs px-2 py-1  btn-sm m-0">Add</a></td>
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
    let res=await axios.get("/consumption-setting-alldata", HeaderToken());
    let productList=$("#productList");
    let productTable=$("#productTable");
    productTable.DataTable().destroy();
    productList.empty();

    res.data.forEach(function (item,index) {
        let row=`<tr class="text-xs">
                <td> ${item['material_name']}</td>
                <td> ${item['size']}</td>
                <td> ${item['bahar']}</td>
                <td> ${item['yard']}</td>
                <td> ${item['inch']}</td>
                <td> ${item['meter_pound']}</td>
                <td><a data-id="${item['id']}" data-mname="${item['material_name']}" data-size="${item['size']}"
                    data-bahar="${item['bahar']}" data-yard="${item['yard']}"
                    data-inch="${item['inch']}" data-meterpound="${item['meter_pound']}" class="btn btn-outline-dark text-xxs px-2 py-1 addProductCre btn-sm m-0">Add</a></td>
             </tr>`
        productList.append(row)
    })


    $('.addProductCre').on('click', async function () {
        let id= $(this).data('id');
        let mname= $(this).data('mname');
        let size= $(this).data('size');
        let bahar= $(this).data('bahar');
        let yard= $(this).data('yard');
        let inch= $(this).data('inch');
        let meterpound= $(this).data('meterpound');
        addModalC(id,mname,size,bahar,yard,inch,meterpound)
    })


    new DataTable('#productTable',{
        order:[[0,'desc']],
        scrollCollapse: false,
        info: false,
        lengthChange: false
    });
}

async function createInvoice() {
    let PURDate=document.getElementById('PURDate').value;
    let PURNo=document.getElementById('PURNo').innerText;
    let SId=document.getElementById('SId').innerText;
    let GTotal=document.getElementById('GTotal').innerText;

   // console.log('today');

    let Data={

    }

    if(SName.length===0){
        errorToast("Section Required !")
    }
    else if(InvoiceItemListCre.length===0){
        errorToast("Product Required !")
    }
    else{
        showLoader();
        let res=await axios.post("/create-purchase-req",Data,HeaderToken())
        hideLoader();
        if(res.data===1){
            window.location.href='/purchase-requsition-list'
            successToast("Purchase Requsition Created");
        }
        else{
            errorToast("Something Went Wrong")
        }
    }

}

</script>

@endsection
