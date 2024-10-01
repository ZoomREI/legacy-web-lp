import { __ } from "@wordpress/i18n";
import { useBlockProps } from "@wordpress/block-editor";
import "./editor.css";

export default function Edit() {
	return (
		<div {...useBlockProps()}>
			<h3>{__("S2 As Seen On Carousel Placeholder", "chris-buys")}</h3>
		</div>
	);
}
