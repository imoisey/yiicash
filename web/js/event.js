;(function($){

    // Опции по умолчанию
    var defopt = {
        formSelector: "#eventAddForm",
        operationListSelector: ".event-operation-list",
        itemTplSelector: "#event-list-item",
        operationAddSelector: ".operationAdd",
        operationRemoveSelector: "[data-operation-remove]",
        operationItemSelector: "[data-operation-item]",
        operationMessageSelector: "[data-operation-message]",
        messageNotOperaton: "Error. Operation not found."
    }

    // Поля формы
    var formFields = {
        employee: "[data-field-employee] :selected",
        amount: "[data-field-amount]",
        type: "[data-field-type]:checked"
    }

    var validators = {}

    var index = 0;

    /**
     * Конструктор
     * 
     * @param {object} options 
     */
    function self(options) 
    {
        defopt = $.extend(defopt, options);
        initEventListener();
    }

    /**
     * Установка событий
     */
    function initEventListener()
    {
        $(document).on('submit', defopt.formSelector, onSubmit);
        $(defopt.formSelector + ' :required').on('invalid', onInvalid);
        $(defopt.formSelector + ' :required').on('focus', onFocus);
        $(document).on('click', defopt.operationAddSelector, onAddOperation);
        $(document).on('click', defopt.operationRemoveSelector, onDeleteOperation);
        $(document).on('operation-delete', postDeleteOperationEvent);
        $(document).on('operation-add', postAddOperationEvent);

    }

    /**
     * Добавляет валидацию для поля формы
     * 
     * @param {string} fieldName 
     * @param {callable} callback 
     */
    function addValidator(fieldName, callback) 
    {
        validators[fieldName] = callback;
    }

    /**
     * Добавляет участника в список
     * 
     * @param {object} person 
     */
    function addOperation(person)
    {
        var elementCode = _getTemplateAndReplace(person);
        $(defopt.operationListSelector).append(elementCode);
        $(document).trigger('operation-add');
    }

    /**
     * Генерирует код с участником для вставки в список
     * 
     * @param {object} person 
     */
    function _getTemplateAndReplace(person)
    {
        var replacement = {
            "{index}": index++,
            "{employeeId}": person.id,
            "{employeeName}": person.name,
            "{amount}": person.amount,
            "{type}": person.type,
        };

        var str = $(defopt.itemTplSelector).html();

        return str.replace(/{\w+}/g, function(all){
            return replacement[all] || all;
        });
    }

    /**
     * Обработчик события удаления операции
     * 
     * @param {Event} e 
     */
    function onDeleteOperation(e)
    {
        e.preventDefault();
        $(this).closest(defopt.operationItemSelector).remove();
        $(document).trigger('operation-delete');
    }

    /**
     * Срабытывает после удаления операции
     * 
     * @param {Event} e 
     */
    function postDeleteOperationEvent(e)
    {
        var cntOperations = $(defopt.operationListSelector)
                            .find(defopt.operationItemSelector).length;
        if(cntOperations == 0) {
            $(defopt.operationMessageSelector).show();
        }
    }

    /**
     * Срабатывает после добавления операции
     * 
     * @param {Event} e 
     */
    function postAddOperationEvent(e)
    {
        $(defopt.operationMessageSelector).hide();
        clearForm();
    }

    /**
     * Сбрасывает форму в исходное состояние
     * 
     */
    function clearForm()
    {
        $(defopt.formSelector).get(0).reset();
    }

    /**
     * Добавляем стиль для отображение невалидных полей
     * 
     * @param {Event} e 
     */
    function onInvalid(e)
    {
        $(this).closest(".form-group").addClass('has-error');
    }

    /**
     * Отключаем ошибки при фокусе поля
     * 
     * @param {Event} e 
     */
    function onFocus(e) 
    {
        $(this).closest(".form-group").removeClass('has-error');
    }

    /**
     * Обработчик добавления операции
     * 
     * @param {Event} e 
     */
    function onAddOperation(e)
    {
        e.preventDefault();

        var invalidFlag = false;
        $.each(formFields, function(name, selector){
            var fieldValue = $(selector).val();
            if(validators[name] !== undefined) {
                var resultValidation = validators[name](fieldValue);
                if(resultValidation.status === false) {
                    $(selector)
                        .closest('.form-group')
                        .find('.help-block')
                        .text(resultValidation.message);
                    $(selector).get(0).setCustomValidity(resultValidation.message);
                    $(selector).trigger('invalid');
                    invalidFlag = true;
                }
            }
        });

        if(invalidFlag === true) {
            return false;
        }

        addOperation({
            id: $(formFields.employee).val(),
            name: $(formFields.employee).text(),
            amount: $(formFields.amount).val(),
            type: $(formFields.type).val(),
        });
    }

    function onSubmit(e)
    {
        if($(defopt.formSelector).find(defopt.operationItemSelector).length == 0) {
            alert(defopt.messageNotOperaton);
            return false;
        }
    }

    // Публичные методы
    self.addValidator = addValidator;

    window.EventFormModule = self;
}(window.jQuery));

EventFormModule({
    formSelector: "#eventAddForm",
    listSelector: ".event-employee-list",
    itemTplSelector: "#EventFormModule-Template-Item",
    messageNotOperaton: window.message.notOperation
});

EventFormModule.addValidator('amount', function(value){
    if(value == "") {
        return {status: false, message: "Сумма обязательна для заполнения"}
    }

    if(value % 50 !== 0) {
        return {status: false, message: "Сумма должна быть кратна 50"}
    }

    return {status: true};
});