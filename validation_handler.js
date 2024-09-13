// Gets the available form from the site (Registration or Login)
function getForm() {
    // Initalize variables to null
    let registrationForm = null;
    let loginForm = null;

    // Check if they are vailable
    registrationForm = document.getElementById("registration-form") ?? null;

    // Check if the login form is available
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
        e.target.setCustomValidity(); // Clear any existing custom validity

        // Set custom validtation messages
        //Registration form settings
        if(form.id === 'registration-form'){
            if(e.target.id === 'email'){
                e.target.setCustomValidity("Kérlek add meg az email-cimedet.");
            }
            else if(e.target.id='confirm_email'){
                e.target.setCustomValidity("Kérlek erősítsd meg ay email címedet!");
            }
            else if(e.target.id='username'){
                e.taget.setCustomValidity("Kérlek adj meg a felhasználónevet!");
            }
            else if(e.target.id='password'){
                e.taget.setCustomValidity("Kérlek adj meg egy jelszót!");
            }
            else if(e.target.id='confirm_password'){
                e.taget.setCustomValidity("Kérlek erősítsd meg a jelszavadat'!");
            }
        }
        // Login form settings
        else if(form.id === 'login-form'){
            if(form.id = 'registration-form'){
                if(e.target.id === 'email'){
                    e.target.setCustomValidity("Kérlek add meg az email-cimedet.");
                }
                else if(e.target.id='username'){
                    e.taget.setCustomValidity("Kérlek add meg a felhasználóneved!");
                }
                else if(e.target.id='password'){
                    e.taget.setCustomValidity("Kérlek add meg a jelszavadat!");
                }
            }
        }
        
    })
}