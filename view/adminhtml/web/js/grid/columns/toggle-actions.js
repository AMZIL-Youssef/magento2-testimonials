define(['jquery', 'uiRegistry', 'mage/url'], function ($, uiRegistry, urlM) {
    'use strict';
    $(document).on('click', '.action-approve, .action-reject, .action-delete', function (e) {
        e.preventDefault();

        var $btn   = $(this),
            url    = $btn.data('url'),
            urlStats = $('.page-contain').data('url');

        if ($btn.data('action') === 'delete') {
            if (!confirm('Cette action supprimera définitivement. Continuer ?')) {
                return;
            }
        }

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: {
                form_key: window.FORM_KEY
            }
        }).done(function (res) {
            if (res.success) {
                console.log(res.message || $btn.attr('title') + ' réussi');
            } else {
                console.error(res.message || 'Échec de l’opération');
            }
        }).fail(function () {
            console.error('Erreur AJAX');
        }).always(function () {
            var provider = uiRegistry.get('sda_testimonials_listing.sda_testimonials_listing_data_source');
            provider.reload({ refresh: true });
            
            $.ajax({
                url: urlStats,
                type: 'POST',
                data: {
                    form_key: FORM_KEY
                }
            }).done(function (data) {
                // console.log('data : ', data);
                $('#totalCount').text(data.total);
                $('#approvedCount').text(data.approved);
                $('#pendingCount').text(data.pending);
                $('#rejectedCount').text(data.rejected);
                $('#avgRating').text(data.average);
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.error('AJAX error:', textStatus, errorThrown);
                console.log('Raw response:', jqXHR.responseText);
            });
        });
    });
});
