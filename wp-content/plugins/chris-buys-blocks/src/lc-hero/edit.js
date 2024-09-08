import { __ } from "@wordpress/i18n";
import { useBlockProps, InnerBlocks } from "@wordpress/block-editor";
import "./editor.css";

const ALLOWED_BLOCKS = ["gravityforms/form"];

export default function Edit() {
	return (
		<div {...useBlockProps()}>
			<h3>{__("Life Changes Hero", "chris-buys")}</h3>
			<InnerBlocks allowedBlocks={ALLOWED_BLOCKS} />
		</div>
	);
}
