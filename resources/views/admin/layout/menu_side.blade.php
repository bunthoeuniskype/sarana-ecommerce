<style type="text/css">
    .side-nav {
    position: fixed;
    top: 92px;
    left: 0px;
    width: 25%;
    margin-left: 0px;
    border: none;
    border-radius: 0;
    overflow-y: auto;
    background-color: #f6ffff;
    bottom: 0;
    overflow-x: hidden;
    padding-bottom: 40px;
    min-height: 450px;
}

</style>

 <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                
                    <li class="active">
                        <a href="{{ url('/') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>                
                     <li>
                         <a href="{{url('admin/feedback')}}"><i class="fa fa-envelope fa-fw"></i>{{ trans('Contact')}}</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#Trans"><i class="fa fa-cube" aria-hidden="true"></i> Others <i class="fa fa-fw fa-caret-down"></i></a>
                   <ul id="Trans" class="collapse">
                      
                        
                     <li>
                        <a href="{{url('admin/advertisement')}}"><i class="fa fa-hand-o-right fa-fw"></i>{{ trans('common.advertisement')}}</a>
                    </li>
                   
                     <li>
                        <a href="{{url('admin/category')}}"><i class="fa fa-hand-o-right fa-fw"></i>{{ trans('common.category')}}</a>
                    </li>
                     <li>
                        <a href="{{url('admin/subcategory')}}"><i class="fa fa-hand-o-right fa-fw"></i>{{ trans('common.sub_category')}}</a>
                    </li>
                   
                        </ul>
                    </li>
                   
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#setup1"><i class="fa fa-key" aria-hidden="true"></i> Security <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="setup1" class="collapse">
                    
                       <li>
                        <a href="{{url('admin/user')}}"><i class="fa fa-hand-o-right fa-fw"></i>{{ trans('common.user')}}</a>
                       </li>
                        <li>
                        <a href="{{url('admin/backup')}}"><i class="fa fa-hand-o-right fa-fw"></i>{{ trans('common.backup')}}</a>
                       </li>
                    </ul>
                    </li>                    
                     <li>
                         <a href="{{url('admin/setting')}}"><i class="fa fa-cog fa-fw"></i>{{ trans('common.setting')}}</a>
                    </li>
               
                  
                </ul>
            </div>