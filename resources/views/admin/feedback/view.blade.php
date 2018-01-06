@extends('layouts.layout')


@section('content')


<div id="panel panel-default" style="margin-top: -20px;">
               
               <div class="panel panel-heading clearfix" style="margin-bottom: -15px;">
                         <a href="{{ url('admin/feedback') }}"> <button class="btn btn-primary pull-right"><i class="fa fa-reply" aria-hidden="true"></i> {{ trans('common.back') }} </button></a>
                        <h3 style="margin-top: 5px;">{{ trans('common.message') }} </h3>
                       
                         </div>
                            <div class="panel panel-body">

    <table class="table table-striped table-bordered nowrap table-over" >
        <thead>
            <tr>
             <th>{{ trans('common.name') }} : {{$feedback->name}} 
                <br>
             {{ trans('common.email') }} : {{ $feedback->email }}
             </th>        
            </tr>
        </thead>
        <body>    
       
          <tr>          
              <td colspan="2">{{$feedback->message}}</td>
          </tr>
    
        </body>
    </table>
    </div>
</div>

   
</script>

@endsection


