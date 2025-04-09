<!-- Create Locker -->
<div class="modal fade" id="lockerCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="POST" action="?view=LOCKER&action=ADDLOCKER">
            <div class="modal-header">
                <h5>Create Locker</h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                <div class="form-group">
                    <label for="exampleInputEmail1">Locker</label>
                    <input type="text" class="form-control" name="locker" required="">
                </div>
                <div class="form-group mt-2">
                    <label for="exampleInputEmail1">Size</label>
                    <select class="form-control" name="size" required="">
                       <option value="Small">Small</option>
                       <option value="Medium">Medium</option>
                       <option value="Large">Large</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <label for="exampleInputEmail1">Dimension</label>
                    <input type="text" class="form-control" name="dimension" required="">
                </div>
                <div class="form-group mt-2">
                    <label for="exampleInputEmail1">Status</label>
                    <select class="form-control" name="status" required="">
                       <option value="Available">Available</option>
                       <option value="Occupied">Occupied</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <label for="exampleInputEmail1">Price</label>
                    <input type="number" class="form-control" name="price" required="">
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="create" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Create</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- Create Locker -->


<!-- Locker Edit Modal -->
<div class="modal fade" id="lockeredit_<?php echo $lockers['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="POST" action="?view=LOCKER&action=UPDATELOCKERPRICE">
            <div class="modal-header">
                 <h5> Edit Locker</h5>
            </div>
            <div class="modal-body">
            <div class="container-fluid">
                <div class="form-group">
                    <label for="exampleInputEmail1">Locker</label>
                    <input type="hidden" class="form-control" name="id" value="<?php echo $lockers['id']; ?>" readonly="">
                    <input type="text" class="form-control" name="locker" value="<?php echo $lockers['locker']; ?>" readonly="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Size</label>
                    <input type="text" class="form-control" name="size" value="<?php echo $lockers['size']; ?>"  readonly="">
                </div>
                <div class="form-group mt-2">
                    <label for="exampleInputEmail1">Dimension</label>
                    <input type="text" class="form-control" name="dimension" value="<?php echo $lockers['dimension']; ?>" readonly="">
                </div>
                <div class="form-group mt-2">
                    <label for="exampleInputEmail1">Status</label>
                    <input type="text" class="form-control" name="status" value="<?php echo $lockers['status']; ?>" readonly="">
                </div>
      
                <div class="form-group mt-2">
                    <label for="exampleInputEmail1">Price</label>
                    <input type="text" class="form-control" name="price" value="<?php echo $lockers['price']; ?>" required="">
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="edit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Update</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Locker Delete Modal -->
<div class="modal fade" id="lockerdelete_<?php echo $lockers['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="POST" action="?view=LOCKER&action=DELETELOCKER">
            <div class="modal-header">
               <h5>Delete Locker | Locker <?php echo $lockers['locker']; ?></h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- Modal content here -->
                    <input type="hidden" class="form-control" name="id" value="<?php echo $lockers['id']; ?>" readonly="">
                    <h5 style="text-align:center;">Are you sure you want to delete this ? </h5>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="delete" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Confirm</button>
            </div>
        </form>
        </div>
    </div>
</div>


<div class="modal fade" id="lockerstatus_<?php echo $lockers['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="POST" action="?view=LOCKER&action=STATUSLOCKER">
            <div class="modal-header">
               <h5>Status Locker | Locker <?php echo $lockers['locker']; ?></h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- Modal content here -->
                    <input type="hidden" class="form-control" name="id" value="<?php echo $lockers['id']; ?>" readonly="">
                    <select class="form-control" name="status" required="">
                            <option value="<?php echo $lockers['status']; ?>"><?php echo strtoupper($lockers['status']); ?> (CURRENT)</option>
                            <option value="AVAILABLE">AVAILABLE</option>
                            <option value="UNAVAILABLE">UNAVAILABLE</option>
                            <option value="OCCUPIED">OCCUPIED</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="edit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Confirm</button>
            </div>
        </form>
        </div>
    </div>
</div>





<!-- Create User -->
<div class="modal fade" id="userCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- Modal content here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="edit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Create</button>
            </div>
        </div>
    </div>
</div>
<!-- Create Locker -->


<!-- User Edit Modal -->
<div class="modal fade" id="adminuseredit_<?php echo $user['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="POST" action="?view=ADMIN&action=UPDATEADMIN">
            <div class="modal-header">
               <h5>User Edit : <?php echo $user['user_id']; ?></h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Firstname</label>
                        <input type="hidden" class="form-control" name="user_id" value="<?php echo $user['user_id']; ?>" readonly="">
                        <input type="text" class="form-control" name="firstname" value="<?php echo $user['firstname']; ?>" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Lastname</label>
                        <input type="text" class="form-control" name="lastname" value="<?php echo $user['lastname']; ?>"  required="">
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleInputEmail1">Contact</label>
                        <input type="text" class="form-control" name="contact" value="<?php echo $user['contact']; ?>" readonly="">
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" class="form-control" name="email" value="<?php echo $user['email']; ?>" readonly="">
                    </div>
        
                    <div class="form-group mt-2">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="text" class="form-control" name="password" value="<?php echo $user['unhashed']; ?>" required="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="edit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Update</button>
            </div>
        </form>
        </div>
    </div>
