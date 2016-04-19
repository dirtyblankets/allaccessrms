
/*!
 * Start Bootstrap - Grayscale Bootstrap Theme (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */

// jQuery to collapse the navbar on scroll
$(window).scroll(function() {

    if ($(".navbar.navbarscroll").offset().top > 50) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
    }
});

// jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});

// Closes the Responsive Menu on Menu Item Click
$('.navbar-collapse ul li a').click(function() {
    $('.navbar-toggle:visible').click();
});

// Keep drop-down menu opened if has error
$(function() {
    var haserror = $(".login span.help-block");
    if (haserror.text())
    {
        $(".dropdown-toggle").dropdown("toggle");
    }
});

$(function() {
    var haserror = $(".alert-danger ul li");
    if (haserror.text())
    {
        jumpto('registration');
    }
});

function jumpto(anchor){
    window.location.href = "#"+anchor;
}

$(function() {
    HandleRegistrationPage();
});

function HandleRegistrationPage() {
    handleSignaturePads("parentSignaturePadWrapper", "parent_signature");
}

function handleSignaturePads(wrapperId, inputName) {

    var wrapper = document.getElementById(wrapperId);
    var canvas = document.querySelector("canvas");
    var clearButton = wrapper.querySelector("[data-action=clear]");
    var saveButton = wrapper.querySelector("[data-action=save]");

    var signaturePad = new SignaturePad(canvas);
    
    var oldValue = $("input[name="+inputName+"]").val();

    if (oldValue) {
        signaturePad.fromDataURL(oldValue);
    }

    clearButton.addEventListener("click", function (event) {

        signaturePad.clear();

        $("input[name="+inputName+"]").val('');

    });

    saveButton.addEventListener("click", function (event) {
        if (signaturePad.isEmpty()) {
            alert("Please provide signature first.");
        } else {
            $("input[name="+inputName+"]").val(signaturePad.toDataURL());
        }
    });
}

