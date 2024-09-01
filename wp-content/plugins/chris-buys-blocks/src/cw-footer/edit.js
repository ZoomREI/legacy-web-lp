import { __ } from "@wordpress/i18n";
import { useBlockProps, InspectorControls } from "@wordpress/block-editor";
import { PanelBody, SelectControl } from "@wordpress/components";
import "./editor.css";

// Static base path for logos relative to the plugin directory
const logosBasePath =
	"/wp-content/plugins/chris-buys-blocks/src/cw-footer/assets/";

export default function Edit({ attributes, setAttributes }) {
	const { selectedMarket } = attributes;

	const onChangeMarket = (newMarket) => {
		setAttributes({ selectedMarket: newMarket });
	};

	// Determine the logo URL and name based on the selected market
	const logoMap = {
		"Kansas City": `${logosBasePath}kc-footer-logo.svg`,
		"San Francisco Bay Area": `${logosBasePath}sf-footer-logo.svg`,
		"St. Louis": `${logosBasePath}stl-footer-logo.svg`,
		"Metro Detroit": `${logosBasePath}det-footer-logo.svg`,
		Cleveland: `${logosBasePath}cle-footer-logo.svg`,
		Indianapolis: `${logosBasePath}ind-footer-logo.svg`,
	};

	const logoUrl = logoMap[selectedMarket] || `${logosBasePath}stl-logo.svg`;

	// Automatically set the brand name based on the selected market
	const brandName =
		selectedMarket === "San Francisco Bay Area"
			? "John Buys Bay Area Houses"
			: "Chris Buys Homes";

	return (
		<div {...useBlockProps()}>
			<InspectorControls>
				<PanelBody
					title={__("Footer Settings", "chris-buys-blocks")}
					initialOpen={true}
				>
					<div className="footer-block-settings">
						<SelectControl
							label={__("Choose a Market", "chris-buys-blocks")}
							value={selectedMarket}
							options={[
								{ label: "Kansas City", value: "Kansas City" },
								{ label: "San Francisco", value: "San Francisco Bay Area" },
								{ label: "St. Louis", value: "St. Louis" },
								{ label: "Detroit", value: "Metro Detroit" },
								{ label: "Cleveland", value: "Cleveland" },
								{ label: "Indianapolis", value: "Indianapolis" },
							]}
							onChange={onChangeMarket}
						/>
					</div>
				</PanelBody>
			</InspectorControls>
			<div className="cw-footer-edit">
				<div className="cw-footer__logo">
					<img src={logoUrl} alt={__("Logo", "chris-buys-blocks")} />
				</div>
				<div className="cw-footer__brand-name">
					<h3>{brandName} Footer</h3>
				</div>
			</div>
		</div>
	);
}
