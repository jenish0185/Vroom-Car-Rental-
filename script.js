window.addEventListener('scroll', function() {
    var header = document.querySelector('header');
    header.classList.toggle('scrolled', window.scrollY > 0);

    var sections = document.querySelectorAll('.panel');
    var scrollPosition = window.scrollY;

    sections.forEach(function(section) {
        var rect = section.getBoundingClientRect();
        var sectionTop = rect.top;
        var sectionBottom = rect.bottom;

        if ((sectionTop <= window.innerHeight / 2 && sectionBottom >= window.innerHeight / 2) ||
            (sectionTop >= 0 && sectionBottom <= window.innerHeight)) {
            var sectionId = section.getAttribute('id');
            if (sectionId === 'home' && scrollPosition < 200) { // Highlight home panel at top of the page
                return;
            }
        }
    });
});
