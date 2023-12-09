<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./globalManagePrinter.css" />
    <link rel="stylesheet" href="./updatePrinterState.css" />
    <!-- <link rel="stylesheet" href="./addPrinter.css" /> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" />

    <!-- swiper css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container">
        <p class="bt-tt">BẬT / TẮT MÁY IN</p>
        <form method="POST" id="printerForm">
            <div class="input-ID">
                <div class="menu">
                    <div class="input-text">Nhập ID máy in</div>
                    <div class="input">
                        <input type="text" name="printerID" class="ID-text .input-text1" required"></input>
                    </div>
                    <!-- <span id="idExistsText" class="id-check-text"></span> -->
                </div>
                <div class="menu">
                    <div class="input-text">Xác nhận ID máy in</div>
                    <div class="input">
                        <input type="text" name="validatePrinterID" class="ID-text" required"></input>
                    </div>
                    <!-- <button class="check-button" onclick="clearTextID()">Check</button> -->

                </div>
            </div>
            <!-- TODO: press confirm THEN send the request, not press the button -->
            <div class="c-s-1-group">
                <div class="c-s-12">
                    <button type="button" class="choose-button" name="selection"
                        onclick="setPrinterState('Bật')"></button>
                    <div class="bt">Bật</div>
                </div>
                <div class="c-s-12">
                    <button type="button" class="choose-button" name="selection"
                        onclick="setPrinterState('Tắt')"></button>
                    <div class="bt">Tắt</div>
                </div>
            </div>


            <div class="confirm-change">
                <button class="button" id="back" onclick="closeUpdatePrinterState()">
                    <div class="tip-tc">Quay lại</div>
                </button>
                <button class="button1" id="confirm" onclick="executeQuery(event)">
                    <div class="tip-tc">Tiếp tục</div>
                </button>

            </div>
        </form>


    </div>
</body>
<script>

    // turn clicked button black
    var buttons = document.querySelectorAll('.choose-button');

    buttons.forEach(function (button) {
        button.addEventListener('click', function () {
            buttons.forEach(function (btn) {
                btn.classList.remove('active-button');
            });

            this.classList.add('active-button');
            setPrinterState(this.textContent.trim()); // Set the printer state based on the button text
        });
    });

    function closeUpdatePrinterState() {
        window.close(); // Close the pop-up window
        window.opener.location.reload(); // Refresh the parent window (managePrinter.php)
    }

    var upcomingPrinterState = ''; // Variable to store the upcoming printer state

    function setPrinterState(state) {
        upcomingPrinterState = state === 'Bật' ? 'Y' : state === 'Tắt' ? 'N' : '';
    }

    document.getElementById('printerForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    executeQuery();
});

function executeQuery() {
    var printerID = document.querySelector('input[name="printerID"]').value;
    var selectedState = upcomingPrinterState; // Assuming this variable holds the printer state ('Bật' or 'Tắt')

    if (printerID.trim() === '') {
        // Handle empty printer ID error
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'changeState.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log('Response:', xhr.responseText);
                // Handle successful response
                window.alert("Update printer state successfully");
            } else {
                console.error('Error:', xhr.status);
                // Handle error response
            }
        }
    };

    xhr.send('printerID=' + encodeURIComponent(printerID) + '&selection=' + encodeURIComponent(selectedState));
}



</script>

</html>