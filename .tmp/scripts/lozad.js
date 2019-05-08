/*! lozad.js - v1.9.0 - 2019-02-09
* https://github.com/ApoorvSaxena/lozad.js
* Copyright (c) 2019 Apoorv Saxena; Licensed MIT */


(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
  typeof define === 'function' && define.amd ? define(factory) :
  (global.lozad = factory());
}(this, (function () { 'use strict';

  var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

  /**
   * Detect IE browser
   * @const {boolean}
   * @private
   */
  var isIE = typeof document !== 'undefined' && document.documentMode;

  var defaultConfig = {
    rootMargin: '0px',
    threshold: 0,
    load: function load(element) {
      if (element.nodeName.toLowerCase() === 'picture') {
        var img = document.createElement('img');
        if (isIE && element.getAttribute('data-iesrc')) {
          img.src = element.getAttribute('data-iesrc');
        }
        if (element.getAttribute('data-alt')) {
          img.alt = element.getAttribute('data-alt');
        }
        element.appendChild(img);
      }
      if (element.nodeName.toLowerCase() === 'video' && !element.getAttribute('data-src')) {
        if (element.children) {
          var childs = element.children;
          var childSrc = void 0;
          for (var i = 0; i <= childs.length - 1; i++) {
            childSrc = childs[i].getAttribute('data-src');
            if (childSrc) {
              childs[i].src = childSrc;
            }
          }
          element.load();
        }
      }
      if (element.getAttribute('data-src')) {
        element.src = element.getAttribute('data-src');
      }
      if (element.getAttribute('data-srcset')) {
        element.setAttribute('srcset', element.getAttribute('data-srcset'));
      }
      if (element.getAttribute('data-background-image')) {
        element.style.backgroundImage = 'url(\'' + element.getAttribute('data-background-image') + '\')';
      }
      if (element.getAttribute('data-toggle-class')) {
        element.classList.toggle(element.getAttribute('data-toggle-class'));
      }
    },
    loaded: function loaded() {}
  };

  function markAsLoaded(element) {
    element.setAttribute('data-loaded', true);
  }

  var isLoaded = function isLoaded(element) {
    return element.getAttribute('data-loaded') === 'true';
  };

  var onIntersection = function onIntersection(load, loaded) {
    return function (entries, observer) {
      entries.forEach(function (entry) {
        if (entry.intersectionRatio > 0 || entry.isIntersecting) {
          observer.unobserve(entry.target);

          if (!isLoaded(entry.target)) {
            load(entry.target);
            markAsLoaded(entry.target);
            loaded(entry.target);
          }
        }
      });
    };
  };

  var getElements = function getElements(selector) {
    var root = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : document;

    if (selector instanceof Element) {
      return [selector];
    }
    if (selector instanceof NodeList) {
      return selector;
    }
    return root.querySelectorAll(selector);
  };

  function lozad () {
    var selector = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '.lozad';
    var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

    var _defaultConfig$option = _extends({}, defaultConfig, options),
        root = _defaultConfig$option.root,
        rootMargin = _defaultConfig$option.rootMargin,
        threshold = _defaultConfig$option.threshold,
        load = _defaultConfig$option.load,
        loaded = _defaultConfig$option.loaded;

    var observer = void 0;

    if (window.IntersectionObserver) {
      observer = new IntersectionObserver(onIntersection(load, loaded), {
        root: root,
        rootMargin: rootMargin,
        threshold: threshold
      });
    }

    return {
      observe: function observe() {
        var elements = getElements(selector, root);

        for (var i = 0; i < elements.length; i++) {
          if (isLoaded(elements[i])) {
            continue;
          }
          if (observer) {
            observer.observe(elements[i]);
            continue;
          }
          load(elements[i]);
          markAsLoaded(elements[i]);
          loaded(elements[i]);
        }
      },
      triggerLoad: function triggerLoad(element) {
        if (isLoaded(element)) {
          return;
        }

        load(element);
        markAsLoaded(element);
        loaded(element);
      },

      observer: observer
    };
  }

  return lozad;

})));

