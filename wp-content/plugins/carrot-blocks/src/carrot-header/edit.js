import { __ } from "@wordpress/i18n";
import { useBlockProps, InspectorControls } from "@wordpress/block-editor";
import { PanelBody, SelectControl, TextControl } from "@wordpress/components";
import "./editor.css";

export default function Edit({ attributes, setAttributes }) {
	const { selectedMarket, phoneNumber } = attributes;

	const onChangeSelectedMarket = (newMarket) => {
		setAttributes({ selectedMarket: newMarket });
	};

	const onChangePhoneNumber = (newPhoneNumber) => {
		setAttributes({ phoneNumber: newPhoneNumber });
	};

	return (
		<div {...useBlockProps()}>
			<InspectorControls>
				<PanelBody
					title={__("Header Settings", "carrot-blocks")}
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
					<TextControl
						label={__("Phone Number", "carrot-blocks")}
						value={phoneNumber}
						onChange={onChangePhoneNumber}
						placeholder={__("Enter phone number", "carrot-blocks")}
					/>
				</PanelBody>
			</InspectorControls>
			<div className="c-header">
				<h3>{__("Carrot Header", "carrot-blocks")}</h3>
			</div>
		</div>
	);
}
