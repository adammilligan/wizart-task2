let input = document.querySelector('#file');
let label = input.nextElementSibling,
    labelVal = label.querySelector('.file_label_text').innerText;

input.addEventListener('change', function (e) {
    let countFiles = '';
    if (this.files && this.files.length >= 1)
        countFiles = this.files.length;

    if (countFiles)
        label.querySelector('.file_label_text').innerText = 'Выбрано файлов: ' + countFiles;
    else
        label.querySelector('.file_label_text').innerText = labelVal;
})

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
    .addField('#city', [
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
    .addField('#file' ,[
        {
            rule: 'minFilesCount',
            value: 1,
            errorMessage: 'Выберите хотя бы один файл',
        },
    ])

    .addField('#date', [
      {
        plugin: JustValidatePluginDate((fields) => ({
          format: 'yyyy-MM-dd',
        })),
      },
    ]);

const popup = document.querySelector('.popup')
const popupClose = document.querySelector('.popup_close')
const submitButton = document.querySelector('#submit_button')

const popupVisibleClass  = 'popup_visible'

validation.onSuccess(function () {
    popup.classList.add(popupVisibleClass)

    submitButton.classList.add('button_submitted')

    submitButton.value = "Заявка уже отправлена"
})

popupClose.addEventListener('click', function () {
    popup.classList.remove(popupVisibleClass)
})
