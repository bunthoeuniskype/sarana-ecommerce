@extends('site.layout.master')

@section('content')

            <div class="panel panel-default">
                <div class="panel-heading">Profile</div>
                <div class="panel-body">                
                @php print_r(Session::get('customer')->id); @endphp
              </div>
            </div>

@endsection
