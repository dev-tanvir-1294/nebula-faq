jQuery(document).ready(function($) {
    $('.nebula-faq-question').on('click', function() {
        const item = $(this).closest('.nebula-faq-item');
        const answer = item.find('.nebula-faq-answer');
        
        // Close other items
        item.siblings().removeClass('active').find('.nebula-faq-answer').css('max-height', 0);
        
        // Toggle current item
        item.toggleClass('active');
        
        if (item.hasClass('active')) {
            answer.css('max-height', answer[0].scrollHeight + 'px');
        } else {
            answer.css('max-height', 0);
        }
    });
});
