<div class="px-4 overflow-auto" style="max-height: calc(100vh);">
   <div class="row g-3 mb-4">
        <div class="row g-3">
            <div class="col-12">
                <div class="bg-white rounded shadow-sm mb-4 p-4">
                    <table id="accountLockerTable" class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Locker</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Size</th>
                                    <th>Amount</th>
                                    <th>Total</th>
                                    <th>Hours</th>
                                    <th>Date</th>
                                    <th>Start</th>
                                    <th>End</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $report = $portCont->smartReport();
                                if (!empty($report)) {
                                    foreach ($report as $key => $report) {
                                ?>
                                <tr>
                                    <td><?php echo $report['locker']; ?></td>
                                    <td><?php echo $report['name']; ?></td>
                                    <td><?php echo $report['email']; ?> | <?php echo $report['phone']; ?></td>
                                    <td><?php echo $report['size']; ?></td>
                                    <td>₱ <?php echo $report['price']; ?></td>
                                    <td>₱ <?php echo $report['total']; ?></td>
                                    <td><?php echo $report['hours']; ?></td>
                                    <td><?php echo $report['date_created']; ?></td>
                                    <td><?php echo $report['date_start']; ?></td>
                                    <td><?php echo $report['date_end']; ?></td>    
                                
                                </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
           </div>
       </div>
    </div>
</div>