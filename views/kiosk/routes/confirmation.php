
<div class="container d-flex flex-column flex-fill text-white fs-3 px-5 py-4" style="max-width: 768px; background-image: url('../../public/assets/images/bg.jpg'); background-size: cover;">
        <div class="d-flex justify-content-between">
            <a href="?view=RENT" class="text-white"><i class="bi bi-chevron-left"></i></a>
            <div></div>
        </div>
        <div class="d-flex flex-fill align-items-center justify-content-center text-center">
            <form method="POST" action="?view=CONFIRMATION&action=CONFIRMATION" class="d-flex flex-column align-items-center">
                <input type="hidden" name="pin" id="hiddenPin" />
                <input type="hidden" name="code" value="<?php echo $lockerAccountResult[0]['code']; ?>"/>
                <div>Enter 4-digit Verification Code:</div>
                <div class="d-flex mb-4">
                    <div class="d-flex ms-5" id="pinDisplay">
                        <div class="digit" id="digit1">_</div>
                        <div class="digit" id="digit2">_</div>
                        <div class="digit" id="digit3">_</div>
                        <div class="digit" id="digit4">_</div>
                    </div>
                    <button class="bg-transparent border-0 me-4 text-light" id="toggleButton" onclick="toggleShow(event)">
                        <i class="bi bi-eye-fill" id="eyeIcon"></i>
                    </button>
                </div>
                <button type="submit" name="submit" class="btn btn-light fw-bold fs-3 w-75" id="confirmButton">Confirm</button>
            </form>
        </div>
    </div>
    <div class="d-flex flex-fill">
        <div class="container d-flex align-items-center bg-white px-5 py-3" style="max-width: 768px;">
            <div class="keypad d-flex flex-wrap justify-content-center mx-auto" style="max-width: 400px;">
                <div class="col-4"><button class="btn btn-light" onclick="addDigit(1)">1</button></div>
                <div class="col-4"><button class="btn btn-light" onclick="addDigit(2)">2</button></div>
                <div class="col-4"><button class="btn btn-light" onclick="addDigit(3)">3</button></div>
                <div class="col-4"><button class="btn btn-light" onclick="addDigit(4)">4</button></div>
                <div class="col-4"><button class="btn btn-light" onclick="addDigit(5)">5</button></div>
                <div class="col-4"><button class="btn btn-light" onclick="addDigit(6)">6</button></div>
                <div class="col-4"><button class="btn btn-light" onclick="addDigit(7)">7</button></div>
                <div class="col-4"><button class="btn btn-light" onclick="addDigit(8)">8</button></div>
                <div class="col-4"><button class="btn btn-light" onclick="addDigit(9)">9</button></div>
                <div class="col-4"></div>
                <div class="col-4"><button class="btn btn-light" onclick="addDigit(0)">0</button></div>
                <div class="col-4"><button class="btn btn-light" onclick="removeDigit()">&#x232B;</button></div>
            </div>
        </div>
    </div>