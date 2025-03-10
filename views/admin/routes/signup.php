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

    <div class="d-flex justify-content-center bg-white fs-5 pb-5 px-5 w-100">
        <form action="?view=SIGNUP&action=SIGNUP" method="POST" enctype="multipart/form-data" class="w-75">
            <h3 class="fw-bold text-center mt-5 mb-4">Sign up</h3>
            <input type="hidden" name="token">
            <div class="d-flex flex-column mb-4">
                <label for="" class="fw-bold mb-2">Image</label>
                <input type="file" name="image" class="form-control border-secondary w-100" required="">
            </div>
            <div class='d-flex'>
                <div class="d-flex flex-column mb-4 me-4 w-100">
                    <label for="" class="fw-bold mb-2">First Name</label>
                    <input type="text" name="firstname" class="form-control border-secondary" placeholder="Enter your first name" required="">
                </div>
                <div class="d-flex flex-column mb-4 w-100">
                    <label for="" class="fw-bold mb-2">Last Name</label>
                    <input type="text" name="lastname" class="form-control border-secondary" placeholder="Enter your last name" required="">
                </div>
            </div>
            <div class="d-flex flex-column mb-4">
                <label for="" class="fw-bold mb-2">Contact</label>
                <input type="tel" name="contact" maxlength="11" pattern="[0-9]*" inputmode="numeric" oninput="this.value=this.value.replace(/[^0-9]/g,'')" class="form-control border-secondary" placeholder="Enter your contact" required="">
            </div>
            <div class="d-flex flex-column mb-4">
                <label for="" class="fw-bold mb-2">Email</label>
                <input type="text" name="email" class="form-control border-secondary" placeholder="Enter your email address" required="">
            </div>
            <div class="d-flex flex-column mb-4">
                <label for="" class="fw-bold mb-2">Password</label>
                <input type="password" name="password" class="form-control border-secondary" placeholder="Enter your password" required="">
            </div>

            <!-- Error Display Section -->
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php foreach ($errors as $error): ?>
                        <?= $error . "<br>" ?>
                    <?php endforeach; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <!-- <div class="d-flex flex-column justify-content-center gap-5 mt-5 px-5">
                <button type="submit" class="btn btn-dark me-5 rounded-pill w-100" style="background-color: #3a4058">Sign Up</button>
                <button type="button" class="btn btn-light me-5 border-secondary rounded-pill w-100" onclick="#">Cancel</button>
            </div> -->

            <div class="d-flex flex-column mt-5">
                <button type="submit" name="submit" class="btn btn-dark rounded-pill me-5 w-100">Sign Up</button>
                <a type="button" class="btn btn-light border-secondary me-5 rounded-pill w-100 mt-2" href="?view=HOME">Cancel</a>
            </div>

        </form>
    </div>