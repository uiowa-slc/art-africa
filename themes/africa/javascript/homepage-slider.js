 // set the homepage background to the selected switcher on page load
      $(document).ready(function () {
        var selectedSwitcher = $('.switcher.selected:first');
        $('#homepage-pic').css('background-image', 'url(' + selectedSwitcher.data('img-url') + ')');
        $('#homepage-pic-desc').text( selectedSwitcher.data('desc') );
      });

      // when a switcher that is not selected is clicked, switch to its background
      $(document).on('click', '.switcher:not(.selected)', function () {
        // `this` is the .switcher:not(.selected) element that was clicked
        switchTo(this);
      });

      // when the homepage pic is clicked visit its link
      $(document).on('click', '#homepage-pic', function (event) {
        // if the target of the event is a switcher within the
        // #homepage-pic element just ignore the click
        if (! event.target.classList.contains('switcher')) {
          window.location.href = $('.switcher.selected').data('link');
        }
      });

      function switchTo (switcherElement) {
        var hp = $('#homepage-pic'),
            switcher = $(switcherElement);

        // mark the switcher as selected and deselect its selected siblings
        switcher.addClass('selected')
                .siblings('.selected')
                .removeClass('selected');

        // animate the background image
        // step 1: fade opacity to 0
        hp.animate(
          { opacity: 0 },
          { duration: 400,
            // step 2: change description and background-image, then fade opacity back to 1
            complete: function () {
              $('#homepage-pic-desc').text( switcher.data('desc') );
              hp.css('background-image', 'url(' + switcher.data('img-url') + ')');
              hp.animate({ opacity: 1 },
                         { duration: 600 });
            }
          }
        );

        // clear the existing auto-switch timeout
        clearTimeout(slideshowTimeout);
        // start the auto-switch timeout again
        slideshowTimeout = setTimeout(switchToNext, slideshowInterval);
      }

      function switchToNext () {
        // if there are not multiple homepage pics, do nothing
        if (document.querySelectorAll('.switcher').length < 2) { return; }

        // try to get the next switcher
        var nextEl = document.querySelector('.switcher.selected').nextElementSibling;

        // if there is a nextEl and it is a switcher...
        if (nextEl && nextEl.classList.contains('switcher')) {
          switchTo(nextEl);
        } else {
        // if there is not a nextEl, switch to the first switcher
          switchTo(document.querySelector('.switcher'));
        }
      }

      // start the slideshow timeout
      var slideshowInterval = 10000,
          slideshowTimeout  = setTimeout(switchToNext, slideshowInterval);