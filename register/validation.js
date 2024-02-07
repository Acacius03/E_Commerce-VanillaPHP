const validation = new JustValidate("#signup-form");

validation
  .addField("#first_name", [
    {
      rule: "required",
    },
  ])
  .addField("#last_name", [
    {
      rule: "required",
    },
  ])
  .addField("#email", [
    {
      rule: "required",
    },
    {
      rule: "email",
    },
    {
      validator: (value) => () => {
        return fetch("validate-email.php?email=" + encodeURIComponent(value))
          .then((res) => res.json())
          .then((json) => json.available);
      },
      errorMessage: "Email already taken",
    },
  ])
  .addField("#password", [
    {
      rule: "required",
    },
    {
      rule: "password",
    },
  ])
  .addField("#password_confirmation", [
    {
      validator: (value, fields) => {
        return value === fields["#password"].elem.value;
      },
      errorMessage: "Password should match",
    },
  ])
  .onSuccess((e) => {
    document.getElementById("signup-form").submit();
  });
