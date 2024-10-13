// scripts.js

document.getElementById("register-form").addEventListener("submit", function(event) {
  // Impede o envio do formulário por padrão
  event.preventDefault();

  // Obtém os valores dos campos
  const email = document.getElementById("email").value;
  const nome = document.getElementById("name").value;
  const sobrenome = document.getElementById("lastname").value;
  const senha = document.getElementById("password").value;
  const confirmacaoSenha = document.getElementById("passwordconfirmation").value;
  const termosAceitos = document.getElementById("agreement").checked;

  // Valida os campos
  if (!email || !nome || !sobrenome || !senha || !confirmacaoSenha) {
      alert("Por favor, preencha todos os campos obrigatórios.");
      return; // Para o envio do formulário
  }

  if (senha !== confirmacaoSenha) {
      alert("As senhas não coincidem.");
      return; // Para o envio do formulário
  }

  if (!termosAceitos) {
      alert("Você deve aceitar os termos de uso.");
      return; // Para o envio do formulário
  }

  // Se tudo estiver válido, envia o formulário
  this.submit(); // Envia o formulário
});
