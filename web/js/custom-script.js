function initMap() {
    var uluru = {
        lat: 23.094197,
        lng: 72.558148
    };
    var map = new google.maps.Map(document.getElementById('contact-map'), {
        zoom: 14,
        center: uluru,
        scrollwheel: false
    });
    var marker = new google.maps.Marker({
        position: uluru,
        map: map,
        icon: 'https://easetemplate.com/free-website-templates/life-coach/images/map_marker.png'

    });
}

$(document).ready(function(){
    $('.customer-logos').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 3
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 2
            }
        }]
    });
});
