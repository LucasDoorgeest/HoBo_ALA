document.addEventListener("DOMContentLoaded", function() {
  let lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));
  const placeholderSrc = "/img/placeholder.svg";

  lazyImages.forEach(function(lazyImage) {
      lazyImage.src = placeholderSrc;
  });

  if ("IntersectionObserver" in window) {
      let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
          entries.forEach(function(entry) {
              let lazyImage = entry.target;
              if (entry.isIntersecting) {
                  lazyImage.src = lazyImage.dataset.src;
                  lazyImage.classList.remove("lazy");
                  lazyImage.setAttribute('data-loaded', 'true');
              } else if (lazyImage.getAttribute('data-loaded') === 'true') {
                  lazyImage.src = placeholderSrc;
                  lazyImage.classList.add("lazy");
                  lazyImage.removeAttribute('data-loaded');
              }
          });
      }, {
          rootMargin: "1000px"
      });

      lazyImages.forEach(function(lazyImage) {
          lazyImageObserver.observe(lazyImage);
      });
  } else {
      lazyImages.forEach(function(lazyImage) {
          lazyImage.src = lazyImage.dataset.src;
          lazyImage.classList.remove("lazy");
      });
  }
});