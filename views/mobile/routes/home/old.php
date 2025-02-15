<div class="container d-flex flex-column flex-fill text-white fs-4 pt-4 px-4" style="max-width: 480px; background-image: url('../../public/assets/images/bg.jpg'); background-size: cover;">
        <div class="d-flex flex-fill align-items-center justify-content-center text-center">
            <form method="POST" action="?view=HOME&action=HOMEOLDLOGIN" class="d-flex flex-column align-items-center">
                <div>Enter 6-digit PIN:</div>
                <div class="d-flex mb-5">
                <input type="hidden" name="pin" id="hiddenPin" />
                    <div class="d-flex ms-5" id="pinDisplay">
                        <div class="digit" id="digit1">_</div>
                        <div class="digit" id="digit2">_</div>
                        <div class="digit" id="digit3">_</div>
                        <div class="digit" id="digit4">_</div>
                        <div class="digit" id="digit5">_</div>
                        <div class="digit" id="digit6">_</div>
                    </div>
                    <button type="button" class="bg-transparent border-0 me-4 text-light" id="toggleButton" onclick="toggleShow()">
                        <i class="bi bi-eye-fill" id="eyeIcon"></i>
                    </button>
                </div>
                <button type="submit" name="submit" class="btn btn-light fw-bold fs-4 w-75" id="confirmButton">Confirm</button>
            </form>
        </div>
    </div>
    <div class="d-flex flex-fill">
        <div class="container d-flex align-items-center bg-white px-5" style="max-width: 480px;">
            <div class="keypad d-flex flex-wrap justify-content-center mx-auto" style="max-width: 480px;">
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