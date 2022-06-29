var xHRObject = false
if (window.XMLHttpRequest) {
    xHRObject = new XMLHttpRequest()
} else if (window.ActiveXObject) {
    xHRObject = new ActiveXObject("Microsoft.XMLHTTP")
}

window.onload = function () {
    const bookList = document.getElementById("bookList")

    books.forEach((book) => {
        var bookDiv = document.createElement("div")
        var img = document.createElement("img")
        img.src = book.image
        img.width = "300"
        img.height = "400"
        bookDiv.appendChild(img)

        var title = document.createElement("div")
        title.id = `book-${book.ISBN}`
        title.textContent = book.name
        bookDiv.appendChild(title)

        var author = document.createElement("div")
        author.id = `authors-${book.ISBN}`
        author.textContent = book.author
        bookDiv.appendChild(author)

        var ISBN = document.createElement("div")
        ISBN.id = `ISBN-${book.ISBN}`
        ISBN.textContent = book.ISBN
        bookDiv.appendChild(ISBN)

        var price = document.createElement("div")
        price.id = `price-${book.ISBN}`
        price.textContent = `$${book.price}`
        bookDiv.appendChild(price)

        var addRemove = document.createElement("a")
        addRemove.href = "#"
        addRemove.onclick = () => AddRemoveItem("Add", book.ISBN)
        addRemove.textContent = "Add to Shopping Cart"
        bookDiv.appendChild(addRemove)

        var cart = document.createElement("div")
        cart.id = `cart-${book.ISBN}`
        bookDiv.appendChild(cart)

        bookList.appendChild(bookDiv)
    })
}

function AddRemoveItem(action, bookId) {
    var book = document.getElementById(`book-${bookId}`).textContent
    var ISBN = document.getElementById(`ISBN-${bookId}`).textContent
    var price = document.getElementById(`price-${bookId}`).textContent

    price = price.substr(price.indexOf("$") + 1)

    console.log(action, bookId)

    xHRObject.open(
        "GET",
        "process.php?action=" +
        action +
        "&name=" +
        book +
        "&value=" +
        Number(new Date()) +
        "&ISBN=" +
        ISBN +
        "&price=" +
        price,
        true
    )

    xHRObject.onreadystatechange = getData
    xHRObject.send(null)
}

function getData() {
    if (xHRObject.readyState == 4 && xHRObject.status == 200) {
        console.log(xHRObject.responseText)

        var serverResponse
        if (xHRObject.responseText !== "") {
            serverResponse = JSON.parse(xHRObject.responseText)
        } else {
            serverResponse = null
        }

        if (serverResponse != null) {
            const span = document.getElementById(`cart-${serverResponse.ISBN}`)

            if (serverResponse.price > 0) {
                span.textContent = serverResponse.price

                const removeButton = document.createElement("BUTTON")
                removeButton.onclick = () =>
                    AddRemoveItem("Remove", serverResponse.ISBN)
                removeButton.innerText = "Remove book"
                span.appendChild(removeButton)
            } else {
                span.textContent = ""
                span.removeChild(span.firstChild)
            }
        }
    }
}
