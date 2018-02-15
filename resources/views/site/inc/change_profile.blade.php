<!-- Modal -->
<div class="modal fade model-change-profile" style="padding-bottom:20px" id="model-change-profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header"> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5> Update Profile</h5>
      </div>
      <div class="panel-body" style="padding:25px">
        <form name="formChangeProfile" id="formChangeProfile" method="post" action="#">
        
          {{csrf_field()}}
     
          <div class="col-md-12">
            <div class="errorServe-signup error" style="color:red"></div>
          </div>
          
          <div class="col-md-12 login-model">
           <label>User Name</label>
           <input type="text" class="form-control control-form-m" value="{{ Auth::guard('customer')->user()->username }}" name="username" placeholder="">          
          </div>

          <div class="col-md-12 login-model">
           <label>First Name</label>
           <input type="text" class="form-control control-form-m" name="firstname" value="{{ Auth::guard('customer')->user()->firstname }}" placeholder="">          
          </div>

          <div class="col-md-12 login-model">
           <label>Last Name</label>
           <input type="text" class="form-control control-form-m" name="lastname" value="{{ Auth::guard('customer')->user()->lastname }}" placeholder="">          
          </div>

          <div class="col-md-12 login-model">
           <label>Gender</label>
          <select name="gender" class="form-control">
            <option value="Male">Male</option>
            <option {{ Auth::guard('customer')->user()->gender == 'Female' ? 'selected' : '' }} value="Female">Female</option>
          </select>       
          </div>

           <div class="col-md-12 login-model">
           <label>E-mail</label>
           <input type="text" class="form-control control-form-m"  name="email" value="{{ Auth::guard('customer')->user()->email }}"  placeholder="">          
          </div>

          <div class="col-md-12 login-model">
           <label>Phone</label>
           <input type="text" class="form-control control-form-m"  name="phone" value="{{ Auth::guard('customer')->user()->phone }}" placeholder="">          
          </div>

          <div class="col-md-12 login-model">
           <label>Address</label>
           <input type="text" class="form-control control-form-m"  name="address" value="{{ Auth::guard('customer')->user()->address }}" placeholder="">          
          </div>
        
           <div class="col-md-12 login-model">
            <button type="submit" class="btn btn-black btn-model btn-primary pull-right control-form-m btn-model-signup">Update Profile</button>
          </div>
             
        </form>
    
    </div>
   </div>
  </div>
</div>
 <script type="text/javascript">  

  function show_password(id){
    if($('.password_show_'+id).is("input:text")){
      $('.password_show_'+id).prop('type','password');
    }else{
      $('.password_show_'+id).prop('type','text');
    }
    
  }

  $(function(){    
    
    $('#formChangeProfile').submit(function(e){     
            e.preventDefault();
            var $form = $(this);  
        
                $.ajax({
                    url: "{{route('customer.change_profile')}}",
                    type: "POST",
                    data: new FormData($('#formChangeProfile')[0]),
                    contentType:false,
                    cache: false,
                    processData:false,
                    success: function (response) {
                     if(response.status == 200){
                      $("#formChangeProfile")[0].reset();   
                      $('.errorServe-signup').html('');
                      $('#model-change-profile').modal('hide');  
                      alert('profile update successfully');  
                      location.reload();              
                    }else{
                     $('.errorServe-signup').html('');
                     $.each(response.error, function (key, value) {                 
                          $('.errorServe-signup').append("<span>"+value+"</span><br>");
                      })           
                    }
                             
                    },
             });
            
    });

});

</script>

