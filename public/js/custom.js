const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('overlay');

function openSidebar() {
  sidebar.classList.add('show');
  overlay.classList.add('show');
}

function closeSidebar() {
  sidebar.classList.remove('show');
  overlay.classList.remove('show');
}

// Check if there's a message and show SweetAlert
if (window.sessionMessage) {
  Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: window.sessionMessage,
    confirmButtonText: 'OK'
  });
}
