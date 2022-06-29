function Email(name, email) {
    this.name = name
    this.email = email
}

Email.prototype.displayInfo = function () {
    let email = "Name: " + this.name +
        " | " + "Email Address: " + this.email;
    window.alert(email);
}

function EmailRecord() {
    this.records = []
}

EmailRecord.prototype.addEmail = function (email) {
    this.records.push(email)
}

EmailRecord.prototype.displayRecords = function () {
    this.records.forEach((email) => {
        email.displayInfo(email)
    })
}
function test() {
    const email1 = new Email("Helen Pham", "helenpham1097@gmail.com");
    const email2 = new Email("HelTha", "heltha@gmail.com");
    const email3 = new Email("Thay Huynh", "thayhuynh@gmail.com");
    let test = new EmailRecord();
    test.addEmail(email1);
    test.addEmail(email2);
    test.addEmail(email3);
    test.displayRecords();
}




