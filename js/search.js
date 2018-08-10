(function($) {

  // Check to make sure that the search modal is supported
  $(document).ready(function(event) {
    if (typeof HTMLDialogElement !== 'function') {
      // OH NO!!! No dialog support :(
      var dialogElement = document.getElementById('js-dialog');
      dialogElement.parentNode.removeChild(dialogElement);
      // Also hide the menu item for opening the modal
      var searchButton = document.querySelectorAll('li.js-search')[0];
      searchButton.parentNode.removeChild(searchButton);
    }
  });

  // --------------------------------------------------------------
  // Modal controls
  // --------------------------------------------------------------

  $(document).on('click', '.js-search a', function(event) {
    event.preventDefault();
    document.querySelector('#js-dialog').showModal();
  });

  // Want to close the dialog box if the backdrop is clicked
  $(document).on('click', '#js-dialog', function(e) {
    const isInside = checkClickInsideBoundingBox(e, this);
    if(!isInside) {
      this.close();
    }
  });

  $(document).on('click', '.dialog-close', function(e) {
    document.querySelector('#js-dialog').close();
  });

  document.addEventListener('keydown', function(e) {
    // Check if the dialog is open and is part of a gallery
    var dialog = document.querySelector('#js-dialog');
    var dialogOpen = dialog.open;
    if(!dialogOpen) {
      return;
    }
    var char = (e.keyCode) ? e.keyCode : e.which;
    if(13 == char) {
      e.preventDefault();
      $('.search-form').submit();
    }
  });

  // Will check whether or not a click event was on the element proper, or outside it (on, say, a pseudo element)
  function checkClickInsideBoundingBox(event, element) {
    elementPos = element.getBoundingClientRect();
    if(elementPos.left <= event.clientX && elementPos.right >= event.clientX &&
       elementPos.top <= event.clientY && elementPos.bottom >= event.clientY) {
      return true; 
    }
    return false;
  }

  $(document).on('submit', '.search-form', function(event) {
    event.preventDefault();
    $.ajax({
      'url': $('#site_base_url').val() + '/wp-json/brg/search/' + $('#s').val(),
      success: function(results) {
        $('#search-results').html(results);
      }
    });
  });

})(jQuery);