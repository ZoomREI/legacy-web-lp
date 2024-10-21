<?php
$selectedName = isset($attributes['selectedName']) ? $attributes['selectedName'] : 'Chris';
$brandName = ($selectedName == "Chris") ? "Chris Buys Homes" : "John Buys Houses";

$faqs = array(
    array(
        "question" => "Why should I choose " . esc_html($brandName) . "?",
        "answer" => "We’re top-rated on Google because we deliver on our promises. Our customers love us. We’ll get you the best cash offer for your home, even if it means connecting you with other trusted buyers."
    ),
    array(
        "question" => "How are you different from a real estate agent?",
        "answer" => "Agents list your property, charge fees, and you handle costs and showings. We buy your property directly or connect you with buyers. Skip the hassle – get a quick offer, close on your timeline."
    ),
    array(
        "question" => "My property is in terrible condition, will you still buy it?",
        "answer" => "We buy huses AS-IS in any condition. The more the fix-ups, the better for us! Absolutely, we’ll buy your house even if it’s rough. You might be surprised by our offer."
    ),
    array(
        "question" => "I'm a rental property owner, dealing with property management issues. Can you help me?",
        "answer" => "We understand the challenges landlords face: problematic tenants, high maintenance costs, or poor financial returns. We offer a fast purchase process, fair pricing, and a straightforward approach, avoiding traditional real estate hurdles."
    ),
    array(
        "question" => "I need to sell my inherited property quickly and move - Are You the best choice?",
        "answer" => "We specialize in fast and flexible property sales for inherited property owners. No repairs needed, no commissions, and a flexible timeline that suits your needs."
    ),
);
?>

<section class="ao-faqs">
    <div class="ao-faqs__header">
        <h2 class="ao-faqs__title">Frequently Asked Questions</h2>
        <p>Have any questions? We’re here to help.</p>
    </div>
    <div class="ao-faqs__items">
        <?php foreach ($faqs as $faq) : ?>
            <div class="ao-faqs__item">
                <div class="faq-question ao-faqs__question">
                    <?php echo esc_html($faq['question']); ?>
                    <span class="ao-faq-indicator">+</span>
                </div>
                <div class="ao-faqs__answer">
                    <?php echo wp_kses_post($faq['answer']); ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>