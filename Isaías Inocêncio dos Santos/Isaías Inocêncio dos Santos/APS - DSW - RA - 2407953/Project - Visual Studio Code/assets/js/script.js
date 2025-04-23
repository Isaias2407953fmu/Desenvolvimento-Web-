if (isValid) {
    const formData = {
        nome: nomeInput.val(),
        email: emailInput.val(),
        telefone: $('#telefone').val(),
        data_nascimento: dataNascimentoInput.val(),
        sexo: $('input[name="sexo"]:checked').val(),
        mensagem: $('#mensagem').val(),
        termos: termosCheckbox.is(':checked')
    };

    $.ajax({
        url: 'php/processa_formulario.php',
        type: 'POST',
        data: JSON.stringify(formData),
        contentType: 'application/json',
        success: function(response) {
            if (response.success) {
                $('#contactForm').hide();
                $('#successMessage').text(response.message).show();
            } else {
                alert(response.message);
            }
        },
        error: function() {
            alert('Erro ao enviar o formulário. Tente novamente.');
        }
    });
}