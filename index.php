<?php
    require_once "vendor/autoload.php";
    $token = "1603733512:AAEaVyYhnCzLnBzo11Ld8xSf75CsLso9Mv8";

    $bot = new \TelegramBot\Api\Client($token);
    // команда для start
    $bot->command('start', function ($message) use ($bot) {
        $answer = 'Добро пожаловать!';
        $bot->sendMessage($message->getChat()->getId(), $answer);
    });

    // команда для помощи
    $bot->command('help', function ($message) use ($bot) {
        $answer = 'Команды:
    /help - вывод справки';
        $bot->sendMessage($message->getChat()->getId(), $answer);
    });

    // вариации ответов на неизвестные сообщения
    $bot->on(function (\TelegramBot\Api\Types\Update $update) use ($bot) {
        $array = [
            "Ты нормальный вообще?",
            "Пиши адекватные вещи",
            "Я не понимаю",
            "Я не могу выполнить эту команду",
        ];
        $message = $update->getMessage();
        $id = $message->getChat()->getId();
        $rand_answers = array_rand($array, 1);
        $bot->sendMessage($id, $rand_answers);
    }, function () {
        return true;
    });


    $bot->run();

