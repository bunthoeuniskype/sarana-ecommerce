<!-- Modal -->
<div class="modal fade model-change-password" style="padding-bottom:20px" id="model-change-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header"> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5> Change Password</h5>
      </div>
      <div class="panel-body" style="padding:25px">
        <form name="formChangePassword" id="formChangePassword" method="post" action="#">
        
          {{csrf_field()}}
     
          <div class="col-md-12">
            <div class="errorServe-signup error" style="color:red"></div>
          </div>
          
          <div class="col-md-12 login-model">
           <input type="password" class="form-control control-form-m password_show_1" id="password-signup" name="password" placeholder="Password">
           <span class="show-password" onclick="show_password(1);"><i class="fa fa-eye"></i></span>
          </div>

          <div class="col-md-12 login-model">
           <input type="password" class="form-control control-form-m password_show_2" name="confirm_password" placeholder="Confirm Password">
          <span class="show-password" onclick="show_password(2);"><i class="fa fa-eye"></i></span>
          </div>         

           <div class="col-md-12 login-model">
            <button type="submit" class="btn btn-black btn-model btn-primary pull-right control-form-m btn-model-signup">Change Password</button>
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
    
    $('#formChangePassword').submit(function(e){     
            e.preventDefault();
            var $form = $(this);  
        
                $.ajax({
                    url: "{{route('customer.change_password')}}",
                    type: "POST",
                    data: new FormData($('#formChangePassword')[0]),
                    contentType:false,
                    cache: false,
                    processData:false,
                    success: function (response) {
                     if(response.status == 200){
                      $("#formChangePassword")[0].reset();   
                      $('.errorServe-signup').html('');
                      $('#model-change-password').modal('hide');  
                      alert('Password change successfully');                
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

