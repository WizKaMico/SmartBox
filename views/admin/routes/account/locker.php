<div class="px-4 overflow-auto" style="max-height: calc(100vh);">
    <div class="row g-3 mb-4">
        <div class="row g-3">
            <div class="col-12">
                <div class="bg-white rounded shadow-sm mb-4 p-4">
                <a href="#lockerCreate" class="btn btn-success" data-toggle="modal" data-backdrop="false">Create New Locker</a>
                <hr />
                <table id="accountLockerTable" class="table table-borderless">
                    <thead>
                        <tr>
                            <th>LockerId</th>
                            <th>Locker</th>
                            <th>Size</th>
                            <th>Dimension</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                          $lockers = $portCont->lockers();
                            if (!empty($lockers)) {
                              foreach ($lockers as $key => $lockers) {
                        ?>
                        <tr>
                            <td><?php echo $lockers['id']; ?></td>
                            <td><?php echo $lockers['locker']; ?></td>
                            <td><?php echo $lockers['size']; ?></td>
                            <td><?php echo $lockers['dimension']; ?></td>
                            <td>₱ <?php echo $lockers['price']; ?></td>
                            <td><?php echo $lockers['status']; ?></td>
                            <td>
                               <!-- Locker Edit Trigger Button -->
                               <a href="#lockeredit_<?php echo $lockers['id']; ?>" class="btn btn-success" data-toggle="modal" data-backdrop="false"><i class="fa fa-edit"></i> Edit</a>
                                <a  href='#lockerdelete_<?php echo $lockers['id']; ?>' class="btn btn-danger" data-toggle='modal' data-backdrop='false'><i class="fa fa-trash"></i> Delete</a>
                            </td>
                        
                        </tr>
                        <?php include('../modal/modal.php'); ?>
                        <?php } } ?>
                    </tbody>
                </table>

                </div>
            </div>
        </div>
    </div>
</div>