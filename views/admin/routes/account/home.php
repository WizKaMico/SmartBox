<div class="px-4 overflow-auto" style="max-height: calc(100vh);">
    <div class="row g-3 mb-4">

        <div class="col-4">
            <div class="bg-white p-4 rounded shadow-sm">
                <div>Active Rentals</div>
                <div class="fs-1 fw-bold"><?php echo $activeRent[0]['total']; ?></div>
            </div>
        </div>

        <div class="col-4">
            <div class="bg-white p-4 rounded shadow-sm">
                <div>Profit</div>
                <div class="fs-1 fw-bold">₱ <?php echo $activeProfit[0]['total']; ?></div>
            </div>
        </div>

        <div class="col-4">
            <div class="bg-white p-4 rounded shadow-sm">
                <div>Total Rentals Today</div>
                <div class="fs-1 fw-bold"><?php echo $activeRent[0]['total']; ?></div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6">
            <div class="bg-white py-4 ps-4 rounded shadow-sm">
                <div class="mb-2">Lockers</div>
                <div class="d-flex">
                    <div class="overflow-auto w-100" style="max-height: calc(25vh + 20px);">
                        <table id="lockerTable" class="table table-borderless">
                            <thead style="position: sticky; top: 0; z-index: 1;">
                            <tr>
                                <th>Locker</th>
                                <th>Size</th>
                                <th>Dimension</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php 
                                    $lockers = $portCont->lockers();
                                    if (!empty($lockers)) {
                                    foreach ($lockers as $key => $locker) {
                                ?>
                                    <td><?php echo $locker['locker']; ?></td>
                                    <td><?php echo $locker['size']; ?></td>
                                    <td><?php echo $locker['dimension']; ?></td>
                                    <td><?php echo $locker['status']; ?></td>
                               
                                <?php } } ?>
                            </tr>
                            </tbody>
                        </table>
                    </div>


                    <div class="d-flex justify-content-center w-50">
                        <div>
                            <div class="mb-2">
                                <div>Available</div>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="legend-dot bg-success"></div>
                                    <span class="fs-4 fw-bold"></span>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div>Unavailable</div>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="legend-dot bg-secondary"></div>
                                    <span class="fs-4 fw-bold"></span>
                                </div>
                            </div>
                            <div>
                                <div>Occupied</div>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="legend-dot bg-danger"></div>
                                    <span class="fs-4 fw-bold"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="bg-white p-4 rounded shadow-sm">
                <div class="mb-3">Usage</div>
                <div class="overflow-auto w-100" style="max-height: calc(25vh + 10px);">
                    <canvas id="usageChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

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
