/* =============================================================
   V2 JDA Approved Properties - Theme JS
   ============================================================= */

(function () {
  'use strict';

  // ---------- Mobile menu toggle ----------
  var toggle = document.querySelector('.menu-toggle');
  var links  = document.querySelector('.nav-links');
  if (toggle && links) {
    toggle.addEventListener('click', function () {
      links.classList.toggle('open');
      toggle.setAttribute('aria-expanded', links.classList.contains('open'));
    });
    Array.prototype.forEach.call(links.querySelectorAll('a'), function (a) {
      a.addEventListener('click', function () { links.classList.remove('open'); });
    });
  }

  // ---------- Header shadow on scroll ----------
  var header = document.querySelector('.site-header');
  if (header) {
    var onScroll = function () { header.classList.toggle('scrolled', window.scrollY > 30); };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  // ---------- Scroll-in animations ----------
  var animated = document.querySelectorAll('[data-aos]');
  if ('IntersectionObserver' in window && animated.length) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) { e.target.classList.add('in-view'); io.unobserve(e.target); }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    Array.prototype.forEach.call(animated, function (el) { io.observe(el); });
  } else {
    Array.prototype.forEach.call(animated, function (el) { el.classList.add('in-view'); });
  }

  // ---------- Counter animation ----------
  var counters = document.querySelectorAll('[data-count]');
  if (counters.length && 'IntersectionObserver' in window) {
    var cIO = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (!en.isIntersecting) return;
        var el = en.target;
        var target = parseInt(el.getAttribute('data-count'), 10);
        var duration = 1400; var start = performance.now();
        var tick = function (now) {
          var t = Math.min((now - start) / duration, 1);
          el.textContent = Math.floor(t * target).toLocaleString();
          if (t < 1) requestAnimationFrame(tick);
          else el.textContent = target.toLocaleString() + (el.getAttribute('data-suffix') || '');
        };
        requestAnimationFrame(tick);
        cIO.unobserve(el);
      });
    }, { threshold: 0.5 });
    Array.prototype.forEach.call(counters, function (c) { cIO.observe(c); });
  }

  // ---------- Project filter tabs ----------
  var tabs = document.querySelectorAll('.tab');
  var cards = document.querySelectorAll('[data-category]');
  if (tabs.length && cards.length) {
    Array.prototype.forEach.call(tabs, function (t) {
      t.addEventListener('click', function () {
        Array.prototype.forEach.call(tabs, function (x) { x.classList.remove('active'); });
        t.classList.add('active');
        var f = t.getAttribute('data-filter');
        Array.prototype.forEach.call(cards, function (c) {
          var show = f === 'all' || c.getAttribute('data-category') === f;
          c.style.display = show ? '' : 'none';
        });
      });
    });
  }

  // ---------- Lightbox for gallery ----------
  var galleryItems = document.querySelectorAll('.gallery-item');
  if (galleryItems.length) {
    var box = document.createElement('div');
    box.className = 'lightbox';
    box.innerHTML = '<button class="close" aria-label="Close">&times;</button><img alt="">';
    document.body.appendChild(box);
    var img = box.querySelector('img');
    Array.prototype.forEach.call(galleryItems, function (g) {
      g.addEventListener('click', function () {
        var src = g.querySelector('img').currentSrc || g.querySelector('img').src;
        img.src = src;
        box.classList.add('open');
      });
    });
    box.addEventListener('click', function (e) {
      if (e.target === box || e.target.classList.contains('close')) {
        box.classList.remove('open'); img.src = '';
      }
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') { box.classList.remove('open'); img.src = ''; }
    });
  }

  // ---------- Lead form ----------
  // Two modes:
  //   1. WordPress mode  -> window.V2JDA exists; POST to admin-ajax.php (JSON response).
  //   2. Static mode     -> form has data-endpoint="https://script.google.com/.../exec";
  //                         POST direct to Google Apps Script with no-cors.
  var form = document.querySelector('#leadForm');
  if (form) {
    var status = form.querySelector('.form-status');
    var staticEndpoint = form.getAttribute('data-endpoint');

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      status.textContent = 'Sending...';
      status.className = 'form-status';

      var data = new FormData(form);

      if (window.V2JDA && !staticEndpoint) {
        // WordPress AJAX
        data.set('action', 'v2jda_submit_lead');
        data.set('nonce', V2JDA.nonce);

        fetch(V2JDA.ajaxUrl, { method: 'POST', body: data, credentials: 'same-origin' })
          .then(function (r) { return r.json(); })
          .then(function (res) {
            if (res && res.success) {
              status.textContent = (res.data && res.data.message) || 'Thank you! We will contact you soon.';
              status.className = 'form-status success';
              form.reset();
              if (window.gtag) gtag('event', 'lead_submit');
            } else {
              status.textContent = (res && res.data && res.data.message) || 'Please check the form and try again.';
              status.className = 'form-status error';
            }
          })
          .catch(function () {
            status.textContent = 'Sorry, something went wrong. Please call us at +91 75979 61878.';
            status.className = 'form-status error';
          });
        return;
      }

      if (staticEndpoint) {
        // Static -> Google Apps Script. no-cors means we can't read the response,
        // so we treat any non-thrown call as success.
        data.set('source', window.location.href);
        data.set('submitted_at', new Date().toISOString());

        fetch(staticEndpoint, { method: 'POST', mode: 'no-cors', body: data })
          .then(function () {
            status.textContent = 'Thank you! We have received your enquiry and will call you shortly.';
            status.className = 'form-status success';
            form.reset();
            if (window.gtag) gtag('event', 'lead_submit');
          })
          .catch(function () {
            status.textContent = 'Sorry, something went wrong. Please call us at +91 75979 61878.';
            status.className = 'form-status error';
          });
        return;
      }

      // Neither configured -> friendly fallback.
      status.textContent = 'Form not configured. Please call +91 75979 61878 or email vishalkhandelwal267@gmail.com.';
      status.className = 'form-status error';
    });
  }
})();
