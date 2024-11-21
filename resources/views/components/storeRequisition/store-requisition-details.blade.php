<style>
/* #URID{
    display: none;
} */
</style>
<!-- Modal -->
<div class="modal animated zoomIn" id="details-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Recommended or Not Recommended</h5>
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
                                    <span id="STRNoDe"> </span> </span> <br/>
                                <span class=" text-dark text-bold text-xs">Request From : <span id="SNameDe"> </span> <input type="hidden" id="SId" /> </span>
                                
                            </div>
                            
                            <div class="col-md-6">
                                <span class=" text-dark text-bold text-xs">Date: <span id="STRDateDe"> </span></span>
                                <span class=" d-none text-dark text-bold text-xs">user: <span id="URID"> </span></span>
                                <span class=" d-none text-dark text-bold text-xs">id: <span id="Id"> </span></span>
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
                                    <tbody  class="w-100" id="invoiceListDetails">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-primary" data-bs-dismiss="modal">Close</button>
                <button onclick="PrintPage()" class="btn bg-gradient-success">Print</button>
                <button id ="recommendedButton" onclick="recommended()" class=" btn bg-gradient-info" style="display:none">Recommended</button>
                <button id ="notrecommendedButton" onclick="notrecommended()" class="btn bg-gradient-warning" style="display:none">Not Recommended</button>


              

            </div>
        </div>
    </div>
</div>


<script>

    async function RequsitionDetails(id,sec,reqno,user) {

        showLoader()
        let res=await axios.post("/store-req-details",{section_id:sec, store_requsition_id:id,store_req_no:reqno},HeaderToken())
        hideLoader();

        document.getElementById('Id').innerText = res.data['storeReq']['id'];
        document.getElementById('STRDateDe').innerText = res.data['storeReq']['req_date'];
        document.getElementById('STRNoDe').innerText = res.data['storeReq']['store_req_no'];
        document.getElementById('SNameDe').innerText = res.data['storeReq']['section']['name'];
        document.getElementById('URID').innerText = res.data['storeReq']['user_id'];


        let invoiceListDetails=$('#invoiceListDetails');

        invoiceListDetails.empty();

        res.data['storeReqDetail'].forEach(function (item,index) {
            let row=`<tr class="text-xs">
                        <td>${item['product']['product_name']}</td>
                        <td>${item['quantity']} ${item['unit']['unit_name']}</td>
                     </tr>`
            invoiceListDetails.append(row)
        });



        $("#details-modal").modal('show');

        if(user == 1){
            document.getElementById('recommendedButton').style.display = "inline-block";
            document.getElementById('notrecommendedButton').style.display = "inline-block";
        }
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

    async function recommended(){

        let id = document.getElementById('Id').innerText;
        let userid = document.getElementById('URID').innerText;

        document.getElementById('details-modal').click();

        showLoader();
        let res = await axios.post("/store-recommended",{id:id, user_id:userid},HeaderToken());
        hideLoader();

        if(res.status == 200 && res.data['status'] == 'Success'){
            successToast(res.data['message']);
            await getList();
        }else{
            errorToast(res.data['message']);
        }

    }


    async function notrecommended(){

        let id = document.getElementById('Id').innerText;
        let userid = document.getElementById('URID').innerText;

        document.getElementById('details-modal').click();

        showLoader();
        let res = await axios.post("/store-not-recommended",{id:id, user_id:userid},HeaderToken());
        hideLoader();

        if(res.status == 200 && res.data['status'] == 'Success'){
            successToast(res.data['message']);
            await getList();
        }else{
            errorToast(res.data['message']);
        }

    }

</script>
