

// your existing JavaScript starts below this
// Function to open the floating menu
const floatingMenu = () => {
    document.getElementById('floatingMenu').classList.add('openMenu');
};
document.addEventListener('DOMContentLoaded', function () {
    const closeButtons = document.querySelectorAll('#cloaseFloatingMenu, #cloaseFloatingMenu2');
    closeButtons.forEach(button => {
        button.addEventListener('click', () => {
            document.getElementById('floatingMenu').classList.remove('openMenu');
        });
    });
    const menuTriggers = document.querySelectorAll('.stickyshowhide, .showhide');
    menuTriggers.forEach(trigger => {
        trigger.addEventListener('click', function (e) {
            e.preventDefault();
            floatingMenu();
        });
    });
    const menuItemsWithChildren = document.querySelectorAll('.sticky-mobinav .menu-item-has-children');
    menuItemsWithChildren.forEach(item => {
        const dropLink = document.createElement('a');
        dropLink.className = 'drop close';
        dropLink.href = 'javascript:void(0)';
        item.appendChild(dropLink);
    });
    const subMenus = document.querySelectorAll('.sticky-mobinav .menu-item-has-children ul.sub-menu');
    subMenus.forEach(subMenu => {
        subMenu.style.display = 'none';
    });
});
document.addEventListener('click', function (event) {
    if (event.target.matches('.sticky-mobinav .menu-item-has-children a.drop')) {
        event.preventDefault();
        const clickedLink = event.target;
        const menuItem = clickedLink.closest('.menu-item');
        const submenu = menuItem.querySelector('.sub-menu');
        if (submenu) {
            if (submenu.style.display === 'block') {
                submenu.style.display = 'none';
            } else {
                submenu.style.display = 'block';
            }
        }
        const siblingItems = menuItem.parentElement.querySelectorAll('.menu-item');
        siblingItems.forEach(item => {
            if (item !== menuItem) {
                const siblingSubmenu = item.querySelector('.sub-menu');
                const siblingLink = item.querySelector('a.drop');
                if (siblingSubmenu) {
                    siblingSubmenu.style.display = 'none';
                }
                if (siblingLink) {
                    siblingLink.classList.remove('open');
                    siblingLink.classList.add('close');
                }
            }
        });
        if (clickedLink.classList.contains('close')) {
            clickedLink.classList.remove('close');
            clickedLink.classList.add('open');
        } else {
            clickedLink.classList.remove('open');
            clickedLink.classList.add('close');
        }
    }
});
document.addEventListener("DOMContentLoaded", function () {
    const header = document.querySelector(".header-sticky");
    if (window.innerWidth > 0) {
        window.addEventListener("scroll", function () {
            if (window.scrollY > 250) {
                header.classList.add("fixed-header");
            } else {
                header.classList.remove("fixed-header");
            }
        });
    }
});
const header = document.querySelector(".site-header");
const toggleClass = "is-sticky";
const fadingOutClass = "is-fading-out";
let lastScroll = window.pageYOffset;
function shouldApplySticky() {
    return window.innerWidth > 991;
}
window.addEventListener("scroll", () => {
    if (!shouldApplySticky())
        return;

    const currentScroll = window.pageYOffset;

    if (currentScroll > lastScroll && currentScroll > 250) {
        header.classList.remove(fadingOutClass);
        header.classList.add(toggleClass);
    } else if (
            currentScroll < lastScroll &&
            currentScroll < 600 &&
            header.classList.contains(toggleClass)
            ) {
        header.classList.add(fadingOutClass);
        setTimeout(() => {
            header.classList.remove(toggleClass);
            header.classList.remove(fadingOutClass);
        }, 300);
    }
    lastScroll = currentScroll;
});
window.addEventListener("resize", () => {
    if (!shouldApplySticky()) {
        header.classList.remove(toggleClass, fadingOutClass);
    }
});
document.addEventListener('DOMContentLoaded', function () {
    const trigger = document.querySelector(".disclaimer-trigger");
    const popup = document.getElementById("disclaimer-container");
    if (trigger && popup) {
        trigger.addEventListener("click", function (e) {
            e.preventDefault();
            popup.classList.toggle("show");
        });
        document.addEventListener("click", function (e) {
            if (!popup.contains(e.target) && e.target !== trigger) {
                popup.classList.remove("show");
            }
        });
    }
    jQuery(".hm-form a.popup").click(function () {
        jQuery(".hm-form span.popuptext").toggleClass("show");
    });
    jQuery('input[type="email"]').bind("cut copy paste", function (e) {
        e.preventDefault();
    });
    jQuery('#input_2_3').bind("cut copy paste", function (e) {
        e.preventDefault();
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const widgets = document.querySelectorAll(".checked_by");

    widgets.forEach(widget => {
        const name = widget.querySelector(".widget-names");
        const description = widget.querySelector(".widget-description");
        name.addEventListener("click", function () {
            name.classList.toggle("nameactive");
            description.classList.toggle("active");
        });
    });
});
jQuery('.testi-sdbr-blk, .case-sdbr-blk, .team-sdbar-list').owlCarousel({
    loop: true,
    touchDrag: true,
    mouseDrag: true,
    nav: true,
    dots: false,
    items: 1,
    margin: 0,
    autoplay: true
});
jQuery('.testi-slider').owlCarousel({
    loop: true,
    touchDrag: true,
    mouseDrag: true,
    nav: false,
    dots: false,
    items: 1,
    margin: 0,
    autoplay: true
});
document.addEventListener('DOMContentLoaded', () => {
    const menuItems = document.querySelectorAll('.sidebar-menu-pa .menu-item-has-children');

    menuItems.forEach(item => {
        const dropToggle = document.createElement('div');
        dropToggle.className = 'drop close';
        dropToggle.setAttribute('role', 'button');
        dropToggle.setAttribute('tabindex', '0');
        item.appendChild(dropToggle);
        const submenu = item.querySelector('ul.sub-menu');
        if (submenu) {
            submenu.style.maxHeight = '0';
            submenu.style.overflow = 'hidden';
            submenu.style.transition = 'max-height 0.3s ease';
            dropToggle.addEventListener('click', () => {
                const isOpen = submenu.classList.contains('open');
                if (isOpen) {
                    submenu.style.maxHeight = submenu.scrollHeight + 'px';
                    submenu.offsetHeight; // force reflow
                    submenu.style.maxHeight = '0';
                    submenu.classList.remove('open');
                    dropToggle.classList.remove('open');
                    dropToggle.classList.add('close');
                } else {
                    submenu.style.maxHeight = submenu.scrollHeight + 'px';
                    submenu.classList.add('open');
                    dropToggle.classList.remove('close');
                    dropToggle.classList.add('open');
                }
            });
            submenu.addEventListener('transitionend', () => {
                if (submenu.classList.contains('open')) {
                    submenu.style.maxHeight = 'none';
                }
            });
        }
    });


    const mountIfExists = (selector, options = {}, extensions = null) => {
        const el = document.querySelector(selector);
        if (el && typeof Splide !== 'undefined') {
            try {
                const splide = new Splide(el, options);
                splide.mount(extensions || {});
            } catch (e) {
                console.error(`Failed to mount Splide on ${selector}:`, e);
            }
    }
    };
    const splideExtensions = typeof Splide !== 'undefined' && Splide.Extensions ? Splide.Extensions : undefined;
    mountIfExists('#sidebar-reviews', {
        type: 'loop',
        perPage: 1,
        perMove: 1,
        autoplay: true,
        interval: 3000,
        speed: 3500,
        autoHeight: true,
        margin:100
    });

});

jQuery('.hm-insights').owlCarousel({
    loop: true,
    touchDrag: true,
    mouseDrag: true,
    nav: true,
    dots: false,
    items: 2,
    margin: 20,
    autoplay: true
});

jQuery(document).ready(function ($) {

    $('.hm-accordion-blk .accordion-profile').on('click', function () {

        var $item = $(this).closest('.accordion-item');
        var $content = $item.find('.accordion-profile-content');

        // If current item is already open → close it
        if ($item.hasClass('active')) {

            $item.removeClass('active');
            $content.stop(true, true).slideUp(300);

        } else {

            // Close all other items
            $('.hm-accordion-blk .accordion-item')
                .removeClass('active');

            $('.hm-accordion-blk .accordion-profile-content')
                .stop(true, true)
                .slideUp(300);

            // Open current item
            $item.addClass('active');
            $content.stop(true, true).slideDown(300);
        }

    });

});

/* Mobile Slider */
jQuery(document).ready(function () {
    mobilesliders();

    jQuery(window).resize(function () {
        mobilesliders();
    });

    function mobilesliders() {

        if (jQuery(window).width() <= 991) {

            jQuery('.hm-our-serv-blk, .team-blk, .hm-award-list , .nashville-list ,.hm-case-lisl, .practice-list, .inr-attorney-blk')
                .addClass('owl-carousel')
                .owlCarousel({
                    loop: true,
                    autoplay: false,
                    autoplayTimeout: 5000,
                    autoplayHoverPause: true,
                    touchDrag: true,
                    mouseDrag: true,
                    nav: false,
                    dots: true,

                    responsive: {
                        0: {
                            items: 1
                        },
                        768: {
                            items: 2,
                            margin:20
                        }
                    }
                });

        } else {

            jQuery('.hm-our-serv-blk, .team-blk, .hm-award-list')
                .trigger('destroy.owl.carousel')
                .removeClass('owl-carousel');

        }
    }
});
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.tab-btn').forEach(button => {
        button.addEventListener('click', () => {
            const tabId = button.getAttribute('data-tab');
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
            button.classList.add('active');
            const tabContent = document.getElementById(tabId);
            if (tabContent)
                tabContent.classList.add('active');
        });
    });
});

 
jQuery(document).ready(function ($) {
    function mobilesliders() {
        var windowWidth = window.innerWidth;
 
        if (windowWidth <= 991) {
            if (!$('.injury-case-list').hasClass('owl-loaded')) {
                $('.injury-case-list').addClass('owl-carousel').owlCarousel({
                    loop: true,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    autoplayHoverPause: true,
                    touchDrag: true,
                    mouseDrag: true,
                    nav: true,
                    dots: false,
                    items: 1,
                    responsive: {
                        0: { items: 1 },
                        767: { items: 2, margin:10 }
                    }
                });
            }
        } else {
            if ($('.injury-case-list').hasClass('owl-loaded')) {
                $('.injury-case-list')
                    .trigger('destroy.owl.carousel')
                    .removeClass('owl-carousel owl-loaded owl-drag');
                $('.injury-case-list').find('.owl-stage-outer').children().unwrap();
            }
        }
    }
 
    mobilesliders();
    $(window).on('resize', mobilesliders);
});
 

