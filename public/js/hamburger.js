function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const hamburger = document.getElementById('hamburger');
    sidebar.classList.toggle('visible');
    sidebar.classList.toggle('hidden');
    hamburger.style.zIndex = sidebar.classList.contains('visible') ? '1001' : '1000';
}