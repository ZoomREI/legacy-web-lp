import { __ } from "@wordpress/i18n";
import { useBlockProps, InspectorControls } from "@wordpress/block-editor";
import { PanelBody, SelectControl } from "@wordpress/components";
import "./editor.css";

export default function Edit({ attributes, setAttributes }) {
	const { selectedName } = attributes;

	const onChangeName = (newName) => {
		setAttributes({ selectedName: newName });
	};

	return (
		<div {...useBlockProps()}>
			<InspectorControls>
				<PanelBody title={__("Select Name", "custom-blocks")}>
					<SelectControl
						label={__("Choose a Name", "custom-blocks")}
						value={selectedName}
						options={[
							{ label: "Chris", value: "Chris" },
							{ label: "John", value: "John" },
						]}
						onChange={onChangeName}
					/>
				</PanelBody>
			</InspectorControls>

			<h3>{__("cw Faqs Placeholder", "chris-buys")}</h3>
		</div>
	);
}
