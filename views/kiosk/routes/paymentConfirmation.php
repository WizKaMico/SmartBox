<div class="container d-flex flex-column text-white px-5 py-4" style="max-width: 768px; background-image: url('../../public/assets/images/bg.jpg'); background-size: cover;">
        <form method="GET" action="#" class="d-flex flex-fill flex-column align-items-center justify-content-center px-5">
            <img src="../../public/assets/images/gcash.png" class="mb-4 w-75" alt="GCash Logo">
            <h1 class="fw-bold mb-5">PAYMENT <?php echo $status; ?></h1>
            <h5 class="fw-bold mb-5">REF : <?php echo strtoupper($result[0]['src_link']); ?></h5>
        </form>
    </div>

