/**
 * Enable element.matches
 */
if (!Element.prototype.matches) {
  Element.prototype.matches = Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector;
}

/**
 * Closest polyfill
 */
if (!Element.prototype.closest) {
  Element.prototype.closest = function (s) {
    var el = this;
    if (!document.documentElement.contains(el)) {
      return null;
    }
    do {
      if (el.matches(s)) {
        return el;
      }
      el = el.parentElement || el.parentNode;
    } while (el !== null && el.nodeType === 1);
    return null;
  };
}

/**
 * Tab handler
 */
document.addEventListener('click', function (e) {
  var el = e.target;
  if (el.matches('.js-sg-tab')) {
    e.preventDefault();

    var tab = el.closest('[aria-expanded]');
    var tabs = el.closest('.sg-tabs');
    var currentTab = tabs.querySelector('.sg-active');
    var target = document.querySelector(el.getAttribute('href'));
    var targets = target && target.closest('.sg-switch');
    var currentTarget = targets && targets.querySelector('.sg-active');

    tab.classList.add('sg-active');
    tab.setAttribute('aria-expanded', true);
    if (currentTab) {
      currentTab.classList.remove('sg-active');
      currentTab.setAttribute('aria-expanded', false);
    }

    if (target) {
      target.classList.add('sg-active');
    }
    if (currentTarget) {
      currentTarget.classList.remove('sg-active');
    }
  }
});
