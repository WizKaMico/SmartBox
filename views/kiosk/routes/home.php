<div class="container d-flex flex-column justify-content-center text-center text-white fs-3 px-5 py-4" style="max-width: 768px; background-image: url('../../public/assets/images/bg.jpg'); background-size: cover;">
<h1 class="fw-bold mb-5">Available Lockers</h1>
    <div class="px-5">
         <div class="row g-4 mb-4">
         <?php 
            $lockers = $portCont->lockers();
            if (!empty($lockers)) {
              foreach ($lockers as $key => $locker) {
         ?>
         <div class="col-6">
            <a href="?view=RENT&locker=<?php echo $locker['id']; ?>&price=<?php echo $locker['price']; ?>" 
            class="box  <?php echo getLockerClass($locker['status']); ?>" style="height: 15rem;">
            <?php echo str_pad($locker['locker'], 3, '0', STR_PAD_LEFT); ?><?php echo "<br>".$locker['size']; ?></a>
         </div>
         <?php } }else{ ?>
            <div class='col-12'>No lockers found.</div>
         <?php } ?>
         </div>
    </div>
</div>


<?php
function getLockerClass($status)
{
    switch (strtolower($status)) {
        case 'available':
            return 'available';
        case 'occupied':
            return 'occupied disabled';
        case 'unavailable':
            return 'unavailable disabled';
        default:
            return '';
    }
}
?>