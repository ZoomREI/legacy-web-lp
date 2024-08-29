<?php
$selectedName = isset($attributes['selectedName']) ? $attributes['selectedName'] : 'Chris';
$brandName = ($selectedName == "Chris") ? "Chris Buys Homes" : "John Buys Bay Area Houses";

$faqs = array(
     array(
        "question" => "Why should I choose Doctor Homes?",
        "answer" => "We’re top-rated on Google because we deliver on our promises. Our customers in Detroit love us. We’ll get you the best cash offer for your property, even if it means connecting you with other trusted buyers."
     ),
    array(
        "question" => "How are you different from a real estate agent in Detroit?",
        "answer" => "Agents list your property, charge fees, and you handle costs and showings. We buy your property in Detroit directly or connect you with buyers. Skip the hassle – get a quick offer, close on your timeline."
    ),
    array(
        "question" => "My property in Detroit is in terrible condition, will you still buy it?",
        "answer" => "We buy properties AS-IS in any condition. The more the fix-ups, the better for us! We’ll buy your Detroit house even if it’s rough. You might be surprised by our offer."
    ),
    array(
        "question" => "I'm going through a major life change and need to sell my home quickly. Can you help me?",
        "answer" => "We understand that life changes like relocation, divorce, medical issues, or unexpected events can make selling your home urgent. We offer a fast purchase process, fair pricing, and a straightforward approach, avoiding traditional real estate hurdles."
    ),
    array(
        "question" => "I'm a rental property owner in Detroit, dealing with property management issues. Can you help me?",
        "answer" => "We understand the challenges landlords in Detroit face: problematic tenants, high maintenance costs, or poor financial returns. We offer a fast purchase process, fair pricing, and a straightforward approach, avoiding traditional real estate hurdles."
    ),
    array(
        "question" => "I need to sell my inherited property in Detroit quickly and move - Are You the best choice?",
        "answer" => "We specialize in fast and flexible property sales for inherited property owners in Detroit. No repairs needed, no commissions, and a flexible timeline that suits your needs."
    ),
);
?>


<section id='faq' class="cw-faqs">
    <div class="cw-faqs__header">
        <h2 class="cw-faqs__prevtitle">FAQs</h2>
        <h2 class="cw-faqs__title">Frequently Asked <span>Questions</span></h2>
    </div>
    <div class="cw-faqs__items">
        <?php foreach ($faqs as $faq) : ?>
            <div class="cw-faqs__item">
                <div class="cw-faqs__question">
                    <?php echo esc_html($faq['question']); ?>
                    <span class="faq-indicator">+</span>
                </div>
                <div class="cw-faqs__answer">
                    <?php echo wp_kses_post($faq['answer']); ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>