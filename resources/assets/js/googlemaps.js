// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

var placeSearch, autocomplete;

var componentForm = {
    street_number: 'short_name',    
    route: 'long_name',                         //street name
    locality: 'long_name',                      //city
    administrative_area_level_1: 'short_name',  //state
    country: 'long_name',                       
    postal_code: 'short_name'                   
};

function initAutocomplete() {
    // Create the autocomplete object, restricting the search to geographical
    // location types.
    autocomplete = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('searchGoogleMapField')),
        {types: ['geocode', 'establishment']});

    // When the user selects an address from the dropdown, populate the address
    // fields in the form.
    autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
    var streetAddress = {
        street_number: null,
        street_name: null
    }
    
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();

    if (place) {
        $('#establishment').val(place.name);
    }

    for (var component in componentForm) {
        $('#component').val = '';
        $('#component').disabled = false;
    }

    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];

        if (componentForm[addressType]) {
           
            if (addressType !== "street_number" && addressType !== "route") {
                var val = place.address_components[i][componentForm[addressType]];
                $('#' + addressType).val(val);
            }
            else {
                if (addressType === "street_number") {
                    streetAddress.street_number = place.address_components[i][componentForm[addressType]];
                }
                else if (addressType === "route") {
                    streetAddress.street_name = place.address_components[i][componentForm[addressType]];
                }

                if (streetAddress.street_name && streetAddress.street_number) {
                    $('#street_address').val(streetAddress.street_number + " " + streetAddress.street_name);
                }

            }
        }
    }
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
                center: geolocation,
                radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
        });
    }
}