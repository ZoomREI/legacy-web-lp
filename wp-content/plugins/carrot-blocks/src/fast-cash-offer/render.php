<?php
$formId = isset($attributes['formId']) ? esc_attr($attributes['formId']) : '1';
?>

<section class="full-width dark-banner">
    <div class="fast-cash-offer">
        <h2>
            The Fastest Cash Offer You’ll Ever Receive (and also the Best!)
        </h2>
        <div class="fast-cash-offer__content">
            <div class="fast-cash-offer__text">
                <span>Ready to hear more? fill out the form to:</span>
                <ul>
                    <li>
                        Get a quick cash offer on your house – we’re not wasting time!
                    </li>
                    <li>Sell your house to a local home buyer</li>
                    <li>Choose your closing date</li>
                    <li>Avoid Inspections and Repairs</li>
                </ul>
                <p class="fast-cash-offer__hassle-free">
                    What if you can get rid of your house today? Hassle-Free
                </p>
                <p class="fast-cash-offer__forget">
                    Forget about paying commissions and fees, forget about making
                    costly repairs and going through inspections, forget what you
                    knew about selling a house – We offer the easy way!
                </p>
            </div>
            <div class="fast-cash-offer__form">
                <?php echo do_shortcode('[gravityform id="' . $formId . '" title="false" ajax="true"]'); ?>
            </div>
        </div>
    </div>
</section>