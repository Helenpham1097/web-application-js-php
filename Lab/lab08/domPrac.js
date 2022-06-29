function makeTable(){
	let theTable =document.getElementById("tbl");

	if (theTable.firstChild != null){
		let badIEBody = theTable.childNodes[0];
		theTable.removeChild(badIEBody);
	}
	let tBody = document.createElement("TBODY");
	theTable.appendChild(tBody);

	let newRow = document.createElement("tr");
	let c1 = document.createElement("td");
	let v1 = document.createTextNode("7308");
	c1.appendChild(v1);
	newRow.appendChild(c1);
	let c2 = document.createElement("td");
	let v2 = document.createTextNode("Software Engineering");
	c2.appendChild(v2);
	newRow.appendChild(c2);
	tBody.appendChild(newRow);

	newRow = document.createElement("tr");
	c1 = document.createElement("td");
	v1 = document.createTextNode("7003");
	c1.appendChild(v1);
	newRow.appendChild(c1);
	c2 = document.createElement("td");
	v2 = document.createTextNode("Web Development");
	c2.appendChild(v2);
	newRow.appendChild(c2);
	tBody.appendChild(newRow);
}

function appendRow() {
	let table= document.getElementById('tbl');
	let courseCode = prompt("Enter course code", "COMP610");
	let courseName = prompt("Enter course name","Data Structure and Algorithm");

	if(courseCode!=null && courseName != null){
		let newRow = document.createElement("tr");
		newRow.classList.add('new');
		let c1 = document.createElement("td");
		let v1 = document.createTextNode(courseCode);
		c1.appendChild(v1);
		newRow.appendChild(c1);
		let c2 = document.createElement("td");
		let v2 = document.createTextNode(courseName);
		c2.appendChild(v2);
		newRow.appendChild(c2);
		table.lastChild.appendChild(newRow);
	}
}


