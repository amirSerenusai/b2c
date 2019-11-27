
let newUser = false;
let password , g_email =null;
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
  }catch({ response :{data :{errors : {email : emailResponse}}} }){

        emailResponse =_.head(emailResponse);
        $("#forgotPwd").hide();
        console.log(emailResponse);
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

export let sendPwdLink = async () => {
    if(!g_email) g_email = $("#email").val();
    console.log(g_email);
    let userDetails =    await  axios
        .post(`/pwd-link`, {email : g_email});
    console.log({userDetails})
};




