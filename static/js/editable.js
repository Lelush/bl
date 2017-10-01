/**
 * Created by avolodin on 11.08.16.
 */
(function($){
    var containerSelector = '.editable-container';
    var boxSelector = '.editable-box';
    var staticSelector = '.editable-static';
    var formSelector = '.editable-form';
    var toggleSelector = '.editable-toggle';
    var checkboxSelector = '.editable-static-checkbox';
    var checkboxDisabledSelector = 'editable-static-disable';
    $.fn.editablePanel = function(){
        this.each(function(){
            var item = $(this);
            var container = item.is(containerSelector) ? item : item.parents(containerSelector).first();
            var toggle = container.find(toggleSelector);
            var element = container.find(staticSelector);
            var form = container.find(formSelector);
            var checkbox = container.find(checkboxSelector);

            var timer;
            toggle.off('click').on('click',function(){
                clearTimeout(timer);
                timer = setTimeout(function(){
                    element.toggle();
                    form.toggle();

                    checkbox.each(function(){
                        var checkboxContainer = $(this);
                        if(checkboxContainer.is('.'+checkboxDisabledSelector)){
                            checkboxContainer.find('.text-muted').attr('data-editable-class','text-muted').removeClass('text-muted');
                            checkboxContainer.find('.fill').attr('data-editable-class','fill').removeClass('fill');
                            checkboxContainer.find('.checkbox-disabled').attr('data-editable-class','checkbox-disabled').removeClass('checkbox-disabled');
                            checkboxContainer.find('input[disabled]').attr('data-editable-attr','disabled').removeAttr('disabled');
                            checkboxContainer.removeClass(checkboxDisabledSelector);
                        }else{
                            checkboxContainer.find('[data-editable-class]').each(function(){
                                $(this).addClass($(this).attr('data-editable-class')).removeAttr('data-editable-class');
                            });
                            checkboxContainer.find('[data-editable-attr]').each(function(){
                                $(this).prop($(this).attr('data-editable-attr'), true).removeAttr('data-editable-attr');
                            });
                            checkboxContainer.addClass(checkboxDisabledSelector);
                        }
                    });
                },200);
            });
        });
    }
})(jQuery);
