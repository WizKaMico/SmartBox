<div class="container d-flex flex-column text-white px-5 py-4" id="myDiv" style="max-width: 768px; background-image: url('../../public/assets/images/bg.jpg'); background-size: cover;">
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
            <div id="setPinBtnContainer" class="mt-2"></div>
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

<script>
  function checkPaymentStatus() {
    fetch('../../wapi/api/setPinApi.php?code=<?php echo $_GET["code"]; ?>')
      .then(response => response.json())
      .then(data => {
        if (data.status === "success" && data.data.length > 0) {
          const paymentStatus = data.data[0].status;
          
          if (paymentStatus === "SUCCESS") {
            const container = document.getElementById('setPinBtnContainer');
            
            // Only insert button if it's not already there
            if (!document.getElementById('setButton')) {
              container.innerHTML = `
                <a href="?view=SETUPPIN&code=<?php echo $_GET['code']; ?>" 
                   class="btn btn-dark border rounded-pill fs-3 w-100" 
                   id="setButton">
                  SET 6-DIGIT PIN
                </a>
              `;
            }
          }
        }
      })
      .catch(error => {
        console.error('Error fetching payment status:', error);
      });
  }

  // Call every 1 second
  setInterval(checkPaymentStatus, 1000);
</script>