</div>


<!-- User Edit Modal -->
<div class="modal fade" id="adminuserimage_<?php echo $user['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="POST" action="?view=ADMIN&action=UPDATEADMINIMAGE" enctype="multipart/form-data">
            <div class="modal-header">
               <h5>User Edit  Image: <?php echo $user['user_id']; ?></h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Profile</label>
                        <img src="../users/upload/<?php echo $user['image']; ?>" style="width:100%;"/>
                        <hr />
                        <input type="hidden" class="form-control" name="user_id" value="<?php echo $user['user_id']; ?>" readonly="">
                        <input type="file" name="image" class="form-control border-secondary w-100" required="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="edit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Update</button>
            </div>
        </form>
        </div>
    </div>
</div>



<!-- User Modal -->
<div class="modal fade" id="adminuserStatus_<?php echo $user['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="POST" action="?view=ADMIN&action=UPDATESTATUS">
            <div class="modal-header">
               <h5>User Edit Status: <?php echo $user['user_id']; ?></h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- Modal content here -->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Status</label>
                        <input type="hidden" class="form-control" name="user_id" value="<?php echo $user['user_id']; ?>" readonly="">
                        <select class="form-control" name="staff_status" required="">
                            <option value="<?php echo $user['staff_status']; ?>"><?php echo $user['staff_status']; ?> (CURRENT)</option>
                            <option value="INACTIVE">INACTIVE</option>
                            <option value="ACTIVE">ACTIVE</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="edit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Confirm</button>
            </div>
        </form>
        </div>
    </div>
</div>


<!-- user staff -->




<!-- User Edit Modal -->
<div class="modal fade" id="staffuseredit_<?php echo $user['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="POST" action="?view=STAFF&action=UPDATEADMIN">
            <div class="modal-header">
               <h5>User Edit : <?php echo $user['user_id']; ?></h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Firstname</label>
                        <input type="hidden" class="form-control" name="user_id" value="<?php echo $user['user_id']; ?>" readonly="">
                        <input type="text" class="form-control" name="firstname" value="<?php echo $user['firstname']; ?>" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Lastname</label>
                        <input type="text" class="form-control" name="lastname" value="<?php echo $user['lastname']; ?>"  required="">
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleInputEmail1">Contact</label>
                        <input type="text" class="form-control" name="contact" value="<?php echo $user['contact']; ?>" readonly="">
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" class="form-control" name="email" value="<?php echo $user['email']; ?>" readonly="">
                    </div>
        
                    <div class="form-group mt-2">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="text" class="form-control" name="password" value="<?php echo $user['unhashed']; ?>" required="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="edit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Update</button>
            </div>
        </form>
        </div>
    </div>
</div>


<!-- User Edit Modal -->
<div class="modal fade" id="staffuserimage_<?php echo $user['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="POST" action="?view=STAFF&action=UPDATEADMINIMAGE" enctype="multipart/form-data">
            <div class="modal-header">
               <h5>User Edit  Image: <?php echo $user['user_id']; ?></h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Profile</label>
                        <img src="../users/upload/<?php echo $user['image']; ?>" style="width:100%;"/>
                        <hr />
                        <input type="hidden" class="form-control" name="user_id" value="<?php echo $user['user_id']; ?>" readonly="">
                        <input type="file" name="image" class="form-control border-secondary w-100" required="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="edit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Update</button>
            </div>
        </form>
        </div>
    </div>
</div>



<!-- User Modal -->
<div class="modal fade" id="staffuserStatus_<?php echo $user['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="POST" action="?view=STAFF&action=UPDATESTATUS">
            <div class="modal-header">
               <h5>User Edit Status: <?php echo $user['user_id']; ?></h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- Modal content here -->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Status</label>
                        <input type="hidden" class="form-control" name="user_id" value="<?php echo $user['user_id']; ?>" readonly="">
                        <select class="form-control" name="staff_status" required="">
                            <option value="<?php echo $user['staff_status']; ?>"><?php echo $user['staff_status']; ?> (CURRENT)</option>
                            <option value="INACTIVE">INACTIVE</option>
                            <option value="ACTIVE">ACTIVE</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="edit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Confirm</button>
            </div>
        </form>
        </div>
    </div>
</div>


<div class="modal fade" id="staffuserDelete_<?php echo $user['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="POST" action="?view=STAFF&action=DELETESTAFF">
            <div class="modal-header">
               <h5>User Edit Status: <?php echo $user['user_id']; ?></h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- Modal content here -->
                    <div class="form-group">
                        <h5 style="text-align:center;">Are you sure you want to delete this staff </h5>
                        <input type="hidden" class="form-control" name="user_id" value="<?php echo $user['user_id']; ?>" readonly="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="edit" class="btn btn-danger"><span class="glyphicon glyphicon-check"></span> Delete</button>
            </div>
        </form>
        </div>
    </div>
</div>

