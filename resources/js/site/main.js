"use strict";

let app = {

    loader : '<div class="online-loader"><img src="/images/site/loader.svg"></div>',

    bodyElement : document.querySelector('body'),

    alertErrorMessage : 'Произошла ошибка. Пожалуйста повторите еще раз!',

    phoneSize: 768,

    init : function() {
        app.initOnlineForms();
        app.resizeWindowEvent();
    },

    openModal: function(modalId, values) {
        let modal = document.querySelector('[data-modal-id="' + modalId + '"]');

        if (modal) {

            modal.classList.add('opened');
            app.bodyElement.classList.add('modals-opened');

            if (modal.querySelector('.form-block')) {
                modal.querySelector('.form-block').reset();
            }

            if (values.length > 0) {
                for (const [field, value] of Object.entries(values)) {
                    if (modal.querySelector('[name="' + field + '"]')) {
                        modal.querySelector('[name="' + field + '"]').value = value;
                    }
                }
            }


        } else {
            console.error('Modal with ID: "' + modalId + '" not found');
        }
    },

    closeModal: function(e) {
        app.bodyElement.classList.remove('modals-opened');

        [].forEach.call(e.target.parents('.modal-window'), function(modal) {
            modal.classList.remove('opened');
        });
    },

    closeAllModals: function() {
        app.bodyElement.classList.remove('modals-opened');

        document.querySelectorAll('.modal-window').forEach(function (modal) {
            modal.classList.remove('opened');
        });
    },

    initSelects: function() {
        document.querySelectorAll('.default-select select').forEach(function (select) {

            let options = document.createElement('div');
            options.classList.add('select-options');

            select.querySelectorAll('option').forEach(function (option) {
                let newOption =  document.createElement('div');
                newOption.setAttribute('value', option.getAttribute('value'));
                newOption.innerText = option.innerText;

                if (option.getAttribute('disabled') !== null) {
                    newOption.classList.add('disabled');
                }

                //console.log(option.getAttribute('selected'));
                if (option.getAttribute('selected') !== null) {
                    newOption.classList.add('selected');
                }

                options.append(newOption);

                newOption.addEventListener('click', (e) => {

                    if (newOption.classList.contains('disabled')) {
                        return false;
                    }

                    select.parentNode.classList.remove('opened');
                    select.value = newOption.getAttribute('value');
                    options.querySelectorAll('div').forEach(function (div) {
                       div.classList.remove('selected');
                    });
                    newOption.classList.add('selected');
                });
            });

            select.parentNode.append(options);

            select.addEventListener('mousedown', (e) => {

                let selectBox = e.target.parentNode;

                selectBox.classList.toggle('opened');

                e.preventDefault();
            });
        });
    },

    initOnlineForms: function () {

        document.querySelectorAll('.online-form').forEach(function (form) {

            form.addEventListener('submit', function (e) {

                let action  = form.getAttribute('action'),
                    messageSuccess = document.createElement('div'),
                    btnForm = form.querySelector('input[type="submit"]') || form.querySelector('button[type="submit"]'),
                    inputFile = form.querySelector('input[type="file"]'),
                    formData = new FormData(e.target);

                messageSuccess.classList.add('form-message-success');

                form.querySelectorAll('p.form-field-error').forEach(function (element) {
                    element.remove();
                });

                form.querySelectorAll('label, small').forEach(function (label) {
                    label.parentNode.classList.remove('invalid');
                });

                btnForm.setAttribute('disabled', 'disabled');

                if (inputFile) {
                    for (const file of inputFile.files) {
                        formData.append('files', file, file.name)
                    }
                }

                fetch(action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                }).then(function (response) {

                    if (response.ok) {
                        return response.json();
                    }

                    return Promise.reject(response);

                }).then(function (data) {

                    btnForm.removeAttribute('disabled');

                    if (data.errors && Object.keys(data.errors).length > 0) {
                        for (let field in data.errors) {
                            form.querySelectorAll('input[name="' + field + '"], select[name="' + field + '"], textarea[name="' + field + '"]').forEach(function (element) {
                                let error = document.createElement('p');
                                error.classList.add('form-field-error');
                                error.innerText = data.errors[field].join();
                                element.parentNode.appendChild(error);

                                element.parentNode.classList.add('invalid');
                            });
                        }

                    } else {

                        messageSuccess.innerText = data.success;

                        if (data.redirect) {
                            location.href = data.redirect;
                        }

                        if (form.classList.contains('close-form')) {
                            form.innerHTML = '';
                            form.appendChild(messageSuccess);
                        } else {
                            form.prepend(messageSuccess);
                        }

                        if (form.classList.contains('reload-form')) {
                            setTimeout(function(){
                                document.location.reload();
                            }, 4000);
                        }

                        form.reset();
                    }


                }).catch(function () {
                    alert(app.alertErrorMessage);
                    btnForm.removeAttribute('disabled');
                });

                e.preventDefault();
            });
        });

    },

    resizeWindowEvent: function () {

        if (document.documentElement.offsetWidth < app.phoneSize) {
            app.toMobile();
        } else {
            app.toDesktop();
        }

    },


    toMobile: function() {
        const elements = document.querySelectorAll('[data-desktop]'),
              defaultSlider = '.default-slider';


        for (let element of elements) {
            const id = +element.dataset.desktop;
            const portable = element.querySelector('[data-portable]');
            if (!portable) { return }
            if (document.querySelector(`[data-mobile="${id}"]`)) {
                document.querySelector(`[data-mobile="${id}"]`).append(portable);
            }
        }


        if ($(defaultSlider).length) {
            if ($(defaultSlider).hasClass('slick-initialized')) { return }

            $(defaultSlider).slick({
                slidesToShow: 3,
                arrows: false,
                touchThreshold: 20,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            variableWidth: true,
                            infinite: true,
                            arrows: false,
                        }
                    },
                ]
            });
        }

        document.getElementById('mobile-search-place').append(document.getElementById('search-info'));
    },



    toDesktop: function () {
        const elements = document.querySelectorAll('[data-mobile]'),
              defaultSlider = '.default-slider';

        for (let element of elements) {
            const id = element.dataset.mobile;
            const portable = element.querySelector('[data-portable]')
            if (!portable) { return }
            if (document.querySelector(`[data-desktop="${id}"]`)) {
                document.querySelector(`[data-desktop="${id}"]`).append(portable);
            }
        }

        if ($(defaultSlider).length) {
            let unslickInverval = setInterval(function () {
                if ($(defaultSlider).hasClass('slick-initialized')) {
                    $(defaultSlider).slick('unslick');
                } else {
                    clearInterval(unslickInverval);
                }
            }, 100);
        }

        document.getElementById('desktop-search-place').append(document.getElementById('search-info'));
    }

};

