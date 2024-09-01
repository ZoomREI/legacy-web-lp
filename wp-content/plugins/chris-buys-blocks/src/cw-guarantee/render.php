<?php
$select_url = plugins_url('src/cw-guarantee/assets/select.svg', dirname(__FILE__, 2));
$no_money_url = plugins_url('src/cw-guarantee/assets/no-money.svg', dirname(__FILE__, 2));
$house_url = plugins_url('src/cw-guarantee/assets/house.svg', dirname(__FILE__, 2));
$calendar_url = plugins_url('src/cw-guarantee/assets/calendar.svg', dirname(__FILE__, 2));
?>

<section class="cw-guarantee--wrapper">
    <div class="cw-guarantee__title">
        <h2>Here’s Our Guarantee To You</h2>
        <p>If you need a hassle-free, fast sale, here’s what we guarantee.</p>
    </div>
    <div class="cw-guarantee__guarantees">
        <div class="cw-guarantee">
            <div class="cw-guarantee__heading">
                <div class="cw-guarantee__icon">
                    <img src="<?php echo esc_url($select_url); ?>" alt="Fast Cash Offers">
                </div>
                <h3>Fast Cash Offers</h3>
            </div>
            <div class="cw-guarantee__content">
                <p>Typically we’ll provide you with a cash offer in under 7 minutes, you’ll get none of the delays you’d associate with traditional real estate transactions.</p>
            </div>
        </div>
        <div class="cw-guarantee">
            <div class="cw-guarantee__heading">
                <div class="cw-guarantee__icon">
                    <img src="<?php echo esc_url($no_money_url); ?>" alt="No Fees / Commissions">
                </div>
                <h3>No Fees / Commissions</h3>
            </div>
            <div class="cw-guarantee__content">
                <p>Because you’re dealing with us directly you can avoid real estate fees and sales commissions. You get to keep what we offer you.</p>
            </div>
        </div>
        <div class="cw-guarantee">
            <div class="cw-guarantee__heading">
                <div class="cw-guarantee__icon">
                    <img src="<?php echo esc_url($house_url); ?>" alt="No Repairs Needed">
                </div>
                <h3>No Repairs Needed</h3>
            </div>
            <div class="cw-guarantee__content">
                <p>Whatever the condition of your property, we’ll buy it. There’s no need for costly repairs or renovations before selling.</p>
            </div>
        </div>
        <div class="cw-guarantee">
            <div class="cw-guarantee__heading">
                <div class="cw-guarantee__icon">
                    <img src="<?php echo esc_url($calendar_url); ?>" alt="Flexible Closing Dates">
                </div>
                <h3>Flexible Closing Dates</h3>
            </div>
            <div class="cw-guarantee__content">
                <p>We’ll work with you to find a timeline that suits your needs.</p>
            </div>
        </div>
    </div>
</section>