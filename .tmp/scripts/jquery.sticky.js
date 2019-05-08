// Sticky Plugin v1.0.0 for jQuery
// =============
// Author: Anthony Garand
// Improvements by German M. Bravo (Kronuz) and Ruud Kamphuis (ruudk)
// Improvements by Leonardo C. Daronco (daronco)
// Created: 2/14/2011
// Date: 2/12/2012
// Website: http://labs.anthonygarand.com/sticky
// Description: Makes an element on the page stick on the screen as you scroll
//       It will only set the 'top' and 'position' of your element, you
//       might need to adjust the width in some cases.

(function($) {
  var defaults = {
      topSpacing: 0,
      bottomSpacing: 0,
      className: 'is-sticky',
      wrapperClassName: 'sticky-wrapper',
      center: false,
      getWidthFrom: ''
    },
    $window = $(window),
    $document = $(document),
    sticked = [],
    windowHeight = $window.height(),
    scroller = function() {
      var scrollTop = $window.scrollTop(),
        documentHeight = $document.height(),
        dwh = documentHeight - windowHeight,
        extra = (scrollTop > dwh) ? dwh - scrollTop : 0;

      for (var i = 0; i < sticked.length; i++) {
        var s = sticked[i],
          elementTop = s.stickyWrapper.offset().top,
          etse = elementTop - s.topSpacing - extra;

        if (scrollTop <= etse) {
          if (s.currentTop !== null) {
            s.stickyElement
              .css('position', '')
              .css('top', '');
            s.stickyElement.parent().removeClass(s.className);
            s.currentTop = null;
          }
        }
        else {
          var newTop = documentHeight - s.stickyElement.outerHeight()
            - s.topSpacing - s.bottomSpacing - scrollTop - extra;
          if (newTop < 0) {
            newTop = newTop + s.topSpacing;
          } else {
            newTop = s.topSpacing;
          }
          if (s.currentTop != newTop) {
            s.stickyElement
              .css('position', 'fixed')
              .css('top', newTop);

            if (typeof s.getWidthFrom !== 'undefined') {
              s.stickyElement.css('width', $(s.getWidthFrom).width());
            }

            s.stickyElement.parent().addClass(s.className);
            s.currentTop = newTop;
          }
        }
      }
    },
    resizer = function() {
      windowHeight = $window.height();
    },
    methods = {
      init: function(options) {
        var o = $.extend(defaults, options);
        return this.each(function() {
          var stickyElement = $(this);

          var stickyId = stickyElement.attr('id');
          var wrapper = $('<div></div>')
            .attr('id', stickyId + '-sticky-wrapper')
            .addClass(o.wrapperClassName);
          stickyElement.wrapAll(wrapper);

          if (o.center) {
            stickyElement.parent().css({width:stickyElement.outerWidth(),marginLeft:"auto",marginRight:"auto"});
          }

          if (stickyElement.css("float") == "right") {
            stickyElement.css({"float":"none"}).parent().css({"float":"right"});
          }

          var stickyWrapper = stickyElement.parent();
          stickyWrapper.css('height', stickyElement.outerHeight());
          sticked.push({
            topSpacing: o.topSpacing,
            bottomSpacing: o.bottomSpacing,
            stickyElement: stickyElement,
            currentTop: null,
            stickyWrapper: stickyWrapper,
            className: o.className,
            getWidthFrom: o.getWidthFrom
          });
        });
      },
      update: scroller
    };

  // should be more efficient than using $window.scroll(scroller) and $window.resize(resizer):
  if (window.addEventListener) {
    window.addEventListener('scroll', scroller, false);
    window.addEventListener('resize', resizer, false);
  } else if (window.attachEvent) {
    window.attachEvent('onscroll', scroller);
    window.attachEvent('onresize', resizer);
  }

  $.fn.sticky = function(method) {
    if (methods[method]) {
      return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
    } else if (typeof method === 'object' || !method ) {
      return methods.init.apply( this, arguments );
    } else {
      $.error('Method ' + method + ' does not exist on jQuery.sticky');
    }
  };
  $(function() {
    setTimeout(scroller, 0);
  });
})(jQuery);

