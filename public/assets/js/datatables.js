/**
 * Ajax DataTables Implementation
 */

$(document).ready(function() {
    // Users DataTable
    if ($('#users-table').length) {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/admin/users/data',
                data: function(d) {
                    d.role_filter = $('#role-filter').val();
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { 
                    data: 'name', 
                    name: 'name',
                    render: function(data, type, row) {
                        return `
                            <div class="d-flex align-items-center">
                                <div class="user-avatar me-2">${data.charAt(0)}</div>
                                ${data}
                            </div>
                        `;
                    }
                },
                { data: 'email', name: 'email' },
                { 
                    data: 'role', 
                    name: 'role',
                    render: function(data) {
                        const badgeClass = data === 'admin' ? 'primary' : (data === 'editor' ? 'success' : 'secondary');
                        return `<span class="badge badge-${badgeClass}">${data.charAt(0).toUpperCase() + data.slice(1)}</span>`;
                    }
                },
                { data: 'created_at', name: 'created_at' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            order: [[0, 'desc']],
            pageLength: 10,
            responsive: true,
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rtip'
        });

        $('#role-filter').on('change', function() {
            $('#users-table').DataTable().ajax.reload();
        });
    }

    // Testimonials DataTable
    if ($('#testimonials-table').length) {
        $('#testimonials-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/admin/testimonials/data',
                data: function(d) {
                    d.star_rating_filter = $('#star-rating-filter').val();
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { 
                    data: 'image', 
                    name: 'image', 
                    orderable: false, 
                    searchable: false,
                    render: function(data, type, row) {
                        if (data) {
                            return `<img src="/storage/testimonials/${data}" alt="${row.name}" style="height: 40px; width: 40px; object-fit: cover; border-radius: 50%;">`;
                        } else {
                            return `<div style="height: 40px; width: 40px; background-color: #f3f4f6; border-radius: 50%; display: flex; align-items: center; justify-content: center;"><i class="fas fa-user text-secondary"></i></div>`;
                        }
                    }
                },
                { data: 'name', name: 'name' },
                { 
                    data: 'star_rating', 
                    name: 'star_rating',
                    render: function(data) {
                        let stars = '';
                        for (let i = 1; i <= 5; i++) {
                            if (i <= data) {
                                stars += '<i class="fas fa-star text-warning"></i>';
                            } else {
                                stars += '<i class="far fa-star text-warning"></i>';
                            }
                        }
                        return `<div class="star-rating">${stars}</div>`;
                    }
                },
                { 
                    data: 'home_visibility', 
                    name: 'home_visibility',
                    orderable: false,
                    render: function(data, type, row) {
                        const isActive = data == 1 ? 'active' : '';
                        return `<div class="toggle-switch ${isActive}" onclick="toggleStatus('/admin/testimonials/${row.id}/toggle-home-visibility', this)"><div class="toggle-slider"></div></div>`;
                    }
                },
                { 
                    data: 'status', 
                    name: 'status',
                    orderable: false,
                    render: function(data, type, row) {
                        const isActive = data == 1 ? 'active' : '';
                        return `<div class="toggle-switch ${isActive}" onclick="toggleStatus('/admin/testimonials/${row.id}/toggle-status', this)"><div class="toggle-slider"></div></div>`;
                    }
                },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            order: [[0, 'desc']],
            pageLength: 10,
            responsive: true
        });

        $('#star-rating-filter').on('change', function() {
            $('#testimonials-table').DataTable().ajax.reload();
        });
    }

    // Blogs DataTable
    if ($('#blogs-table').length) {
        $('#blogs-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/admin/blogs/data',
            columns: [
                { data: 'id', name: 'id' },
                { 
                    data: 'image', 
                    name: 'image', 
                    orderable: false, 
                    searchable: false,
                    render: function(data, type, row) {
                        if (data) {
                            return `<img src="/storage/blogs/${data}" alt="${row.heading}" style="height: 40px; width: 40px; object-fit: cover; border-radius: 4px;">`;
                        } else {
                            return `<div style="height: 40px; width: 40px; background-color: #f3f4f6; border-radius: 4px; display: flex; align-items: center; justify-content: center;"><i class="fas fa-image text-secondary"></i></div>`;
                        }
                    }
                },
                { 
                    data: 'heading', 
                    name: 'heading',
                    render: function(data) {
                        return data.length > 30 ? data.substring(0, 30) + '...' : data;
                    }
                },
                { data: 'user_name', name: 'user_name' },
                { data: 'date', name: 'date' },
                { 
                    data: 'home_visibility', 
                    name: 'home_visibility',
                    orderable: false,
                    render: function(data, type, row) {
                        const isActive = data == 1 ? 'active' : '';
                        return `<div class="toggle-switch ${isActive}" onclick="toggleStatus('/admin/blogs/${row.id}/toggle-home-visibility', this)"><div class="toggle-slider"></div></div>`;
                    }
                },
                { 
                    data: 'status', 
                    name: 'status',
                    orderable: false,
                    render: function(data, type, row) {
                        const isActive = data == 1 ? 'active' : '';
                        return `<div class="toggle-switch ${isActive}" onclick="toggleStatus('/admin/blogs/${row.id}/toggle-status', this)"><div class="toggle-slider"></div></div>`;
                    }
                },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            order: [[0, 'desc']],
            pageLength: 10,
            responsive: true
        });
    }

    // Service Types DataTable
    if ($('#service-types-table').length) {
        $('#service-types-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/admin/service-types/data',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'type', name: 'type' },
                { data: 'name', name: 'name' },
                { 
                    data: 'status', 
                    name: 'status',
                    orderable: false,
                    render: function(data, type, row) {
                        const isActive = data == 1 ? 'active' : '';
                        return `<div class="toggle-switch ${isActive}" onclick="toggleStatus('/admin/service-types/${row.id}/toggle-status', this)"><div class="toggle-slider"></div></div>`;
                    }
                },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            order: [[0, 'desc']],
            pageLength: 10,
            responsive: true
        });
    }

    // Services DataTable
    if ($('#services-table').length) {
        $('#services-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/admin/services/data',
                data: function(d) {
                    d.type_filter = $('#type-filter').val();
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { 
                    data: 'image', 
                    name: 'image', 
                    orderable: false, 
                    searchable: false,
                    render: function(data, type, row) {
                        if (data) {
                            return `<img src="/storage/projects/${data}" alt="${row.name}" style="height: 40px; width: 40px; object-fit: cover; border-radius: 4px;">`;
                        } else {
                            return `<div style="height: 40px; width: 40px; background-color: #f3f4f6; border-radius: 4px; display: flex; align-items: center; justify-content: center;"><i class="fas fa-tools text-secondary"></i></div>`;
                        }
                    }
                },
                { data: 'name', name: 'name' },
                { data: 'subtitle', name: 'subtitle' },
                { 
                    data: 'menu_item_id', 
                    name: 'MenuItem.name',
                    render: function(data) {
                        return `<span class="badge badge-primary">${data}</span>`;
                    }
                },
                { 
                    data: 'home_visibility', 
                    name: 'home_visibility',
                    orderable: false,
                    render: function(data, type, row) {
                        const isActive = data == 1 ? 'active' : '';
                        return `<div class="toggle-switch ${isActive}" onclick="toggleStatus('/admin/services/${row.id}/toggle-home-visibility', this)"><div class="toggle-slider"></div></div>`;
                    }
                },
                { 
                    data: 'status', 
                    name: 'status',
                    orderable: false,
                    render: function(data, type, row) {
                        const isActive = data == 1 ? 'active' : '';
                        return `<div class="toggle-switch ${isActive}" onclick="toggleStatus('/admin/services/${row.id}/toggle-status', this)"><div class="toggle-slider"></div></div>`;
                    }
                },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            order: [[0, 'desc']],
            pageLength: 10,
            responsive: true
        });

        $('#type-filter').on('change', function() {
            $('#services-table').DataTable().ajax.reload();
        });
    }

    // Service Gallery DataTable
    if ($('#service-galleries-table').length) {
        $('#service-galleries-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/admin/service-galleries/data',
                data: function(d) {
                    d.type_filter = $('#type-filter').val();
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { 
                    data: 'image', 
                    name: 'image', 
                    orderable: false, 
                    searchable: false,
                    render: function(data) {
                        return `<img src="/storage/project_images/${data}" alt="Gallery Image" style="height: 40px; width: 40px; object-fit: cover; border-radius: 4px;">`;
                    }
                },
                { data: 'service_name', name: 'Project.name' },
                { 
                    data: 'service_type', 
                    name: 'Project.MenuItem.name',
                    render: function(data) {
                        return `<span class="badge badge-primary">${data}</span>`;
                    }
                },
                { 
                    data: 'status', 
                    name: 'status',
                    orderable: false,
                    render: function(data, type, row) {
                        const isActive = data == 1 ? 'active' : '';
                        return `<div class="toggle-switch ${isActive}" onclick="toggleStatus('/admin/service-galleries/${row.id}/toggle-status', this)"><div class="toggle-slider"></div></div>`;
                    }
                },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            order: [[0, 'desc']],
            pageLength: 10,
            responsive: true
        });

        $('#type-filter').on('change', function() {
            $('#service-galleries-table').DataTable().ajax.reload();
        });
    }

    // Video DataTable
    if ($('#video-items-table').length) {
        $('#video-items-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/admin/video-items/data',
                data: function(d) {
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { 
                    data: 'thumb', 
                    name: 'thumb', 
                    orderable: false, 
                    searchable: false,
                    render: function(data) {
                        return `<img src="/storage/video_items/${data}" alt="Gallery Image" style="height: 100px; width: 100x; object-fit: cover; border-radius: 4px;">`;
                    }
                },
                { data: 'type', name: 'type' },
                
                { 
                    data: 'home_visibility', 
                    name: 'home_visibility',
                    orderable: false,
                    render: function(data, type, row) {
                        const isActive = data == 1 ? 'active' : '';
                        return `<div class="toggle-switch ${isActive}" onclick="toggleStatus('/admin/video-items/${row.id}/toggle-home-visibility', this)"><div class="toggle-slider"></div></div>`;
                    }
                },
                { 
                    data: 'status', 
                    name: 'status',
                    orderable: false,
                    render: function(data, type, row) {
                        const isActive = data == 1 ? 'active' : '';
                        return `<div class="toggle-switch ${isActive}" onclick="toggleStatus('/admin/video-items/${row.id}/toggle-status', this)"><div class="toggle-slider"></div></div>`;
                    }
                },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            order: [[0, 'desc']],
            pageLength: 10,
            responsive: true
        });

        $('#type-filter').on('change', function() {
            $('#video-items-table').DataTable().ajax.reload();
        });
    }

   
});