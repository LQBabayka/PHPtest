<?php
//home controller
//session()->put('shortname', $contragenty->shortname ?? '');


function getSSL() {
    $url = "https://demodostup.hserm.ru/home";

    $orignal_parse = parse_url($url, PHP_URL_HOST);
    $get = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE)));
    $read = stream_socket_client(
        "ssl://" . $orignal_parse . ":443",
        $errno,
        $errstr,
        30,
        STREAM_CLIENT_CONNECT,
        $get
    );
    $cert = stream_context_get_params($read);
    $certinfo = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);
    // $valid_from = date(DATE_RFC2822, $certinfo['validFrom_time_t']);
    // $valid_to = date(DATE_RFC2822, $certinfo['validTo_time_t']);

    // dd(date(DATE_RFC2822, $certinfo['validTo_time_t']));
    // dd(date('r'));

    $sslDay = date_create(date(DATE_RFC2822, $certinfo['validTo_time_t'])); //2022-10-02 02:59:59.0 +03:00
    $toDay = date_create(date('r'));                                        //2022-09-30 12:48:53.0 +03:00
// dd($sslDay, $toDay);

    $interval = date_diff($toDay, $sslDay);
// echo $interval->format('%R%a дней');
// dd($interval->format('%d')); //строка, кол-во дней
//echo "<script>alert('alert php')</script>";

?>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js">
</script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js">
</script>
<script>
    // alert('Осталось ' +  <?php echo $interval->format('%d')?>  + ' дней');
    $(document).ready(function() {
console.log("document.ready");
toastr.warning('Осталось ' +  <?php echo $interval->format('%d')?>  + ' дней');
});

$(window).load(function() {
console.log("window.load");
toastr.info('window.load');
});
</script>
<?php
}
// getSSL();

function getAllSSL() {
    $urls = array("https://demodostup.hserm.ru/home", "https://pravo-ros.ru/", "https://hseblog.ru/", "https://mymedprofi.ru/");

    foreach ($urls as $value) {

        $orignal_parse = parse_url($value, PHP_URL_HOST);
    $get = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE)));
    $read = stream_socket_client(
        "ssl://" . $orignal_parse . ":443",
        $errno,
        $errstr,
        30,
        STREAM_CLIENT_CONNECT,
        $get
    );
    $cert = stream_context_get_params($read);
    $certinfo = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);
    $sslDay = date_create(date(DATE_RFC2822, $certinfo['validTo_time_t']));

    $sslDay = date_create(date(DATE_RFC2822, $certinfo['validTo_time_t']));
    $toDay = date_create(date('r'));
    $interval = date_diff($toDay, $sslDay);
    // dd($value, $sslDay);
    // echo $value . ' is ' . $interval->format('%d');

    ?>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js">
</script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js">
</script>

<script>
    $(document).ready(function() {
console.log("document.ready");
toastr.warning(' осталось ' +  <?php echo $interval->format('%d');?>  + ' дней');
});
</script>
<?php

    }
}
getAllSSL();