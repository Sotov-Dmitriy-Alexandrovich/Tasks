document.addEventListener('DOMContentLoaded', () => {
    const passwordInputs = [
        document.getElementById('password'),
        document.getElementById('password_confirmation'),
        document.getElementById('password-login')
    ];

    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function () {
            const firstInput = passwordInputs.find(input => input);
            if (!firstInput) return;

            const newType = firstInput.type === 'password' ? 'text' : 'password';

            passwordInputs.forEach(input => {
                if (input) input.type = newType;
            });

            document.querySelectorAll('.toggle-password').forEach(btn => {
                btn.classList.toggle('active', newType === 'text');
            });
        });
    });
});
