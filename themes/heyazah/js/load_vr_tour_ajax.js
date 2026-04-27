// console.log('===== VR TOUR AJAX JS LOADED =====');
// console.log('AJAX URL:', typeof ajax_object !== 'undefined' ? ajax_object.ajax_url : 'UNDEFINED');
// console.log('Nonce:', typeof ajax_object !== 'undefined' ? ajax_object.nonce : 'UNDEFINED');

jQuery(function($) {
    console.log('===== jQuery READY =====');
    
    var currentTourId = null;
    
    // Intercept clicks on tour links
    $(document).on('click', 'a[data-toggle="modal"][data-target="#vr_modal"]', function(e) {
        // console.log('===== TOUR LINK CLICKED =====');
        
        var $link = $(this);
        currentTourId = $link.attr('data-tour-id');
        
        // console.log('Tour ID:', currentTourId);
        
        // DON'T prevent default - let Bootstrap handle modal opening
        // Just make the AJAX request
        
        var $popupFrame = $('#vr_modal').find('.popup-frame');
        
        // Show loader immediately
        $popupFrame.html('<div class="iframe-loader"><div class="spinner"></div><p>Loading 360° Tour...</p></div>');
        
        // Make AJAX request
//         console.log('===== SENDING AJAX REQUEST =====');
        
        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'load_vr_tour',
                tour_id: currentTourId,
                nonce: ajax_object.nonce
            },
            beforeSend: function() {
                console.log('AJAX request starting...');
            },
            success: function(response) {
                // console.log('===== AJAX SUCCESS =====');
                // console.log('Full Response:', response);
                
                if (response.success && response.data && response.data.iframe_url) {
                    console.log('Iframe URL:', response.data.iframe_url);
                    
                    var iframeHtml = '<iframe class="fthL6" ' +
                                    'title="' + (response.data.title || 'Virtual Tour') + '" ' +
                                    'data-hook="iframe-component" ' +
                                    'style="background-color:transparent; width:100%; height:500px; border:none;" ' +
                                    'allow="fullscreen; autoplay; encrypted-media" ' +
                                    'allowfullscreen ' +
                                    'tabindex="0" ' +
                                    'src="' + response.data.iframe_url + '" ' +
                                    'sandbox="allow-popups allow-presentation allow-forms allow-same-origin allow-scripts">' +
                                    '</iframe>';
                    
                    $popupFrame.html(iframeHtml);
                    // console.log('===== IFRAME INSERTED =====');
                } else {
                    // console.error('Error in response:', response);
                    $popupFrame.html('<div class="error-message"><p>Error: ' + (response.data || 'Failed to load') + '</p></div>');
                }
            },
            error: function(xhr, status, error) {
                // console.error('===== AJAX FAILED =====');
                // console.error('Status:', status);
                // console.error('Error:', error);
                // console.error('Response Text:', xhr.responseText);
                
                $popupFrame.html('<div class="error-message"><p>Connection error: ' + error + '</p></div>');
            },
            complete: function() {
                // console.log('===== AJAX COMPLETE =====');
            }
        });
    });
    
    // Clear when modal is hidden
    $(document).on('hidden.bs.modal', '#vr_modal', function () {
//         console.log('===== MODAL CLOSED =====');
        $(this).find('.popup-frame').html('<div class="iframe-loader"><div class="spinner"></div><p>Loading 360° Tour...</p></div>');
    });
});