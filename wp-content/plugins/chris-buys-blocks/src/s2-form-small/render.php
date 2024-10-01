<?php
    $selectedName = isset($attributes['selectedName']) ? $attributes['selectedName'] : 'Chris';
	$phoneNumber = isset($attributes['phoneNumber']) ? esc_html($attributes['phoneNumber']) : '';
?>

<div class="s2-form-small">
	<div class="s2-form-small__start">
		<a href="tel:<?php echo $phoneNumber; ?>" class="s2-form-small__start-phone"><span>Call Us! <br><?php echo $phoneNumber; ?></span></a>
		<div class="s2-form-small__start-title"><span>Get A Cash Offer in 7 Minutes</span></div>
	</div>
    <div class="s2-form-small__container">
		<div class="s2-form-small__video">
            <?php if($selectedName === 'Chris') : ?>
                <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/1012736746?title=0&byline=0&portrait=0&badge=0&autopause=0&player_id=0&badge=0" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write" style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Chris Buys Homes Commercial"></iframe></div>
                <script src="https://player.vimeo.com/api/player.js"></script>
            <?php else: ?>
                <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/1013050500?title=0&byline=0&portrait=0&badge=0&autopause=0&player_id=0&badge=0" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write" style="position:absolute;top:0;left:0;width:100%;height:100%;" title="John Buys Bay Area Houses Commercial"></iframe></div>
                <script src="https://player.vimeo.com/api/player.js"></script>
            <?php endif; ?>
		</div>
        <div data-page="main" class="s2-form-small__step">
			<div class="s2-form-small__main-container">
				<div class="s2-form-small__title">
					<h1>Great! Just a few more quick questions to learn more about your property. </h1>
				</div>
				<div class="s2-form-small__subtitle">
                <span>It'll only take 5 minutes and help us make a faster, more accurate offer. <br>
				The more we know, the better we can tailor our offer to you.</span>

					<p>Prefer to talk instead?<br>
						Give us a call at <a href="tel:<?php echo $phoneNumber; ?>"><?php echo $phoneNumber; ?></a> or send a text-whatever works best for you.</p>
				</div>
				<div class="s2-form-small__form">
					<?php echo $content; ?>
				</div>
			</div>
        </div>
		<div data-page="thanks" class="s2-form-small__step s2-form-small__step--hide">
			<div class="s2-form-small__title-custom s2-form-small__thanks">
				<h3>Thank you!</h3>
				<p>We've received your information and will be in touch soon with your offer.</p>
			</div>
		</div>
    </div>
</div>
