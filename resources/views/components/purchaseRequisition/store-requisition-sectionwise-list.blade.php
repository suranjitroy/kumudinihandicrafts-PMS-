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

                <label class="form-label">Section</label>
                <select class="form-control form-select" id="sectionWiseReqRepID">
                    <option value="">Select Section</option>

                </select>
                <div class="align-items-center col">
            <button onclick="SectionWiseRequsitionReport()" class="btn mt-3 bg-gradient-primary ">Show Report</button>
            </div>

            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h4>Section Wise Requsition Report</h4>
                </div>
                {{-- <div class="align-items-center col">
                    <button onclick="DownloadReport()" class="float-end btn mt-3 bg-gradient-primary">Download</button>
                </div> --}}
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
                    <th>Status</th>
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


SectionWiseDropDownList();

    async function SectionWiseDropDownList(){

        let res = await axios.get("/section-list", HeaderToken());
        res.data.forEach(function(item, index){
            
            let option = `<option value="${item['id']}">${item['name']}</option>`

            $("#sectionWiseReqRepID").append(option);
        })
       

    }


    async function SectionWiseRequsitionReport() {

        //let id = document.getElementById('storeWiseRepID').value;
        let sectionID = document.getElementById('sectionWiseReqRepID').value;

        showLoader();
        let res = await axios.post('/section-wise-requsition-report',{section_id: sectionID},HeaderToken());
        hideLoader();

        if(res.status == 200){
            
        let tableData = $('#tableData');
        let tableList = $('#tableList');

       tableData.DataTable().destroy();
       tableList.empty();


       //alert(res.data['products']);

        res.data.forEach(function(item, index){
            let row = `
                    <tr>
                    <td>${index+1}</td>
                    <td>${item['req_date']}</td>
                    <td>${item['store_req_no']}</td>
                    <td>${item['section']['name']}</td>
                    <td>
                        ${
                        (item['is_approve'] == 3) ? '<span class="n-recomending">Not Recommended</span>': 
                        (item['is_approve'] == 2) ? '<span class="pending">Pending</span>': 
                        (item['is_approve'] == 1) ? '<span class="recomending">Recommended</span>':
                        (item['is_approve'] == 0) ? '<span class="approved">Approve</span>':
                        ''
                        }   
                    </td>
 
                    <td>
                        <button data-idrep="${item['id']}" data-secrep="${item['section_id']}" data-reqnorep="${item['store_req_no']}" data-userrep="${item['user_id']}" class="btn text-sm viewBtnRepDetails" style="color"><i class="fa text-sm fa-eye"></i></button>                       
                    </td>
                    </tr>`;
            tableList.append(row);
        });

        tableData.DataTable({
            responsive: true,
            lengthMenu:[5,10,15,20,25,30],
            order:[[0, 'desc']]
        });

    }else{
        errorToast(res.data['message']);   
    }

    $('.viewBtnRepDetails').on('click', async function(){
        let idRepDet = $(this).data('idrep');
        let secRepDet = $(this).data('secrep');
        let reqnoRepDet = $(this).data('reqnorep');
        let userRepDet = $(this).data('userrep');
        await RequsitionDetailsRepView(idRepDet, secRepDet, reqnoRepDet, userRepDet);
    });


    
    async function DownloadReport(){
        let storeWiseIDDown = document.getElementById('sectionWiseReqRepID').value;
            showLoader();
            let response = await axios.post("/stockwise-store-list-download", {store_id: storeWiseIDDown} , HeaderTokenWithBlob());
            hideLoader();
            const url = window.URL.createObjectURL(new Blob([response.data]));
            //debugger;
            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', 'Store-Wise-Product-Stock-Report.pdf'); // or another filename
            document.body.appendChild(link);
            link.click();
            link.remove();

    }

    }

    

</script>

