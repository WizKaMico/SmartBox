<div class="container d-flex flex-column align-items-center p-4" style="max-width: 480px; background-image: url('../../../public/assets/images/bg.jpg'); background-size: cover;">
        <div class="d-flex align-items-center justify-content-between mb-3 w-100">
        <a href="?view=NOTIFICATION" class="text-white fs-4 mb-2 position-relative">
        <i class="bi bi-bell-fill"></i>
        <!-- Notification badge -->
        <span class="badge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            <?php echo $notifCount[0]['notif']; ?>
        </span>
        </a>

            <h2 class="fw-bold ms-3">SmartLocker</h2>
            <a href="?view=LOGOUT&message=logout" class="text-white fs-4 mb-1 me-1"><i class="bi bi-box-arrow-left"></i></a>
        </div>
        <div class="d-flex align-items-center justify-content-center bg-black mb-3 px-4 py-3 w-100" style="min-width: 390px">
            <div class="d-flex justify-content-between rounded-1 bg-dark px-3 py-2 w-100">
                <div class="fw-bold"><?php echo $account[0]['fullname']; ?></div>
                <div><?php echo $account[0]['phone'];  ?></div>
            </div>
        </div>
        <h1 class="fw-bold" style="font-size: 3rem;"><?php echo $account[0]['locker']; ?></h1>
        <div class="text-light mb-4">Locker</div>

        <?php
        $status =  isset($account[0]['lockerStat']) && $account[0]['lockerStat'] !== '' ? $account[0]['lockerStat'] : 'unlocked';
        if ($status === 'unlocked') {
            $actionLabel = "Touch to Lock";
            $statusValueClass = "status-unlocked";
            $statusValueText = "Un-Locked";
        } else {
            $actionLabel = "Touch to Unlock";
            $statusValueClass = "status-locked";
            $statusValueText = "Locked";
        }
        ?>

       <form action="?view=HOME&action=LOCKER" method="POST">
        <button class="d-flex align-items-center justify-content-center bg-dark rounded-circle text-white fs-1 mb-4" name="locker" id="lockButton">
            <i class="bi bi-<?= $status === 'locked' ? 'lock-fill' : 'unlock-fill' ?>" id="lockIcon"></i>
        </button>
       </form>

        <div class="text-light mb-5" id="actionLabel"><?= $actionLabel ?></div>

        <div class="bg-dark rounded-3 text-start p-3 w-100">
            <label for="" class="fw-bold mb-1">Locker <?php echo $account[0]['locker']; ?></label>
            <div class="d-flex justify-content-between">
                <div class="text-light">
                    <div class="mb-1">Size : </div>
                    <div class="mb-1">Status:</div>
                    <div class="mb-1">From:</div>
                    <div>Until:</div>
                </div>
                <div class="text-end">
                    <?php
                    $startDate = date_create();
                    $endDate = date_create();

                    $startDate = date_create($account[0]['DateStart']);
                    $endDate = date_create($account[0]['EndDate']);

                    $timezone = new DateTimeZone('Asia/Manila');
                    $startDate->setTimezone($timezone);
                    $endDate->setTimezone($timezone);
                    ?>

                    <div class="mb-1"><?php echo $account[0]['size']; ?></div>
                    <div class="mb-1 <?php echo $statusValueClass ?>" id="statusValue"><?php echo $statusValueText ?></div>
                    <div class="mb-1" id="fromTime"><?php echo date_format($startDate, "h:i A"); ?></div>
                    <div class="mb-1" id="untilTime"><?php echo date_format($endDate, "h:i A"); ?></div>
                  </div>
                </div>
            </div>
         </div>