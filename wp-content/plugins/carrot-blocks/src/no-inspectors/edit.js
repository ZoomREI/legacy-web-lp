import { __ } from "@wordpress/i18n";
import { useBlockProps, InspectorControls } from "@wordpress/block-editor";
import { PanelBody, SelectControl } from "@wordpress/components";
import "./editor.css";

export default function Edit({ attributes, setAttributes }) {
	const { selectedMarket } = attributes;

	const onChangeSelectedMarket = (newMarket) => {
		setAttributes({ selectedMarket: newMarket });
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
							{ label: "Kansas City", value: "Chris Buys Homes in Kansas City" },
							{ label: "San Francisco", value: "John Buys Bay Area Houses" },
							{ label: "St. Louis", value: "Chris Buys Homes in St. Louis" },
							{ label: "Detroit", value: "Chris Buys Homes in Detroit" },
							{ label: "Cleveland", value: "Chris Buys Homes in Cleveland" },
							{ label: "Indianapolis", value: "Chris Buys Homes in Indianapolis" },
						]}
						onChange={onChangeSelectedMarket}
					/>
				</PanelBody>
			</InspectorControls>
			<h3>{__("Carrot No Inspectors", "carrot-blocks")}</h3>
		</div>
	);
}
