document.querySelectorAll('[data-toggle="modal"]').forEach(trigger => {
    trigger.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default action for the link
        
        const modalId = this.getAttribute('href'); // Get modal ID from href attribute
        const modalElement = document.querySelector(modalId); // Find the modal element using its ID
        const modal = new bootstrap.Modal(modalElement, {
            backdrop: 'true' // Enable the backdrop
        });

        modal.show(); // Show the modal
    });
});

// Automatically close the modal when the "X" button is clicked (close button)
document.querySelectorAll('.close').forEach(closeButton => {
    closeButton.addEventListener('click', function () {
        const modalElement = this.closest('.modal'); // Find the closest modal element
        const modalInstance = bootstrap.Modal.getInstance(modalElement); // Get the Bootstrap Modal instance
        modalInstance.hide(); // Close the modal
    });
});

// Automatically close the modal when clicking outside the modal
window.addEventListener('click', function (event) {
    document.querySelectorAll('.modal').forEach(modal => {
        if (event.target === modal) { // If the clicked target is the modal (backdrop)
            const modalInstance = bootstrap.Modal.getInstance(modal);
            modalInstance.hide(); // Close the modal
        }
    });
});
