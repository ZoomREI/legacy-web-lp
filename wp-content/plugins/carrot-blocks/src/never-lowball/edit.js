import { __ } from "@wordpress/i18n";
import { useBlockProps, InspectorControls } from "@wordpress/block-editor";
import { PanelBody, SelectControl, TextControl } from "@wordpress/components";
import "./editor.css";

export default function Edit({ attributes, setAttributes }) {
	const { selectedMarket, brandName, brandArea } = attributes;

	const onChangeSelectedMarket = (newMarket) => {
		setAttributes({ selectedMarket: newMarket });
	};

	const onChangeBrandName = (newBrandName) => {
		setAttributes({ brandName: newBrandName });
	};

	const onChangeBrandArea = (newBrandArea) => {
		setAttributes({ brandArea: newBrandArea });
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
							{ label: "San Francisco", value: "San Francisco Bay Area" },
							{ label: "St. Louis", value: "St. Louis" },
							{ label: "Kansas City", value: "Kansas City" },
							{ label: "Detroit", value: "Metro Detroit" },
							{ label: "Cleveland", value: "Cleveland" },
							{ label: "Indianapolis", value: "Indianapolis" },
						]}
						onChange={onChangeSelectedMarket}
					/>
				</PanelBody>
				<PanelBody
					title={__("Brand Details", "carrot-blocks")}
					initialOpen={true}
				>
					<TextControl
						label={__("Brand Name", "carrot-blocks")}
						value={brandName}
						onChange={onChangeBrandName}
						placeholder={__("Enter Brand Name", "carrot-blocks")}
					/>
					<TextControl
						label={__("Brand Area", "carrot-blocks")}
						value={brandArea}
						onChange={onChangeBrandArea}
						placeholder={__("Enter Brand Area", "carrot-blocks")}
					/>
				</PanelBody>
			</InspectorControls>
			<h3>{__("Carrot Never Lowball", "carrot-blocks")}</h3>
		</div>
	);
}
