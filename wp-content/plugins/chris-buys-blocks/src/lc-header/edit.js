import { __ } from "@wordpress/i18n";
import {
	useBlockProps,
	InspectorControls,
	RichText,
} from "@wordpress/block-editor";
import { PanelBody, SelectControl, TextControl } from "@wordpress/components";
import "./editor.css";

// Static base path for logos relative to the plugin directory
const logosBasePath =
	"/wp-content/plugins/chris-buys-blocks/src/lc-header/assets/";

export default function Edit({ attributes, setAttributes }) {
	const { selectedMarket, phoneNumber } = attributes;

	const onChangeSelectedMarket = (value) => {
		setAttributes({ selectedMarket: value });
	};

	const onChangePhoneNumber = (value) => {
		setAttributes({ phoneNumber: value });
	};

	const logoMap = {
		"Kansas City": `${logosBasePath}kc-logo.svg`,
		"San Francisco Bay Area": `${logosBasePath}sf-logo.svg`,
		"St. Louis": `${logosBasePath}stl-logo.svg`,
		"Metro Detroit": `${logosBasePath}det-logo.svg`,
		Cleveland: `${logosBasePath}cle-logo.svg`,
		Indianapolis: `${logosBasePath}ind-logo.svg`,
	};

	const logoUrl = logoMap[selectedMarket] || `${logosBasePath}stl-logo.svg`;

	return (
		<div {...useBlockProps()}>
			<InspectorControls>
				<PanelBody
					title={__("Header Settings", "chris-buys-blocks")}
					initialOpen={true}
				>
					<SelectControl
						label={__("Select Market", "chris-buys-blocks")}
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
						label={__("Phone Number", "chris-buys-blocks")}
						value={phoneNumber}
						onChange={onChangePhoneNumber}
						placeholder={__("Enter phone number", "chris-buys-blocks")}
					/>
				</PanelBody>
			</InspectorControls>
			<div className="cw-header">
				<h3>{__("Life Changes Header", "chris-buys-blocks")}</h3>
				<div className="cw-header__logo">
					<img src={logoUrl} alt={__("Logo", "chris-buys-blocks")} />
				</div>
				<div className="cw-header__phone-number">
					<RichText
						tagName="a"
						href={`tel:${phoneNumber}`}
						value={phoneNumber}
						onChange={onChangePhoneNumber}
						placeholder={__("Enter phone number", "chris-buys-blocks")}
					/>
				</div>
			</div>
		</div>
	);
}
