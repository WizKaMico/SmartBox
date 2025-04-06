$(document).ready(function () {
  function getQueryParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
  }

  const basePrice = parseFloat(getQueryParam("price"));

  if (isNaN(basePrice)) {
    console.warn("Invalid price, defaulting to 0");
    basePrice = 0;
  }

  console.log("Base Price:", basePrice);

  const amountDisplay = $("#amountDisplay");
  const payButton = $("#payButton");
  const currentTimeDisplay = $("#currentTime");
  const timeSelect = $("#timeSelect");

  // function updateCurrentTime() {
  //     const now = new Date();
  //     let hours = now.getHours();
  //     const minutes = String(now.getMinutes()).padStart(2, '0');
  //     const ampm = hours >= 12 ? 'PM' : 'AM';
  //     hours = hours % 12;
  //     hours = hours ? hours : 12;

  //     const formattedTime = `${hours}:${minutes} ${ampm}`;
  //     currentTimeDisplay.text(formattedTime);

  //     const currentHour = now.getHours();
  //     const maxHours = Math.max(0, 12 - currentHour);

  //     timeSelect.find('option').each(function() {
  //         const optionValue = parseInt($(this).val());
  //         if (optionValue > maxHours) {
  //             $(this).prop('disabled', true);
  //         } else {
  //             $(this).prop('disabled', true);
  //         }
  //     });
  // }

  function updateCurrentTime() {
    const now = new Date();
    const manilaTime = new Intl.DateTimeFormat("en-PH", {
      timeZone: "Asia/Manila",
      hour: "2-digit",
      minute: "2-digit",
      hour12: true,
    }).format(now);

    const [hours, minutesWithAmPm] = manilaTime.split(":");
    const [minutes, ampm] = minutesWithAmPm.split(" ");

    const formattedTime = `${hours}:${minutes} ${ampm}`;
    currentTimeDisplay.text(formattedTime);

    // const currentHour = parseInt(hours);
    const currentHour = parseInt(hours);

    const maxHours = Math.max(0, 24 - currentHour);

    // Bypass the disabling of options (comment out the below block for now)
    /*
        timeSelect.find('option').each(function() {
            const optionValue = parseInt($(this).val());
            // Disable options that exceed the maximum selectable hours
            if (optionValue > maxHours) {
                $(this).prop('disabled', true);
            } else {
                $(this).prop('disabled', false);
            }
        });
        */
  }

  setInterval(updateCurrentTime, 60000);
  updateCurrentTime();

  function updatePayButtonState() {
    const selectedHours = parseInt($("#timeSelect").val());
    const isTimeSelected = !isNaN(selectedHours);
    payButton.prop("disabled", !isTimeSelected);
  }

  $("#timeSelect").on("change", function () {
    const selectedHours = parseInt($(this).val());
    const totalPrice = basePrice * selectedHours;
    amountDisplay.text(`₱ ${totalPrice}`);

    updatePayButtonState();
  });
});
