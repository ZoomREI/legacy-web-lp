import { __ } from "@wordpress/i18n";
import { useBlockProps, InspectorControls } from "@wordpress/block-editor";
import { PanelBody, SelectControl, TextControl } from "@wordpress/components";
import "./editor.css";

export default function Edit({ attributes, setAttributes }) {
	const { formId, selectedMarket } = attributes;

	const onChangeFormId = (newFormId) => {
		setAttributes({ formId: newFormId });
	};

	const onChangeMarket = (newMarket) => {
		setAttributes({ selectedMarket: newMarket });
	};

	return (
		<div {...useBlockProps()}>
			<InspectorControls>
				<PanelBody
					title={__("Form Settings", "chris-buys-blocks")}
					initialOpen={true}
				>
					<TextControl
						label={__("Form ID", "chris-buys-blocks")}
						value={formId}
						onChange={onChangeFormId}
						placeholder={__("Enter Form ID", "chris-buys-blocks")}
					/>
				</PanelBody>
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

			<h3>{__("cw Hero Placeholder", "chris-buys-blocks")}</h3>
		</div>
	);
}
