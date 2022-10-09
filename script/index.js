const Body = document.querySelector('body');
const MenuLink = document.querySelectorAll('.menu_link');
const HeaderLogo = document.querySelector('.header_logo');
const FooterLogo = document.querySelector('.footer_logo-icon');
const ContactForm = document.querySelector('.contacts-form');
const ContactFormMobileButton = document.querySelector('.contacts-form-mobile_button');

new Gallery(document.getElementById('gallery'));

// Переход по ссылкам
function scrollToHash(e) {
    e.preventDefault();
    
    let anchor = document.querySelector(this.hash);
    anchor.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
}

for (let link of MenuLink) {
    link.addEventListener('click', scrollToHash);
}
HeaderLogo.addEventListener('click', scrollToHash);
FooterLogo.addEventListener('click', scrollToHash);


// Input для телефона
const telInput = document.querySelector('.field-tel');
telInput.addEventListener('keydown', (evt) => {
    if (evt.keyCode == 107 || // +
    evt.keyCode == 109 || // -
    evt.keyCode == 8 || // BackSpace
    evt.keyCode == 9 || // Tab
    evt.keyCode == 46 || // Delete
    evt.keyCode == 48 || // 0 (доп ")")
    evt.keyCode == 57 || // 9 (доп "(")
    (evt.keyCode == 189 && evt.shiftKey === false) || // -
    (evt.keyCode == 187 && evt.shiftKey === true) || // доп "+"
    (evt.keyCode >= 37 && evt.keyCode <= 40) || // стрелки
    (evt.keyCode == 65 && evt.ctrlKey === true) || // Ctrl + A
    (evt.keyCode == 90 && evt.ctrlKey === true) || // Ctrl + Z
    (evt.keyCode > 48 && evt.keyCode < 57 && evt.shiftKey === false && evt.ctrlKey === false) || // цифры
    (evt.keyCode >= 96 && evt.keyCode <= 105 && evt.shiftKey === false && evt.ctrlKey === false)) { // цифры на цифровой клавиатуре
        return
    } else {
        evt.preventDefault();
    }
})


// Перенос формы в контактах в модальное окно для экранов уже 768px
const ContactModalWindow = 'contact-modal-window';
const ContactModalWindowShown = 'contact-modal-window-shown'
const CloseIcon = 'close-icon';

function getModalWindow(btn, form) {
    if (Body.clientWidth < 767.98) {
        wrapElementByDiv({
            element: form, 
            className: ContactModalWindow});
        btn.style.display = "inline-block";
	}

    const modal = document.querySelector(`.${ContactModalWindow}`);

    const close = document.createElement('div');
    close.classList.add(CloseIcon);
    close.innerHTML = `<img src="image/close.png" alt="Закрыть">`
    modal.prepend(close);

    btn.addEventListener('click', () => {
        modal.classList.add(ContactModalWindowShown);
        Body.classList.add('body_lock');
    })

    close.addEventListener('click', () => {
        modal.classList.remove(ContactModalWindowShown);
        Body.classList.remove('body_lock');
    })
}

getModalWindow(ContactFormMobileButton, ContactForm);


// Маска для input телефона
/*
window.addEventListener("DOMContentLoaded", function() {
    [].forEach.call( document.querySelectorAll('.tel'), function(input) {
    var keyCode;
    function mask(event) {
        event.keyCode && (keyCode = event.keyCode);
        var pos = this.selectionStart;
        if (pos < 3) event.preventDefault();
        var matrix = "+7 (___) ___ ____",
            i = 0,
            def = matrix.replace(/\D/g, ""),
            val = this.value.replace(/\D/g, ""),
            new_value = matrix.replace(/[_\d]/g, function(a) {
                return i < val.length ? val.charAt(i++) || def.charAt(i) : a
            });
        i = new_value.indexOf("_");
        if (i != -1) {
            i < 5 && (i = 3);
            new_value = new_value.slice(0, i)
        }
        var reg = matrix.substr(0, this.value.length).replace(/_+/g,
            function(a) {
                return "\\d{1," + a.length + "}"
            }).replace(/[+()]/g, "\\$&");
        reg = new RegExp("^" + reg + "$");
        if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
        if (event.type == "blur" && this.value.length < 5)  this.value = ""
    }

    input.addEventListener("input", mask, false);
    input.addEventListener("focus", mask, false);
    input.addEventListener("blur", mask, false);
    input.addEventListener("keydown", mask, false)

  });

});
*/