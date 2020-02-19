<?php


namespace App\Http\Controllers;

//1. Import the PayPal SDK client that was created in `Set up Server-Side SDK`.

use App\Order;
use Illuminate\Http\Request;
use Sample\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;

class PayPalController extends  ApiController
{

    // 2. Set up your server to receive a call from the client
    /**
     *You can use this function to retrieve an order by passing order ID as an argument.
     * @param Request $request
     * @return string
     */
    public static function getOrder(Request $request)
    {

            return [auth()->user()->id];
            $orderId = $request->get('orderID');
//            info("order id : ");
//        info($orderId);

        // 3. Call PayPal to get the transaction details
       try {
           $client = PayPalClient::client();
           $response = $client->execute(new OrdersGetRequest($orderId));
       }catch (\Throwable $th) {
           return  $th;
       }

        info(collect($response)->toJson());
        /**
         *Enable the following line to print complete response as JSON.
         */
        //print json_encode($response->result);
        $print = "Status Code: {$response->statusCode}\n";
        $print .= "Status: {$response->result->status}\n";
        $print .= "Order ID: {$response->result->id}\n";
        $print .= "Intent: {$response->result->intent}\n";
        $print .= "Links:\n";
        foreach($response->result->links as $link)
        {
            $print .= "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
        }
        // 4. Save the transaction in your database. Implement logic to save transaction to your database for future reference.
        $print .= "Gross Amount: {$response->result->purchase_units[0]->amount->currency_code} {$response->result->purchase_units[0]->amount->value}\n";
//        Order::create([
//
//            'user_id' => auth()->user()->id,
//            'proc_id' => 159,
//            'comb_id' => 0,
//            'paypal_id' => $orderId,
//            'amount'  => 1,
//             'tests_left' => 1,
//             'expires_at' =>   date("l jS \of F Y h:i:s A")
//        ]);
        // To print the whole response body, uncomment the following line
        // echo json_encode($response->result, JSON_PRETTY_PRINT);
        return $print ;
    }
}

/**
 *This driver function invokes the getOrder function to retrieve
 *sample order details.
 *
 *To get the correct order ID, this sample uses createOrder to create a new order
 *and then uses the newly-created order ID with GetOrder.
 */
if (!count(debug_backtrace()))
{
    GetOrder::getOrder('REPLACE-WITH-ORDER-ID', true);
}
?>

