<div class="px-4 overflow-auto" style="max-height: calc(100vh);">
    <div class="row g-3 mb-4">
        <div class="row g-3">
            <div class="col-12">
                <div class="bg-white rounded shadow-sm mb-4 p-4">
                <table id="accountLockerTable" class="table table-borderless">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Contact </th>
                            <th>Email</th>
                            <th>Locker</th>
                            <th>Payment</th>
                            <th>Reference Number</th>
                            <th>Session</th>
                            <th>Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                          $payTrans = $portCont->payment_transaction();
                            if (!empty($payTrans)) {
                              foreach ($payTrans as $key => $payTrans) {
                        ?>
                        <tr>
                            <td><?php echo $payTrans['name']; ?></td>
                            <td><?php echo $payTrans['phone']; ?></td>
                            <td><?php echo $payTrans['email']; ?></td>
                            <td>Locker <?php echo $payTrans['locker']; ?></td>
                            <td>₱ <?php echo $payTrans['price']; ?></td>
                            <td><?php echo $payTrans['reference']; ?></td>
                            <td><?php echo $payTrans['session']; ?></td>
                            <td><?php echo $payTrans['date_created']; ?></td>
                        </tr>
                        <?php } } ?>
                    </tbody>
                </table>

                </div>
            </div>
        </div>
    </div>
</div>