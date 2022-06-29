/**
 *Student Name: Helen Pham
 * Student ID: 21133245
 * getBooking() function is used to render booking information received from the PHP file and suitable assign button with the booking status.
 * It will append dynamic code to the searching-booking div in admin.html page
 * assignBooking() function is used to send booking reference number need to be assigned to PHP page and render information from the PHP to dynamic code in the content div of admin.html page.
 * And also, it will immediately update the status of booking and disable the assign button of HTML page that was just assigned when click the assign button
 * closeAssignBooking() function is used to close the confirmation of booking assigned.
 */

function getNewBookings(bookingReference) {
    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        const response = JSON.parse(this.responseText);
        if (response[0].bookingReference === null || response[0] === undefined) {
            $('.results .bookings').remove();
            $('.content').hide();
            $('.notFound .message').remove();
            $('.notFound').append(`<div class="message"><h2>No Booking match the reference number</h2></div>`)
        } else {
            $('.results .bookings').remove();
            $('.notFound .message').remove();
            let text = "";
            for (let i = 0; i < response.length; i++) {
                let booking = response[i];
                text += `<tr class="bookings">`;
                let bookingReference = "";
                let status = "";
                for (const info in booking) {
                    if (info === "bookingReference") {
                        bookingReference = booking[info];
                    }
                    if (booking[info] == "Assigned") {
                        status = booking[info];
                    }
                    text += `<td class="${info}">${booking[info]}</td>`;
                }
                if (status === "") {
                    text += `<td><button class="assign" onclick="assignBooking('${bookingReference}')">Assign</button></td></tr>`;
                } else {
                    text += `<td><button class="assign" disabled onclick="assignBooking('${bookingReference}')">Assign</button></td></tr>`;
                }
            }
            $('.results').append(text);
            $('.content').show();
        }
    }
    xhr.open("GET", "admin.php?bsearch=" + bookingReference, true);
    xhr.send();
}

function assignBooking(bookingReference) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "admin.php");
    xhr.setRequestHeader("Accept", "application/json");
    xhr.setRequestHeader("Content-type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let results = JSON.parse(xhr.responseText);
            let response = results[0];
            let bookingReference = response.bookingReference;
            let customerName = response.customerName;
            let customerPhone = response.customerPhone;
            let suburb = response.suburb;
            let destinationSuburb = response.destinationSuburb;
            let pickUpDate = response.pickUpDate;
            let pickUpTime = response.pickUpTime;
            let status = response.status;
            let confirmation = `<div class="icon">
        <img src="images/icons8-check-mark-48.png">
    </div>
    <div class="message">
        <h2>Congratulations! Booking request ${bookingReference} has been assigned! </h2>
    </div>
    <div style="border: 1px solid black" class="table">
        <table>
            <tr style="border: thin solid">
                    <th>Booking reference number</th>
                    <th>Customer name</th>
                    <th>Phone</th>
                    <th>Pickup suburb</th>
                    <th>Destination suburb</th>
                    <th>Pickup date</th>
                    <th>Pickup time</th>
                    <th>Status</th>
                   
                </tr>
                   <tr style="border: thin solid">
                    <td>${bookingReference}</td>
                    <td>${customerName}</td>
                    <td>${customerPhone}</td>
                    <td>${suburb}</td>
                    <td>${destinationSuburb}</td>
                    <td>${pickUpDate}</td>
                    <td>${pickUpTime}</td>
                    <td>${status}</td>
                </tr>
                
        </table>
    </div>
    <div class="close-btn">
        <button class="close-btn button" onclick="closeAssignedBooking()">Close</button>
    </div>`;
            $('.booking-assign').append(confirmation);
            document.getElementsByClassName("booking-assign")[0].classList.add("active");
            $('.results tr').each(function () {
                let booking = $(this).find(".bookingReference").html();
                if (booking === bookingReference) {
                    $(this).find(".status").text("Assigned");
                    $(this).find(".assign").prop('disabled', true);
                }
            });
        }
    }
    const update = '{"bookingReference": "' + bookingReference + '"}';
    xhr.send(update);
}

function closeAssignedBooking() {
    $('.booking-assign .icon').remove();
    $('.booking-assign .message').remove();
    $('.booking-assign .table').remove();
    $('.booking-assign .close-btn').remove();
    document.getElementsByClassName("booking-assign")[0].classList.remove("active");
}
