'use strict';
//  Author: AdminDesigns.com
// 
//  This file is reserved for changes made by the use. 
//  Always seperate your work from the theme. It makes
//  modifications, and future theme updates much easier 
// 

(function($) {
    // Init Theme Core
    Core.init();


    // Init Widget Demo JS
    // demoHighCharts.init();

    // Because we are using Admin Panels we use the OnFinish
    // callback to activate the demoWidgets. It's smoother if
    // we let the panels be moved and organized before
    // filling them with content from various plugins

    // Init plugins used on this page
    // HighCharts, JvectorMap, Admin Panels

    // Init Admin Panels on widgets inside the ".admin-panels" container
    $('.admin-panels').adminpanel({
        grid: '.admin-grid',
        //draggable: true,
        //preserveGrid: true,
        mobile: false,
        onStart: function () {
            // Do something before AdminPanels runs
        },
        onFinish: function () {
            $('.admin-panels').addClass('animated fadeIn').removeClass('fade-onload');

            // Init the rest of the plugins now that the panels
            // have had a chance to be moved and organized.
            // It's less taxing to organize empty panels
//                        demoHighCharts.init();
//                        runVectorMaps(); // function below
        },
        onSave: function () {
            $(window).trigger('resize');
        }
    });

    $('.editable-container').editablePanel();

    $.datepicker.regional['ru'] = {
        closeText: 'Закрыть',
        prevText: '&#x3c;Пред',
        nextText: 'След&#x3e;',
        currentText: 'Сегодня',
        monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
            'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
        monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
            'Июл','Авг','Сен','Окт','Ноя','Дек'],
        dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
        dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
        dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
        timeOnlyTitle: 'Выберите время',
        firstDay: 1,
        isRTL: false
    };
    $.datepicker.setDefaults($.datepicker.regional['ru']);
    $.timepicker.regional['ru'] = {
        timeText: 'Время',
        hourText: 'Часы',
        minuteText: 'Минуты',
        secondText: 'Секунды',
        millisecText: 'Миллисекунды',
        timezoneText: 'Часовой пояс',
        currentText: 'Сейчас',
        closeText: 'Закрыть',
        timeFormat: 'hh:mm tt',
        amNames: ['AM', 'A'],
        pmNames: ['PM', 'P']
    };
    $.timepicker.setDefaults($.timepicker.regional['ru']);
    $('.hasDateTimePicker').datetimepicker({
        dateFormat: 'yy-mm-dd',
        timeFormat: 'H:mm:ss',
        showOn: 'both',
        buttonText: '<i class="fa fa-calendar-o"></i>',
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>',
        beforeShow: function(input, inst) {
        }
    });
    $('.hasDatePicker').datepicker({
        dateFormat: 'yy-mm-dd',
        showOn: 'both',
        buttonText: '<i class="fa fa-calendar-o"></i>',
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>',
        beforeShow: function(input, inst) {
        }
    });

    $('.btn-filter').off('click').click(function(){
        var filter = $($(this).attr('data-target'));
        if(filter.is(':hidden')){
            filter.show(function(){
                var layer = $('<div>').addClass('layer');
                filter.after(layer);
                layer.click(function(){
                    filter.hide();
                    layer.remove();
                });
            });
        } else {
            filter.hide();
        }
    });
    
    $('a[data-toggle="tab"]').click(function (e) {
        var tab = 'tab_' + $(this).attr("href").replace('#', '');
        location.hash = '#'+tab;
        localStorage.setItem(location.origin+location.pathname+'tabId', tab);
    });
    var tab_ids = (localStorage.getItem(location.origin+location.pathname+'tabId') || location.hash).split('_');
    if (tab_ids.length > 1) {
        var tabId = '#' + tab_ids[1];
        $('a[data-toggle="tab"][href="'+ tabId +'"]').tab('show');
    }

    $(document).on('click', "[data-modal-ajax]",function(){
        $($(this).attr('data-target')).modal('show')
            .find(".modal-content")
            .load(($(this).attr('value') || $(this).attr('href')));
        return false;
    });

    $(document).on('click',"[data-copy-target]", function(e){
        var that = $(this);
        var target = $(that.attr('data-copy-target'));
        copy(e);
        return false;
    });
    function copy(e) {

        // find target element
        var
            t = e.target,
            c = $(t.dataset.copyTarget),inp,r;

        if(!c.is('input')){
            inp = $('<input>',{'value':(c.val()||c.text())});
            c.after(inp);
            r = true;
        } else {
            inp = c;
        }
        // is element selectable?
        if (inp && inp.select) {

            // select text
            inp.select();
            try {
                // copy text
                document.execCommand('copy');
                inp.blur();
            }
            catch (err) {
                alert('please press Ctrl/Cmd+C to copy');
            }

        }
        if(r){
            inp.remove();
        }

    }

    $(document).on('click', '.table-row-toggle', function(e){
        var that = $(this);
        var row = that.parents('tr').first();
        var id = row.attr('data-item-id');
        var table = that.parents('table').first();
        table.find('[data-parent-id='+id+']').toggleClass('hide');
        e.preventDefault();
        return false;
    });
    if(localStorage.getItem('sidemenu_l') == 'true'){
        $("#toggle_sidemenu_l").click();
    }

    $("#toggle_sidemenu_l").on('click', function(){
        if(!$('body').is('.sb-l-m')){
            localStorage.setItem('sidemenu_l',true);
        } else {
            localStorage.setItem('sidemenu_l',false);
        }
    });

    $("#toggle_sidemenu_logo").on('click', function(){
        if(!$('body').is('.sb-l-m')){
            localStorage.setItem('sidemenu_l',true);
        } else {
            localStorage.setItem('sidemenu_l',false);
        }
    });

})(jQuery);

