<div class="d-flex flex-column align-items-center text-center text-white fs-3 p-5 w-100" style="background-image: url('../../public/assets/images/blocks.jpg'); background-size: cover;">
    <div class="mb-5">Welcome to</div>
    <img src="../../public/assets/images/logo.png" class="mb-3">
    <div class="mb-5">SmartBox™</div>
    <p class="text-light fs-6 mt-3 mb-5 w-75">SmartBox™, an innovative solution that allows users to rent lockers through an online platform, enabling secure and convenient<br>access to their belongings.</p>
    <div class="d-flex text-light fs-6 gap-3" style="position: absolute; bottom: 2rem; left: 18%;">
      <div>SmartBox™</div>
      <div>|</div>
      <div>Locker System</div>
    </div>
  </div>

  <div class="d-flex justify-content-center bg-white fs-5 p-5 w-100">
    <form action="?view=FORGOT&action=FORGOT" method="POST" class="w-75">
      <?php if (!empty($errors)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php foreach ($errors as $error): ?>
                <?= $error . "<br>" ?>
            <?php endforeach; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
      
      <h3 class="fw-bold text-center my-5 pb-5">Reset Password</h3>
      
      <!-- Email Input -->
      <div class="d-flex flex-column mb-4">
        <label for="email" class="fw-bold mb-2">Email</label>
        <input type="email" class="form-control border-secondary p-2" name="email" placeholder="Enter your email address">
      </div>

      <!-- Buttons -->
      <div class="d-flex flex-column mt-5">
        <button type="submit" name="submit" class="btn btn-dark rounded-pill me-5 w-100">Send</button>
        <a type="button" class="btn btn-light border-secondary me-5 rounded-pill w-100 mt-2" href="?view=HOME">Cancel</a>
      </div>
    </form>
  </div>