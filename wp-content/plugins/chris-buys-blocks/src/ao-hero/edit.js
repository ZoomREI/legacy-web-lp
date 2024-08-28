import { __ } from "@wordpress/i18n";
import { useBlockProps, InspectorControls } from "@wordpress/block-editor";
import { PanelBody, TextControl } from "@wordpress/components";
import "./editor.css";

export default function Edit({ attributes, setAttributes }) {
	const { formId } = attributes;

	const onChangeFormId = (newFormId) => {
		setAttributes({ formId: newFormId });
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
			</InspectorControls>
			<h3>{__("Absentee Owners Hero", "chris-buys")}</h3>
		</div>
	);
}
