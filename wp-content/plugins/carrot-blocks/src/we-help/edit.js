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
							{ label: "Kansas City", value: "kc" },
							{ label: "San Francisco", value: "sf" },
							{ label: "St. Louis", value: "stl" },
							{ label: "Detroit", value: "det" },
							{ label: "Cleveland", value: "cle" },
							{ label: "Indianapolis", value: "ind" },
						]}
						onChange={onChangeSelectedMarket}
					/>
				</PanelBody>
			</InspectorControls>
			<h3>{__("Carrot We Help", "carrot-blocks")}</h3>
		</div>
	);
}
