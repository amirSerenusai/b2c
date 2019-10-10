


function validateEmailDB() {

    axios
        .get(`/validate-email`, {});
}


$("#email").on('blur', validateEmailDB);


