import { __ } from "@wordpress/i18n";
import {
	InnerBlocks,
	useBlockProps,
	InspectorControls,
} from "@wordpress/block-editor";
import { PanelBody, SelectControl, TextControl } from "@wordpress/components";
import "./editor.css";

const ALLOWED_BLOCKS = ["gravityforms/form"];

export default function Edit({ attributes, setAttributes }) {
	const { selectedMarket, phoneNumber } = attributes;

	// Function to handle the change of selected market
	const onChangeSelectedMarket = (newMarket) => {
		setAttributes({ selectedMarket: newMarket });
	};

	// Function to handle the change of phone number
	const onChangePhoneNumber = (newPhoneNumber) => {
		setAttributes({ phoneNumber: newPhoneNumber });
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
							{ label: "San Francisco", value: "sf" },
							{ label: "St. Louis", value: "stl" },
							{ label: "Kansas City", value: "kc" },
							{ label: "Detroit", value: "det" },
							{ label: "Cleveland", value: "cle" },
							{ label: "Indianapolis", value: "ind" },
						]}
						onChange={onChangeSelectedMarket}
					/>
				</PanelBody>
				<PanelBody
					title={__("Contact Settings", "carrot-blocks")}
					initialOpen={true}
				>
					<TextControl
						label={__("Phone Number", "carrot-blocks")}
						value={phoneNumber}
						onChange={onChangePhoneNumber}
						placeholder={__("Enter Phone Number", "carrot-blocks")}
					/>
				</PanelBody>
			</InspectorControls>
			<h3>{__("Carrot Hero", "carrot-blocks")}</h3>
			<InnerBlocks allowedBlocks={ALLOWED_BLOCKS} />
		</div>
	);
}
