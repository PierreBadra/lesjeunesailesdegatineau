<?php get_header(); ?>

<?php
$form_message = '';
$form_success = false;

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_form_submit'])) {

    // Validate required fields
    $required_fields = ['firstName', 'lastName', 'email', 'message'];
    $missing_fields = [];

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $missing_fields[] = $field;
        }
    }

    if (!empty($missing_fields)) {
        $form_message = 'Veuillez remplir tous les champs obligatoires.';
        $form_success = false;
    } else {
        // Sanitize and validate data
        $form_data = [
            'firstName' => sanitize_text_field($_POST['firstName']),
            'lastName' => sanitize_text_field($_POST['lastName']),
            'email' => sanitize_email($_POST['email']),
            'phoneNumber' => sanitize_text_field($_POST['phoneNumber']),
            'message' => sanitize_textarea_field($_POST['message'])
        ];

        // Validate email
        if (!is_email($form_data['email'])) {
            $form_message = 'Veuillez entrer une adresse email valide.';
            $form_success = false;
        } else {
            // Send email
            $result = send_contact_email($form_data);
            $form_message = $result['message'];
            $form_success = $result['success'];

            // Clear form data on success
            if ($form_success) {
                $form_data = [
                    'firstName' => '',
                    'lastName' => '',
                    'email' => '',
                    'phoneNumber' => '',
                    'message' => ''
                ];
            }
        }
    }
}

// Preserve form data if validation failed
if (!$form_success && isset($form_data)) {
    $form_values = $form_data;
} else {
    $form_values = [
        'firstName' => '',
        'lastName' => '',
        'email' => '',
        'phoneNumber' => '',
        'message' => ''
    ];
}
?>

<section class="py-16 px-6 pt-36">
    <div class="container mx-auto max-w-7xl">

        <div class="flex flex-col xl:flex-row items-center gap-8 mb-20 container max-w-7xl mx-auto">
            <!-- Text Content -->
            <div class="w-full xl:w-1/2 text-start">
                <div
                    class="flex items-center gap-1 text-blue-950 bg-amber-300 justify-center px-4 py-1 rounded-md w-fit mb-3">
                    <svg data-v-56bd7dfc="" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="w-4 h-4 lucide lucide-send-icon lucide-send">
                        <path
                            d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z">
                        </path>
                        <path d="m21.854 2.147-10.94 10.939"></path>
                    </svg>
                    <div
                        class="inline-flex items-center rounded-full border font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80 text-xs font-[Inter]">
                        Contact
                    </div>
                </div>

                <h1
                    class="text-3xl sm:text-4xl/10 md:text-5xl/15 font-bold bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent mb-4 uppercase font-[Oswald] tracking-wider sm:tracking-widest">
                    Nous Joindre
                </h1>

                <p class="text-lg sm:text-xl text-gray-600 mb-4 font-[Inter]">
                    Vous avez des questions ou souhaitez entrer en contact avec notre équipe ? Remplissez le formulaire
                    ci-dessous et nous vous répondrons dans les plus brefs délais.
                </p>
            </div>

            <!-- Image -->
            <div class="w-full xl:w-1/2 flex justify-center xl:justify-end">
                <img class="rounded-lg w-full h-full object-cover"
                    src="<?= get_template_directory_uri() ?>/assets/images/default-image.svg" alt="Image d'avant page">
            </div>
        </div>
        <!-- Display form message -->
        <?php if (!empty($form_message)): ?>
            <div
                class="mb-6 p-4 rounded-lg <?php echo $form_success ? 'bg-green-100 text-green-800 border border-green-300' : 'bg-red-100 text-red-800 border border-red-300'; ?>">
                <?php echo esc_html($form_message); ?>
            </div>
        <?php endif; ?>

        <h2
            class="font-semibold flex mb-6 items-center gap-2 text-2xl bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent uppercase font-[Oswald] tracking-widest">
            Envoyez-nous un message
        </h2>

        <form method="post" action="" id="contact-form" class="space-y-6">
            <?php wp_nonce_field('contact_form_nonce'); ?>
            <input type="hidden" name="contact_form_submit" value="1">

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label for="firstName"
                        class="block text-sm font-medium font-[Inter] tracking-widest uppercase mb-2 text-gray-600 leading-relaxed">
                        Prénom <span class="text-red-500">*</span>
                    </label>
                    <input id="firstName" name="firstName" type="text"
                        value="<?php echo esc_attr($form_values['firstName']); ?>"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-950 focus:border-transparent transition-colors"
                        placeholder="Votre prénom">
                </div>
                <div>
                    <label for="lastName"
                        class="block text-sm font-medium font-[Inter] tracking-widest uppercase mb-2 text-gray-600 leading-relaxed">
                        Nom de famille <span class="text-red-500">*</span>
                    </label>
                    <input id="lastName" name="lastName" type="text"
                        value="<?php echo esc_attr($form_values['lastName']); ?>"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-950 focus:border-transparent transition-colors"
                        placeholder="Votre nom de famille">
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label for="phoneNumber"
                        class="block text-sm font-medium font-[Inter] tracking-widest uppercase mb-2 text-gray-600 leading-relaxed">
                        Numéro de téléphone
                    </label>
                    <input id="phoneNumber" name="phoneNumber" type="tel"
                        value="<?php echo esc_attr($form_values['phoneNumber']); ?>"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-950 focus:border-transparent transition-colors"
                        placeholder="(819) 555-0123">
                </div>
                <div>
                    <label for="email"
                        class="block text-sm font-medium font-[Inter] tracking-widest uppercase mb-2 text-gray-600 leading-relaxed">
                        Adresse courriel <span class="text-red-500">*</span>
                    </label>
                    <input id="email" name="email" type="email" value="<?php echo esc_attr($form_values['email']); ?>"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-950 focus:border-transparent transition-colors"
                        placeholder="votre@courriel.com">
                </div>
            </div>

            <div>
                <label for="message"
                    class="block text-sm font-medium font-[Inter] tracking-widest uppercase mb-2 text-gray-600 leading-relaxed">
                    Message <span class="text-red-500">*</span>
                </label>
                <textarea id="message" name="message" rows="6"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-950 focus:border-transparent transition-colors resize-vertical min-h-[6rem] max-h-[12rem]"
                    placeholder="Décrivez votre demande, vos questions ou commentaires…"><?php echo esc_textarea($form_values['message']); ?></textarea>
            </div>

            <p class="text-sm text-gray-500 text-center xl:text-end">
                <span class="text-red-500">*</span> Champs obligatoires.
                Nous respectons votre vie privée et ne partagerons jamais vos informations.
            </p>

            <button type="submit" id="submit-btn"
                class="w-full sm:w-auto bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 text-white rounded-xl
                          first:rounded-t-lg last:rounded-b-lg py-4 sm:py-5 sm:px-8 tracking-wider sm:tracking-widest text-md
                          text-center flex items-center justify-center gap-2 transition-colors duration-200 gradient-animate uppercase">
                <span id="btn-text">Envoyer le message</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-send w-5 h-5 group-hover:translate-x-1 transition-transform">
                    <path d="m22 2-7 20-4-9-9-4Z"></path>
                    <path d="M22 2 11 13"></path>
                </svg>
            </button>
        </form>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>

