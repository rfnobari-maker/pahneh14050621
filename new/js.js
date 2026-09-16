const button = document.querySelector("#btn1") ; 
const container = document.querySelector('.container');
const Rbutton = document.querySelector("#btn2") ; 
console.log(button) ; 
const show_message = ()=>{
    container.style.backgroundColor = 'green';
    button.disabled = true ; 
    Rbutton.disabled = false ; 
    button.innerText = 'please wait'
}; 
button.addEventListener('click', show_message) ;


const Rshow_message = ()=>{
    container.style.backgroundColor = 'red';
    button.disabled = false ; 
    Rbutton.disabled = true ; 
    button.innerText = 'Click me'
}; 
Rbutton.addEventListener('click', Rshow_message) ;


// Get the form element
const form = document.querySelector('form');

// Add an event listener to the form submission
form.addEventListener('submit', (event) => {
    // Prevent the default form submission behavior
    event.preventDefault();

    // Get the values of the form fields
    const name = document.getElementById('name').value;
    const lastName = document.getElementById('lastName').value;
    const email = document.getElementById('email').value;

    // Create an object to store the form data
    const formData = {
        name: name,
        lastName: lastName,
        email: email
    };

    // Send the form data to another file using AJAX or fetch API
    // Replace 'path/to/otherfile.php' with the actual file path
    fetch('./save.php', {
        method: 'POST',
        body: JSON.stringify(formData),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        // Handle the response from the server
        console.log(data);
    })
    .catch(error => {
        // Handle any errors that occur during the request
        console.error(error);
    });
});

