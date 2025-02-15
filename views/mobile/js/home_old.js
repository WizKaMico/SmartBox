
let pin = "";
let isShowing = false;

function updateDisplay() {
    for (let i = 1; i <= 6; i++) {
        document.getElementById(`digit${i}`).innerText = isShowing ? (pin[i - 1] || "_") : (pin[i - 1] ? "*" : "_");
    }
}

function toggleShow() {
    isShowing = !isShowing;
    document.getElementById('eyeIcon').className = isShowing ? 'bi bi-eye-slash-fill' : 'bi bi-eye-fill';
    updateDisplay();
}

function addDigit(digit) {
    if (pin.length < 6) {
        pin += digit;
        updateDisplay();
    }
}

function removeDigit() {
    pin = pin.slice(0, -1);
    updateDisplay();
}

document.getElementById('confirmButton').addEventListener('click', function (e) {
    if (pin.length === 6) {
        document.getElementById('hiddenPin').value = pin;
    } else {
        e.preventDefault();
        alert("Please enter a 6-digit PIN.");
    }
});