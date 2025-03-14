function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const hamburger = document.getElementById('hamburger');
    console.log(hamburger);
    sidebar.classList.toggle('visible');
    sidebar.classList.toggle('hidden');
    hamburger.style.zIndex = sidebar.classList.contains('visible') ? '1001' : '1000';
}

document.getElementById('hamburger').addEventListener('click', function() {
    var sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('hidden');
});