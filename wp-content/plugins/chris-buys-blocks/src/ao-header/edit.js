import { __ } from "@wordpress/i18n";
import {
	useBlockProps,
	MediaUpload,
	RichText,
	InspectorControls,
	PlainText,
} from "@wordpress/block-editor";
import { Button, PanelBody, TextControl } from "@wordpress/components";
import "./editor.css";
import defaultLogo from "./assets/stl-logo.svg";

export default function Edit({ attributes, setAttributes }) {
	const { logoUrl, phoneNumber } = attributes;

	const onSelectLogo = (media) => {
		setAttributes({ logoUrl: media.url });
	};

	const onChangePhoneNumber = (value) => {
		setAttributes({ phoneNumber: value });
	};

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
						<TextControl
							label={__("Phone Number", "chris-buys-blocks")}
							value={phoneNumber}
							onChange={onChangePhoneNumber}
							placeholder={__("Enter phone number", "chris-buys-blocks")}
						/>
					</div>
				</PanelBody>
			</InspectorControls>
			<div className="ao-header">
				<h3>{__("Absentee Owners Header", "chris-buys-blocks")}</h3>
				<div className="ao-header__logo">
					<img
						src={logoUrl || defaultLogo}
						alt={__("Logo", "chris-buys-blocks")}
					/>
				</div>
				<div className="ao-header__phone-number">
					<RichText
						tagName="a"
						href={`tel:${phoneNumber}`}
						value={phoneNumber}
						onChange={onChangePhoneNumber}
						placeholder={__("Enter phone number", "chris-buys-blocks")}
					/>
				</div>
			</div>
		</div>
	);
}
