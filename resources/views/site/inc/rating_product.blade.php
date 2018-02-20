<style type="text/css">

.rating ul{margin:0;padding:0;}
.rating li{cursor:pointer;list-style-type: none; display: inline-block;color: #F0F0F0;text-shadow: 0 0 1px #666666;font-size:20px;}
 .rating .highlight, .rating .selected {color:#F4B30A;text-shadow: 0 0 1px #F48F0A;}

</style>
<div class="rating" id="rating_post_{{$product->id}}">
  <input type="hidden" name="rating" id="rating"/>
    <ul onMouseOut="resetRating({{ $product->id }});" style="padding-left:5px;">
      <?php
      for($i=1;$i<=5;$i++) {
      $selected = "";
      if(!empty($product->rate) && $i<=$product->rate) {
      $selected = "selected";
      }
      ?>
      <li class='<?php echo $selected; ?>' onmouseover="highlightStar(this,{{ $product->id }});" onmouseout="removeHighlight({{ $product->id}});" onClick="addRating(this,{{ $product->id }});">&#9733;</li>  
      <?php }  ?>
    </ul>
</div>


<script type="text/javascript">

function highlightStar(obj,id) {
  removeHighlight(id);    
  $('#rating_post_'+id+' li').each(function(index) {
    $(this).addClass('highlight');
    if(index == $('#rating_post_'+id+' li').index(obj)) {
      return false; 
    }
  });
}

function removeHighlight(id) {
  $('#rating_post_'+id+' li').removeClass('selected');
  $('#rating_post_'+id+' li').removeClass('highlight');
}

function addRating(obj,id) {
  $('#rating_post_'+id+' li').each(function(index) {
    $(this).addClass('selected');
    $('#rating_post_'+id+' #rating').val((index+1));   
    if(index == $('#rating_post_'+id+' li').index(obj)) {
      return false; 
    }
  });
 
 $.ajax({
  url: "{{route('product.rating')}}",
  data:'id='+id+'&rate='+$('#rating_post_'+id+' #rating').val()+'&_token={{ csrf_token() }}',
  type: "POST"
  }); 
}

function resetRating(id) {
  if($('#rating_post_'+id+' #rating').val() != 0) {
    $('#rating_post_'+id+' li').each(function(index) {
      $(this).addClass('selected');
      if((index+1) == $('#rating_post_'+id+' #rating').val()) {
        return false; 
      }
    });
  }
} 

</script>

