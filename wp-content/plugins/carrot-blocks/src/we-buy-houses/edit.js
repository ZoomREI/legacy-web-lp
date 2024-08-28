import { __ } from "@wordpress/i18n";
import {
	useBlockProps,
	InspectorControls,
} from "@wordpress/block-editor";
import {
	PanelBody,
	SelectControl,
} from "@wordpress/components";
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
							{ label: "San Francisco", value: "San Francisco Bay Area, CA" },
							{ label: "St. Louis", value: "St. Louis, MO" },
							{ label: "Kansas City", value: "Kansas City" },
							{ label: "Detroit", value: "Metro Detroit, MI" },
							{ label: "Cleveland", value: "Cleveland, OH" },
							{ label: "Indianapolis", value: "Indianapolis, IN" },
						]}
						onChange={onChangeSelectedMarket}
					/>
				</PanelBody>
			</InspectorControls>
			<h3>{__("Carrot We Buy Houses", "carrot-blocks")}</h3>
		</div>
	);
}
