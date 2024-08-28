<?php
$selectedName = isset($attributes['selectedName']) ? $attributes['selectedName'] : 'Chris';
$brandName = ($selectedName == "Chris") ? "Chris Buys Homes" : "John Buys Bay Area Houses";

$faqs = array(
    array(
        "question" => "Why should I choose " . esc_html($brandName) . "?",
        "answer" => "We’re top-rated on Google because we deliver on our promises. Our customers love us. We’ll get you the best cash offer for your home, even if it means connecting you with other trusted buyers."
    ),
    array(
        "question" => "How are you different from a real estate agent?",
        "answer" => "Agents list your house, charge fees, and you handle costs and showings. We buy your house directly or connect you with buyers. Skip the hassle – get a quick offer, close on your timeline."
    ),
    array(
        "question" => "My property is in terrible condition, will you still buy it?",
        "answer" => "We buy huses AS-IS in any condition. The more the fix-ups, the better for us! Absolutely, we’ll buy your house even if it’s rough. You might be surprised by our offer."
    ),
    array(
        "question" => "I'm going through a major life change and need to sell my home quickly. Can you help me?",
        "answer" => "We understand that life changes like relocation, divorce, medical issueas, or unexpected events can make selling your home urgent. We offer a fast purchase process, fair pricing, and a straightforward approach, avoiding traditional real estate hurdles."
    )
);
?>

<section class="lc-faqs">
    <div class="lc-faqs__container">
        <div class="lc-faqs__header">
            <h2 class="lc-faqs__title">Frequently Asked Questions</h2>
            <p>Have any questions? We’re here to help.</p>
        </div>
        <div class="lc-faqs__items">
            <?php foreach ($faqs as $faq) : ?>
                <div class="lc-faqs__item">
                    <div class="lc-faqs__question">
                        <?php echo esc_html($faq['question']); ?>
                        <span class="faq-indicator">+</span>
                    </div>
                    <div class="lc-faqs__answer">
                        <?php echo wp_kses_post($faq['answer']); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>