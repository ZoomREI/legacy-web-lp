import { __ } from "@wordpress/i18n";
import { InnerBlocks, useBlockProps } from "@wordpress/block-editor";
import "./editor.css";

const ALLOWED_BLOCKS = ["gravityforms/form"];

export default function Edit() {
	return (
		<div {...useBlockProps()}>
			<h3>{__("Carrot Fast Cash Offer", "carrot-blocks")}</h3>
			<InnerBlocks allowedBlocks={ALLOWED_BLOCKS} />
		</div>
	);
}
