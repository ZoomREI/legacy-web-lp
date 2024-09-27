<?php
    $selectedName = isset($attributes['selectedName']) ? $attributes['selectedName'] : 'Chris';

?>

<div class="s2-form">
    <div class="s2-form__container">
        <div data-page="main" class="s2-form__step">
            <div class="s2-form__title">
                <h1>Thanks for reaching out to us! </h1>
            </div>
            <div class="s2-form__subtitle">
                <p>You’re just a few steps away from getting a fast cash offer for your house...</p>
            </div>
            <div class="s2-form__progress" style="--progress: 50%">
                <span class="done"></span>
                <span class="process"></span>
                <span ></span>
            </div>
            <div class="s2-form__title big">
                <p>Why should you choose us?</p>
            </div>
            <div class="s2-form__subtitle">
                <p>Watch a short video and find out!</p>
            </div>
            <div class="s2-form__video">
                <?php if($selectedName === 'Chris') : ?>
                    <div style="padding:56.25% 0 0 0;position:relative;"><iframe
                            src="https://player.vimeo.com/video/1012736746?title=0&byline=0&portrait=0&badge=0&autopause=0&autoplay=1&muted=1&controls=0"
                            allow="autoplay; encrypted-media"
                            frameborder="0"
                            style="position:absolute;top:0;left:0;width:100%;height:100%;"
                            title="Chris Buys Homes Commercial"
                            data-ready="true">
                        </iframe>
                    
                    </div><script src="https://player.vimeo.com/api/player.js"></script>
                <?php else: ?>
                    <div style="padding:56.25% 0 0 0;position:relative;"><iframe
                            src="https://player.vimeo.com/video/1012741396?title=0&byline=0&portrait=0&badge=0&autopause=0&autoplay=1&muted=1&controls=0"
                            allow="autoplay; encrypted-media"
                            frameborder="0"
                            style="position:absolute;top:0;left:0;width:100%;height:100%;"
                            title="John Buys Bay Area Houses Commercial"
                            data-ready="true">
                        </iframe>

                    </div><script src="https://player.vimeo.com/api/player.js"></script>
                <?php endif; ?>
            </div>
            <button data-page-link="form" type="button" class="s2-form__btn">continue</button>
        </div>
        <div data-page="form" class="s2-form__step">
            <div class="s2-form__progress" style="--progress: 50%">
                <span class="done"></span>
                <span class="done"></span>
                <span class="process"></span>
            </div>
            <div class="s2-form__title big">
                <h2>Let Us Prepare the Best Offer for You</h2>
            </div>
            <div class="s2-form__subtitle">
                <p>We just need a little more information to understand your situation and offer you the best options, including an instant cash offer.
					<br>
					<br>
					If you’re unsure about any details, feel free to leave those fields blank for now.
				</p>
            </div>
            <div class="s2-form__form">
                <?php echo $content; ?>
            </div>
        </div>
		<div data-page="thanks" class="s2-form__step">
			<div class="s2-form__progress" style="--progress: 100%">
				<span class="done"></span>
				<span class="done"></span>
				<span class="done"></span>
			</div>
			<div class="s2-form__title-custom s2-form__thanks">
				<h3>Thank you!</h3>
				<p>We've received your information and will be in touch soon with your offer.</p>
			</div>
		</div>
    </div>
</div>
