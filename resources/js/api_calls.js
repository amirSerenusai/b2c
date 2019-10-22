


async function validateEmailDB(email) {



    try {
        let  response =
        await  axios
            .post(`/validate-email`, {email});
        $("#info").text('');
        $("#forgotPwd").show();

      // console.log(email+" exist");
console.log(response)
    //}catch({ response :{data :{message}} }){
  }catch({ response :{data :{errors : {email : email}}} }){
        email =_.head(email);
        $("#forgotPwd").hide();
        console.log(email);
         $("#info").text(email );
    }

}


$("#email").on('blur', function(email){  validateEmailDB(email.target.value); }  );






