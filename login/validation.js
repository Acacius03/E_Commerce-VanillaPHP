const validation = new JustValidate('#login-form');

validation
	.addField('#email', [
		{
			rule: 'required',
		},
		{
			rule: 'email',
		},
	])
	.addField('#password', [
		{
			rule: 'required',
		},
	])
	.onSuccess((e) => {
		document.getElementById('login-form').submit();
	});
