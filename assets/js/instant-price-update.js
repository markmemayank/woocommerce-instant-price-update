jQuery(document).ready(function($) {
    $('form.variations_form').on('change', '.variations select', function() {
        var $form = $(this).closest('form.variations_form');
        var selected = {};

        $form.find('.variations select').each(function() {
            var attribute_name = $(this).data('attribute_name') || $(this).attr('name');
            selected[attribute_name] = $(this).val();
        });

        var product_id = $form.data('product_id');
        var variation_id = $form.find('input[name="variation_id"]').val();

        if (variation_id) {
            $.ajax({
                url: wc_add_to_cart_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'wc_instant_price_update',
                    variation_id: variation_id,
                    product_id: product_id
                },
                success: function(response) {
                    if (response.success) {
                        $('.woocommerce-Price-amount.amount').html(response.data.price_html);
                    }
                }
            });
        }
    });
});
