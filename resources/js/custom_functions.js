import { connectUser } from './api_calls';


function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
var email = $("#email");
function validate() {
    console.log("inside validate");
    var $result = $("#result");
    var email = $("#email").val();
    $result.text("");
    if(email.length < 1) return ;
    if (validateEmail(email)) {
        $result.text(email + " is valid :)");
        $result.css("color", "green");
        $(".next-step").prop('disabled', false).css({cursor:'pointer'});
    } else {
        $(".next-step").prop('disabled', true).css({cursor:'not-allowed'});
        $result.text(email + " is not valid :(");
        $result.css("color", "red");
    }
    return false;
}

$("#email").on('input', validate );

$("#validate").on("click", validate);
email.hover(validate, validate);

$(".next-step").on("click",async function() {
    if( $(this).hasClass('step2') ) connectUser()  ;

    var email = $("#email").val();
    var $result = $("#result");
    if (!email)   return $result.text('Please enter a valid email') ;
    await validate();
    // $("#email").prop('disabled', true);
    $(".carousel-control-next")[0].click();
    //console.log($(`.progressbar  li c${cItem}`));
    $(this).removeClass(`step${cItem}`);
    $(`.progressbar  li.c${cItem}`).removeClass('shadow');
    cItem = cItem === 3 ? 1 : cItem+1;
    $(this).addClass(`step${cItem}`);
    $(`.progressbar  li.c${cItem}`).addClass('active shadow');
});