//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJqcXVlcnkuc3RpY2t5LmpzIl0sInNvdXJjZXNDb250ZW50IjpbIi8vIFN0aWNreSBQbHVnaW4gdjEuMC4wIGZvciBqUXVlcnlcbi8vID09PT09PT09PT09PT1cbi8vIEF1dGhvcjogQW50aG9ueSBHYXJhbmRcbi8vIEltcHJvdmVtZW50cyBieSBHZXJtYW4gTS4gQnJhdm8gKEtyb251eikgYW5kIFJ1dWQgS2FtcGh1aXMgKHJ1dWRrKVxuLy8gSW1wcm92ZW1lbnRzIGJ5IExlb25hcmRvIEMuIERhcm9uY28gKGRhcm9uY28pXG4vLyBDcmVhdGVkOiAyLzE0LzIwMTFcbi8vIERhdGU6IDIvMTIvMjAxMlxuLy8gV2Vic2l0ZTogaHR0cDovL2xhYnMuYW50aG9ueWdhcmFuZC5jb20vc3RpY2t5XG4vLyBEZXNjcmlwdGlvbjogTWFrZXMgYW4gZWxlbWVudCBvbiB0aGUgcGFnZSBzdGljayBvbiB0aGUgc2NyZWVuIGFzIHlvdSBzY3JvbGxcbi8vICAgICAgIEl0IHdpbGwgb25seSBzZXQgdGhlICd0b3AnIGFuZCAncG9zaXRpb24nIG9mIHlvdXIgZWxlbWVudCwgeW91XG4vLyAgICAgICBtaWdodCBuZWVkIHRvIGFkanVzdCB0aGUgd2lkdGggaW4gc29tZSBjYXNlcy5cblxuKGZ1bmN0aW9uKCQpIHtcbiAgdmFyIGRlZmF1bHRzID0ge1xuICAgICAgdG9wU3BhY2luZzogMCxcbiAgICAgIGJvdHRvbVNwYWNpbmc6IDAsXG4gICAgICBjbGFzc05hbWU6ICdpcy1zdGlja3knLFxuICAgICAgd3JhcHBlckNsYXNzTmFtZTogJ3N0aWNreS13cmFwcGVyJyxcbiAgICAgIGNlbnRlcjogZmFsc2UsXG4gICAgICBnZXRXaWR0aEZyb206ICcnXG4gICAgfSxcbiAgICAkd2luZG93ID0gJCh3aW5kb3cpLFxuICAgICRkb2N1bWVudCA9ICQoZG9jdW1lbnQpLFxuICAgIHN0aWNrZWQgPSBbXSxcbiAgICB3aW5kb3dIZWlnaHQgPSAkd2luZG93LmhlaWdodCgpLFxuICAgIHNjcm9sbGVyID0gZnVuY3Rpb24oKSB7XG4gICAgICB2YXIgc2Nyb2xsVG9wID0gJHdpbmRvdy5zY3JvbGxUb3AoKSxcbiAgICAgICAgZG9jdW1lbnRIZWlnaHQgPSAkZG9jdW1lbnQuaGVpZ2h0KCksXG4gICAgICAgIGR3aCA9IGRvY3VtZW50SGVpZ2h0IC0gd2luZG93SGVpZ2h0LFxuICAgICAgICBleHRyYSA9IChzY3JvbGxUb3AgPiBkd2gpID8gZHdoIC0gc2Nyb2xsVG9wIDogMDtcblxuICAgICAgZm9yICh2YXIgaSA9IDA7IGkgPCBzdGlja2VkLmxlbmd0aDsgaSsrKSB7XG4gICAgICAgIHZhciBzID0gc3RpY2tlZFtpXSxcbiAgICAgICAgICBlbGVtZW50VG9wID0gcy5zdGlja3lXcmFwcGVyLm9mZnNldCgpLnRvcCxcbiAgICAgICAgICBldHNlID0gZWxlbWVudFRvcCAtIHMudG9wU3BhY2luZyAtIGV4dHJhO1xuXG4gICAgICAgIGlmIChzY3JvbGxUb3AgPD0gZXRzZSkge1xuICAgICAgICAgIGlmIChzLmN1cnJlbnRUb3AgIT09IG51bGwpIHtcbiAgICAgICAgICAgIHMuc3RpY2t5RWxlbWVudFxuICAgICAgICAgICAgICAuY3NzKCdwb3NpdGlvbicsICcnKVxuICAgICAgICAgICAgICAuY3NzKCd0b3AnLCAnJyk7XG4gICAgICAgICAgICBzLnN0aWNreUVsZW1lbnQucGFyZW50KCkucmVtb3ZlQ2xhc3Mocy5jbGFzc05hbWUpO1xuICAgICAgICAgICAgcy5jdXJyZW50VG9wID0gbnVsbDtcbiAgICAgICAgICB9XG4gICAgICAgIH1cbiAgICAgICAgZWxzZSB7XG4gICAgICAgICAgdmFyIG5ld1RvcCA9IGRvY3VtZW50SGVpZ2h0IC0gcy5zdGlja3lFbGVtZW50Lm91dGVySGVpZ2h0KClcbiAgICAgICAgICAgIC0gcy50b3BTcGFjaW5nIC0gcy5ib3R0b21TcGFjaW5nIC0gc2Nyb2xsVG9wIC0gZXh0cmE7XG4gICAgICAgICAgaWYgKG5ld1RvcCA8IDApIHtcbiAgICAgICAgICAgIG5ld1RvcCA9IG5ld1RvcCArIHMudG9wU3BhY2luZztcbiAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgbmV3VG9wID0gcy50b3BTcGFjaW5nO1xuICAgICAgICAgIH1cbiAgICAgICAgICBpZiAocy5jdXJyZW50VG9wICE9IG5ld1RvcCkge1xuICAgICAgICAgICAgcy5zdGlja3lFbGVtZW50XG4gICAgICAgICAgICAgIC5jc3MoJ3Bvc2l0aW9uJywgJ2ZpeGVkJylcbiAgICAgICAgICAgICAgLmNzcygndG9wJywgbmV3VG9wKTtcblxuICAgICAgICAgICAgaWYgKHR5cGVvZiBzLmdldFdpZHRoRnJvbSAhPT0gJ3VuZGVmaW5lZCcpIHtcbiAgICAgICAgICAgICAgcy5zdGlja3lFbGVtZW50LmNzcygnd2lkdGgnLCAkKHMuZ2V0V2lkdGhGcm9tKS53aWR0aCgpKTtcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgcy5zdGlja3lFbGVtZW50LnBhcmVudCgpLmFkZENsYXNzKHMuY2xhc3NOYW1lKTtcbiAgICAgICAgICAgIHMuY3VycmVudFRvcCA9IG5ld1RvcDtcbiAgICAgICAgICB9XG4gICAgICAgIH1cbiAgICAgIH1cbiAgICB9LFxuICAgIHJlc2l6ZXIgPSBmdW5jdGlvbigpIHtcbiAgICAgIHdpbmRvd0hlaWdodCA9ICR3aW5kb3cuaGVpZ2h0KCk7XG4gICAgfSxcbiAgICBtZXRob2RzID0ge1xuICAgICAgaW5pdDogZnVuY3Rpb24ob3B0aW9ucykge1xuICAgICAgICB2YXIgbyA9ICQuZXh0ZW5kKGRlZmF1bHRzLCBvcHRpb25zKTtcbiAgICAgICAgcmV0dXJuIHRoaXMuZWFjaChmdW5jdGlvbigpIHtcbiAgICAgICAgICB2YXIgc3RpY2t5RWxlbWVudCA9ICQodGhpcyk7XG5cbiAgICAgICAgICB2YXIgc3RpY2t5SWQgPSBzdGlja3lFbGVtZW50LmF0dHIoJ2lkJyk7XG4gICAgICAgICAgdmFyIHdyYXBwZXIgPSAkKCc8ZGl2PjwvZGl2PicpXG4gICAgICAgICAgICAuYXR0cignaWQnLCBzdGlja3lJZCArICctc3RpY2t5LXdyYXBwZXInKVxuICAgICAgICAgICAgLmFkZENsYXNzKG8ud3JhcHBlckNsYXNzTmFtZSk7XG4gICAgICAgICAgc3RpY2t5RWxlbWVudC53cmFwQWxsKHdyYXBwZXIpO1xuXG4gICAgICAgICAgaWYgKG8uY2VudGVyKSB7XG4gICAgICAgICAgICBzdGlja3lFbGVtZW50LnBhcmVudCgpLmNzcyh7d2lkdGg6c3RpY2t5RWxlbWVudC5vdXRlcldpZHRoKCksbWFyZ2luTGVmdDpcImF1dG9cIixtYXJnaW5SaWdodDpcImF1dG9cIn0pO1xuICAgICAgICAgIH1cblxuICAgICAgICAgIGlmIChzdGlja3lFbGVtZW50LmNzcyhcImZsb2F0XCIpID09IFwicmlnaHRcIikge1xuICAgICAgICAgICAgc3RpY2t5RWxlbWVudC5jc3Moe1wiZmxvYXRcIjpcIm5vbmVcIn0pLnBhcmVudCgpLmNzcyh7XCJmbG9hdFwiOlwicmlnaHRcIn0pO1xuICAgICAgICAgIH1cblxuICAgICAgICAgIHZhciBzdGlja3lXcmFwcGVyID0gc3RpY2t5RWxlbWVudC5wYXJlbnQoKTtcbiAgICAgICAgICBzdGlja3lXcmFwcGVyLmNzcygnaGVpZ2h0Jywgc3RpY2t5RWxlbWVudC5vdXRlckhlaWdodCgpKTtcbiAgICAgICAgICBzdGlja2VkLnB1c2goe1xuICAgICAgICAgICAgdG9wU3BhY2luZzogby50b3BTcGFjaW5nLFxuICAgICAgICAgICAgYm90dG9tU3BhY2luZzogby5ib3R0b21TcGFjaW5nLFxuICAgICAgICAgICAgc3RpY2t5RWxlbWVudDogc3RpY2t5RWxlbWVudCxcbiAgICAgICAgICAgIGN1cnJlbnRUb3A6IG51bGwsXG4gICAgICAgICAgICBzdGlja3lXcmFwcGVyOiBzdGlja3lXcmFwcGVyLFxuICAgICAgICAgICAgY2xhc3NOYW1lOiBvLmNsYXNzTmFtZSxcbiAgICAgICAgICAgIGdldFdpZHRoRnJvbTogby5nZXRXaWR0aEZyb21cbiAgICAgICAgICB9KTtcbiAgICAgICAgfSk7XG4gICAgICB9LFxuICAgICAgdXBkYXRlOiBzY3JvbGxlclxuICAgIH07XG5cbiAgLy8gc2hvdWxkIGJlIG1vcmUgZWZmaWNpZW50IHRoYW4gdXNpbmcgJHdpbmRvdy5zY3JvbGwoc2Nyb2xsZXIpIGFuZCAkd2luZG93LnJlc2l6ZShyZXNpemVyKTpcbiAgaWYgKHdpbmRvdy5hZGRFdmVudExpc3RlbmVyKSB7XG4gICAgd2luZG93LmFkZEV2ZW50TGlzdGVuZXIoJ3Njcm9sbCcsIHNjcm9sbGVyLCBmYWxzZSk7XG4gICAgd2luZG93LmFkZEV2ZW50TGlzdGVuZXIoJ3Jlc2l6ZScsIHJlc2l6ZXIsIGZhbHNlKTtcbiAgfSBlbHNlIGlmICh3aW5kb3cuYXR0YWNoRXZlbnQpIHtcbiAgICB3aW5kb3cuYXR0YWNoRXZlbnQoJ29uc2Nyb2xsJywgc2Nyb2xsZXIpO1xuICAgIHdpbmRvdy5hdHRhY2hFdmVudCgnb25yZXNpemUnLCByZXNpemVyKTtcbiAgfVxuXG4gICQuZm4uc3RpY2t5ID0gZnVuY3Rpb24obWV0aG9kKSB7XG4gICAgaWYgKG1ldGhvZHNbbWV0aG9kXSkge1xuICAgICAgcmV0dXJuIG1ldGhvZHNbbWV0aG9kXS5hcHBseSh0aGlzLCBBcnJheS5wcm90b3R5cGUuc2xpY2UuY2FsbChhcmd1bWVudHMsIDEpKTtcbiAgICB9IGVsc2UgaWYgKHR5cGVvZiBtZXRob2QgPT09ICdvYmplY3QnIHx8ICFtZXRob2QgKSB7XG4gICAgICByZXR1cm4gbWV0aG9kcy5pbml0LmFwcGx5KCB0aGlzLCBhcmd1bWVudHMgKTtcbiAgICB9IGVsc2Uge1xuICAgICAgJC5lcnJvcignTWV0aG9kICcgKyBtZXRob2QgKyAnIGRvZXMgbm90IGV4aXN0IG9uIGpRdWVyeS5zdGlja3knKTtcbiAgICB9XG4gIH07XG4gICQoZnVuY3Rpb24oKSB7XG4gICAgc2V0VGltZW91dChzY3JvbGxlciwgMCk7XG4gIH0pO1xufSkoalF1ZXJ5KTtcbiJdLCJmaWxlIjoianF1ZXJ5LnN0aWNreS5qcyJ9
