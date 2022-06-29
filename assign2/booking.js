/**
 * Student Name: Helen Pham
 * Student Id: 21133245
 * This js file contains automatically ready function to set up date and time value when the page is loaded
 * checlValid() function is used to check the time if the pick up date is as same as current date. If the time is earlier than current time, the window will alert invalid input and the value of the time will set to empty and you need to re-enter the valid time input
 * the addBooking() function to post a booking information to the server. When the booking is confirmed, it will generate dynamic code and append to the booking-confirmation div at booking.html page, and set the div to be active.
 * the closeBooking() is to trigger the Close Booking button in the dynamic code generated mentioned above, it will remove all the confirmation and remove active of the booking-confirmation div and reload the page
 */

Date.prototype.toDateInputValue = (function () {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0, 10);
});
Date.prototype.toTimeInputValue = (function () {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    ;
    return local.toJSON().slice(11, 19);
});

function checkValid(val) {
    if ($('#date').val() === $('#date').attr("min") && val < $('#time').attr("min")) {
        window.alert("Time and Date pick up must be later than the current date and time");
        $('#time').val("");
    }
}

$(document).ready(function () {
    $('#date').val(new Date().toDateInputValue());
    $('#time').val(new Date().toTimeInputValue());
    $("#date").attr("min", new Date().toDateInputValue());
    $("#time").attr("min", new Date().toTimeInputValue());
});

function addBooking() {
    let error = "";
    let customerName = $('#cname').val();
    let phoneNumber = $('#phone').val();
    let unitNumber = $('#unumber').val();
    let streetNumber = $('#snumber').val();
    let streetName = $('#stname').val();
    let suburb = $('#sbname').val();
    let destinationSuburb = $('#dsbname').val();
    let pickUpDate = $('#date').val();
    let pickUpTime = $('#time').val();

    let parts_of_date = pickUpDate.split("-");
    let confirmedDate = parts_of_date[2] + '/' + parts_of_date[1] + '/' + parts_of_date[0];
    if(customerName === ""){
        error +=  "Customer Name is not filled, ";
    }
    if(phoneNumber.length <10 || phoneNumber.length >12){
        error += "The length of phone number must be less than 10 and greater than 12, ";
    }
    if(streetNumber === ""){
        error +=  "Street name is not filled, ";
    }
    if(streetName === ""){
        error +=  "Street number is not filled, ";
    }
    if(pickUpTime === ""){
        error += "Pickup Time is not filled, ";
    }
    if(pickUpDate === ""){
        error += "Pickup Date is not filled, ";
    }
    if(customerName == null || (phoneNumber.length <10 || phoneNumber.length >12) || streetNumber == null || streetName == null || pickUpTime == null || pickUpDate == null ){
        let alert = "";
        const errorArray = error.split(",");
        for(let i = 0; i< errorArray.length; i++){
            alert += errorArray[i] + "\n";

        }
        window.alert(alert);
    }else {
        const xHttp = new XMLHttpRequest();
        xHttp.open("POST", "booking.php");
        xHttp.setRequestHeader("Accept", "application/json");
        xHttp.setRequestHeader("Content-type", "application/json");

        xHttp.onreadystatechange = function () {
            if (xHttp.readyState === 4 && xHttp.status === 200) {
                let response = JSON.parse(xHttp.responseText);
                let bookingReference = response.bookingReference;

                if (bookingReference == "error") {
                    window.alert("Cannot book, please check your information");

                } else {
                    let confirmation = `<div class="icon">
        <img src="images/icons8-check-mark-48.png">
    </div>
    <div class="message">
        <h2>Thank you for your booking</h2>
    </div>
    <div class="table">
        <table style="border: none">
            <tr style="outline: none">
                <td>Booking Reference Number</td>
                <td id="bookingReference" name="reference">${bookingReference}</td>
            </tr>
            <tr style="outline: none">
                <td>Pickup Date</td>
                <td id="pickUpDate">${confirmedDate}</td>
            </tr>
            <tr style="outline: none">
                <td>Pickup Time</td>
                <td id="pickUpTime">${pickUpTime}</td>
            </tr>
        </table>
    </div>
    <div class="close-btn">
        <button class="close-btn button" onclick="closeBooking()">Close</button>
    </div>`;
                    $('.booking-confirmation').append(confirmation);
                    document.getElementsByClassName("booking-confirmation")[0].classList.add("active");
                }
            }
        }
        const newBooking = '{"cname": "' + customerName + '", ' +
            '"phone": "' + phoneNumber + '", ' +
            '"unumber": "' + unitNumber + '", ' +
            '"snumber": "' + streetNumber + '", ' +
            '"stname": "' + streetName + '", ' +
            '"sbname": "' + suburb + '", ' +
            '"dsbname": "' + destinationSuburb + '", ' +
            '"date": "' + pickUpDate + '", ' +
            '"time": "' + pickUpTime + '"}';
        xHttp.send(newBooking);
    }
}

function closeBooking() {
    $('.booking-confirmation .icon').remove();
    $('.booking-confirmation .message').remove();
    $('.booking-confirmation .table').remove();
    $('.booking-confirmation .close-btn').remove();
    document.getElementsByClassName("booking-confirmation")[0].classList.remove("active");
    location.reload();
}
