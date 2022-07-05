
const validation = new JustValidate('#form');

validation
    .addField('#name', [
        {
            rule: 'required',
            errorMessage: 'Поле обязательно для заполнения',
        },
        {
            rule: 'minLength',
            value: 3,
        },
        {
            rule: 'maxLength',
            value: 30,
        },
        {
            rule: 'customRegexp',
            value: /^[аАбБвВгГдДеЕёЁжЖзЗиИйЙкКлЛмМнНоОпПрРсСтТуУфФхХцЦчЧшШщЩъЪыЫьЬэЭюЮяЯ]+$/,
            errorMessage: 'Поле заполнено не корректно'
        },
    ])
    .addField('#surname', [
        {
            rule: 'required',
            errorMessage: 'Поле обязательно для заполнения',
        },
        {
            rule: 'minLength',
            value: 3,
        },
        {
            rule: 'maxLength',
            value: 30,
        },
        {
            rule: 'customRegexp',
            value: /^[аАбБвВгГдДеЕёЁжЖзЗиИйЙкКлЛмМнНоОпПрРсСтТуУфФхХцЦчЧшШщЩъЪыЫьЬэЭюЮяЯ]+$/,
            errorMessage: 'Поле заполнено не корректно'
        },
    ])
    .addField('#city', [
        {
            rule: 'required',
            errorMessage: 'Поле обязательно для заполнения',
        },
    ])
    .addField('#email', [
        {
            rule: 'required',
            errorMessage: 'Поле обязательно для заполнения',
        },
        {
            rule: 'email',
            errorMessage: 'Email введён не верно',
        },
    ])
    .addField("#phone", [
        {
            rule: 'required',
            errorMessage: 'Поле обязательно для заполнения',
        },
        {
            rule: 'customRegexp',
            value: /^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/,
            errorMessage: 'Поле заполнено не корректно'
        },
    ])
    .addField('#file', [
        {
            rule: 'minFilesCount',
            value: 1,
            errorMessage: 'Выберите хотя бы один файл',
        },
    ])


const popup = document.querySelector('.popup')
const popupClose = document.querySelector('.popup_close')

const popupVisibleClass = 'popup_visible'

validation.onSuccess(function (event) {
    event.target.submit();
})

if (popupClose) {
    popupClose.addEventListener('click', function () {
        popup.classList.remove(popupVisibleClass)
    })
}

const datepicker = new Datepicker('#datepicker', {
    max: new Date(),
    serialize: function (e) {
        if (typeof e === "string") {
            return e.replace(/\./g, '/')
        } else {
            const t = e.toLocaleDateString();

            if (this.get("time")) {
                let n = e.toLocaleTimeString();
                return t + "@" + (n = n.replace(/(\d{1,2}:\d{2}):00/, "$1"))
            }

            return t
        }
    },
});

$('#city').fias({
    type: $.fias.type.city
});

const $input = $('#file');
const $label = $input.next();
const labelVal = $label.find('.file_label_text').innerText;

$input.on('change', function (event) {
    const $labelText = $label.find('.file_label_text');

    if (this.files.length > 0) {
        const size = this.files[0].size; // размер в байтах
        const maxSize = 20000000

        if (size > maxSize) {
            event.preventDefault();
            $labelText.text('Слишком большой файл') ;
        } else {
            if (this.files && this.files.length >= 1) {
                $labelText.text('Выбран 1 файл')
            }
        }
    } else {
        $labelText.text(labelVal);
    }
});