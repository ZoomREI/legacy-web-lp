import gsap from "gsap";

document.addEventListener("DOMContentLoaded", () => {
	const faqs = document.querySelectorAll(".cw-faqs__item");

	faqs.forEach((faq) => {
		const question = faq.querySelector(".cw-faqs__question");
		const answer = faq.querySelector(".cw-faqs__answer");
		const indicator = question.querySelector(".cw-faq-indicator");

		// Ensure answers are hidden by default
		gsap.set(answer, {
			height: 0,
			opacity: 0,
			paddingTop: 0,
			paddingBottom: 0,
			overflow: "hidden",
		});

		question.addEventListener("click", () => {
			const isVisible = parseInt(gsap.getProperty(answer, "height")) > 0;

			// Close all other answers
			faqs.forEach((otherFaq) => {
				if (otherFaq !== faq) {
					const otherQuestion = otherFaq.querySelector(".cw-faqs__question");
					const otherAnswer = otherFaq.querySelector(".cw-faqs__answer");
					const otherIndicator = otherFaq.querySelector(".cw-faq-indicator");

					gsap.to(otherAnswer, {
						height: 0,
						opacity: 0,
						paddingTop: 0,
						paddingBottom: 0,
						duration: 0.5,
						onComplete: () => {
							otherAnswer.style.height = "0";
						},
					});
					otherIndicator.innerHTML = "+";
					otherQuestion.style.fontWeight = "normal";
					otherQuestion.classList.remove("_active");
				}
			});

			if (isVisible) {
				gsap.to(answer, {
					height: 0,
					opacity: 0,
					paddingTop: 0,
					paddingBottom: 0,
					duration: 0.5,
					onComplete: () => {
						answer.style.height = "0";
					},
				});
				indicator.innerHTML = "+";
				question.style.fontWeight = "normal";
				question.classList.remove("_active");
			} else {
				answer.style.height = "auto";
				const fullHeight = answer.scrollHeight + 48; // Add padding top and bottom
				gsap.to(answer, {
					height: fullHeight,
					opacity: 1,
					paddingTop: "1.5rem",
					paddingBottom: "1.5rem",
					duration: 0.5,
					onComplete: () => {
						answer.style.height = "auto";
					},
				});
				indicator.innerHTML = "-";
				question.style.fontWeight = "600";

				question.classList.add("_active");
			}
		});
	});

	// Open the first FAQ by default
	if (faqs.length > 0) {
		const firstFaq = faqs[0];
		const firstQuestion = firstFaq.querySelector(".cw-faqs__question");
		const firstAnswer = firstFaq.querySelector(".cw-faqs__answer");
		const firstIndicator = firstFaq.querySelector(".cw-faq-indicator");

		firstAnswer.style.height = "auto";
		const fullHeight = firstAnswer.scrollHeight + 48; // Add padding top and bottom
		gsap.to(firstAnswer, {
			height: fullHeight,
			opacity: 1,
			paddingTop: "1.5rem",
			paddingBottom: "1.5rem",
			duration: 0.5,
			onComplete: () => {
				firstAnswer.style.height = "auto";
			},
		});
		firstIndicator.innerHTML = "-";
		firstQuestion.style.fontWeight = "600";

		firstQuestion.classList.add("_active");
	}
});
