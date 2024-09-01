import { __ } from "@wordpress/i18n";
import { useBlockProps, InspectorControls } from "@wordpress/block-editor";
import { PanelBody, SelectControl } from "@wordpress/components";
import "./editor.css";

export default function Edit({ attributes, setAttributes }) {
	const { selectedMarket } = attributes;

	const onChangeMarket = (newMarket) => {
		setAttributes({ selectedMarket: newMarket });
	};

	return (
		<div {...useBlockProps()}>
			<InspectorControls>
				<PanelBody title={__("Select Market", "custom-blocks")}>
					<SelectControl
						label={__("Choose a Market", "custom-blocks")}
						value={selectedMarket}
						options={[
							{ label: "Kansas City", value: "Kansas City" },
							{ label: "San Francisco", value: "The Bay Area" },
							{ label: "St. Louis", value: "St. Louis" },
							{ label: "Metro Detroit", value: "Detroit" },
							{ label: "Cleveland", value: "Cleveland" },
							{ label: "Indianapolis", value: "Indianapolis" },
						]}
						onChange={onChangeMarket}
					/>
				</PanelBody>
			</InspectorControls>

			<h3>{__("AO Meet Chris", "chris-buys")}</h3>
		</div>
	);
}
