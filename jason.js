document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    const successPopup = document.getElementById('successPopup');
    const closePopupButton = document.getElementById('closePopup');

    // 1. Check if the donation was successful
    if (status === 'success') {
        // Show the popup by removing the 'hidden' class
        successPopup.classList.remove('hidden');

        // Clear the status from the URL history to prevent the popup from reappearing on refresh
        if (window.history.replaceState) {
            const cleanUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
            window.history.replaceState({path: cleanUrl}, '', cleanUrl);
        }
    } 

    // 2. Add functionality to close the popup
    closePopupButton.addEventListener('click', function() {
        successPopup.classList.add('hidden');
    });

    // Closes popup when the overlay is clicked 
    successPopup.addEventListener('click', function(event) {
        if (event.target === successPopup) {
            successPopup.classList.add('hidden');
        }
    });
});