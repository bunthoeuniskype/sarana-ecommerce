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
                <div class="panel-heading"><h3>Delivery</h3></div> 

                    <div class="panel-body"> 
                    <div class="row" style="padding: 10px;">
                        <div class="col-md-12" >
                           <img style="width:100%;margin:0 auto;" class="img img-responsive" src="{{asset('public/uploads/images/delivery.jpg')}}">
                          </div>

                          <div class="col-md-12">
                            <h5>Internet shopping: how to buy online</h5>
                            
                            From concert tickets to washing machines, groceries to holidays, there’s bound to be a website that sells just what you want. If there’s a particular brand or store you like, you can go straight to their website or you can visit a shopping website such as eBay or Amazon, which carry broad ranges of new and second-hand items. If you’re a bargain hunter, you can use a price comparison site such as moneysupermarket.com, which lists the websites that sell your product according to price

                            In this guide, we’re going to show you how to find a product online and make a transaction.
                             
                            You’ll need:
                            a computer with an internet connection
                            a credit or debit card.
                            Follow these step-by-step instructions to learn how to buy online
                             
                            Step 1: Search for a product using Google shopping
                             
                            Type the name of the item you want to buy into the search box of a search engine such as Google – for example, ‘Roberts radio’ – and click Search or press enter on your keyboard.
                             
                            You will see a range of websites, from actual department stores such as John Lewis to large websites simply devoted to shopping, such as Amazon. You can also use the Shopping option on Google itself. Clicking on this will give you items available based on product reviews and price. You can also ask only for results available in shops near to you by clicking on 'Available nearby'.
                       </div>
               </div>
            </div>

@endsection
