function toggleDetails() {
    const sidebar = document.getElementById('sidebar');
    if (sidebar.style.width === '0px' || sidebar.style.width === '') {
        sidebar.style.width = '33.33%';
    } else {
        sidebar.style.width = '0px';
    }
}
