<div class="px-4 overflow-auto" style="max-height: calc(100vh);">
    <div class="row g-3 mb-4">
        <div class="row g-3">
            <div class="col-12">
                <div class="bg-white rounded shadow-sm mb-4 p-4">
                <a href="#userCreate" class="btn btn-success" data-toggle="modal" data-backdrop="false">Create New User</a>
                <hr />
                <table id="accountLockerTable" class="table table-borderless">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Profile</th>
                            <th>Fullname</th>
                            <th>Contact</th>
                            <th>Status</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                          $user = $portCont->smart_users();
                            if (!empty($user)) {
                              foreach ($user as $key => $user) {
                        ?>
                        <tr>
                            <td><?php echo $user['user_id']; ?></td>
                            <td><?php echo $user['image']; ?></td>
                            <td><?php echo $user['firstname']; ?> <?php echo $user['lastname']; ?></td>
                            <td><?php echo $user['contact']; ?></td>
                            <td><?php echo $user['status']; ?></td>
                            <td>
                               <!-- Locker Edit Trigger Button -->
                               <a href="#useredit_<?php echo $user['user_id']; ?>" class="btn btn-success" data-toggle="modal" data-backdrop="false"><i class="fa fa-edit"></i> Edit</a>
                               <a href='#userdelete_<?php echo $user['user_id']; ?>' class="btn btn-danger" data-toggle='modal' data-backdrop='false'><i class="fa fa-trash"></i> Delete</a>
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