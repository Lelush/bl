'use strict';
//  Author: AdminDesigns.com
// 
//  This file is reserved for changes made by the use. 
//  Always seperate your work from the theme. It makes
//  modifications, and future theme updates much easier 
// 

(function($) {

    var buffForm;
    function applyFilter(){
        var form = $(this).parents('form');
        var pjax = form.attr('data-pjax-target');
        var url = window.location.origin + window.location.pathname;
        var delimiter = '';
        if(url.match(/(&|\?)[^&\?]+$/)){
            delimiter = '&';
        }else if(url.match(/(&|\?)$/)){
            delimiter = '';
        }else{
            delimiter = '?';
        }
        url+=delimiter+form.serialize();
        $.pjax.reload({
            container:pjax,
            url:url
        });
        return false;
    }

    var inputChangeTimeout;
    function timeoutApplyFilter(){
        var self = this;
        clearTimeout(inputChangeTimeout);
        inputChangeTimeout = setTimeout(function(){
            $.proxy(applyFilter,self)();
        },300);
    }

    $(document).on('click','.apply-pjax', function(){
        var form = $(this).parents('form');
        form.find('button').addClass('disabled');
        buffForm = form;
        $.proxy(applyFilter,this)();
    });

    $.fn.clearForm = function() {
        return this.each(function() {
            var type = this.type, tag = this.tagName.toLowerCase();
            if (tag == 'form')
                return $(':input',this).clearForm();
            if (type == 'text' || type == 'password' || tag == 'textarea'){
                this.value = typeof this.attributes['data-default'] != 'undefined' ? this.attributes['data-default'].value :'';
            }
            else if (type == 'checkbox' || type == 'radio')
                this.checked = false;
            else if (tag == 'select')
                this.selectedIndex = 0;
        });
    };

    $(document).on('click','.clear-pjax', function(){
        var form = $(this).parents('form');
        form.clearForm();
        form.find('button').addClass('disabled');
        buffForm = form;
        $.proxy(applyFilter,this)();
    });

    $(document).on('change', '.change-pjax-delay', function(){
        $.proxy(timeoutApplyFilter,this)();
    });

    $(document).on('change', '.change-pjax', function(){
        $.proxy(applyFilter,this)();
    });

    $(document).on('keyup','[data-pjax-target] input, [data-pjax-target] textarea' ,function(e){
        if(e.keyCode == 13){ //enter
            $.proxy(applyFilter,this)();
        }
    });


    //$('.offer-filter').find(':checkbox, :radio, select').on('change',function(){
    //    $.proxy(applyFilter, this)();
    //});
    $(document).on("pjax:click", "a:not(.goto-page):not(table th a):not([data-pjax=0])", false);
    $(document).on('pjax:beforeSend', function() {
        $('#pjax-filtered-deposit-list-trobbler').css('display', 'block');
    });
    $(document).on('pjax:complete', function() {
        $('.layer').click();
        if(buffForm){
            $(buffForm).find('button').removeClass('disabled');
        }
    });
    if($.pjax) {
        $.pjax.defaults = $.pjax.defaults || {};
        $.pjax.defaults.timeout = 2000;
    }

    window.Profile = (function(){
            return {
                toggleFriend: function(button, id){
                    var param = yii.getCsrfParam();
                    var data = {
                        id:id
                    };
                    data[param] = yii.getCsrfToken();
                   $.ajax({
                       dataType: 'json',
                       method: 'POST',
                       url:'/users/toggle-friends.html',
                       data: data,
                       success: function(response) {
                           if(response.success) {
                               $(button).text(response.btnText);
                           } else {
                               console.error(response);
                           }
                       },
                       error: function(response) {
                           console.error(response);
                       }
                   })
                }
            }
    })();



    // Init Theme Core
    Core.init();


    var myVideo = document.getElementById("video1");
    var myVideoPC = document.getElementById("video2");

    $(document).on('click', '#videoPop-up', function () {
        $('.video-overlay').addClass('active');
    });

    $(document).on('click', '#videoPop-up_close', function () {
        if (myVideoPC.played) {
            myVideoPC.pause();
        }

        if($('#pP-icon2').hasClass('fa fa-play')) {
            $('#pP-icon2').removeClass('fa fa-play').addClass('fa fa-pause');
        } else {
            $('#pP-icon2').removeClass('fa fa-pause').addClass('fa fa-play');
        }
        $('.video-overlay').removeClass('active');
    });

    function playPause() {
        if (myVideo.paused)
            myVideo.play();
        else
            myVideo.pause();
    }

    function playPause2() {
        if (myVideoPC.paused)
            myVideoPC.play();
        else
            myVideoPC.pause();
    }

    $(document).on('click', '#play-Pause', function () {
        playPause();

        if($('#pP-icon').hasClass('fa fa-play')) {
            $('#pP-icon').removeClass('fa fa-play').addClass('fa fa-pause');
        } else {
            $('#pP-icon').removeClass('fa fa-pause').addClass('fa fa-play');
        }
    });

    $(document).on('click', '#play-Pause2', function () {
        playPause2();

        if($('#pP-icon2').hasClass('fa fa-play')) {
            $('#pP-icon2').removeClass('fa fa-play').addClass('fa fa-pause');
        } else {
            $('#pP-icon2').removeClass('fa fa-pause').addClass('fa fa-play');
        }
    });


    $(document).on('click', '.tab-button', function (e) {
        $('.tab-button').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
        var id = $(this).attr('data-feed');

        $(".feed-content_box").each(function(){
            $(this).hide();
            if($(this).attr('id') == id) {
                $(this).show();
            }
        });
    });


    $(document).on('click', '#step_1', function () {

        $('#reg_1').hide();

        $('#reg_2').show();
    });

    $(document).on('click', '#back', function () {
        $('#reg_1').show();

        $('#reg_2').hide();

    });

    $(document).on('click', '.choose-button:not([href])', function (e) {
        $('#cb-main').hide();
        e.preventDefault();
        var id = $(this).attr('data-modal');

        $(".choose-modal").each(function(){
            $(this).hide().removeClass('opened');
            if($(this).attr('id') == id) {
                $(this).show().addClass('opened');
            }
        });
        return false;
    });

    $(document).on('click', '.choose-modal.opened .more-box_button.back', function (e) {
        $(".choose-modal.opened").removeClass('opened').hide();
        $('#cb-main').show();
        return false;
    });

    $(document).on('click', '#add-company', function () {
        /*$(this).fadeOut('fast');
         $('#add-close').fadeIn();*/
        $(this).removeClass('add').addClass('add-close');
        $('#addCompany-wrapper').fadeIn();
    });

    $(document).on('click', '.add-close', function () {
        /*$(this).fadeOut('fast');
         $('#addCompany-wrapper').fadeOut('fast');*/
        $(this).removeClass('add-close').addClass('add');
        $('#addCompany-wrapper').fadeOut();
    });

    $(document).on('click', '#cb-showAll', function () {
        $('.map-companyBox').animate({height: "100%"}, 1000).addClass('opened');
        $('.map-filter').addClass('opened');
        $('.blured').hide();
        $('#showAll-close').show();
    });

    $(document).on('click', '#showAll-close', function () {
        $('.map-companyBox').animate({height: "210px"}, 0).removeClass('opened');
        $('.map-filter').removeClass('opened');
        $('.blured').show();
        $(this).hide();
    });

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

