'use strict';

window.confirmRequest = function(url, answer) {
    var request = confirm(answer != null ? answer : 'Вы уверены что хотите удалить ?');

    if (request == true){
        location = url;
    }

    return false;
}

document.addEventListener("DOMContentLoaded", () => {

    document.querySelectorAll('.choice-select').forEach(function(element) {
        new Choices(element, {
            noChoicesText: 'Вариантов выбора больше нет',
            noResultsText: 'Список пуст',
            itemSelectText: 'Нажмите для выбора',
            loadingText: 'Загрузка...',
            removeItemButton: true,
            editItems: true,
            shouldSort: false,
        });
    });


    // мобильное меню - открытие/закрытие
    document.querySelector('#mobile_menu').addEventListener('click', function(e) {
        document.querySelector('.dashboard_menu').classList.toggle('dashboard_menu_mobile');

        e.preventDefault();
    });

    // аккордеон
    document.querySelectorAll('#accordion .card-header .btn').forEach(function(item) {
        item.addEventListener('click', function(e) {

            let target = e.target.dataset.target;

            document.querySelector('#accordion div[id="' + target + '"]').classList.toggle('show');

            e.preventDefault();
        });
    });

    // боковое меню - открытие/закрытие разделов
    document.querySelectorAll('.submenu_opener').forEach(function(item) {
        item.addEventListener('click', function(e) {
            this.classList.toggle('opened');

            for (let sibling of this.parentNode.children) {
                if (sibling !== this)
                    sibling.classList.toggle('event-slide-down');
            }

            e.preventDefault();
        });
    });


    // кнопка с выпадающими пунктами
    document.querySelectorAll('.dropdown-toggle').forEach(function(item) {
        item.addEventListener('click', function(e) {

            for (let sibling of this.parentNode.children) {
                if (sibling !== this)
                    sibling.classList.toggle('show');
            }

            e.preventDefault();
        });
    });

    // открытие модального окна
    document.querySelectorAll('a[data-toggle="modal"]').forEach(function(item) {
        item.addEventListener('click', function(e) {

            let modalWindowClass = this.dataset.target,
                modalWindow = document.querySelector(modalWindowClass);

            document.querySelector('body').classList.toggle('modal-open');
            modalWindow.classList.toggle('show');
            modalWindow.style.display = modalWindow.style.display === 'none' ? 'block' : 'none';

            let backDrop = document.querySelector('.modal-backdrop');

            if (backDrop) {
                backDrop.remove();
            } else {
                let newBackDrop = document.createElement('div');
                newBackDrop.classList.add('modal-backdrop', 'fade', 'show');
                document.body.appendChild(newBackDrop);
            }

            e.preventDefault();
        });
    });

    // закрытие модального окна
    document.querySelectorAll('button[class="close"]').forEach(function(item) {
        item.addEventListener('click', function(e) {

            [].forEach.call(e.target.parents('.modal'), (element) => {
                element.classList.remove('show');
                element.style.display = 'none';
            });

            document.querySelector('body').classList.remove('modal-open');

            var backDrop = document.querySelector('.modal-backdrop');

            if (backDrop) {
                backDrop.remove();
            }

            e.preventDefault();
        });
    });

    // табы на странице
    document.querySelectorAll('.nav-tabs a').forEach(function(item) {
        item.addEventListener('click', function(e) {
            var tab = this.getAttribute('aria-controls');

            document.querySelectorAll('.nav-tabs > li').forEach(function(navTab) {
                navTab.classList.remove('active');
            });

            this.parentNode.classList.add('active');

            document.querySelectorAll('.tab-content > div').forEach(function(tabContent) {
                tabContent.classList.remove('active');
                if (tabContent.id == tab) {
                    tabContent.classList.add('active');
                }
            });

            e.preventDefault();
        });
    });

    // событие при клике на лупу в таблице (поиск по столбцам)
    document.querySelectorAll('.search-field-form').forEach(function(item) {
        item.addEventListener('click', function(e) {

            [].forEach.call(e.target.parents('.sortable-field'), (element) => {
                element.classList.toggle('opened');
            });

            e.preventDefault();
        });
    });

    // отображать вводимое значение у изображений
    document.querySelectorAll('.gallery_input').forEach(function(item) {
        item.addEventListener('keyup', function(e) {

            this.parentNode.querySelector('.images_size_span').innerHTML = this.value;

        });
    });


    // проверка валидации в табах и переключение на необходимый таб
    document.querySelectorAll('input[type="submit"], button[type="submit"]').forEach(function(form) {
        form.addEventListener('click', () => {

            let invalidField = document.querySelector('input:invalid, textarea:invalid, select:invalid');

            if (invalidField) {
                [].forEach.call(invalidField.parents('.tab-pane'), (element) => {
                    document.querySelector('.nav-tabs a[aria-controls="' + element.id + '"]').click();
                });
            }

        });
    });

    // открытие объекта в таблице при нажатии на сам объект (tr -> td)
    document.querySelectorAll('table.table tr > td').forEach(function(item) {
        item.addEventListener('click', function(e) {

            let target = e.currentTarget;

            if (target.querySelectorAll('a, input').length == 0) {

                [].forEach.call(e.target.parents('tr'), (element) => {
                    if (element.dataset.href) {
                        location.href = element.dataset.href;
                    }
                });

                e.preventDefault();
            }

        });
    });

});
