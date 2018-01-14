@extends('site.layout.master')

@section('content')

        <div class="col-md-6 col-md-offset-3">
           <!-- CREDIT CARD FORM STARTS HERE -->
            <div class="panel panel-default credit-card-box" style="width:50%; padding-left:25%;padding-right:25%">
                <div class="panel-heading display-table" >
                    <div class="row display-tr" >
                        <h3 class="panel-title display-td" > Payment Method</h3>
                        <div class="display-td" >                            
                            <img class="img-responsive pull-right" src="{{ asset('public/uploads/images/accepted_c22e0.png') }}">
                        </div>
                    </div>                    
                </div>
                <div class="panel-body">    

                    @if ($message = Session::get('success'))
                    <div class="custom-alerts alert alert-success fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        {!! $message !!}
                    </div>
                    <?php Session::forget('success');?>
                    @endif
                    @if ($message = Session::get('error'))
                    <div class="custom-alerts alert alert-danger fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        {!! $message !!}
                    </div>
                    <?php Session::forget('error');?>
                    @endif

                      <div class="row" style="margin-top:15px;">
                            <div class="col-xs-12">
                                {{Form::open(array('url'=>route('addmoney.paypal'),'method'=>'POST'))}}
                                     {{ csrf_field() }}
                                   <input id="qty" type="hidden" class="form-control" name="qty" value="{{ $totalQty }}">
                                   <input id="amount" type="hidden" class="form-control" name="amount" value="{{ $totalPrice }}">
                                   <button class="subscribe btn btn-primary btn-lg btn-block" type="submit">Payment With Paypal ${{ $totalPrice }}</button>
                                {{Form::close()}}
                            </div>
                            <div class="col-xs-12" style="margin-top:15px;">
                              <a href="{{url('only-order')}}">  <button class="subscribe btn btn-success btn-lg btn-block" type="button">Only Order Payment Later ${{ $totalPrice }}</button></a>
                            </div>
                        </div>
                </div>
                <div class="panel-footer text-center" style="margin-top:15px;">Please Come Back Our Shop </div>
            </div>            
            <!-- CREDIT CARD FORM ENDS HERE -->
        </div>



@endsection
