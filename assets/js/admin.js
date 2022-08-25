function delete_subscriber(id) {
    if (confirm('Are you sure you want to delete this user?')) {
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            dataType: 'json',
            data: {
                action: 'delete_subscriber',
                id: id,
            },
            success: function(response) {
                if(response.success) {
                    location.reload();
                }
            },
        })
    }
}