@extends('site.layout.master')

@section('content')
<style type="text/css">
  .img-rounded {
    border: 1px solid #a7da92;
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    border-radius: 104px;
    max-height: 99px;
    padding: 3px;
}
</style>

<?php use App\Setting; ?>

            <div class="panel panel-default">
                <div class="panel-heading"><h3>Contact Us</h3></div> 

                    <div class="panel-body"> 
                    <div class="row" style="padding: 10px;">
                        <div class="col-md-7" >
                           {!! Setting::getSetting('map') !!}
                          </div>

                          <div class="col-md-5">
                            <h5><i class="fa fa-location"></i> Our Location </h5>
                            <label>Phone : <span>{{ Setting::getSetting('phone') }}</span></label>
                            <label>Email : <span>{{ Setting::getSetting('email') }}</span></label>
                            <label>Address : <span>{{ Setting::getSetting('address') }}</span></label>
                            <hr>
                              <h4><strong>Send Message</strong></h4>
                             @if ($message = Session::get('success'))
                              <div class="custom-alerts alert alert-success fade in">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                  {!! $message !!}
                              </div>                          
                             @endif
                            <form method="post" action="{{route('feedback')}}">
                            {{ csrf_field() }}
                              <div class="form-group">
                                <input type="text" required class="form-control" name="name" placeholder="Name">
                              </div>
                              <div class="form-group">
                                <input type="email" required class="form-control" name="email" placeholder="E-mail">
                              </div>
                              <div class="form-group">
                                <input type="tel" class="form-control" name="phone" placeholder="Phone">
                              </div>
                              <div class="form-group">
                                <textarea class="form-control" name="message" required rows="3" placeholder="Message"></textarea>
                              </div>
                              <button class="btn btn-primary" type="submit" name="button">
                                  <i class="fa fa-paper-plane-o" aria-hidden="true"></i> Submit
                              </button>
                            </form>
                          </div>
               </div>
            </div>

@endsection
