import { __ } from "@wordpress/i18n";
import { useBlockProps, InspectorControls } from "@wordpress/block-editor";
import { PanelBody, SelectControl, TextControl } from "@wordpress/components"; // Import TextControl
import "./editor.css";

export default function Edit({ attributes, setAttributes }) {
	const { formId, selectedName } = attributes; // Combined destructuring

	const onChangeFormId = (newFormId) => {
		setAttributes({ formId: newFormId });
	};

	const onChangeName = (newName) => {
		setAttributes({ selectedName: newName });
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
				<PanelBody title={__("Select Name", "chris-buys-blocks")}>
					<SelectControl
						label={__("Choose a Name", "chris-buys-blocks")}
						value={selectedName}
						options={[
							{ label: "Chris", value: "Chris" },
							{ label: "John", value: "John" },
						]}
						onChange={onChangeName}
					/>
				</PanelBody>
			</InspectorControls>

			<h3>{__("cw Hero Placeholder", "chris-buys-blocks")}</h3>
		</div>
	);
}
