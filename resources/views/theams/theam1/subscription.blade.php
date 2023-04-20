<!DOCTYPE html>
<html>
<title>Razorpay</title>
<body>


<script src = "https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  var options = {
    "key": "{{ $account->razorPayApiKey }}",
    "subscription_id": "sub_HLjAvoZwaDy2OC",
    "name": "{{ $account->title }}",
    "description": "Payment to {{ $account->domain }}",
    "image": "https://{{ $account->domain.'/'.$account->logo }}",
    "callback_url": "https://eneqd3r9zrjok.x.pipedream.net/",
    "prefill": {
      "name": "{{ $register->name }}",
      "email": "{{ $register->email }}",
      "contact": "{{ $register->phone }}"
    },
    "theme": {
      "color": "#F37254"
    }
  };
var rzp1 = new Razorpay(options);

  rzp1.open();
  e.preventDefault();

</script>

</body>
</html>