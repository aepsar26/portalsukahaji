// Sidebar toggle for mobile
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('open');
}

// Auto-hide alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.remove();
            }, 300);
        }, 5000);
    });
});

// Handle window resize for responsive behavior
window.addEventListener('resize', function() {
    if (window.innerWidth > 768) {
        document.getElementById('sidebar').classList.remove('open');
    }
});

// Format numbers in forms
function formatNumber(input) {
    let value = input.value.replace(/[^\d]/g, '');
    input.value = parseInt(value).toLocaleString('id-ID');
}

function openModal(id) {
    document.getElementById(id).style.display = 'flex';
}
function closeModal(id) {
    document.getElementById(id).style.display = 'none';
}


// Confirm delete actions
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('btn-danger') && e.target.type === 'submit') {
        if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            e.preventDefault();
            return false;
        }
    }
});

// Add loading state to forms
document.addEventListener('submit', function(e) {
    const submitBtn = e.target.querySelector('button[type="submit"]');
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Memproses...';
    }
});

function toggleUserMenu() {
    const menu = document.getElementById('user-menu');
    menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
}

// Tutup dropdown kalau klik di luar
document.addEventListener('click', function(event) {
    const menu = document.getElementById('user-menu');
    const avatar = document.querySelector('.user-avatar');
    if (menu && avatar && !avatar.contains(event.target) && !menu.contains(event.target)) {
        menu.style.display = 'none';
    }
});

// Konfirmasi logout dengan SweetAlert2
function confirmLogout() {
    Swal.fire({
        title: 'Yakin mau logout?',
        text: "Kamu akan keluar dari dashboard.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3490dc',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Logout',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("logout-form").submit();
        }
    });
}

// 🔔 Notifikasi Sukses
if (typeof successMessage !== 'undefined' && successMessage) {
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: successMessage,
        showConfirmButton: false,
        timer: 2000
    });
}

// 🔔 Notifikasi Error (Validasi)
if (typeof errorMessages !== 'undefined' && errorMessages.length > 0) {
    Swal.fire({
        icon: 'error',
        title: 'Terjadi Kesalahan',
        html: errorMessages.join('<br>')
    });
}

// 🔔 Konfirmasi Hapus (Global)
function confirmDelete(formId) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data yang sudah dihapus tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}

// 🔔 Konfirmasi Logout
function confirmLogout() {
    Swal.fire({
        title: 'Yakin mau logout?',
        text: "Kamu akan keluar dari dashboard.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3490dc',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Logout',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("logout-form").submit();
        }
    });
}

// Toggle menu user
function toggleUserMenu() {
    const menu = document.getElementById("user-menu");
    menu.style.display = menu.style.display === "block" ? "none" : "block";
}

// Klik di luar → tutup menu
document.addEventListener("click", function(e) {
    const avatar = document.querySelector(".user-avatar");
    const menu = document.getElementById("user-menu");
    if (avatar && menu && !avatar.contains(e.target) && !menu.contains(e.target)) {
        menu.style.display = "none";
    }
});
