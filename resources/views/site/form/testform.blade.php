@extends('site.layout.master')

@section('content')

    <div id="register">
        <div class="modal-header">

        <h3>Register</h3>
        </div>
        <div class="modal-body">
        <form method="POST" action="test-form" enctype="multipart/form-data">
        {{ csrf_field() }}

          <div id="append_control">
              <a href="#" onclick="addAppend()">Add</a>
              <div class="control-group">
                <input class="form-control"  type="text" id="append" name="append[]" placeholder="Append Text">
             </div>
          </div>
        
      
        <button type="submit" class="btn btn-success pull-right" style="margin-right:3px;">Register</button>
        </form>  
        
        </div>
    </div>
<script type="text/javascript">
function addAppend() {

var count = 0;
  td = '<div class="control-group" id="'+count+'">';
  td += '<input class="form-control"  type="text" id="append'+count+'" name="append[]" placeholder="Append Text"><a href="#" onclick="removeAppend('+count+')">Remove</a>';
  td += '</div>';

  $("#append_control").append(td);
}

function removeAppend(id){
   $("#"+id).remove();
}
</script>

@endsection