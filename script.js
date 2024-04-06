window.addEventListener('scroll', function() {
    var header = document.querySelector('header');
    header.classList.toggle('scrolled', window.scrollY > 0);

    var sections = document.querySelectorAll('.panel');
    var navItems = document.querySelectorAll('nav ul li a');
    
    var scrollPosition = window.scrollY;

    sections.forEach(function(section) {
        var sectionTop = section.offsetTop - 100; // Adjust offset as needed
        var sectionBottom = sectionTop + section.offsetHeight;

        if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
            var sectionId = section.getAttribute('id');
            navItems.forEach(function(item) {
                if (item.getAttribute('href') === '#' + sectionId) {
                    item.style.color = 'purple';
                } else if (sectionId === 'home') {
                    item.style.color = 'purple';
                } else {
                    item.style.color = 'white';
                }
            });
        }
    });
});
