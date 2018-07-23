(function($) {

  $(document).on('submit', '.search-form', function(event) {
    event.preventDefault();
    $.ajax({
      'url': $('#site_base_url').val() + '/wp-json/brg/search/' + $('#s').val(),
      success: function(results) {
        var data = JSON.parse(results);
        // Reset the search results
        $('#search-results').html('');
        // Add each post
        for(var i = 0; i < data.length; i++) {
          $('#search-results').append(`
           <a class="single-result" href="` + data[i]['post_link'] + `">
            <h3 class="single-result__title">` + data[i]['title'] + `</h3>
            <p>` + data[i]['excerpt'] + `</p>
           </a>
          `);
        }
      }
    });
  });

})(jQuery);