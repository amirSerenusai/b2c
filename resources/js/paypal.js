

// $('body').addClass('body-order');
paypal.Buttons({
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: '0.01'
                }
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            console.log({data , details})
            alert('Transaction completed by ' + details.payer.name.given_name);

            return axios.post("/api/paypal-transaction-complete", {
                orderID: data.orderID
            });
            // Call your server to save the transaction
        //     return fetch('{{url("/api/paypal-transaction-complete")}}', {
        //         method: 'post',
        //         headers: {
        //             'content-type': 'application/json' ,
        //             //'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        //         },
        //         body: JSON.stringify({
        //             orderID: data.orderID,
        //
        // })
        // });
        });
    }
}).render('#paypal-button-container');


