import { __ } from "@wordpress/i18n";
import { useBlockProps, InspectorControls } from "@wordpress/block-editor";
import {
	PanelBody,
	SelectControl,
	TextareaControl,
} from "@wordpress/components";
import "./editor.css";

export default function Edit({ attributes, setAttributes }) {
	const { selectedMarket, content } = attributes;

	const onChangeSelectedMarket = (newMarket) => {
		setAttributes({ selectedMarket: newMarket });
	};

	const onChangeContent = (newContent) => {
		setAttributes({ content: newContent });
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
							{ label: "Kansas City", value: "Kansas City" },
							{ label: "San Francisco", value: "San Francisco Bay Area" },
							{ label: "St. Louis", value: "St. Louis" },
							{ label: "Detroit", value: "Metro Detroit" },
							{ label: "Cleveland", value: "Cleveland" },
							{ label: "Indianapolis", value: "Indianapolis" },
						]}
						onChange={onChangeSelectedMarket}
					/>
				</PanelBody>
				<PanelBody
					title={__("Section Content", "carrot-blocks")}
					initialOpen={true}
				>
					<TextareaControl
						label={__("Content", "carrot-blocks")}
						value={content}
						onChange={onChangeContent}
						placeholder={__("Enter the content for this section...")}
					/>
				</PanelBody>
			</InspectorControls>
			<h3>{__("Carrot New And Easy", "carrot-blocks")}</h3>
		</div>
	);
}
