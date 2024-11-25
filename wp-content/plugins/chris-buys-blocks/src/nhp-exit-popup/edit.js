import { __ } from "@wordpress/i18n";
import { useBlockProps, InnerBlocks } from "@wordpress/block-editor";
import "./editor.css";


export default function Edit() {
	return (
		<div {...useBlockProps()}>
			<h3>{__("Exit Intent Popup", "chris-buys")}</h3>
			<InnerBlocks />
		</div>
	);
}
