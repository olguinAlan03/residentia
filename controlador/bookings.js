getAllBookings()

function getAllBookings() {
    let table = document.getElementById('tableBody')

    if (table) {
        db.collection("bookings").onSnapshot((querySnapshot) => {
            table.innerHTML = ''
            querySnapshot.forEach((doc) => {

                table.innerHTML += `
                <div class="bodyBookings">
                    <div class="item">
                    ${doc.data().name}
                    </div>
                    <div class="item">
                    ${doc.data().lastName}
                    </div>
                    <div class="item">
                    ${doc.data().phone}
                    </div>
                    <div class="item">
                    ${doc.data().email}
                    </div>
                    <div class="item">
                    ${doc.data().date}
                    </div>
                    <div class="item">
                    ${doc.data().time}
                    </div>
                </div>
            `
            });
        });
    }
}