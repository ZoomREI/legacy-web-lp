import { __ } from "@wordpress/i18n";
import {
	InnerBlocks,
	useBlockProps,
	InspectorControls,
} from "@wordpress/block-editor";
import {
	PanelBody,
	SelectControl,
} from "@wordpress/components";
import "./editor.css";

// The edit function, which renders the block in the Gutenberg editor
export default function Edit({ attributes, setAttributes }) {
	const { selectedMarket } = attributes;

	const onChangeMarket = (newMarket) => {
		setAttributes({ selectedMarket: newMarket });
	};

	return (
		<div {...useBlockProps()}>
			<InspectorControls>
				<PanelBody title={__("Select Market", "chris-buys-blocks")}>
					<SelectControl
						label={__("Choose a Market", "chris-buys-blocks")}
						value={selectedMarket}
						options={[
							{ label: "St. Louis", value: "St. Louis, Missouri" },
							{ label: "San Francisco", value: "the Bay Area" },
							{ label: "Kansas City", value: "Kansas City" },
							{ label: "Detroit", value: "Metro Detroit" },
							{ label: "Cleveland", value: "Cleveland" },
							{ label: "Indianapolis", value: "Indianapolis" },
						]}
						onChange={onChangeMarket}
					/>
				</PanelBody>
			</InspectorControls>

			{/* Block Content */}
			<div>
				<h3>{__("CW Hero Placeholder", "chris-buys-blocks")}</h3>
				<InnerBlocks />
			</div>
		</div>
	);
}
