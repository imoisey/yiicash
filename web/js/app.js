$(function(){

    $.collapseAddEventForm = function(
        eventName, 
        addClassIcon, 
        removeClassIcon, 
        btnText) 
    {
        $(document).on(eventName, '#addEventBlock', function() {
            let button = $('[data-target="#addEventBlock"]');
            button
                .find(".glyphicon")
                .addClass(addClassIcon)
                .removeClass(removeClassIcon);
            button
                .find(".text")
                .text(btnText);
        });
    };

    $.collapseAddEventForm('show.bs.collapse', 'glyphicon-minus', 'glyphicon-plus', 'Скрыть');
    $.collapseAddEventForm('hide.bs.collapse', 'glyphicon-plus', 'glyphicon-minus', 'Показать');
});
