<div class="px-4 overflow-auto" style="max-height: calc(100vh);">
    <div class="row g-3 mb-4">
        <div class="row g-3">
            <div class="col-12">
                <div class="bg-white rounded shadow-sm mb-4 p-4">
                <table id="accountLockerTable" class="table table-borderless">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Profile</th>
                            <th>Fullname</th>
                            <th>Contact</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                          $user = $portCont->smart_checkLogs();
                            if (!empty($user)) {
                              foreach ($user as $key => $user) {
                        ?>
                        <tr>
                            <td><?php echo $user['user_id']; ?></td>
                            <td><?php echo $user['image']; ?></td>
                            <td><?php echo $user['firstname']; ?> <?php echo $user['lastname']; ?></td>
                            <td><?php echo $user['contact']; ?></td>
                            <td><?php echo $user['status']; ?></td>
                        
                        </tr>
                        <?php } } ?>
                    </tbody>
                </table>

                </div>
            </div>
        </div>
    </div>
</div>