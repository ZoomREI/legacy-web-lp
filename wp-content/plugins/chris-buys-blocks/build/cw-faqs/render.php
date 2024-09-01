<?php
$selectedMarket = isset($attributes['selectedMarket']) ? esc_html($attributes['selectedMarket']) : 'St. Louis';

// Determine the brand name and individual based on the selected market
if ($selectedMarket === "San Francisco Bay Area") {
    $selectedName = "John";
    $brandName = "John Buys Bay Area Houses";
} else {
    $selectedName = "Chris";
    $brandName = "Chris Buys Homes in " . $selectedMarket;
}

$faqs = array(
    array(
        "question" => "Is a “cash home buying” company right for me?",
        "answer" => "Believe it or not, most sellers we’ve helped in " . $selectedMarket . " weren’t desperate or facing foreclosure.</br>They come to us because, well, who wants repair headaches or endless showings?</br>We buy houses as they are, no hassle. Get a free, no-obligation cash offer quick and easy!"
    ),
    array(
        "question" => "Why should I choose " . $brandName . "?",
        "answer" => "We’re the top home buyers in " . $selectedMarket . ", found right at the top of Google for a reason. Our customers love us because we deliver what we promise.</br>We’re dedicated to getting you the best cash offer for your house, even if it means connecting you with other trusted buyers.</br>We genuinely care and go the extra mile without expecting anything back."
    ),
    array(
        "question" => "How are you different from a real estate agent?",
        "answer" => "Agents don’t buy your house; they list it, charge fees, and you deal with costs and showings.</br>We’re cash buyers, directly purchasing your house or connecting you with others who do. Skip the agent hassle – get a quick offer and sale in " . $selectedMarket . ".</br>We cover selling expenses."
    ),
    array(
        "question" => "Do I need to clean before I move out?",
        "answer" => "Don’t stress. Take what you need, leave the rest. Fridge food, clothes, furniture – we’ve seen it all.</br>Simplify your move – keep what you want, and we’ll handle the rest hassle-free.</br>Anything decent? We donate to local charities."
    ),
    array(
        "question" => "Will I get a fair price for my property?",
        "answer" => "Great question! We pay fair prices, but not always full market value.</br>For houses needing repairs, we calculate fair prices by subtracting repair costs.</br>Sometimes, we offer market value but might explore seller financing if an all-cash deal doesn’t fit."
    ),
    array(
        "question" => "My house is in terrible condition, will you still buy it?",
        "answer" => "We buy homes AS-IS in any condition in " . $selectedMarket . ".</br>The more the fix-ups, the better for us! Absolutely, we’ll buy your house even if it’s rough. You might be surprised by our offer.</br>Fill out our form and see what cash we’re offering for your house!"
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
                    <span class="cw-faq-indicator">+</span>
                </div>
                <div class="cw-faqs__answer">
                    <?php echo wp_kses_post($faq['answer']); ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>