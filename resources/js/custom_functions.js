import {connectUser, validateEmailDB , sendPwdLink} from './api_calls';
var $result , getPasswordLinkPressed;
function msg(msg){

   return console.log('%c '+msg, 'background: white; color: green; display: block;');
}

function validateEmail(email) {

    if(!email) email = $("#email").val();
    console.log({email});
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

const email = $("#email");

function validate() {
    msg("inside validate");
      $result = $("#result");
    var email = $("#email").val();
    $result.text("");
    if(email.length < 1){
        if (getPasswordLinkPressed)  { $result.text('Email is empty :('); $result.css({color : 'red'}); }

        throw('EMAIL IS EMPTY');}

    if (validateEmail(email)) {



        $result.text(email + " is valid :)");
        $result.css("color", "green");
        $(".next-step").prop('disabled', false).css({cursor:'pointer'});
        return true

    } else {
        $(".next-step").prop('disabled', true).css({cursor:'not-allowed'});
        $result.text(email + " is not valid :(");
        $result.css("color", "red");
        return false ;
    }

}

// $("#email").on('input', validate );

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
$(".make-jello").on('click' , function () {
 if(($(this).next()[0]).style.display == "none") {
     $("#getDecision").removeClass('jello');
     $("#getDecision").removeClass('pulse');
     setTimeout(() => {
         $("#getDecision").addClass('pulse');
     } , 100)
 }
});
// $(".start-process").on('click', "#getDecision" , async function() {
//
//     // $("#getDecision").on('click', async function () {
//
//         getPasswordLinkPressed = true;
//         let isValid = await validate();
//         if (!isValid) return console.log("not Valid . stop.");
//         else {
//             let userExists = await validateEmailDB();
//             console.log({ userExists });
//             return alert(userExists);
//             await sendPwdLink(userExists);
//         }
//
//
//     // });
// });

$(".welcome-text").on('click' , "#pwdLink" ,async  function () {

  let checkEmail =  await validateEmail();
  console.log(checkEmail);
  if(!checkEmail) return  $result.text("email is not valid");
   validateEmailDB().then( res =>  {


       shakeLoginUser(res);
       $result.text( res ? 'User exists in system' : 'sending mail.....');
   });

} );

function shakeLoginUser(res) {
    if(!res) return;
    let login =  $("#loginUser");
    if(login.hasClass('shake')) return ;
    login.addClass('animated shake');
    setTimeout(() => { login.removeClass('animated shake')} , 2000 );

}


$('#getDecision').on('click' , async function() {

   let procedureName   = $(this).attr('data-procedure');


    // $("#getDecision").on('click', async function () {
    // $(this).attr('data-notify-msg' ,"mtr massagw");



    // SEMICOLON.widget.notifications(this);
    getPasswordLinkPressed = true;
    let isValid = await validate();

    if (!isValid) return console.log("not Valid . stop.");
    else {

        let userExists = await validateEmailDB();

        console.log({ userExists });

        await sendPwdLink(userExists , procedureName);
    }


    // });
});
//
// $(window).scroll(function (event) {
//     var scroll = $(window).scrollTop();
//     // Do something
//     console.log(scroll);
//     if(scroll > 30 && scroll < 502 ) $("img.fadeInUp").addClass('grayscale');
//     else $("img.fadeInUp").removeClass('grayscale');
//
// });


