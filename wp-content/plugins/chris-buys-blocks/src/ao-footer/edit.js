import { __ } from "@wordpress/i18n";
import {
	useBlockProps,
	MediaUpload,
	InspectorControls,
} from "@wordpress/block-editor";
import { Button, PanelBody, SelectControl } from "@wordpress/components";
import "./editor.css";
import defaultLogo from "./assets/stl-footer-logo.svg";

export default function Edit({ attributes, setAttributes }) {
	const { logoUrl, selectedName } = attributes;

	const onSelectLogo = (media) => {
		setAttributes({ logoUrl: media.url });
	};

	const onChangeName = (newName) => {
		setAttributes({ selectedName: newName });
	};

	// Determine the brand name based on the selected name
	const brandName =
		selectedName === "John" ? "John Buys Bay Area Houses" : "Chris Buys Homes";

	return (
		<div {...useBlockProps()}>
			<InspectorControls>
				<PanelBody
					title={__("Header Settings", "chris-buys-blocks")}
					initialOpen={true}
				>
					<div className="header-block-settings">
						<strong>{__("Logo Image", "chris-buys-blocks")}</strong>
						<MediaUpload
							onSelect={onSelectLogo}
							allowedTypes={["image"]}
							value={logoUrl || defaultLogo}
							render={({ open }) => (
								<Button onClick={open} isPrimary>
									{__("Choose Logo", "chris-buys-blocks")}
								</Button>
							)}
						/>
					</div>
					<div className="header-block-settings">
						<SelectControl
							label={__("Choose a Name", "chris-buys-blocks")}
							value={selectedName}
							options={[
								{ label: "Chris", value: "Chris" },
								{ label: "John", value: "John" },
							]}
							onChange={onChangeName}
						/>
					</div>
				</PanelBody>
			</InspectorControls>
			<div className="cw-footer">
				<div className="cw-footer__logo">
					<img
						src={logoUrl || defaultLogo}
						alt={__("Logo", "chris-buys-blocks")}
					/>
				</div>
				<div className="cw-footer__brand-name">
					<h3>{brandName} Footer</h3>
				</div>
			</div>
		</div>
	);
}
