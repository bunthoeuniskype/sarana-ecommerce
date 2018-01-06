
@extends('admin.layout.master')

@section('content')

<div class="col-xs-12">

 <div class="col-xs-3">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6">
                <i class="fa fa-database fa-5x"></i>
              </div>
              <div class="col-xs-6 text-right">
                <p class="announcement-heading"></p>
                <p class="announcement-text"></p>
              </div>
            </div>
          </div>
          <a href="{{ url('admin/report/product') }}">
            <div class="panel-footer announcement-bottom">
              <div class="row">
                <div class="col-xs-6">
                 {{ trans('common.product') }}
                </div>
                <div class="col-xs-6 text-right">
                  <i class="fa fa-arrow-circle-right"></i>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>


 <div class="col-xs-3">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6">
                <i class="fa fa-users fa-5x"></i>
              </div>
              <div class="col-xs-6 text-right">
                <p class="announcement-heading"></p>
                <p class="announcement-text"></p>
              </div>
            </div>
          </div>
          <a href="{{ url('admin/report/employee') }}">
            <div class="panel-footer announcement-bottom">
              <div class="row">
                <div class="col-xs-6">
                 {{ trans('common.employee') }}
                </div>
                <div class="col-xs-6 text-right">
                  <i class="fa fa-arrow-circle-right"></i>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>


 <div class="col-xs-3">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6">
                <i class="fa fa-users fa-5x"></i>
              </div>
              <div class="col-xs-6 text-right">
                <p class="announcement-heading"></p>
                <p class="announcement-text"></p>
              </div>
            </div>
          </div>
          <a href="{{ url('admin/report/customer') }}">
            <div class="panel-footer announcement-bottom">
              <div class="row">
                <div class="col-xs-6">
                 {{ trans('common.customer') }}
                </div>
                <div class="col-xs-6 text-right">
                  <i class="fa fa-arrow-circle-right"></i>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>


 <div class="col-xs-3">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6">
                <i class="fa fa-users fa-5x"></i>
              </div>
              <div class="col-xs-6 text-right">
                <p class="announcement-heading"></p>
                <p class="announcement-text"></p>
              </div>
            </div>
          </div>
          <a href="{{ url('admin/report/supplier') }}">
            <div class="panel-footer announcement-bottom">
              <div class="row">
                <div class="col-xs-6">
                 {{ trans('common.supplier') }}
                </div>
                <div class="col-xs-6 text-right">
                  <i class="fa fa-arrow-circle-right"></i>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>


 <div class="col-xs-3">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6">
                <i class="fa fa-users fa-5x"></i>
              </div>
              <div class="col-xs-6 text-right">
                <p class="announcement-heading"></p>
                <p class="announcement-text"></p>
              </div>
            </div>
          </div>
          <a href="{{ url('admin/report/shipper') }}">
            <div class="panel-footer announcement-bottom">
              <div class="row">
                <div class="col-xs-6">
                 {{ trans('common.shipper') }}
                </div>
                <div class="col-xs-6 text-right">
                  <i class="fa fa-arrow-circle-right"></i>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>

      <div class="col-xs-3">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6">
                <i class="fa fa-dollar fa-5x"></i>
              </div>
              <div class="col-xs-6 text-right">
                <p class="announcement-heading"></p>
                <p class="announcement-text"></p>
              </div>
            </div>
          </div>
          <a href="{{ url('admin/report/pay-deposite') }}">
            <div class="panel-footer announcement-bottom">
              <div class="row">
                <div class="col-xs-6">
                 {{ trans('common.pay_deposite') }}
                </div>
                <div class="col-xs-6 text-right">
                  <i class="fa fa-arrow-circle-right"></i>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>

       <div class="col-xs-3">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6">
                <i class="fa fa-money fa-5x"></i>
              </div>
              <div class="col-xs-6 text-right">
                <p class="announcement-heading"></p>
                <p class="announcement-text"></p>
              </div>
            </div>
          </div>
          <a href="{{ url('admin/report/exchange') }}">
            <div class="panel-footer announcement-bottom">
              <div class="row">
                <div class="col-xs-6">
                 {{ trans('common.exchange_rate') }}
                </div>
                <div class="col-xs-6 text-right">
                  <i class="fa fa-arrow-circle-right"></i>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>

      <div class="col-xs-3">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6">
                <i class="fa fa-dollar fa-5x"></i>
              </div>
              <div class="col-xs-6 text-right">
                <p class="announcement-heading"></p>
                <p class="announcement-text"></p>
              </div>
            </div>
          </div>
          <a href="{{ url('admin/report/expense_income') }}">
            <div class="panel-footer announcement-bottom">
              <div class="row">
                <div class="col-xs-6">
                 {{ trans('common.expense_income') }}
                </div>
                <div class="col-xs-6 text-right">
                  <i class="fa fa-arrow-circle-right"></i>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>

       <div class="col-xs-3">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6">
                <i class="fa fa-database fa-5x"></i>
              </div>
              <div class="col-xs-6 text-right">
                <p class="announcement-heading"></p>
                <p class="announcement-text"></p>
              </div>
            </div>
          </div>
          <a href="{{ url('admin/report/inventory') }}">
            <div class="panel-footer announcement-bottom">
              <div class="row">
                <div class="col-xs-6">
                 {{ trans('common.inventory') }}
                </div>
                <div class="col-xs-6 text-right">
                  <i class="fa fa-arrow-circle-right"></i>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>

       <div class="col-xs-3">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6">
                <i class="fa fa-shopping-cart fa-5x"></i>
              </div>
              <div class="col-xs-6 text-right">
                <p class="announcement-heading"></p>
                <p class="announcement-text"></p>
              </div>
            </div>
          </div>
          <a href="{{ url('admin/report/sale') }}">
            <div class="panel-footer announcement-bottom">
              <div class="row">
                <div class="col-xs-6">
                 {{ trans('common.sale') }}
                </div>
                <div class="col-xs-6 text-right">
                  <i class="fa fa-arrow-circle-right"></i>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>

      <div class="col-xs-3">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6">
                <i class="fa fa-server fa-5x"></i>
              </div>
              <div class="col-xs-6 text-right">
                <p class="announcement-heading"></p>
                <p class="announcement-text"></p>
              </div>
            </div>
          </div>
          <a href="{{ url('admin/report/purchase') }}">
            <div class="panel-footer announcement-bottom">
              <div class="row">
                <div class="col-xs-6">
                 {{ trans('common.purchase') }}
                </div>
                <div class="col-xs-6 text-right">
                  <i class="fa fa-arrow-circle-right"></i>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>



 </div>
@endsection








                        