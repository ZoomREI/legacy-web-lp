import { __ } from "@wordpress/i18n";
import { useBlockProps, InspectorControls, InnerBlocks } from "@wordpress/block-editor";
import { PanelBody, SelectControl, TextControl } from "@wordpress/components";
import "./editor.css";

const ALLOWED_BLOCKS = ["gravityforms/form"];

export default function Edit({ attributes, setAttributes }) {
	const { selectedName, phoneNumber } = attributes;

	const onChangeName = (newName) => {
		setAttributes({ selectedName: newName });
	};
	const onChangePhoneNumber = (value) => {
		setAttributes({ phoneNumber: value });
	};

	return (
		<div {...useBlockProps()}>
			<InspectorControls>
				<PanelBody title={__("Name and phone number", "custom-blocks")}>
					<SelectControl
						label={__("Choose a Name", "custom-blocks")}
						value={selectedName}
						options={[
							{ label: "Chris", value: "Chris" },
							{ label: "John", value: "John" },
						]}
						onChange={onChangeName}
					/>
					<TextControl
						label={__("Phone Number", "chris-buys-blocks")}
						value={phoneNumber}
						onChange={onChangePhoneNumber}
						placeholder={__("Enter phone number", "chris-buys-blocks")}
					/>
				</PanelBody>
			</InspectorControls>

			<h3>{__("Step 2 Form Small", "chris-buys")}</h3>
			<InnerBlocks allowedBlocks={ALLOWED_BLOCKS} />
		</div>
	);
}
