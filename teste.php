<?php

require_once 'vendor/autoload.php'; // Inclua o autoload do Composer

use app\Controller\EnviaEmail\EmailSender;

// Crie uma instância do EmailSender
$emailSender = new EmailSender();

// Defina o destinatário, assunto e corpo do e-mail
$recipient = 'milenesantana@somosdevteam.com';
$subject = 'Uma declaração de amor';
$body = 'Querida Milene,

É difícil expressar em palavras o tamanho do amor que sinto por você. Cada momento ao seu lado é uma dádiva, uma jornada repleta de carinho, cumplicidade e felicidade. Desde o dia em que nos encontramos, minha vida se iluminou de uma maneira que nunca imaginei ser possível.

Você é o sol que aquece meu coração, a lua que ilumina meus sonhos mais doces. Estar ao seu lado é como encontrar o lar em um abraço, é onde encontro paz, conforto e segurança. Em cada olhar, em cada sorriso, vejo o reflexo do amor mais puro e verdadeiro.

Prometo estar ao seu lado em todos os momentos, nas alegrias e nas tristezas, na saúde e na doença. Quero caminhar ao seu lado pelo resto dos meus dias, enfrentando desafios juntos e celebrando cada conquista. Você é minha companheira, minha melhor amiga e meu amor eterno.

Obrigado por ser a luz da minha vida, por me fazer sentir completo e amado. Eu te amo mais do que as palavras podem expressar, e sempre te amarei com todo o meu coração.

Enviado do meu iPhone.';

// Tente enviar o e-mail
try {
    $emailSender->sendEmail($recipient, $subject, $body);
    echo "E-mail enviado com sucesso!";
} catch (\Exception $e) {
    // Se ocorrer um erro, capture-o e exiba uma mensagem de erro
    echo "Erro ao enviar e-mail: " . $e->getMessage();
}
