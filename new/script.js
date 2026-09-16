function loadContent(page) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', page, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('content').innerHTML = xhr.responseText;
        } else {
            document.getElementById('content').innerHTML = '<p>خطا در بارگذاری محتوا</p>';
        }
    };
    xhr.send();
}

// بارگذاری محتوای پیش‌فرض
document.addEventListener('DOMContentLoaded', function() {
    loadContent('home.html');
});

function toggleMenu() {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    sidebar.classList.toggle('open');
    content.classList.toggle('shift');
}

function toggleSubmenu(event) {
    event.stopPropagation();
    const submenu = event.target.nextElementSibling;
    if (submenu.classList.contains("show")) {
        submenu.classList.remove("show");
        event.target.innerHTML = "+";
    } else {
        submenu.classList.add("show");
        event.target.innerHTML = "-";
    }
}
