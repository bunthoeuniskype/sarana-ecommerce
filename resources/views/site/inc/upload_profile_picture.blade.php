
<script>

$(".input-picture").on("change",function(){

    var myattr = $(this).attr('myAttr');
    var reg=/(.jpg|.gif|.png|.JPG|.PNG|GIF)$/;
    if (!reg.test($(".input-picture").val())) {
        alert('Invalid File Type');
        return false;
    }
    uploadFile(myattr);
});

$(".choose-picture").on("click",function(){
    $('.input-picture').click();
});

function uploadFile(myattr)
{
    $(".upload-picture").ajaxSubmit({
        dataType: 'json',
        success: function(data, statusText, xhr, wrapper){
            if(data.status == 200){ 
                $('.display-picture').prop("src","{{url('')}}/"+data.name);              
            }      
        }
    });
}   

</script>