//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJsb3phZC5qcyJdLCJzb3VyY2VzQ29udGVudCI6WyIvKiEgbG96YWQuanMgLSB2MS45LjAgLSAyMDE5LTAyLTA5XG4qIGh0dHBzOi8vZ2l0aHViLmNvbS9BcG9vcnZTYXhlbmEvbG96YWQuanNcbiogQ29weXJpZ2h0IChjKSAyMDE5IEFwb29ydiBTYXhlbmE7IExpY2Vuc2VkIE1JVCAqL1xuXG5cbihmdW5jdGlvbiAoZ2xvYmFsLCBmYWN0b3J5KSB7XG4gIHR5cGVvZiBleHBvcnRzID09PSAnb2JqZWN0JyAmJiB0eXBlb2YgbW9kdWxlICE9PSAndW5kZWZpbmVkJyA/IG1vZHVsZS5leHBvcnRzID0gZmFjdG9yeSgpIDpcbiAgdHlwZW9mIGRlZmluZSA9PT0gJ2Z1bmN0aW9uJyAmJiBkZWZpbmUuYW1kID8gZGVmaW5lKGZhY3RvcnkpIDpcbiAgKGdsb2JhbC5sb3phZCA9IGZhY3RvcnkoKSk7XG59KHRoaXMsIChmdW5jdGlvbiAoKSB7ICd1c2Ugc3RyaWN0JztcblxuICB2YXIgX2V4dGVuZHMgPSBPYmplY3QuYXNzaWduIHx8IGZ1bmN0aW9uICh0YXJnZXQpIHsgZm9yICh2YXIgaSA9IDE7IGkgPCBhcmd1bWVudHMubGVuZ3RoOyBpKyspIHsgdmFyIHNvdXJjZSA9IGFyZ3VtZW50c1tpXTsgZm9yICh2YXIga2V5IGluIHNvdXJjZSkgeyBpZiAoT2JqZWN0LnByb3RvdHlwZS5oYXNPd25Qcm9wZXJ0eS5jYWxsKHNvdXJjZSwga2V5KSkgeyB0YXJnZXRba2V5XSA9IHNvdXJjZVtrZXldOyB9IH0gfSByZXR1cm4gdGFyZ2V0OyB9O1xuXG4gIC8qKlxuICAgKiBEZXRlY3QgSUUgYnJvd3NlclxuICAgKiBAY29uc3Qge2Jvb2xlYW59XG4gICAqIEBwcml2YXRlXG4gICAqL1xuICB2YXIgaXNJRSA9IHR5cGVvZiBkb2N1bWVudCAhPT0gJ3VuZGVmaW5lZCcgJiYgZG9jdW1lbnQuZG9jdW1lbnRNb2RlO1xuXG4gIHZhciBkZWZhdWx0Q29uZmlnID0ge1xuICAgIHJvb3RNYXJnaW46ICcwcHgnLFxuICAgIHRocmVzaG9sZDogMCxcbiAgICBsb2FkOiBmdW5jdGlvbiBsb2FkKGVsZW1lbnQpIHtcbiAgICAgIGlmIChlbGVtZW50Lm5vZGVOYW1lLnRvTG93ZXJDYXNlKCkgPT09ICdwaWN0dXJlJykge1xuICAgICAgICB2YXIgaW1nID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudCgnaW1nJyk7XG4gICAgICAgIGlmIChpc0lFICYmIGVsZW1lbnQuZ2V0QXR0cmlidXRlKCdkYXRhLWllc3JjJykpIHtcbiAgICAgICAgICBpbWcuc3JjID0gZWxlbWVudC5nZXRBdHRyaWJ1dGUoJ2RhdGEtaWVzcmMnKTtcbiAgICAgICAgfVxuICAgICAgICBpZiAoZWxlbWVudC5nZXRBdHRyaWJ1dGUoJ2RhdGEtYWx0JykpIHtcbiAgICAgICAgICBpbWcuYWx0ID0gZWxlbWVudC5nZXRBdHRyaWJ1dGUoJ2RhdGEtYWx0Jyk7XG4gICAgICAgIH1cbiAgICAgICAgZWxlbWVudC5hcHBlbmRDaGlsZChpbWcpO1xuICAgICAgfVxuICAgICAgaWYgKGVsZW1lbnQubm9kZU5hbWUudG9Mb3dlckNhc2UoKSA9PT0gJ3ZpZGVvJyAmJiAhZWxlbWVudC5nZXRBdHRyaWJ1dGUoJ2RhdGEtc3JjJykpIHtcbiAgICAgICAgaWYgKGVsZW1lbnQuY2hpbGRyZW4pIHtcbiAgICAgICAgICB2YXIgY2hpbGRzID0gZWxlbWVudC5jaGlsZHJlbjtcbiAgICAgICAgICB2YXIgY2hpbGRTcmMgPSB2b2lkIDA7XG4gICAgICAgICAgZm9yICh2YXIgaSA9IDA7IGkgPD0gY2hpbGRzLmxlbmd0aCAtIDE7IGkrKykge1xuICAgICAgICAgICAgY2hpbGRTcmMgPSBjaGlsZHNbaV0uZ2V0QXR0cmlidXRlKCdkYXRhLXNyYycpO1xuICAgICAgICAgICAgaWYgKGNoaWxkU3JjKSB7XG4gICAgICAgICAgICAgIGNoaWxkc1tpXS5zcmMgPSBjaGlsZFNyYztcbiAgICAgICAgICAgIH1cbiAgICAgICAgICB9XG4gICAgICAgICAgZWxlbWVudC5sb2FkKCk7XG4gICAgICAgIH1cbiAgICAgIH1cbiAgICAgIGlmIChlbGVtZW50LmdldEF0dHJpYnV0ZSgnZGF0YS1zcmMnKSkge1xuICAgICAgICBlbGVtZW50LnNyYyA9IGVsZW1lbnQuZ2V0QXR0cmlidXRlKCdkYXRhLXNyYycpO1xuICAgICAgfVxuICAgICAgaWYgKGVsZW1lbnQuZ2V0QXR0cmlidXRlKCdkYXRhLXNyY3NldCcpKSB7XG4gICAgICAgIGVsZW1lbnQuc2V0QXR0cmlidXRlKCdzcmNzZXQnLCBlbGVtZW50LmdldEF0dHJpYnV0ZSgnZGF0YS1zcmNzZXQnKSk7XG4gICAgICB9XG4gICAgICBpZiAoZWxlbWVudC5nZXRBdHRyaWJ1dGUoJ2RhdGEtYmFja2dyb3VuZC1pbWFnZScpKSB7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUuYmFja2dyb3VuZEltYWdlID0gJ3VybChcXCcnICsgZWxlbWVudC5nZXRBdHRyaWJ1dGUoJ2RhdGEtYmFja2dyb3VuZC1pbWFnZScpICsgJ1xcJyknO1xuICAgICAgfVxuICAgICAgaWYgKGVsZW1lbnQuZ2V0QXR0cmlidXRlKCdkYXRhLXRvZ2dsZS1jbGFzcycpKSB7XG4gICAgICAgIGVsZW1lbnQuY2xhc3NMaXN0LnRvZ2dsZShlbGVtZW50LmdldEF0dHJpYnV0ZSgnZGF0YS10b2dnbGUtY2xhc3MnKSk7XG4gICAgICB9XG4gICAgfSxcbiAgICBsb2FkZWQ6IGZ1bmN0aW9uIGxvYWRlZCgpIHt9XG4gIH07XG5cbiAgZnVuY3Rpb24gbWFya0FzTG9hZGVkKGVsZW1lbnQpIHtcbiAgICBlbGVtZW50LnNldEF0dHJpYnV0ZSgnZGF0YS1sb2FkZWQnLCB0cnVlKTtcbiAgfVxuXG4gIHZhciBpc0xvYWRlZCA9IGZ1bmN0aW9uIGlzTG9hZGVkKGVsZW1lbnQpIHtcbiAgICByZXR1cm4gZWxlbWVudC5nZXRBdHRyaWJ1dGUoJ2RhdGEtbG9hZGVkJykgPT09ICd0cnVlJztcbiAgfTtcblxuICB2YXIgb25JbnRlcnNlY3Rpb24gPSBmdW5jdGlvbiBvbkludGVyc2VjdGlvbihsb2FkLCBsb2FkZWQpIHtcbiAgICByZXR1cm4gZnVuY3Rpb24gKGVudHJpZXMsIG9ic2VydmVyKSB7XG4gICAgICBlbnRyaWVzLmZvckVhY2goZnVuY3Rpb24gKGVudHJ5KSB7XG4gICAgICAgIGlmIChlbnRyeS5pbnRlcnNlY3Rpb25SYXRpbyA+IDAgfHwgZW50cnkuaXNJbnRlcnNlY3RpbmcpIHtcbiAgICAgICAgICBvYnNlcnZlci51bm9ic2VydmUoZW50cnkudGFyZ2V0KTtcblxuICAgICAgICAgIGlmICghaXNMb2FkZWQoZW50cnkudGFyZ2V0KSkge1xuICAgICAgICAgICAgbG9hZChlbnRyeS50YXJnZXQpO1xuICAgICAgICAgICAgbWFya0FzTG9hZGVkKGVudHJ5LnRhcmdldCk7XG4gICAgICAgICAgICBsb2FkZWQoZW50cnkudGFyZ2V0KTtcbiAgICAgICAgICB9XG4gICAgICAgIH1cbiAgICAgIH0pO1xuICAgIH07XG4gIH07XG5cbiAgdmFyIGdldEVsZW1lbnRzID0gZnVuY3Rpb24gZ2V0RWxlbWVudHMoc2VsZWN0b3IpIHtcbiAgICB2YXIgcm9vdCA9IGFyZ3VtZW50cy5sZW5ndGggPiAxICYmIGFyZ3VtZW50c1sxXSAhPT0gdW5kZWZpbmVkID8gYXJndW1lbnRzWzFdIDogZG9jdW1lbnQ7XG5cbiAgICBpZiAoc2VsZWN0b3IgaW5zdGFuY2VvZiBFbGVtZW50KSB7XG4gICAgICByZXR1cm4gW3NlbGVjdG9yXTtcbiAgICB9XG4gICAgaWYgKHNlbGVjdG9yIGluc3RhbmNlb2YgTm9kZUxpc3QpIHtcbiAgICAgIHJldHVybiBzZWxlY3RvcjtcbiAgICB9XG4gICAgcmV0dXJuIHJvb3QucXVlcnlTZWxlY3RvckFsbChzZWxlY3Rvcik7XG4gIH07XG5cbiAgZnVuY3Rpb24gbG96YWQgKCkge1xuICAgIHZhciBzZWxlY3RvciA9IGFyZ3VtZW50cy5sZW5ndGggPiAwICYmIGFyZ3VtZW50c1swXSAhPT0gdW5kZWZpbmVkID8gYXJndW1lbnRzWzBdIDogJy5sb3phZCc7XG4gICAgdmFyIG9wdGlvbnMgPSBhcmd1bWVudHMubGVuZ3RoID4gMSAmJiBhcmd1bWVudHNbMV0gIT09IHVuZGVmaW5lZCA/IGFyZ3VtZW50c1sxXSA6IHt9O1xuXG4gICAgdmFyIF9kZWZhdWx0Q29uZmlnJG9wdGlvbiA9IF9leHRlbmRzKHt9LCBkZWZhdWx0Q29uZmlnLCBvcHRpb25zKSxcbiAgICAgICAgcm9vdCA9IF9kZWZhdWx0Q29uZmlnJG9wdGlvbi5yb290LFxuICAgICAgICByb290TWFyZ2luID0gX2RlZmF1bHRDb25maWckb3B0aW9uLnJvb3RNYXJnaW4sXG4gICAgICAgIHRocmVzaG9sZCA9IF9kZWZhdWx0Q29uZmlnJG9wdGlvbi50aHJlc2hvbGQsXG4gICAgICAgIGxvYWQgPSBfZGVmYXVsdENvbmZpZyRvcHRpb24ubG9hZCxcbiAgICAgICAgbG9hZGVkID0gX2RlZmF1bHRDb25maWckb3B0aW9uLmxvYWRlZDtcblxuICAgIHZhciBvYnNlcnZlciA9IHZvaWQgMDtcblxuICAgIGlmICh3aW5kb3cuSW50ZXJzZWN0aW9uT2JzZXJ2ZXIpIHtcbiAgICAgIG9ic2VydmVyID0gbmV3IEludGVyc2VjdGlvbk9ic2VydmVyKG9uSW50ZXJzZWN0aW9uKGxvYWQsIGxvYWRlZCksIHtcbiAgICAgICAgcm9vdDogcm9vdCxcbiAgICAgICAgcm9vdE1hcmdpbjogcm9vdE1hcmdpbixcbiAgICAgICAgdGhyZXNob2xkOiB0aHJlc2hvbGRcbiAgICAgIH0pO1xuICAgIH1cblxuICAgIHJldHVybiB7XG4gICAgICBvYnNlcnZlOiBmdW5jdGlvbiBvYnNlcnZlKCkge1xuICAgICAgICB2YXIgZWxlbWVudHMgPSBnZXRFbGVtZW50cyhzZWxlY3Rvciwgcm9vdCk7XG5cbiAgICAgICAgZm9yICh2YXIgaSA9IDA7IGkgPCBlbGVtZW50cy5sZW5ndGg7IGkrKykge1xuICAgICAgICAgIGlmIChpc0xvYWRlZChlbGVtZW50c1tpXSkpIHtcbiAgICAgICAgICAgIGNvbnRpbnVlO1xuICAgICAgICAgIH1cbiAgICAgICAgICBpZiAob2JzZXJ2ZXIpIHtcbiAgICAgICAgICAgIG9ic2VydmVyLm9ic2VydmUoZWxlbWVudHNbaV0pO1xuICAgICAgICAgICAgY29udGludWU7XG4gICAgICAgICAgfVxuICAgICAgICAgIGxvYWQoZWxlbWVudHNbaV0pO1xuICAgICAgICAgIG1hcmtBc0xvYWRlZChlbGVtZW50c1tpXSk7XG4gICAgICAgICAgbG9hZGVkKGVsZW1lbnRzW2ldKTtcbiAgICAgICAgfVxuICAgICAgfSxcbiAgICAgIHRyaWdnZXJMb2FkOiBmdW5jdGlvbiB0cmlnZ2VyTG9hZChlbGVtZW50KSB7XG4gICAgICAgIGlmIChpc0xvYWRlZChlbGVtZW50KSkge1xuICAgICAgICAgIHJldHVybjtcbiAgICAgICAgfVxuXG4gICAgICAgIGxvYWQoZWxlbWVudCk7XG4gICAgICAgIG1hcmtBc0xvYWRlZChlbGVtZW50KTtcbiAgICAgICAgbG9hZGVkKGVsZW1lbnQpO1xuICAgICAgfSxcblxuICAgICAgb2JzZXJ2ZXI6IG9ic2VydmVyXG4gICAgfTtcbiAgfVxuXG4gIHJldHVybiBsb3phZDtcblxufSkpKTtcbiJdLCJmaWxlIjoibG96YWQuanMifQ==
