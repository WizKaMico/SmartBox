<div class="container d-flex flex-column text-white px-5 py-4" style="max-width: 768px; background-image: url('../../public/assets/images/bg.jpg'); background-size: cover;">
        <div class="d-flex justify-content-between">
            <a href="?view=CONFIRMATION&code=<?php echo $_GET['code']; ?>" class="text-white fs-3"><i class="bi bi-chevron-left"></i></a>
            <div></div>
        </div>
        <form method="GET" action="#" class="d-flex flex-fill flex-column align-items-center justify-content-center px-5">
            <img src="../../public/assets/images/gcash.png" class="mb-4 w-75" alt="GCash Logo">
            <h1 class="fw-bold mb-5">SCAN TO PAY HERE</h1>
            <div class="d-flex justify-content-center rounded-5 bg-white mb-5 p-4 w-50">
                <?php include('../../public/assets/payment/pay.php'); ?>
                <canvas class="w-100" id="qr-code"></canvas>
            </div>
            <input type="hidden" name="account_id" value="<?php echo $lockerAccountResult[0]['account_id']; ?>" />
            <input type="hidden" name="source_id" value="<?php echo $sourceId; ?>" />
                <?php 
                $pay = $portCont->accountPaymentDetailsView($code); 
                if (!empty($pay)) {
                    if ($pay[0]['status'] == 'SUCCESS') { 
                ?>
                <a href="?view=SETUPPIN&code=<?php echo $_GET['code']; ?>" class="btn btn-dark border rounded-pill fs-3 w-75" id="setButton">SET YOUR 6-DIGIT PIN</a>
                <?php } } ?>
        </form>
    </div>

    <script src="https://cdn.rawgit.com/neocotic/qrious/master/dist/qrious.min.js"></script>
    <script>
        const qr = new QRious({
            element: document.getElementById('qr-code'),
            size: 400,
        });

        qr.value = "<?php echo $checkoutUrl; ?>"
    </script>