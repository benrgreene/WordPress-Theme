(function($) {
	
	var api_endpoint = ''; 

	$(document).ready(function(){
		api_endpoint = $('#site_base_url').val() + '/wp-json/';
		// Need fitvids and magnific.
	});

	$(document).on('click', '#js-ajax-load-posts', function(event) {
    if( 'disabled' == $(this).attr('disabled') ) {
      return;
    }
    $(this).attr('disabled', 'disabled');
    
		var post_on = $('#post-on').val();
		var post_type = $('#post-type').val();

		if(null == post_on) {
			post_on = 0;
		}
		if(null == post_type) {
			post_type = 'post';
		}
		
		$.ajax({
			url: api_endpoint + post_type + '/get-posts/' + post_on,
			method: 'GET',
			success: function(data) {
				$('#post-on').val(parseInt(post_on) + 3);
				$('.grid-contain').append(data);

				if(0 < $('#last-post-present').length) {
					$('#js-ajax-load-posts').hide(300);
				} else {
          // There are posts left, so enable the button again
          $('#js-ajax-load-posts').removeAttr('disabled');
        }
			}
		});
	});

	$(document).ready(function(e) {
		var dismissed = sessionStorage.getItem('notice-dismissed');
		if( 'true' != dismissed ) {
			$('.notice').show();
		}
	});

	$(document).on('click', '#js-dismiss', function(e) {
		$('.notice').hide();
		sessionStorage.setItem('notice-dismissed', 'true');
	});
})(jQuery);

const parentMenus = document.querySelectorAll('.sub-menu');
const menuToggle  = document.querySelector('#menu-toggle');
const menu        = document.querySelector('.menu-primary-menu-container');

// Variable for tracking whether the menu is displayed or hidden
let isDisplayed = false;

// Loop through the menu and add toggle buttons for all submenus
parentMenus.forEach(function(element) {
  var expandButton = document.createElement('button');  
  expandButton.innerHTML = '+';
  expandButton.dataset.isOpen = 'false';
  expandButton.classList.add('sub-menu__toggle');
  element.parentNode.prepend(expandButton);
});

// Toggle submenu open button being interacted with
const allButtons = document.querySelectorAll('.sub-menu__toggle');
allButtons.forEach(function(el, idx) {
  el.addEventListener('click', function(ev) {
    let subMenuOpen = el.dataset.isOpen;
    if('false' == subMenuOpen) {
      el.innerHTML = '-';
    } else {
      el.innerHTML = '+';
    }
    el.dataset.isOpen = ('true' == subMenuOpen) ? 'false' : 'true';
    el.parentNode.classList.toggle('menu-item--open');
  });
});

// Toggle opening/closing the menu
menuToggle.addEventListener('click', function(event) {
	console.log('here');
  isDisplayed = !isDisplayed;
  var displayClass = isDisplayed ? 'block' : 'none';
  if(isDisplayed) {
    menuToggle.innerHTML = `<i class="fas fa-times"></i>`;
  } else {
    menuToggle.innerHTML = `<i class="fas fa-bars"></i>`;
  }
  document.body.classList.toggle('nav-open');
});