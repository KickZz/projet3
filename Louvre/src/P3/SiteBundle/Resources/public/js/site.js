$(function () {
    var $form = $('#payment-form');
    $form.submit(function (event) {
        // Disable the submit button to prevent repeated clicks:
        $form.find('.submit').prop('disabled', true);

        // Request a token from Stripe:
        Stripe.card.createToken($form, stripeResponseHandler);

        // Prevent the form from being submitted:
        return false;
    });
});
var errorMessages = {
  incorrect_number: "Les numéros de la carte sont incorrects.",
  invalid_number: "Le numéro de la carte n'est pas un numéro de carte valide.",
  invalid_expiry_month: "La date d'expiration de la carte n'est pas valide.",
  invalid_expiry_year: "L'année de la date d'expiration de la carte n'est pas valide.",
  invalid_cvc: "Le cryptogramme n'est pas valide.",
  expired_card: "la carte a expirée.",
  incorrect_cvc: "Le cryptogramme n'est pas correct.",
  incorrect_zip: "Le code postal est incorrect.",
  card_declined: "La carte a été refusée.",
  missing: "Il n'y a aucune carte.",
  processing_error: "Une erreur est arrivée en traitant la carte.",
  rate_limit:  "Une erreur est survenue en raison des trop nombreuses requêtes. Si le problème persiste n'hésitez pas à nous contacter."
};

function stripeResponseHandler(status, response) {
    // Grab the form:
    var $form = $('#payment-form');

    if (response.error) { // Problem!

        // Show the errors on the form:
        $form.find('.payment-errors').text(errorMessages[ response.error.code ]);
        $form.find('.submit').prop('disabled', false); // Re-enable submission

    } else { // Token was created!

        // Get the token ID:
        var token = response.id;

        // Insert the token ID into the form so it gets submitted to the server:
        $form.append($('<input type="hidden" name="stripeToken">').val(token));

        // Submit the form:
        $form.get(0).submit();
    }
};