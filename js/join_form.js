document.addEventListener('DOMContentLoaded', function() {
    // Select all buttons that open the popup
    const joinButtons = document.querySelectorAll('.join-btn');
    const popupOverlay = document.querySelector('.popup-overlay');
    const closeButton = document.querySelector('.popup-form .close-btn');
    const joinForm = document.querySelector('.popup-form');

    if (!popupOverlay || !closeButton || !joinForm) {
        console.error('Popup elements not found');
        return;
    }

    // Function to open popup
    function openPopup(e) {
        e.preventDefault(); // Prevent default link behavior
        popupOverlay.style.display = 'flex';
        setTimeout(() => popupOverlay.style.opacity = '1', 10);
    }

    // Function to close popup
    function closePopup() {
        popupOverlay.style.opacity = '0';
        setTimeout(() => popupOverlay.style.display = 'none', 300);
    }

    // Add click event to all Join Now buttons
    joinButtons.forEach(button => {
        button.addEventListener('click', openPopup);
    });

    // Add click event to Close button
    closeButton.addEventListener('click', closePopup);

    // Close popup when clicking on overlay
    popupOverlay.addEventListener('click', function(e) {
        if (e.target === popupOverlay) {
            closePopup();
        }
    });

    // फॉर्म सबमिशन हैंडल करें
    joinForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        formData.append('submit', '1');

        fetch('join_form.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                closePopup();
                joinForm.reset();
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('फॉर्म जमा करने में त्रुटि हुई');
        });
    });

    // Update file upload label
    const fileInput = document.querySelector('.popup-form input[type="file"]');
    const fileLabel = document.querySelector('.file-upload span');

    fileInput.addEventListener('change', function() {
        if (this.files.length > 0) {
            fileLabel.textContent = this.files[0].name;
        } else {
            fileLabel.textContent = 'Choose File';
        }
    });
});;