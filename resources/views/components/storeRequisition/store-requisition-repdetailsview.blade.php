<style>
/* #URIDSec{
    display: inline-block;
} */
</style>
<!-- Modal -->
<div class="modal animated zoomIn" id="details-modal-sec" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Details</h5>
            </div>
            <div id="invoice" class="modal-body p-3">
                    <div class="container-fluid">
                        <br/>
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="text-bold mx-0 my-3 text-dark text-center "><u>Store Requsition</u></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <span class=" text-dark text-bold text-xs">Requsition No: 
                                    <span id="STRNoSec"> </span> </span> <br/>
                                <span class=" text-dark text-bold text-xs">Request From : <span id="SNameSec"> </span> <input type="hidden" id="SIdSec" /> </span>
                                
                            </div>
                            
                            <div class="col-md-6">
                                <span class=" text-dark text-bold text-xs">Date: <span id="STRDateSec"> </span></span>
                                <span class=" d-none text-dark text-bold text-xs">user: <span id="URIDSec"> </span></span>
                                <span class=" d-none text-dark text-bold text-xs">id: <span id="IdSec"> </span></span>
                            </div>
                            
                        </div>
                        <hr class="mx-0 my-2 p-0 bg-secondary"/>
                        <div class="row">
                            <div class="col-12">
                                <table class="table w-100" id="invoiceTable">
                                    <thead class="w-100">
                                    <tr class="text-xs text-bold">
                                        <td>Name</td>
                                        <td>Qty</td>
                                    </tr>
                                    </thead>
                                    <tbody  class="w-100" id="invoiceListDetailsSec">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn bg-gradient-primary" data-bs-dismiss="modal">Close</button>

                <button onclick="PrintPage()" class="btn bg-gradient-success">Print</button>
                {{-- <button id ="recommendedButton" onclick="recommended()" class=" btn bg-gradient-info" style="display:none">Recommended</button>
                <button id ="notrecommendedButton" onclick="notrecommended()" class="btn bg-gradient-warning" style="display:none">Not Recommended</button> --}}


              

            </div>
        </div>
    </div>
</div>



<script>

    async function RequsitionDetailsRepView(idRepDet, secRepDet, reqnoRepDet, userRepDet) {

        showLoader()
        let res=await axios.post("/store-req-details",{section_id:secRepDet, store_requsition_id:idRepDet,store_req_no:reqnoRepDet},HeaderToken())
        hideLoader();

        document.getElementById('IdSec').innerText = res.data['storeReq']['id'];
        document.getElementById('STRDateSec').innerText = res.data['storeReq']['req_date'];
        document.getElementById('STRNoSec').innerText = res.data['storeReq']['store_req_no'];
        document.getElementById('SNameSec').innerText = res.data['storeReq']['section']['name'];
        document.getElementById('URIDSec').innerText = res.data['storeReq']['user_id'];


        let invoiceListDetailsSec=$('#invoiceListDetailsSec');

        invoiceListDetailsSec.empty();

        res.data['storeReqDetail'].forEach(function (item,index) {
            let row=`<tr class="text-xs">
                        <td>${item['product']['product_name']}</td>
                        <td>${item['quantity']} ${item['unit']['unit_name']}</td>
                     </tr>`
            invoiceListDetailsSec.append(row)
        });



        $("#details-modal-sec").modal('show');

    }

    function PrintPage() {
        let printContents = document.getElementById('invoice').innerHTML;
        let originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        setTimeout(function() {
            location.reload();
        }, 1000);
    }

    // async function recommended(){

    //     let id = document.getElementById('Id').innerText;
    //     let userid = document.getElementById('URIDSec').innerText;

    //     document.getElementById('details-modal-sec').click();

    //     showLoader();
    //     let res = await axios.post("/store-recommended",{id:id, user_id:userid},HeaderToken());
    //     hideLoader();

    //     if(res.status == 200 && res.data['status'] == 'Success'){
    //         successToast(res.data['message']);
    //         await getList();
    //     }else{
    //         errorToast(res.data['message']);
    //     }

    // }


    // async function notrecommended(){

    //     let id = document.getElementById('Id').innerText;
    //     let userid = document.getElementById('URIDSec').innerText;

    //     document.getElementById('details-modal-sec').click();

    //     showLoader();
    //     let res = await axios.post("/store-not-recommended",{id:id, user_id:userid},HeaderToken());
    //     hideLoader();

    //     if(res.status == 200 && res.data['status'] == 'Success'){
    //         successToast(res.data['message']);
    //         await getList();
    //     }else{
    //         errorToast(res.data['message']);
    //     }

    // }

</script>
