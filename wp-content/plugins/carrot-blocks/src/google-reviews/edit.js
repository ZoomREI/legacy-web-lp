import { __ } from "@wordpress/i18n";
import { useBlockProps, InspectorControls } from "@wordpress/block-editor";
import { PanelBody, SelectControl } from "@wordpress/components";
import "./editor.css";

export default function Edit({ attributes, setAttributes }) {
	const { selectedMarket, reviewText, reviewerName } = attributes;

	const reviews = {
		"San Francisco Bay Area, CA": {
			reviewText:
				"John and his team are outstanding. John is a very fair business man and I was happy with the ease of the process. I would definitely recommend John to my friends or their friends!",
			reviewerName: "Steven F. Hayward, CA",
		},
		"St. Louis, MO": {
			reviewText:
				"Chris Buys Homes Real Estate experience was amazing and they are number 1 on google for a reason. When I typed in investment companies in St. Louis Chris buys homes popped up. When I called the number Chris answered and I met with someone the next day. I was able to Negotiate a deal to my liking and we closed in three weeks. This is a company of great integrity and I would recommend them to everyone.",
			reviewerName: "Daniel R. [Hazelwood, MO]",
		},
		"Kansas City": {
			reviewText:
				"My family had a property in Kansas City that needed major repairs, and we needed a cash buyer.Chris was able to give us the best cash offer for the property. It was a great decision to work with this company. Everything worked out the way he told us. I would highly recommend this company.",
			reviewerName: "Timothy J. Kansas City, MO",
		},
		"Metro Detroit, MI": {
			reviewText:
				"Chris buys homes Real Estate experience was amazing and they are number 1 on google for a reason. When I typed in investment companies in Detroit, Chris buys homes popped up. When I called the number Chris answered and I met with someone the next day. I was able to Negotiate a deal to my liking and we closed in three weeks. This is a company of great integrity and I would recommend them to everyone.”Chris Buys Homes Real Estate experience was amazing and they are number 1 on google for a reason. When I typed in investment companies in St. Louis Chris buys homes popped up. When I called the number Chris answered and I met with someone the next day. I was able to Negotiate a deal to my liking and we closed in three weeks. This is a company of great integrity and I would recommend them to everyone.",
			reviewerName: "Jaime R. Detroit, MI",
		},
		"Cleveland, OH": {
			reviewText:
				"Chris Buys Homes Real Estate experience was amazing and they are number 1 on google for a reason. When I typed in investment companies in Cleveland Chris buys homes popped up. When I called the number Chris answered and I met with someone the next day. I was able to Negotiate a deal to my liking and we closed in three weeks. This is a company of great integrity and I would recommend them to everyone.",
			reviewerName: "Daniel R. Cleveland, OH",
		},
		"Indianapolis, IN": {
			reviewText:
				"Chris buys home Real Estate experience was amazing and they are number 1 on google for a reason. When I typed in investment companies in Indianapolis Chris buys homes popped up. When I called the number Chris answered and I met with someone the next day. I was able to Negotiate a deal to my liking and we closed in three weeks. This is a company of great integrity and I would recommend them to everyone.",
			reviewerName: "Roger K. Indianapolis, IN",
		},
	};

	const onChangeSelectedMarket = (newMarket) => {
		const { reviewText, reviewerName } = reviews[newMarket] || {
			reviewText:
				"“Chris Buys Homes Real Estate experience was amazing and they are number 1 on google for a reason. When I typed in investment companies in St. Louis Chris buys homes popped up. When I called the number Chris answered and I met with someone the next day. I was able to Negotiate a deal to my liking and we closed in three weeks. This is a company of great integrity and I would recommend them to everyone.”",
			reviewerName: "Daniel R. [Hazelwood, MO]",
		};

		// Set the selected market and corresponding review content
		setAttributes({
			selectedMarket: newMarket,
			reviewText: reviewText,
			reviewerName: reviewerName,
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
							{ label: "San Francisco", value: "San Francisco Bay Area, CA" },
							{ label: "St. Louis", value: "St. Louis, MO" },
							{ label: "Kansas City", value: "Kansas City" },
							{ label: "Detroit", value: "Metro Detroit, MI" },
							{ label: "Cleveland", value: "Cleveland, OH" },
							{ label: "Indianapolis", value: "Indianapolis, IN" },
						]}
						onChange={onChangeSelectedMarket}
					/>
				</PanelBody>
			</InspectorControls>
			<h3>{__("Carrot Google Reviews", "carrot-blocks")}</h3>
		</div>
	);
}
