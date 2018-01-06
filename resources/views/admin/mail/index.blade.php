@extends('admin.main.main')

@section('content')

<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Mail
                          
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="#">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Send Mail
                            </li>
                        </ol>
                    
                        @if(Session::has('send_success'))
                        <div class="alert alert-success">
                        <em>{!! Session('send_success') !!}</em>
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">&times</span>
                        </button>
                        </div>
                        @endif
                        <div class="panel-body">
                        <!-- show error input-->
                         @include('admin/common/errors')

                        {!! Form::open(array('url'=>'mail/send', 'files' => true)) !!}
                        {{ csrf_field() }}
                        <div class="form-group">
                        <div class="form-label col-sm-2">
                            {!! Form::label('receiveby','Send To: ') !!}
                        </div>
                       <div class="input-group from-group col-sm-9">                       
                        {!! Form::text('receiveby',null,array('class'=>'form-control')) !!}
                        </div>
                        </div>
                          <div class="form-group">
                        <div class="form-label col-sm-2">
                            {!! Form::label('subject','Subject: ') !!}
                        </div>
                       <div class="input-group from-group col-sm-9">                       
                        {!! Form::text('subject',null,array('class'=>'form-control')) !!}
                        </div>
                        </div>

                        
                        {{ Html::script('public/assets/nicEditor/nicEdit.js') }}                    
                        <script type="text/javascript">
                            bkLib.onDomLoaded(function() { nicEditors.allTextAreas('description') });
                        </script>
                         <div class="form-group">
                         <div class="form-label col-sm-2">
                            {!! Form::label('message','Message: ') !!}
                        </div>
                       <div class="input-group from-group col-sm-9">                       
                        {!! Form::textarea('message',null,array('class'=>'form-control',3>4)) !!}
                        </div>
                        </div>

                          <div class="form-group">
                         <div class="form-label col-sm-2">
                            {!! Form::label('attachment','Attachment: ') !!}
                        </div>
                       <div class="input-group from-group col-sm-9">                       
                        {!! Form::file('attachment',null,array('id'=>'attachment')) !!}
                        </div>
                        </div>
                         
                        <div class="from-group col-sm-9 col-sm-offset-9">
                           {!! Form::submit('Send',array('class'=>'btn btn-primary')) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                         </div>
                </div>
                    <script>

$(document).ready(function(){

$('#attachment').fileinput({
        maxFileSize: 10240,
        allowedFileExtensions : ['jpeg','jpg','bmp','png','gif','zip','rar','pdf','psd','ai','cdr','rtf','doc','docx','xls','xlsx','ppt'],
        showUpload: false,
        showCaption: false,
        browseClass: "btn btn-primary btn-lg",
        fileType: "any",
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
    });

    });


</script>

                
                <!-- /.row -->
@endsection