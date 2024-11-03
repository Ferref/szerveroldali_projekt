/*This code ensures that the site displays a Hungarian message to the user 
when some data is missing in the registration or in the login form, 
instead of the Bootstrap basic English language */

function getForm() {
    // Set variables to null, try to get login form, registration form.
    let registrationForm = null;
    let loginForm = null;

    registrationForm = document.getElementById("registration-form") ?? null;

    loginForm = document.getElementById("login-form") ?? null;

    if(registrationForm && loginForm){
        throw new Error("Registration form and Login form are both available on the site!");
    }

    if(registrationForm){
        return registrationForm;
    }
    else if(loginForm){
        return loginForm;
    }
    else{
        throw new Error("No Registration and/or Login form on the site!");
    }
}

// Select the form
form = getForm()

function customizeValidationMessages(form){
    form.addEventListener('submit', function(e){
        e.preventDefault(); // Prevent default browser validation message
        e.stopPropagation()
        e.target.setCustomValidity(); // Clear any existing custom validity

        // Set custom validtation messages        
        if(form.id === 'registration-form' || form.id === 'login-form'){
            if(e.target.id === 'email'){
                e.target.setCustomValidity("Kérlek add meg az email-cimedet!");
            }
            else if(e.target.id ==='username'){
                e.target.setCustomValidity("Kérlek adj meg a felhasználónevet!");
            }
            else if(e.target.id === 'password'){
                e.target.setCustomValidity("Kérlek adj meg egy jelszót!");
            }
            }
        
        // Registration form settings
        if(form.id === 'registration-form'){
            if(e.target.id === 'confirm_email'){
                e.target.setCustomValidity("Kérlek erősítsd meg a email címedet!");
            } else if (e.target.id === 'confirm_password'){
                e.target.setCustomValidity("Kérlek erősítsd meg a jelszavadat!");
            }
        }

        // Trigger the validtaion. Process the form if its valid.
        if(!form.checkValidity()){
            form.reportValidity();
        }
        else{
            form.submit();
        }
    });
}

customizeValidationMessages(form);