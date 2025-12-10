<div class="flex justify-between items-center w-full" style="position:relative;">
    <!-- Left Section -->
    <div class="flex items-center gap-3">
        <button id="sidebarToggle" class="text-gray-700 hover:text-indigo-600 focus:outline-none">
            <i class="bi bi-list" style="font-size:1.8rem;"></i>
        </button>
        <h2 class="text-lg font-semibold text-gray-800">@yield('page_title', 'Dashboard')</h2>
    </div>

    <!-- Right Section -->
    <div class="flex items-center gap-4">

        @if(Auth::user()->role != 'admin')
        <!-- Notification Bell -->
        <div class="dropdown">
            <a class="nav-link position-relative" href="#" id="notificationDropdown" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-bell fs-5 text-gray-700"></i>
                <span id="notification-count"
                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    style="font-size: 0.7rem;">0</span>
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="notificationDropdown"
                style="width: 320px; max-height: 400px; overflow-y: auto;">
                <li class="dropdown-header fw-bold bg-light">Notifications</li>
                <div id="notification-list">
                    <li class="text-center py-2 text-muted">Loading...</li>
                </div>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li class="text-center">
                    <a href="{{ route('notifications.index') }}" class="btn btn-sm btn-outline-primary">
                        View All Notifications
                    </a>
                </li>
            </ul>
        </div>
        @endif

        <!-- User Menu -->
        <div class="user-menu" style="position:relative;">
            <button type="button" class="user-toggle" aria-haspopup="true" aria-expanded="false"
                style="background:transparent;border:none;display:flex;align-items:center;gap:8px;cursor:pointer;">
                <i class="bi bi-person-circle text-indigo-600" style="font-size:1.5rem"></i>
                <span class="font-medium">{{ Auth::user()->name ?? 'User' }}</span>
                <i class="bi bi-caret-down-fill" style="color:#6b7280;margin-left:6px;"></i>
            </button>

            <!-- Dropdown -->
            <div class="user-dropdown" role="menu" aria-label="User menu"
                style="position:absolute;right:0;top:calc(100% + 8px);width:220px;background:#fff;
                border:1px solid rgba(0,0,0,0.08);box-shadow:0 6px 18px rgba(0,0,0,0.08);
                border-radius:8px;display:none;z-index:999;">
                <a href="{{ route('profile.edit') }}"
                    style="display:block;padding:10px 14px;color:#111;text-decoration:none;border-bottom:1px solid rgba(0,0,0,0.03);">
                    <i class="bi bi-gear me-2"></i> Update Profile
                </a>
                <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                    @csrf
                    <button type="submit"
                        style="display:block;width:100%;text-align:left;padding:10px 14px;
                            color:#d9534f;border:none;background:transparent;cursor:pointer;
                            border-top:1px solid rgba(0,0,0,0.03);">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.querySelector('.user-toggle');
        const dropdown = document.querySelector('.user-dropdown');

        if (!toggle || !dropdown) return;

        toggle.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });

        document.addEventListener('click', function() {
            dropdown.style.display = 'none';
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') dropdown.style.display = 'none';
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        fetchNotifications();

        // Fetch all notifications
        function fetchNotifications() {
            fetch("{{ route('notifications.fetch') }}")
                .then(res => res.json())
                .then(data => {
                    const list = document.getElementById('notification-list');
                    const count = document.getElementById('notification-count');

                    count.textContent = data.unread_count > 0 ? data.unread_count : '';

                    if (data.notifications.length === 0) {
                        list.innerHTML = '<li class="text-center py-2 text-muted">No notifications found</li>';
                        return;
                    }

                    let html = '';
                    data.notifications.forEach(notification => {
                        html += `
                        <li class="dropdown-item d-flex justify-content-between align-items-start py-2 border-bottom notification-item"
                            data-id="${notification.id}">
                            <div>
                                <strong>${notification.title}</strong><br>
                                <small>${notification.description ? notification.description.substring(0, 50) + '...' : ''}</small>
                            </div>
                            ${!notification.is_read ? '<span class="badge bg-danger rounded-circle">●</span>' : ''}
                        </li>`;
                    });

                    list.innerHTML = html;

                    // Attach click events to each notification item
                    document.querySelectorAll('.notification-item').forEach(item => {
                        item.addEventListener('click', function() {
                            const id = this.getAttribute('data-id');
                            markAsRead(id);
                        });
                    });
                })
                .catch(err => console.error(err));
        }

        // Mark as read
        function markAsRead(id) {
            fetch(`/notifications/read/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        fetchNotifications(); // Refresh after marking read
                    }
                })
                .catch(err => console.error(err));
        }

        // Optional: Auto-refresh notifications every minute
        setInterval(fetchNotifications, 60000);
    });
</script>