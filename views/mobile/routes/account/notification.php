<div class="container d-flex flex-column align-items-center fs-4 p-4" style="max-width: 480px; background-image: url('../../../public/assets/images/bg.jpg'); background-size: cover;">
        <div class="d-flex align-itmes-center justify-content-between w-100">
            <a href="?view=HOME" class="text-white"><i class="bi bi-arrow-left"></i></a>
            <div class="fw-bold">Notifications</div>
            <div></div>
        </div>
        <?php if($notifCount[0]['notif'] > 0) { ?>
            <?php 
                $result = $portCont->myNotifList($account_id); 
                if(!empty($result)) {
                    foreach ($result as $key => $value) {
            ?>
            <div class="notif-box bg-dark rounded-3 text-start p-3 w-100 mt-3">
                <label for="" class="fw-bold mb-1">Activity: <?php echo $value['activity']; ?></label>
                <div class="d-flex justify-content-between">
                    <div class="text-light">
                        <div class="mb-1">Date:</div>
                    </div>
                    <div class="text-end">
                        <div class="mb-1"><?php echo $value['DATE(loggedDate)']; ?></div>
                    </div>
                </div>
            </div>
            <?php } } ?>
        <?php }else{ ?>
        <div class="d-flex flex-fill flex-column align-items-center justify-content-center text-center">
            <img src="../../../public/assets/images/notifications.png" class="mb-3">
            <h2 class="fw-bold mb-2">No notifications yet</h2>
            <div class="text-light fs-6">Your notification will appear here<br>once you’ve received them.</div>
        </div>
        <?php } ?>
    </div>
