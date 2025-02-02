<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card animated fadeIn w-100 p-3">
                <div class="card-body">
                    <h4>User Profile</h4>
                    <hr/>
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">

                            <div class="col-md-4 p-2">
                                <label>First Name</label>
                                <input id="userID" placeholder="First Name" class="form-control" type="text"/>
                            </div>

                            <div class="col-md-4 p-2">
                                <label>First Name</label>
                                <input id="name" placeholder="First Name" class="form-control" type="text"/>
                            </div>

                            <div class="col-md-4 p-2">
                                <label>Email Address</label>
                                <input readonly id="email" placeholder="User Email" class="form-control" type="email"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Password</label>
                                <input id="password" placeholder="User Password" class="form-control" type="password"/>
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <button onclick="onUpdate()" class="btn mt-3 w-100  bg-gradient-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    getProfile()
    async function getProfile(){
        try{
            showLoader();
            let res=await axios.get("/user-profile",HeaderToken());
            hideLoader();
            document.getElementById('userID').value=res.data['id'];
            document.getElementById('name').value=res.data['name'];
            document.getElementById('email').value=res.data['email'];
            document.getElementById('password').value=res.data['password'];
            

        }catch (e) {
           unauthorized(e.response.status)
        }
    }


// async function onUpdate(){
//     let PostBody={
//         "firstName":document.getElementById('firstName').value,
//         "lastName":document.getElementById('lastName').value,
//         "mobile":document.getElementById('mobile').value,
//     }
//     showLoader();
//     let res=await axios.post("/user-update",PostBody,HeaderToken());
//     hideLoader();
//     if(res.data['status']==="success"){
//         successToast(res.data['message'])
//         await getProfile();
//     }
//     else {
//         successToast(res.data['message'])
//     }
//  }

</script>