jQuery('.hm-testi-list').owlCarousel({
    loop: true,
    touchDrag: true,
    mouseDrag: true,
    nav: true,
    dots: false,
    items: 3,
    margin: 28,
    autoplay: true,
 
    responsive: {
        0: { items: 1, margin: 20 },
        768: { items: 2, margin: 20 },
        992: { items: 3, margin: 20 },
        1600: { items: 3, margin: 24 },
        1601: { items: 3, margin: 28 }
    }
});
 

// jQuery('.hm-testi-list').owlCarousel({
//     loop: true,
//     touchDrag: true,
//     mouseDrag: true,
//     nav: true,
//     dots: false,
//     items: 1,
//     margin: 0,
//     center: true,
//     stagePadding: 510,
//     autoplay: true,
//     responsive: {
//         0: { items: 1, margin: 20, stagePadding: 0 },
//         768: { items: 1, margin: 20, stagePadding: 100 },
//         992: { items: 1, margin: 20, stagePadding: 250 },
//         1600: { items: 1, margin: 40, stagePadding: 450 },
//         1601: { items: 1, margin: 40, stagePadding: 510 }
//     }
// });

 
 /* Accordion Section */
  jQuery(document).ready(function () {
    function close_accordion_section() {
        jQuery('.accordion .accordion-section-title').removeClass('active');
        jQuery('.accordion .accordion-section-content').slideUp(300).removeClass('open');
    }
 
    jQuery('.accordion-section-title').on('click', function (e) {
        e.preventDefault();
 
        // --- Prevent scroll jump by saving and restoring scroll position ---
        const scrollPos = jQuery(window).scrollTop();
 
        const currentAttrValue = jQuery(this).attr('href');
 
        if (jQuery(this).hasClass('active')) {
            close_accordion_section();
        } else {
            close_accordion_section();
            jQuery(this).addClass('active');
            jQuery('.accordion ' + currentAttrValue).slideDown(300).addClass('open');
        }
 
        // --- Restore scroll position after accordion animation ---
        setTimeout(function () {
            jQuery(window).scrollTop(scrollPos);
        }, 10);
    });
 
    // Open the first accordion by default
    jQuery(".accordion-section").each(function (index) {
        var title = jQuery(this).find(".accordion-section-title");
        var content = jQuery(this).find(".accordion-section-content");
        if (index === 0) {
            title.addClass("active");
            content.addClass("open").show();
        } else {
            title.removeClass("active");
            content.removeClass("open").hide();
        }
    });
});
 
 
 