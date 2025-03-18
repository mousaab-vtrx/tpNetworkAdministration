document.addEventListener('DOMContentLoaded', function() {
    // Add icons to buttons
    const addIcons = () => {
      // Add icon for add button
      const addButtons = document.querySelectorAll('.btn-add');
      addButtons.forEach(button => {
        const icon = document.createElement('span');
        icon.classList.add('icon');
        icon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>';
        button.prepend(icon);
      });
  
      // Add icon for edit buttons
      const editButtons = document.querySelectorAll('.btn-edit');
      editButtons.forEach(button => {
        const icon = document.createElement('span');
        icon.classList.add('icon');
        icon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>';
        button.innerHTML = '';
        button.appendChild(icon);
      });
  
      // Add icon for delete buttons
      const deleteButtons = document.querySelectorAll('.btn-delete');
      deleteButtons.forEach(button => {
        const icon = document.createElement('span');
        icon.classList.add('icon');
        icon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>';
        button.innerHTML = '';
        button.appendChild(icon);
      });
    };
  
    // Animation for table rows
    const animateTableRows = () => {
      const tableRows = document.querySelectorAll('tbody tr');
      tableRows.forEach((row, index) => {
        row.classList.add('animated');
        row.style.animationDelay = `${index * 0.05}s`;
      });
    };
  
    // Form validation
    const setupFormValidation = () => {
      const form = document.querySelector('form');
      if (!form) return;
  
      const validateName = (input) => {
        if (input.value.trim() === '') {
          showError(input, 'This field is required.');
          return false;
        } else if (!/^[A-Za-z]+$/.test(input.value)) {
          showError(input, 'Invalid name format.');
          return false;
        }
        removeError(input);
        return true;
      };
  
      const validateEmail = (input) => {
        if (input.value.trim() === '') {
          showError(input, 'This field is required.');
          return false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value)) {
          showError(input, 'Please enter a valid email address.');
          return false;
        }
        removeError(input);
        return true;
      };
  
      const validateAge = (input) => {
        if (input.value.trim() === '') {
          showError(input, 'This field is required.');
          return false;
        } else if (!/^\d+$/.test(input.value)) {
          showError(input, 'Please enter a valid age number.');
          return false;
        }
        removeError(input);
        return true;
      };
  
      const validateSelect = (input) => {
        if (input.value === '' || input.value === 'Select Gender' || input.value === 'Select Designation') {
          showError(input, 'This field is required.');
          return false;
        }
        removeError(input);
        return true;
      };
  
      const validateDate = (input) => {
        if (input.value.trim() === '') {
          showError(input, 'This field is required.');
          return false;
        }
        removeError(input);
        return true;
      };
  
      const showError = (input, message) => {
        // Remove any existing error
        removeError(input);
        
        // Create error element
        const error = document.createElement('span');
        error.classList.add('form-error');
        error.textContent = message;
        
        // Add error after input
        input.parentNode.appendChild(error);
        input.classList.add('error');
      };
  
      const removeError = (input) => {
        // Remove existing error message if any
        const existingError = input.parentNode.querySelector('.form-error');
        if (existingError) {
          existingError.remove();
        }
        input.classList.remove('error');
      };
  
      if (form) {
        // Add input validation on blur
        const fnameInput = document.getElementById('fname');
        const lnameInput = document.getElementById('lname');
        const emailInput = document.getElementById('email');
        const ageInput = document.getElementById('age');
        const genderSelect = document.getElementById('gender');
        const designationSelect = document.getElementById('designation');
        const dateInput = document.getElementById('date');
  
        if (fnameInput) fnameInput.addEventListener('blur', () => validateName(fnameInput));
        if (lnameInput) lnameInput.addEventListener('blur', () => validateName(lnameInput));
        if (emailInput) emailInput.addEventListener('blur', () => validateEmail(emailInput));
        if (ageInput) ageInput.addEventListener('blur', () => validateAge(ageInput));
        if (genderSelect) genderSelect.addEventListener('change', () => validateSelect(genderSelect));
        if (designationSelect) designationSelect.addEventListener('change', () => validateSelect(designationSelect));
        if (dateInput) dateInput.addEventListener('blur', () => validateDate(dateInput));
  
        // Form submission
        form.addEventListener('submit', (e) => {
          let isValid = true;
  
          if (fnameInput && !validateName(fnameInput)) isValid = false;
          if (lnameInput && !validateName(lnameInput)) isValid = false;
          if (emailInput && !validateEmail(emailInput)) isValid = false;
          if (ageInput && !validateAge(ageInput)) isValid = false;
          if (genderSelect && !validateSelect(genderSelect)) isValid = false;
          if (designationSelect && !validateSelect(designationSelect)) isValid = false;
          if (dateInput && !validateDate(dateInput)) isValid = false;
  
          if (!isValid) {
            e.preventDefault();
          }
        });
      }
    };
  
    // Delete confirmation
    const setupDeleteConfirmation = () => {
      const deleteButtons = document.querySelectorAll('.btn-delete');
      deleteButtons.forEach(button => {
        button.addEventListener('click', (e) => {
          if (!confirm('Are you sure you want to delete this record?')) {
            e.preventDefault();
          }
        });
      });
    };
  
    // Run all functions
    addIcons();
    animateTableRows();
    setupFormValidation();
    setupDeleteConfirmation();
  });