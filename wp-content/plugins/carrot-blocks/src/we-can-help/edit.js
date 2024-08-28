import { __ } from "@wordpress/i18n";
import { useBlockProps, InspectorControls } from "@wordpress/block-editor";
import { PanelBody, SelectControl } from "@wordpress/components";
import "./editor.css";

export default function Edit({ attributes, setAttributes }) {
	const { selectedMarket, firstMarketMention, secondMarketMention } =
		attributes;

	// Updated mapping of markets to their respective text mentions
	const marketMentions = {
		"Kansas City": {
			firstMarketMention: "Kansas City",
			secondMarketMention: "Kansas City",
		},
		"San Francisco Bay Area": {
			firstMarketMention: "the San Francisco bay area",
			secondMarketMention: "SF bay area, CA",
		},
		"St. Louis": {
			firstMarketMention: "Saint Louis",
			secondMarketMention: "St. Louis",
		},
		"Metro Detroit": {
			firstMarketMention: "Detroit",
			secondMarketMention: "Metro Detroit",
		},
		Cleveland: {
			firstMarketMention: "Cleveland",
			secondMarketMention: "Cleveland",
		},
		Indianapolis: {
			firstMarketMention: "Indianapolis",
			secondMarketMention: "Indianapolis",
		},
	};

	const onChangeSelectedMarket = (newMarket) => {
		const mentions = marketMentions[newMarket] || {
			firstMarketMention: "Your Area",
			secondMarketMention: "Your Area",
		};

		setAttributes({
			selectedMarket: newMarket,
			firstMarketMention: mentions.firstMarketMention,
			secondMarketMention: mentions.secondMarketMention,
		});
	};

	return (
		<div {...useBlockProps()}>
			<InspectorControls>
				<PanelBody
					title={__("Market Selection", "carrot-blocks")}
					initialOpen={true}
				>
					<SelectControl
						label={__("Select Market", "carrot-blocks")}
						value={selectedMarket}
						options={[
							{ label: "Kansas City", value: "Kansas City" },
							{ label: "San Francisco", value: "San Francisco Bay Area" },
							{ label: "St. Louis", value: "St. Louis" },
							{ label: "Detroit", value: "Metro Detroit" },
							{ label: "Cleveland", value: "Cleveland" },
							{ label: "Indianapolis", value: "Indianapolis" },
						]}
						onChange={onChangeSelectedMarket}
					/>
				</PanelBody>
			</InspectorControls>
			<h3>{__("Carrot We Can Help", "carrot-blocks")}</h3>
		</div>
	);
}
