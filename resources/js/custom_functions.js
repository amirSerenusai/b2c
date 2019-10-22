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
        $("#email").prop('disabled', false);
    } else {
        $("#email").prop('disabled', true);
        $result.text(email + " is not valid :(");
        $result.css("color", "red");
    }
    return false;
}
$("#validate").on("click", validate);
email.hover(validate, validate);
$(".step1").on("click",()=>{
    var email = $("#email").val();
    console.log("slick on step1");

});
$(".next-step").on("click",async function() {
    var email = $("#email").val();
    var $result = $("#result");
    if (!email)   return $result.text('Please enter a valid email') ;
    await validate();
    $("#email").prop('disabled', true);
    $(".carousel-control-next")[0].click();

    //console.log($(`.progressbar  li c${cItem}`));

    $(`.progressbar  li.c${cItem}`).removeClass('shadow');
    cItem = cItem === 3 ? 1 : cItem+1;
    $(`.progressbar  li.c${cItem}`).addClass('active shadow');
});


