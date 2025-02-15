<div class="container d-flex flex-column text-white fs-3 px-5 py-4" style="max-width: 768px; background-image: url('../../public/assets/images/bg.jpg'); background-size: cover;">
        <div class="d-flex justify-content-between">
            <a href="?view=SETUPPIN&code=<?php echo $_GET['code']; ?>" class="text-white"><i class="bi bi-chevron-left"></i></a>
            <div></div>
        </div>
        <div class="d-flex flex-column flex-fill align-items-center justify-content-center px-5">
            <h1 class="fw-bold mb-2" style="font-size: 4rem;"><i>SCAN HERE</i></h1>
            <div class="mb-4">To Access Your Locker!</div>
            <div class="d-flex justify-content-center border rounded-5 bg-white mb-5 p-4 w-50">
               <canvas class="w-100" id="qr-code"></canvas>
            </div>
            <button class="btn btn-dark border rounded-pill fs-3 w-75" id="BackButton" onclick="window.location.href='?view=SETUPPIN&code=<?php echo $_GET['code']; ?>'">Back</button>
        </div>
    </div>

    <script src="https://cdn.rawgit.com/neocotic/qrious/master/dist/qrious.min.js"></script>
    <script>
        const qr = new QRious({
            element: document.getElementById('qr-code'),
            size: 400,
        });

        qr.value = "http://localhost/smart/views/mobile/?view=HOME&code=<?php echo $code; ?>"
    </script>