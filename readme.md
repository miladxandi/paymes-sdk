
# Simple run for Laravel
```
// Enter the details of the payment
$data = [
    'orderId' => '1',
    'price' => '1000',
    'currency' => 'TRY',
    'productName' => "Jascket",
    'buyerName' => "User Name",
    'buyerPhone' => "+1123457890",
    'buyerEmail' => "username@example.com",
    'buyerAddress' => "Temcula Road, California, Los Angeles",
    'create_order_by_kiosk' => false,
];


//set default configurations
$paymes = new OrdersService('PUBLIC_KEY','SECRET_KEY');


//generate payment link
$result = $paymes->create($data);


//redirect to payment page
return redirect($result['returnUrl']);
```