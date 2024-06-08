let button = document.getElementById("action")
if (button) {
    button.addEventListener("click", function () {
        getData()
    })
}

function getData() {
    /** LABELS **/
    let validateName = document.getElementById("validate-name")
    let validateLastName = document.getElementById("validate-lastName")
    let validatePhone = document.getElementById("validate-phone")
    let validateEmail = document.getElementById("validate-email")
    let validateDate = document.getElementById("validate-date")
    let validateTime = document.getElementById("validate-time")

    /** INPUTS **/
    let nameInput = document.getElementById("name")
    let lastNameInput = document.getElementById("lastName")
    let phoneInput = document.getElementById("phone")
    let emailInput = document.getElementById("email")
    let dateInput = document.getElementById("date")
    let timeInput = document.getElementById("time")

    /** INPUT VALUES **/
    let name = document.getElementById("name").value
    let lastName = document.getElementById("lastName").value
    let phone = document.getElementById("phone").value
    let email = document.getElementById("email").value
    let date = document.getElementById("date").value
    let time = document.getElementById("time").value

    validate(
        name,
        validateName,
        nameInput,
        lastName,
        validateLastName,
        lastNameInput,
        phone,
        validatePhone,
        phoneInput,
        email,
        validateEmail,
        emailInput,
        date,
        validateDate,
        dateInput,
        time,
        validateTime,
        timeInput
    )
}

function validate
    (
        name,
        validateName,
        nameInput,
        lastName,
        validateLastName,
        lastNameInput,
        phone,
        validatePhone,
        phoneInput,
        email,
        validateEmail,
        emailInput,
        date,
        validateDate,
        dateInput,
        time,
        validateTime,
        timeInput
    ) {

    if (name) {
        validateName.classList.remove("validate-text-active")
        nameInput.classList.remove("validate-input-active")
        validateName.className = ("validate-text-inactive")
    } else {
        validateName.classList.remove("validate-text-inactive")
        validateName.className = ("validate-text-active")
        nameInput.className = ("validate-input-active")
    }
    if (lastName) {
        validateLastName.classList.remove("validate-text-active")
        lastNameInput.classList.remove("validate-input-active")
        validateLastName.className = ("validate-text-inactive")
    } else {
        validateLastName.classList.remove("validate-text-inactive")
        validateLastName.className = ("validate-text-active")
        lastNameInput.className = ("validate-input-active")
    }
    if (phone) {
        validatePhone.classList.remove("validate-text-active")
        phoneInput.classList.remove("validate-input-active")
        validatePhone.className = ("validate-text-inactive")
    } else {
        validatePhone.classList.remove("validate-text-inactive")
        validatePhone.className = ("validate-text-active")
        phoneInput.className = ("validate-input-active")
    }
    if (email) {
        validateEmail.classList.remove("validate-text-active")
        emailInput.classList.remove("validate-input-active")
        validateEmail.className = ("validate-text-inactive")
    } else {
        validateEmail.classList.remove("validate-text-inactive")
        validateEmail.className = ("validate-text-active")
        emailInput.className = ("validate-input-active")
    }
    if (date) {
        validateDate.classList.remove("validate-text-active")
        dateInput.classList.remove("validate-input-active")
        validateDate.className = ("validate-text-inactive")
    } else {
        validateDate.classList.remove("validate-text-inactive")
        validateDate.className = ("validate-text-active")
        dateInput.className = ("validate-input-active")
    }
    if (time) {
        validateTime.classList.remove("validate-text-active")
        timeInput.classList.remove("validate-input-active")
        validateTime.className = ("validate-text-inactive")
    } else {
        validateTime.classList.remove("validate-text-inactive")
        validateTime.className = ("validate-text-active")
        timeInput.className = ("validate-input-active")
    }

    if (name && lastName && phone && email && date && time) {
        reserve(name, lastName, phone, email, date, time)
    }
}

function reserve(name, lastName, phone, email, date, time) {
    console.log("reservando..")

    db.collection("bookings").add({
        name: name,
        lastName: lastName,
        phone: phone,
        email: email,
        date: date,
        time: time
    })
        .then(function (docRef) {
            console.log("Document written with ID: ", docRef.id);
            cleanInputs()
            Swal.fire(
                'Reserva Exitosa!',
                '',
                'success'
            )
        })
        .catch(function (error) {
            console.error("Error adding document: ", error);
        });
}

function cleanInputs() {
    document.getElementById('name').value = ''
    document.getElementById('lastName').value = ''
    document.getElementById('email').value = ''
    document.getElementById('phone').value = ''
    document.getElementById('date').value = ''
    document.getElementById('time').value = ''
}