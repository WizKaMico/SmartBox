<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
        if (!empty($_GET['message'])) {
            if ($_GET['message'] == 'success') {
                if(!empty($_GET['route'] && !empty($_GET['code'])))
                {
                    if($_GET['route'] == 'CONFIRMATION')
                    {
                        echo '
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                Swal.fire({
                                    icon: "success",
                                    title: "Proceed To Verification",
                                    text: "",
                                    confirmButtonText: "Proceed",
                                    iconColor:"#000000",
                                    confirmButtonColor: "#000000"
                                }).then((result) => {
                                    // Check if the user clicked "Proceed"
                                    if (result.isConfirmed) {
                                        // Redirect to the payment link (you can modify this URL as needed)
                                        window.location.href = "?view=CONFIRMATION&code='.$_GET['code'].'"; // Replace this with the actual route or payment URL
                                    }
                                });
                            });
                        </script>';
                    }
                    else if($_GET['route'] == 'PAYMENT')
                    {
                        echo '
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                Swal.fire({
                                    icon: "success",
                                    title: "Proceed To Payment",
                                    text: "",
                                    confirmButtonText: "Proceed",
                                    iconColor:"#000000",
                                    confirmButtonColor: "#000000"
                                }).then((result) => {
                                    // Check if the user clicked "Proceed"
                                    if (result.isConfirmed) {
                                        // Redirect to the payment link (you can modify this URL as needed)
                                        window.location.href = "?view=PAYMENT&code='.$_GET['code'].'"; // Replace this with the actual route or payment URL
                                    }
                                });
                            });
                        </script>';
                    }
                    else
                    {

                    }
                }
                else
                {
                    echo '
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            Swal.fire({
                                icon: "success",
                                title: "Inserted Succesfully",
                                text: "",
                                confirmButtonText: "Close",
                                iconColor:"#000000",
                                confirmButtonColor: "#000000"
                            });
                        });
                    </script>';
                }

            } else if($_GET['message'] == 'logout'){
              
                echo '
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                Swal.fire({
                                    icon: "warning",
                                    title: "Are you sure you want to logout?",
                                    text: "",
                                    confirmButtonText: "Proceed",
                                    iconColor:"#000000",
                                    confirmButtonColor: "#000000"
                                }).then((result) => {
                                    // Check if the user clicked "Proceed"
                                    if (result.isConfirmed) {
                                        // Redirect to the payment link (you can modify this URL as needed)
                                        window.location.href = "./logout.php"; // Replace this with the actual route or payment URL
                                    }
                                });
                            });
                        </script>';


            } else {
               
                    echo '
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            Swal.fire({
                                icon: "error",
                                title: "An error occurred",
                                text: "",
                                confirmButtonText: "Close",
                                iconColor:"#000000",
                                confirmButtonColor: "#000000"
                            });
                        });
                    </script>';
             
            }
        }
    ?>

    </script>