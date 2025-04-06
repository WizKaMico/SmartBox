
<?php 
$total =  $lockerResult[0]['price'] * 24;
?>
<div class="container d-flex flex-column flex-fill text-white fs-3 px-5 py-4" style="max-width: 768px; background-image: url('../../public/assets/images/bg.jpg'); background-size: cover;">
        <div class="d-flex justify-content-between">
            <a href="?view=HOME" class="text-white"><i class="bi bi-chevron-left"></i></a>
            <div id="currentTime"></div>
        </div>
        <div class="d-flex flex-fill align-items-center justify-content-center px-5">
            <form method="POST" action="?action=RENT" class="w-100">
            <!--<div class="w-100">-->
                <div class="text-center mb-4">
                    <h1 class="fw-bold border-bottom pb-5">
                        <?php echo $lockerResult[0]['locker'].' Locker';  ?>
                    </h1>
                </div>

                <div class="mb-2">
                    <label class="text-light fs-6">NAME</label>
                    <input type="text" name="name" class="form-control fs-4" id="name" placeholder="Account Name" required>
                </div>
                <div class="mb-2">
                    <label class="text-light fs-6">EMAIL</label>
                    <input type="email" name="email" class="form-control fs-4" id="email" placeholder="Account Email" required>
                </div>
                <div class="mb-2 border-bottom pb-5">
                    <label class="text-light fs-6">PHONE NUMBER</label>
                    <input type="tel" name="phone" class="form-control fs-4" id="phone" placeholder="Account Phone" required inputmode="numeric" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                </div>

                <div class="d-flex justify-content-between mb-2 w-100">
                    <div class="fw-bold" id="sizeDisplay"><?php echo $lockerResult[0]['size']; ?></div>
                    <div class="fw-bold">₱ <?php echo $total; ?></div>
                </div>

                <div class="d-flex justify-content-between mb-2 w-100">
                    <div class="fw-bold" id="sizeDisplay">Hourly Rate</div>
                    <div class="fw-bold">₱ <?php echo $lockerResult[0]['price'];  ?></div>
                </div>

                <div class="mb-2">
                    <input type="hidden" name="locker_id" value="<?php echo $lockerResult[0]['id']; ?>" />
                    <label for="timeSelect" class="text-start text-light mb-2">Select a time</label>
                    <select name="hours" class="rounded p-2 w-100" id="timeSelect">
                        <?php for ($i = 24; $i <= 24; $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?> Hour<?= $i > 1 ? 's' : '' ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="mb-5">
                    <label class="text-start text-light mb-2">Payment method</label>
                    <div class="fw-bold">GCash</div>
                    <input type="hidden" name="payment" value="GCash" />
                </div>

                <button type="submit" class="btn btn-dark border rounded-pill fs-3 w-100" name="submit">PAY NOW</button>
            </form>
            <!--</div>-->
        </div>
    </div>