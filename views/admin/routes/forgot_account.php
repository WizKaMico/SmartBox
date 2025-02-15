
<div class="d-flex justify-content-center align-items-center text-center text-white fs-3 p-5 w-100" style="background-image: url('../../public/assets/images/blocks.jpg'); background-size: cover;">
    <div class="mb-5">Welcome to</div>
    <img src="../../public/assets/images/logo.png" class="mb-3">
    <div class="mb-5">SmartBox™</div>
</div>

<div class="d-flex justify-content-center bg-white fs-5 p-5 w-100">
    <form action="?view=FORGOTACCOUNT&action=FORGOTACCOUNT&code=<?php echo $_GET['code']; ?>" method="POST" class="w-75">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php foreach ($errors as $error): ?>
                    <?= $error . "<br>" ?>
                <?php endforeach; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <h3 class="fw-bold text-center my-5 pb-5">Reset Your Password</h3>

        <div class="d-flex flex-column mb-4">
            <label for="new_password" class="fw-bold mb-2">New Password</label>
            <input type="password" class="form-control border-secondary p-2" name="new_password" id="new_password" placeholder="Enter your new password">
        </div>

        <div class="d-flex flex-column mb-4">
            <label for="confirm_password" class="fw-bold mb-2">Confirm Password</label>
            <input type="password" class="form-control border-secondary p-2" name="confirm_password" id="confirm_password" placeholder="Confirm your new password">
        </div>

        <div id="error-message" style="color: red; display: none;">Passwords do not match. Please try again.</div>

        <div class="d-flex flex-column mt-5">
            <button type="submit" name="submit" id="submitBtn" class="btn btn-dark rounded-pill me-5 w-100" disabled>Reset Password</button>
            <a type="button" class="btn btn-light border-secondary me-5 rounded-pill w-100 mt-2" href="?view=HOME">Cancel</a>
        </div>
    </form>
</div>



<script>
    var newPasswordField = document.getElementById('new_password');
    var confirmPasswordField = document.getElementById('confirm_password');
    var submitButton = document.getElementById('submitBtn');
    var errorMessage = document.getElementById('error-message');

    function checkPasswordsMatch() {
        var newPassword = newPasswordField.value;
        var confirmPassword = confirmPasswordField.value;

        if (newPassword === confirmPassword && newPassword !== '') {
            submitButton.disabled = false;
            errorMessage.style.display = 'none';  
        } else {

            submitButton.disabled = true;
            errorMessage.style.display = 'block'; 
        }
    }

    newPasswordField.addEventListener('input', checkPasswordsMatch);
    confirmPasswordField.addEventListener('input', checkPasswordsMatch);
</script>