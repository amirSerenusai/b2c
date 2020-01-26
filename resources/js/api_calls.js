
let newUser = false;
let addDotInterval = false;
let password , g_email =null ;
let dotLoop = 0;
export async function validateEmailDB(email) {
if(!email) email = $("#email").val();


    try {
        let  response =
        await  axios
            .post(`/validate-email`, {email});
        $("#info").text('');
        $("#forgotPwd").hide().delay(300).show();

      // console.log(email+" exist");
        return true;

    //}catch({ response :{data :{message}} }){
  }catch(emailResponse){  //{ response :{data :{errors : {email : emailResponse}}} }){

            return console.error(emailResponse)


        emailResponse =_.head(emailResponse);
        $("#forgotPwd").hide();
        console.log(emailResponse);
        // noinspection DuplicatedCode
        if (emailResponse  === "new-user") {
            newUser = true;
            $("#info").text('Hello new user , type a password of 8 chars ');
            $("#pwd").attr("placeholder", "Type a password");
            password = $("#pwd").val();
            $("#pwd").attr('placeholder');

        }

        return false;
    }

}


// $("#email").on('blur', function(email){
//     g_email = email.target.value;
//     validateEmailDB(g_email); }
//     );

// $(".step1").on("click", function (){
//    // var email = $("#email").val();
//     validateEmailDB(g_email);
//     console.log("ssssslick on step1");
// });

// $(".next-step").on("click", function (){
//      if( $(this).hasClass('step2') ) alert("step2")
// });

export function connectUser() {
 if (newUser) registerNewUser().then( $(".carousel-item").delay(500).animate({height:700},600));
 else  loginUser().then( $(".carousel-item").delay(500).animate({height:700},600));
}

let registerNewUser = async () => {
    if (!g_email || !password)return console.log("no email to send or password");
    let name =    g_email.substr(0, g_email.indexOf('@'));

    await  axios
        .post(`/register`, {email : g_email , name , password });

};

let loginUser = async () => {
    // if (!g_email || !password)return console.log("no email to send or password");
    // let name =    g_email.substr(0, g_email.indexOf('@'));
 password = $("#pwd").val();
 let userDetails =    await  axios
        .post(`/login`, {email : g_email , name , password });
 console.log({userDetails})
};

function addDot() {
            if (dotLoop < 3 ) {
                let t =  $("#result").text();
                t+=" . ";
                $("#result").text(t);
            }
       else clearInterval(addDotInterval);
dotLoop++;
}

export let sendPwdLink = async (userExists) => {
    $('#progressive').css({display:"block"});
    $(".progress-bar").animate({
        width: "100%"
    }, 250 ); // start in under a sec

    $("#result").text('Sending you a password-link, please wait . . . ');
    console.log($(".spinner-border"));
    $(".spinner-border").removeClass("d-none");
    dotLoop =true;
    addDotInterval = setInterval(addDot, 1000);

    let fci = $(".flip-card-inner");
    let fc = $(".flip-card");
    // if(!g_email)
     g_email = $("#email").val();

    fci.removeClass('link-sent');
    await fc.fadeIn(1000);

    console.log(g_email);
    let userDetails =    await  axios
        .post(`/pwd-link?registered=${userExists}`, {email : g_email});
    if(userDetails.status === 200) {
        // $(".progress-bar").animate({
        //     width: "100%"
        // }, 250 ); // start in under a sec
         $("#result").text('Link  sent successfully! ');

    fci.addClass('link-sent');
       setTimeout(() => { fc.fadeOut(1000);

           $("#progressive").fadeOut()
       },1000);
    }
    console.log({userDetails})
};




