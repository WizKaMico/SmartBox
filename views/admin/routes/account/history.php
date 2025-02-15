<div class="px-4 overflow-auto" style="max-height: calc(100vh);">
    <div class="row g-3 mb-4">
        <div class="row g-3">
            <div class="col-12">
                <div class="bg-white rounded shadow-sm mb-4 p-4">
                <table id="accountLockerTable" class="table table-borderless">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Activity</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                          $user = $portCont->smart_usershistory($user_id);
                            if (!empty($user)) {
                              foreach ($user as $key => $user) {
                        ?>
                        <tr>
                            <td><?php echo $user['sid']; ?></td>
                            <td><?php echo $user['activity']; ?></td>
                            <td><?php echo $user['date_created']; ?></td>
                        
                        </tr>
                        <?php } } ?>
                    </tbody>
                </table>

                </div>
            </div>
        </div>
    </div>
</div>