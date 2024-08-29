import { __ } from "@wordpress/i18n";
import { useBlockProps, InspectorControls } from "@wordpress/block-editor";
import { PanelBody, SelectControl } from "@wordpress/components";
import "./editor.css";

export default function Edit() {
	return (
		<div {...useBlockProps()}>
			<h3>{__("cw Guarantee Placeholder", "chris-buys")}</h3>
		</div>
	);
}