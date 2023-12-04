<?php
header('Content-Type: text/html; charset=utf-8');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $nome_completo = $_POST["nome_completo"];
    $cpf = $_POST["cpf"];
    $telefone = $_POST["telefone"];
    $cidade = $_POST["cidade"];
    $estado = $_POST["estado"];
    $curso = $_POST["curso"];

    // Formatação do CPF (000.000.000-00)
    $cpf_formatado = preg_replace('/[^0-9]/', '', $cpf); // Remove caracteres não numéricos
    $cpf_formatado = substr($cpf_formatado, 0, 3) . "." . substr($cpf_formatado, 3, 3) . "." . substr($cpf_formatado, 6, 3) . "-" . substr($cpf_formatado, 9, 2);

    // Formatação do telefone ((00) 00000-0000)
    $telefone_formatado = preg_replace('/[^0-9]/', '', $telefone); // Remove caracteres não numéricos
    $telefone_formatado = "(" . substr($telefone_formatado, 0, 2) . ") " . substr($telefone_formatado, 2, 5) . "-" . substr($telefone_formatado, 7, 4);

    // Formatação da Data de Conclusão do Curso (DD/MM/AAAA)
    $data_conclusao_curso_formatada = $_POST["data_conclusao_curso"];

    // Converta a data para o formato esperado (MM/DD/YYYY) antes de passá-la para strtotime
    $data_conclusao_curso_formatada = explode('/', $data_conclusao_curso_formatada);
    $data_conclusao_curso_formatada = $data_conclusao_curso_formatada[1] . '/' . $data_conclusao_curso_formatada[0] . '/' . $data_conclusao_curso_formatada[2];

    // Tente converter a data usando strtotime
    $timestamp = strtotime($data_conclusao_curso_formatada);

    if ($timestamp === false || $timestamp === -1) {
        // Se a conversão falhar, a data é inválida
        echo "A data de conclusão do curso é inválida.";
        exit();
    }

    // Converta a data para o formato desejado (DD/MM/AAAA)
    $data_conclusao_curso_formatada = date("d/m/Y", $timestamp);

    // Monta os dados da inscrição em uma única string
    $dados = "Nome Completo: $nome_completo\nCPF: $cpf_formatado\nTelefone: $telefone_formatado\nCidade: $cidade\nEstado: $estado\nCurso Desejado: $curso\nData de Conclusão do Curso: $data_conclusao_curso_formatada\n";

    // Abre o arquivo de inscrições em modo de escrita e anexa os dados com uma quebra de linha
    $arquivo = fopen("fichas.txt", "a"); // Abre o arquivo em modo de anexação

    // Use utf8_decode para escrever os dados no arquivo com a codificação UTF-8
    fwrite($arquivo, utf8_decode($dados) . "\n"); // Escreve os dados no arquivo com uma quebra de linha
    fclose($arquivo); // Fecha o arquivo

    // Redirecionar para uma página de confirmação (opcional)
    header("Location: confirmacao.html");
    exit();
}
?>
