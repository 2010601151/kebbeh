// scripts.js

document.addEventListener('DOMContentLoaded', () => {
    console.log('Page loaded and ready.');

    // Function to handle dynamic form fields based on user role
    const roleSelect = document.getElementById('role');
    const additionalFields = document.getElementById('additional-fields');
    const registrationForm = document.getElementById('registrationForm');
    const registrationFeedback = document.getElementById('registrationFeedback');

    if (roleSelect) {
        roleSelect.addEventListener('change', function() {
            const role = this.value;
            additionalFields.innerHTML = ''; // Clear existing fields

            if (role === 'parent') {
                additionalFields.innerHTML = `
                    <div class="form-group">
                        <label for="student_id">Student ID:</label>
                        <input type="text" id="student_id" name="student_id" required>
                    </div>
                `;
            } else if (role === 'staff') {
                additionalFields.innerHTML = `
                    <div class="form-group">
                        <label for="role_name">Role Name:</label>
                        <input type="text" id="role_name" name="role_name" required>
                    </div>
                `;
            }
            // No additional fields for students
        });
    }

    // Handle form submission via AJAX
    if (registrationForm) {
        registrationForm.addEventListener('submit', (event) => {
            event.preventDefault(); // Prevent the default form submission

            const formData = new FormData(registrationForm);

            fetch('register.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Display the response from the PHP script
                if (registrationFeedback) {
                    registrationFeedback.innerHTML = '<p>' + data + '</p>';
                    // Optionally, reset the form
                    if (data.includes("successful")) {
                        registrationForm.reset();
                        additionalFields.innerHTML = '';
                    }
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }
});
