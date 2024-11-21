import { __ } from "@wordpress/i18n";
import {
	useBlockProps,
	InspectorControls,
} from "@wordpress/block-editor";
import {
	PanelBody,
	TextControl,
	ToggleControl,
	SelectControl,
	Button,
	TextareaControl,
} from "@wordpress/components";
import { useState } from "@wordpress/element";

export default function Edit({ attributes, setAttributes }) {
	const { redirectUrl, webhooks, redirectQuery, btnText } = attributes;

	const onChangeBtnText = (value) => {
		setAttributes({ btnText: value });
	};

	// Update Redirect URL
	const onChangeRedirectUrl = (value) => {
		setAttributes({ redirectUrl: value });
	};

	// Manage Webhooks
	const updateWebhook = (index, key, value) => {
		const updatedWebhooks = [...webhooks];
		updatedWebhooks[index] = { ...updatedWebhooks[index], [key]: value };
		setAttributes({ webhooks: updatedWebhooks });
	};

	const addWebhook = () => {
		setAttributes({
			webhooks: [...webhooks, { url: "", usePreset: true, fieldsPreset: "", fieldsMapping: [] }],
		});
	};

	const removeWebhook = (index) => {
		const updatedWebhooks = [...webhooks];
		updatedWebhooks.splice(index, 1);
		setAttributes({ webhooks: updatedWebhooks });
	};

	// Manage Fields Mapping
	const updateFieldMapping = (webhookIndex, mappingIndex, key, value) => {
		const updatedWebhooks = [...webhooks];
		const mapping = updatedWebhooks[webhookIndex].fieldsMapping || [];
		mapping[mappingIndex] = { ...mapping[mappingIndex], [key]: value };
		updatedWebhooks[webhookIndex].fieldsMapping = mapping;
		setAttributes({ webhooks: updatedWebhooks });
	};

	const addFieldMapping = (webhookIndex) => {
		const updatedWebhooks = [...webhooks];
		updatedWebhooks[webhookIndex].fieldsMapping = [
			...(updatedWebhooks[webhookIndex].fieldsMapping || []),
			{ key: "", field: "" },
		];
		setAttributes({ webhooks: updatedWebhooks });
	};

	const removeFieldMapping = (webhookIndex, mappingIndex) => {
		const updatedWebhooks = [...webhooks];
		const mapping = updatedWebhooks[webhookIndex].fieldsMapping || [];
		mapping.splice(mappingIndex, 1);
		updatedWebhooks[webhookIndex].fieldsMapping = mapping;
		setAttributes({ webhooks: updatedWebhooks });
	};

	// Manage Redirect Query
	const updateRedirectQuery = (index, key, value) => {
		const updatedRedirectQuery = [...redirectQuery];
		updatedRedirectQuery[index] = { ...updatedRedirectQuery[index], [key]: value };
		setAttributes({ redirectQuery: updatedRedirectQuery });
	};

	const addRedirectQuery = () => {
		setAttributes({
			redirectQuery: [...redirectQuery, { key: "", field: "" }],
		});
	};

	const removeRedirectQuery = (index) => {
		const updatedRedirectQuery = [...redirectQuery];
		updatedRedirectQuery.splice(index, 1);
		setAttributes({ redirectQuery: updatedRedirectQuery });
	};

	const fieldOptions = [
		{ label: "Select", value: "" },
		{ label: "Full Name", value: "fullName" },
		{ label: "Phone", value: "phone" },
		{ label: "Email", value: "email" },
		{ label: "Full Address", value: "propertyAddress" },
		{ label: "Street Address", value: "street" },
		{ label: "City", value: "city" },
		{ label: "State", value: "state" },
		{ label: "Zipcode", value: "zipcode" },
		{ label: "Country", value: "country" },
		{ label: "UTM Source", value: "utm_source" },
		{ label: "UTM Term", value: "utm_term" },
		{ label: "UTM Campaign", value: "utm_campaign" },
		{ label: "UTM Medium", value: "utm_medium" },
		{ label: "UTM Content", value: "utm_content" },
		{ label: "Device", value: "device" },
		{ label: "GCLID", value: "gclid" },
		{ label: "FBCLID", value: "fbclid" },
		{ label: "MSCLKID", value: "msclkid" },
		{ label: "Page URL", value: "page_url" },
		{ label: "Lead Source", value: "lead_source" },
		{ label: "Timestamp", value: "timestamp" },
		{ label: "Client ID", value: "client_id" },
		{ label: "Session ID", value: "session_id" },
		{ label: "Form Name", value: "form_name" },
	];
	const presets = [
		{ label: "Select", value: "" },
		{ label: "CMS", value: "cms" },
		{ label: "sGTM", value: "sgtm" },
	];

	return (
		<div {...useBlockProps()} style={{width: '35vw'}}>

			<div style={{marginBottom: "30px"}}>
				<h3>{__("Lead Form V2", "chris-buys-blocks")}</h3>
			</div>
			<TextControl
				label={__("Button text", "doctor-homes-blocks")}
				value={btnText}
				onChange={onChangeBtnText}
				placeholder={__("Enter button text", "doctor-homes-blocks")}
				style={{marginBottom: '15px', color: '#000000'}}
			/>
			<TextControl
				label={__("Redirect URL", "text-domain")}
				value={redirectUrl}
				onChange={onChangeRedirectUrl}
				placeholder={__("Enter redirect URL", "text-domain")}
				style={{marginTop: '10px', color: '#000000'}}
			/>

			<h3 className="lead-form-title" style={{marginTop: '30px', marginBottom: '15px'}}>{__("Webhooks", "text-domain")}</h3>
			{webhooks.map((webhook, index) => (
				<div key={index} style={{ marginBottom: '10px', padding: '10px', border: '1px solid rgb(221, 221, 221)' }}>
					<TextControl
						label={__("URL", "text-domain")}
						value={webhook.url}
						onChange={(value) => updateWebhook(index, "url", value)}
						style={{marginBottom: '10px', color: '#000000'}}
					/>
					<div style={{marginBottom: '15px', marginTop: '20px', color: '#fff'}}>
						<ToggleControl
							label={__("Use Preset", "text-domain")}
							checked={webhook.usePreset}
							onChange={(value) => updateWebhook(index, "usePreset", value)}
						/>
					</div>
					{webhook.usePreset ? (
						<SelectControl
							label={__("Fields Preset", "text-domain")}
							value={webhook.fieldsPreset}
							options={presets}
							onChange={(value) => updateWebhook(index, "fieldsPreset", value)}
						/>
					) : (
						<>
							<h4>{__("Fields Mapping", "text-domain")}</h4>
							{webhook.fieldsMapping.map((mapping, mappingIndex) => (
								<div key={mappingIndex} style={{display: 'flex', marginTop: '10px', alignItems: 'center'}}>
									<div style={{flexBasis: '0', flexGrow: '1', color: '#000000'}}>
										<TextControl
											label={__("Key", "text-domain")}
											value={mapping.key}
											onChange={(value) =>
												updateFieldMapping(index, mappingIndex, "key", value)
											}
											style={{flexBasis: '0', flexGrow: '1'}}
										/>
									</div>
									<div style={{flexBasis: '0', flexGrow: '1', color: '#000000'}}>
										<SelectControl
											label={__("Field", "text-domain")}
											value={mapping.field}
											options={fieldOptions}
											onChange={(value) =>
												updateFieldMapping(index, mappingIndex, "field", value)
											}
										/>
									</div>
									<Button
										isDestructive
										onClick={() => removeFieldMapping(index, mappingIndex)}
										style={{alignSelf: 'flex-end'}}
									>
										{__("Remove Field", "text-domain")}
									</Button>
								</div>
							))}
							<Button className="is-primary is-compact" style={{marginTop: '12px'}} onClick={() => addFieldMapping(index)}>
								{__("Add Field Mapping", "text-domain")}
							</Button>
						</>
					)}
					<Button isDestructive style={{marginLeft: 'auto', display: 'block'}} onClick={() => removeWebhook(index)}>
						{__("Remove Webhook", "text-domain")}
					</Button>
				</div>
			))}
			<Button className="is-primary is-compact" onClick={addWebhook}>{__("Add Webhook", "text-domain")}</Button>

			<h3 style={{marginTop: '20px', marginBottom: '15px'}}>{__("Redirect Query", "text-domain")}</h3>
			{redirectQuery.map((query, index) => (
				<div key={index} style={{padding: '10px', border: '1px solid', marginBottom: '10px', display: 'flex', alignItems: 'center'}}>
					<div style={{flexBasis: '0', flexGrow: '1', transform: 'translateY(7.5px)', color: '#000000'}}>
						<TextControl
							label={__("Key", "text-domain")}
							value={query.key}
							onChange={(value) => updateRedirectQuery(index, "key", value)}
							style={{marginBottom: '10px', color: '#000000'}}
						/>
					</div>
					<div style={{flexBasis: '0', flexGrow: '1', color: '#000000'}}>
						<SelectControl
							label={__("Field", "text-domain")}
							value={query.field}
							options={fieldOptions}
							onChange={(value) => updateRedirectQuery(index, "field", value)}
						/>
					</div>
					<Button isDestructive style={{display: 'block', marginLeft: 'auto', alignSelf: 'flex-end'}} onClick={() => removeRedirectQuery(index)}>
						{__("Remove Query", "text-domain")}
					</Button>
				</div>
			))}
			<Button className="is-primary is-compact" onClick={addRedirectQuery}>{__("Add Redirect Query", "text-domain")}</Button>

		</div>
	);
}
