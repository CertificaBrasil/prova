<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obter os dados do formulário
    $nome = $_POST["nome"];
    $resposta1 = isset($_POST["resposta1"]) ? $_POST["resposta1"] : "Não respondido";
    $resposta2 = isset($_POST["resposta2"]) ? $_POST["resposta2"] : "Não respondido";
    $resposta3 = isset($_POST["resposta3"]) ? $_POST["resposta3"] : "Não respondido";
    $resposta4 = isset($_POST["resposta4"]) ? $_POST["resposta4"] : "Não respondido";
    $resposta5 = isset($_POST["resposta5"]) ? $_POST["resposta5"] : "Não respondido";

    // Montar as respostas em um formato adequado com quebra de linha
    $respostas = "Nome: " . $nome . "\n";
    $respostas .= "Resposta 1: " . $resposta1 . "\n";
    $respostas .= "Resposta 2: " . $resposta2 . "\n";
    $respostas .= "Resposta 3: " . $resposta3 . "\n";
    $respostas .= "Resposta 4: " . $resposta4 . "\n";
    $respostas .= "Resposta 5: " . $resposta5 . "\n";

    // Adicionar uma linha em branco para separar as respostas de cada aluno
    $respostas .= "\n";

    // Caminho para o arquivo onde as respostas serão salvas
    $arquivo = "respostas.txt";

    // Salvar as respostas no arquivo
    if (file_put_contents($arquivo, $respostas, FILE_APPEND | LOCK_EX) !== false) {
        // Redirecionar para a página "mensagem.html"
        header("Location: mensagem.html");
        exit(); // Certifique-se de sair após o redirecionamento
    } else {
        echo "Erro ao salvar as respostas.";
    }
} else {
    echo "Acesso não permitido.";
}
?>
