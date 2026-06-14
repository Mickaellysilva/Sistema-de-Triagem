document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");
    const errorEmailDiv = document.getElementById("error-email");
    const errorPasswordDiv = document.getElementById("error-password");

    const radios = document.querySelectorAll('input[name="perfil"]');
    radios.forEach((radio) => {
        radio.addEventListener("change", function () {
            radios.forEach((r) => {
                const label = r.closest("label");
                if (label) {
                    label.classList.remove("border-[#00b4d8]", "bg-cyan-50/30");
                    label.classList.add("border-gray-200");
                }
            });

            if (this.checked) {
                const activeLabel = this.closest("label");
                if (activeLabel) {
                    activeLabel.classList.remove("border-gray-200");
                    activeLabel.classList.add(
                        "border-[#00b4d8]",
                        "bg-cyan-50/30"
                    );
                }
            }
        });
    });

    form.addEventListener("submit", function (e) {
        let extendsValid = true;

        errorEmailDiv.classList.add("hidden");
        errorPasswordDiv.classList.add("hidden");
        emailInput.classList.remove(
            "border-red-300",
            "focus:border-red-400",
            "focus:ring-red-400"
        );
        passwordInput.classList.remove(
            "border-red-300",
            "focus:border-red-400",
            "focus:ring-red-400"
        );

        if (!emailInput.value.trim()) {
            e.preventDefault();
            extendsValid = false;
            showError(emailInput, errorEmailDiv, "O e-mail é obrigatório.");
        } else {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailInput.value.trim())) {
                e.preventDefault();
                extendsValid = false;
                showError(
                    emailInput,
                    errorEmailDiv,
                    "Insira um e-mail válido."
                );
            }
        }

        if (!passwordInput.value.trim()) {
            e.preventDefault();
            extendsValid = false;
            showError(
                passwordInput,
                errorPasswordDiv,
                "A senha é obrigatória."
            );
        } else if (passwordInput.value.length < 6) {
            e.preventDefault();
            extendsValid = false;
            showError(
                passwordInput,
                errorPasswordDiv,
                "A senha deve conter pelo menos 6 caracteres."
            );
        }

        if (extendsValid) {
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML =
                '<i class="fa-solid fa-spinner animate-spin mr-2"></i> Entrando...';
            submitBtn.classList.add("opacity-70", "cursor-not-allowed");
        }
    });

    function showError(inputElement, errorElement, message) {
        inputElement.classList.add(
            "border-red-300",
            "focus:border-red-400",
            "focus:ring-red-400"
        );
        errorElement.querySelector(".error-text").textContent = message;
        errorElement.classList.remove("hidden");
    }
});
