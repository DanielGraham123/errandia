
(
    function () {
        document.addEventListener('DOMContentLoaded', function() {
            const helpersMenu = document.querySelector('li.treeview > a > span');
            if (helpersMenu) {
                helpersMenu.style.display = 'none';
            }
        });
    }
)