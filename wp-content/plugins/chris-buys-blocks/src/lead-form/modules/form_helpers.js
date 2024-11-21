export function populateUtms(form, formData) {
	let utms = {
		'utm_source': 'utm',
		'utm_term': 'utm',
		'utm_campaign': 'utm',
		'utm_medium': 'utm',
		'utm_content': 'utm',
		'device': 'utm',
		'gclid': 'utm',
		'fbclid': 'utm',
		'msclkid': 'utm',
		'page_url': ()=>{
			return document.location.href
		},
		'lead_source': ()=>{
			return localStorage.getItem('Initial_Lead_Source') || ''
		},
		'timestamp': ()=>{
			return (new Date()).getTime()
		},
		'client_id': ()=>{
			return '??'
		},
		'session_id': ()=>{
			return '??'
		},
		'form_name': form.name,
	}
	let getParams = new URLSearchParams(window.location.search)

	Object.keys(utms).forEach(function (utmName) {
		if(utms[utmName] === 'get'){
			if(getParams.get(utmName)) {
				formData.set(utmName, getParams.get(utmName))
			}
		} else if(utms[utmName] === 'utm'){
			let utmFromQuery= getParams.get(utmName);
			let utmFromSession = sessionStorage.getItem(formConfig.storagePrefix + utmName);

			if(utmFromQuery) {
				formData.set(utmName, utmFromQuery)
			} else if(utmFromSession){
				formData.set(utmName, utmFromSession)
			}
		} else if(typeof utms[utmName] === 'function'){
			formData.set(utmName, utms[utmName]())
		} else {
			formData.set(utmName, utms[utmName])
		}
	})

	return formData;
}
export function getRedirectParams(formData, queries) {
	let query = {}

	queries.forEach(function (fieldData) {
		let inputName = fieldData.field
		let propName = fieldData.key

		if(inputName === 'country'){
			query[propName] = 'United States'
		} else if(formData.get(inputName)) {
			query[propName] = formData.get(inputName)
		}
	})

	return new URLSearchParams(query).toString()
}