<script>
    jQuery(document).ready(function ($) {
        // Check if validate is available
        if (typeof $.fn.validate === 'undefined') {
            console.error('jQuery Validate plugin is not loaded');
            return;
        }

        var $form = $('#contact-form');
        var $submitBtn = $('#submit-btn');
        var $btnText = $('#btn-text');

        $form.validate({
            rules: {
                firstName: {
                    required: true,
                    minlength: 2
                },
                lastName: {
                    required: true,
                    minlength: 2
                },
                phoneNumber: {
                    phoneUS: true
                },
                email: {
                    required: true,
                    email: true
                },
                message: {
                    required: true,
                    minlength: 10
                }
            },
            messages: {
                firstName: {
                    required: "Veuillez entrer votre prénom",
                    minlength: "Votre prénom doit contenir au moins 2 caractères"
                },
                lastName: {
                    required: "Veuillez entrer votre nom de famille",
                    minlength: "Votre nom de famille doit contenir au moins 2 caractères"
                },
                phoneNumber: {
                    phoneUS: "Veuillez entrer un numéro de téléphone valide"
                },
                email: {
                    required: "Veuillez entrer votre adresse courriel",
                    email: "Veuillez entrer une adresse courriel valide"
                },
                message: {
                    required: "Veuillez entrer votre message",
                    minlength: "Votre message doit contenir au moins 10 caractères"
                }
            },
            errorClass: "text-red-500 text-sm mt-1",
            errorElement: "span",
            highlight: function (element) {
                $(element).addClass("border-red-500");
            },
            unhighlight: function (element) {
                $(element).removeClass("border-red-500");
            },
            submitHandler: function (form) {
                // Show loading state
                $submitBtn.prop('disabled', true);
                $btnText.text('Envoi en cours...');

                // Submit the form
                form.submit();
            }
        });
    });
</script>

<?php get_footer(); ?>