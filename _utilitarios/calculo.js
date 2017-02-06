
    $(function (){
    
    var $price  = $("tr.ativo td#fees_part"),
    $percentage = $("tr.ativo td#fees_desc").on("mouseleave", calculatePrice),
    $discount   = $("tr.ativo td#fees_total").on("mouseleave", calculatePerc);
    

function calculatePrice() {
    var percentage = $(this).text();
    var price      = $price.text();
    var calcPrice  = (price - ( price * percentage / 100 )).toFixed(2);
    $discount.text( calcPrice );
}

function calculatePerc() {
    var discount = $(this).text();
    var price    = $price.text();
    var calcPerc = 100 - (discount * 100 / price);
    $percentage.text( calcPerc );
}
    
    });
