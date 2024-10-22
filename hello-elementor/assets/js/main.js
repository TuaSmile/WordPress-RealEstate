document.addEventListener('DOMContentLoaded', function() {
    
});

(function($) {
    $(document).ready(function() {
        // Apply Filter Action
        function apply_filter_handler() {
            const filter_location = $('#filter_location').val();
            const filter_lifestyle_activities = $('#filter_lifestyle_activities').val();
            const filter_features_amenities = $('#filter_features_amenities').val();
            const filter_ownership_type = $('#filter_ownership_type').val();
            const atts = $('#filtered_results').data('atts');
            
         
            $.ajax({
                url: ajax_object.ajax_url, // AJAX URL provided by wp_localize_script
                type: 'POST',
                data: {
                    action: 'filter_real_estates_action', // The action name to handle in PHP
                    security: ajax_object.nonce, // Nonce for security
                    location: filter_location,
                    lifestyle_activities: filter_lifestyle_activities,
                    features_amenities: filter_features_amenities,
                    ownership_type: filter_ownership_type,
                    atts: atts
                },
                beforeSend: function() {
                    // This function will be called before the AJAX request is sent
                    $('#filtered_results').html('Loading ...');
                },
                success: function(response) {
                    if (response.success) {
                        if ( response.html ) {
                            $('#filtered_results').html(response.html);    
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed:', error);
                }
            });
        }
        

        var direction = real_estate_direction_data.direction;
        var nSlideCount = 1;
        if( direction == 'row') {
            nSlideCount = 3
        }
    
        var swiper = new Swiper('.swiper-container', {
            loop: true, 
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            slidesPerView: nSlideCount, 
            spaceBetween: 24, 
            centeredSlides: true
        });

        // Need to apply filter in page load
        apply_filter_handler();

        // Apply Filter click event
        $('#apply_filter').on('click', function(e) {
            e.preventDefault();

            apply_filter_handler();
        });
        
    });
})(window.jQuery);