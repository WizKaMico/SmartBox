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
<div class="modal fade" id="useredit_<?php echo $user['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <button type="submit" name="edit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Update</button>
            </div>
        </div>
    </div>
</div>

<!-- User Delete Modal -->
<div class="modal fade" id="userdelete_<?php echo $user['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <button type="submit" name="edit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Confirm</button>
            </div>
        </div>
    </div>
</div>