window.onload = () => {
    app.init();

    window.addEventListener('resize', function () {
        app.resizeWindowEvent();
    });

    window.addEventListener('click', function (e) {

        if (e.target == document.querySelector('.modal-window-layout')) {
            app.closeAllModals();
        }

        let headerMoreBtn = e.target.closest('.header-menu__item-more');

        if (headerMoreBtn) {
            headerMoreBtn.querySelector('.header-dropdown').toggleAttribute('hidden');
        } else {
            $('.header-dropdown').attr('hidden', true);
        }

    });

    document.querySelectorAll('[data-target-modal]').forEach(function (btn) {
        btn.addEventListener('click', function (e) {

            let targetModal = btn.dataset.targetModal,
                values = [];

            if (btn.dataset.values) {
                values = JSON.parse(btn.dataset.values);
            }

            app.openModal(targetModal, values);

            e.preventDefault();
        })
    });

    document.querySelectorAll('.modal-window .close-modal').forEach(function (item) {
        item.addEventListener('click', (e) => {
            app.closeModal(e);

            e.preventDefault();
        });
    });


    // открыть меню в мобилке
    document.getElementById('toggle-menu').addEventListener('click', function (event) {
        const $menu = document.getElementById('mobile-menu')
        const $header = document.querySelector('.header')

        if ($menu.hasAttribute('hidden')) {
            $menu.removeAttribute('hidden')
            $header.classList.add('header_fixed')
            this.querySelector('img').setAttribute('src', '/images/site/close.svg');
            document.documentElement.style.overflowY = 'hidden'
        } else {
            $menu.setAttribute('hidden', true)
            $header.classList.remove('header_fixed')
            this.querySelector('img').setAttribute('src', '/images/site/3line.svg');
            document.documentElement.style.overflowY = 'auto'
        }
    });

    // рассчитать закят
    if (document.querySelector('.donation-form__calc')) {
        document.querySelector('.donation-form__calc').addEventListener('click', function (event) {

            let sum = 0;

            document.querySelectorAll('.donation-form__inputs input').forEach(function (input) {
                if (input.value) {
                    let amount = parseInt(input.value);

                    if (amount > 0)
                        sum+= parseInt(input.value);
                }
            });

            sum = Math.round(sum * 0.025);

            document.querySelector('.donation-form-total__sum span').innerText = sum;
            document.querySelector('.donation-form-total input').value = sum;

            event.preventDefault();
        });
    }


    document.querySelectorAll('.video-preview__play').forEach(function (video) {
        video.addEventListener('click', function (e) {
            video.parentNode.style.display = 'none';
            video.parentNode.parentNode.querySelector('.video-block-frame').style.display = 'block';
        });
    });

};

window.app = app;
    (function($, document) {
    
      // get tallest tab__content element
      let height = -1;

        $('.tab__content').each(function() {
            height = height > $(this).outerHeight() ? height : $(this).outerHeight();
         $(this).css('position', 'absolute');
        });
      
      // set height of tabs + top offset
        $('[data-tabs]').css('min-height', height + 40 + 'px');
   
}(jQuery, document));






