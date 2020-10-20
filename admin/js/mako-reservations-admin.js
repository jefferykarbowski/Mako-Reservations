(function ($) {
    'use strict';

    const btn_book_now = $('.btn-mako-book-now');
	const background_field = acf.getField('field_5f819b974ec91');
	const background_hover_field = acf.getField('field_5f819bb54ec92');
	const text_color_field = acf.getField('field_5f819bd24ec93');
	const show_box_shadow_field = acf.getField('field_5f819a1c4ec8a');
	const box_shadow_size_field = acf.getField('field_5f819a434ec8b');
	const box_shadow_color_field = acf.getField('field_5f819a8c4ec8c');
	const show_border_field = acf.getField('field_5f819b044ec8d');
	const border_size_field = acf.getField('field_5f819b184ec8e');
	const border_color_field = acf.getField('field_5f819b474ec8f');
	const border_radius_field = acf.getField('field_5f819b694ec90');


    btn_book_now.css({
        'color': text_color_field.val(),
        'background': background_field.val(),
    });

	btn_book_now.find('svg').css('fill', text_color_field.val());

    if ($('.acf-field[data-name=show_box_shadow]').find('input.acf-switch-input').is(':checked')) {
        btn_book_now.css('box-shadow', box_shadow_size_field.val() + 'px ' + box_shadow_size_field.val() + 'px ' + box_shadow_size_field.val() + 'px ' + box_shadow_color_field.val());
    }

    if ($('.acf-field[data-name=show_border]').find('input.acf-switch-input').is(':checked')) {
        btn_book_now.css({
            'border': border_size_field.val() + 'px solid ' + border_color_field.val(),
            'border-radius': border_radius_field.val() + 'px'
        });
    }

    btn_book_now.fadeIn(1000);


    $(".btn-mako-book-now").mouseover(function () {
		const background_hover_color = background_hover_field.val();
        $(this).css('background-color', background_hover_color);
    }).mouseout(function () {
        const background_color = background_field.val();
        $(this).css('background-color', background_color);
    });


    background_field.on('change', function () {
        const background_color = background_field.val();
        btn_book_now.css('background', background_color);
    });


    text_color_field.on('change', function () {
        const text_color = text_color_field.val();
        btn_book_now.css('color', text_color);
		btn_book_now.find('svg').css('fill', text_color);
    });


    show_box_shadow_field.on('change', function () {
        const box_shadow_size_field_val = box_shadow_size_field.val();
        const box_shadow_color_field_val = box_shadow_color_field.val();
        if ($(this).parents('.acf-field').find('.acf-switch').hasClass('-on')) {
            btn_book_now.css('box-shadow', box_shadow_size_field_val + 'px ' + box_shadow_size_field_val + 'px ' + box_shadow_size_field_val + 'px ' + box_shadow_color_field_val);
        } else {
            btn_book_now.css('box-shadow', 'none');
        }
        
    });


    box_shadow_size_field.on('input change', function () {
        const box_shadow_size_field_val = box_shadow_size_field.val();
        const box_shadow_color_field_val = box_shadow_color_field.val();
        btn_book_now.css('box-shadow', box_shadow_size_field_val + 'px ' + box_shadow_size_field_val + 'px ' + box_shadow_size_field_val + 'px ' + box_shadow_color_field_val);
    });


    box_shadow_color_field.on('change', function () {
        const box_shadow_size_field_val = box_shadow_size_field.val();
        const box_shadow_color_field_val = box_shadow_color_field.val();
        btn_book_now.css('box-shadow', box_shadow_size_field_val + 'px ' + box_shadow_size_field_val + 'px ' + box_shadow_size_field_val + 'px ' + box_shadow_color_field_val);
    });


    show_border_field.on('change', function () {
        const border_size_field_val = border_size_field.val();
        const border_color_field_val = border_color_field.val();
        const border_radius_field_val = border_radius_field.val();
        if ($(this).parents('.acf-field').find('.acf-switch').hasClass('-on')) {
            btn_book_now.css({
                'border': border_size_field_val + 'px solid ' + border_color_field_val,
                'border-radius': border_radius_field_val + 'px'
            });
        } else {
            btn_book_now.css({
                'border': 'none',
                'border-radius': 'none'
            });
        }
        
    });


    border_size_field.on('input change', function () {
        const border_size_field_val = border_size_field.val();
        const border_color_field_val = border_color_field.val();

        btn_book_now.css({
            'border': border_size_field_val + 'px solid ' + border_color_field_val
        });
    });


    border_color_field.on('change', function () {
        const border_size_field_val = border_size_field.val();
        const border_color_field_val = border_color_field.val();
        btn_book_now.css({
            'border': border_size_field_val + 'px solid ' + border_color_field_val
        });
    });


    border_radius_field.on('input change', function () {
        const border_radius_field_val = border_radius_field.val();
        btn_book_now.css({
            'border-radius': border_radius_field_val + 'px'
        });
    });



})(jQuery);


