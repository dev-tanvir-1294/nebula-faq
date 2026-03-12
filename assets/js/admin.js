jQuery(document).ready(function($) {
    const container = $('.faq-items-container');
    const template = $('#faq-item-template').html();

    function updateIndices() {
        container.find('.faq-item').each(function(index) {
            const item = $(this);
            item.find('p strong').first().text('Question ' + (index + 1) + ':');
            item.find('input').attr('name', 'faq_items[' + index + '][q]');
            item.find('textarea').attr('name', 'faq_items[' + index + '][a]');
        });
    }

    $('#add-faq-item').on('click', function() {
        const index = container.find('.faq-item').length;
        const newItem = template.replace(/{{index}}/g, index);
        container.append(newItem);
    });

    container.on('click', '.remove-faq-item', function() {
        if (confirm('Are you sure you want to remove this FAQ item?')) {
            $(this).closest('.faq-item').remove();
            updateIndices();
        }
    });
});
