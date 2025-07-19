// assets/js/admin.js

document.addEventListener('DOMContentLoaded', function() {
    // Find the 'Add Role' button and the container where new roles will be added.
    const addRoleBtn = document.getElementById('add-role-btn');
    const rolesContainer = document.getElementById('roles-container');

    // Only run this code if the necessary elements exist on the page.
    if (addRoleBtn && rolesContainer) {
        
        // Initialize a counter. We start at 1 because role 0 is already hardcoded in the HTML.
        let roleIndex = 1; 

        // --- Event Listener for the "Add Another Role" button ---
        addRoleBtn.addEventListener('click', function() {
            
            // 1. Create a new div to hold the set of role fields.
            const newRoleEntry = document.createElement('div');
            newRoleEntry.classList.add('role-entry');

            // 2. Define the HTML for the new fields.
            //    Using a template literal (``) makes it easy to write multi-line HTML.
            //    The ${roleIndex} variable is crucial for creating unique `id` and `name` attributes.
            newRoleEntry.innerHTML = `
                <div class="role-entry-header">
                    <h4>Role ${roleIndex + 1}</h4>
                    <button type="button" class="button button-outline-danger remove-role-btn" aria-label="Remove this role">&times;</button>
                </div>
                <div class="form-group">
                    <label for="role_title_${roleIndex}">Role Title</label>
                    <input type="text" id="role_title_${roleIndex}" name="roles[${roleIndex}][title]" required>
                </div>
                <div class="form-group">
                    <label for="role_period_${roleIndex}">Role Period</label>
                    <input type="text" id="role_period_${roleIndex}" name="roles[${roleIndex}][period]">
                </div>
                <div class="form-group">
                    <label for="role_description_${roleIndex}">Role Description</label>
                    <textarea id="role_description_${roleIndex}" name="roles[${roleIndex}][description]"></textarea>
                    <small>Enter each bullet point on a new line.</small>
                </div>
            `;

            // 3. Append the newly created element to the container.
            rolesContainer.appendChild(newRoleEntry);

            // 4. Increment the index so the next role added will have a new number (e.g., roles[2][...]).
            roleIndex++;
        });

        // --- Event Listener for Removing Roles (using Event Delegation) ---
        // Instead of adding a listener to every single remove button, we add one
        // to the parent container. This is more efficient.
        rolesContainer.addEventListener('click', function(event) {
            // Check if the element that was actually clicked has the .remove-role-btn class
            if (event.target.classList.contains('remove-role-btn')) {
                // If it does, find its closest parent with the .role-entry class and remove it.
                event.target.closest('.role-entry').remove();
            }
        });
    }
});