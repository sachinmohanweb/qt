/**
 * Admin Panel JavaScript
 */
document.addEventListener('DOMContentLoaded', function() {
    // Toggle sidebar on mobile
    const menuToggle = document.querySelector('.menu-toggle');
    const sidebar = document.querySelector('.sidebar');
    const contentWrapper = document.querySelector('.content-wrapper');
    
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('expanded');
        });
    }
    
    // User dropdown
    const userDropdown = document.querySelector('.user-dropdown');
    const dropdownMenu = document.querySelector('.dropdown-menu');
    
    if (userDropdown && dropdownMenu) {
        userDropdown.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdownMenu.classList.toggle('show');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            dropdownMenu.classList.remove('show');
        });
    }
    
    // Alert auto-dismiss
    const alerts = document.querySelectorAll('.alert');
    
    alerts.forEach(alert => {
        if (!alert.classList.contains('alert-persistent')) {
            setTimeout(() => {
                alert.style.opacity = '0';
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 300);
            }, 5000);
        }
    });
    
    // Image preview for file inputs
    const imageInputs = document.querySelectorAll('.image-input');
    
    imageInputs.forEach(input => {
        input.addEventListener('change', function() {
            const previewId = this.dataset.preview;
            const preview = document.getElementById(previewId);
            
            if (preview && this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
    
    // Confirm delete
    const deleteButtons = document.querySelectorAll('.delete-confirm');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to delete this item? This action cannot be undone.')) {
                e.preventDefault();
            }
        });
    });
    
    // Custom data tables (simple sorting and filtering)
    const dataTables = document.querySelectorAll('.data-table');
    
    dataTables.forEach(table => {
        const searchInput = table.parentElement.querySelector('.table-search');
        
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = table.querySelectorAll('tbody tr');
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });
        }
        
        const sortableHeaders = table.querySelectorAll('th.sortable');
        
        sortableHeaders.forEach(header => {
            header.addEventListener('click', function() {
                const index = Array.from(header.parentElement.children).indexOf(header);
                const isAsc = header.classList.contains('sort-asc');
                
                // Reset all headers
                sortableHeaders.forEach(h => {
                    h.classList.remove('sort-asc', 'sort-desc');
                });
                
                // Set new sort direction
                if (isAsc) {
                    header.classList.add('sort-desc');
                } else {
                    header.classList.add('sort-asc');
                }
                
                // Sort the table
                const rows = Array.from(table.querySelectorAll('tbody tr'));
                
                rows.sort((a, b) => {
                    const aValue = a.children[index].textContent.trim();
                    const bValue = b.children[index].textContent.trim();
                    
                    if (!isNaN(parseFloat(aValue)) && !isNaN(parseFloat(bValue))) {
                        return isAsc 
                            ? parseFloat(bValue) - parseFloat(aValue) 
                            : parseFloat(aValue) - parseFloat(bValue);
                    }
                    
                    return isAsc 
                        ? bValue.localeCompare(aValue) 
                        : aValue.localeCompare(bValue);
                });
                
                // Reappend in new order
                const tbody = table.querySelector('tbody');
                rows.forEach(row => tbody.appendChild(row));
            });
        });
    });
    
    // Initialize rich text editors if available
    if (typeof ClassicEditor !== 'undefined') {
        document.querySelectorAll('.rich-editor').forEach(editor => {
            ClassicEditor
                .create(editor)
                .catch(error => {
                    console.error(error);
                });
        });
    }
    
    // Form validation
    const forms = document.querySelectorAll('.needs-validation');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            form.classList.add('was-validated');
        }, false);
    });
});