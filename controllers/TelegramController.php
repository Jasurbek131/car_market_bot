<?php

namespace app\controllers;

use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Exception\TelegramLogException;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;
use yii\rest\Controller;


class TelegramController extends Controller
{
    /**
     * @var string
     */
    public string $api_key = '5894909099:AAHeubtYfOuQdlloXDZ2yvQd_E6cBe0pdcE';

    /**
     * @var string
     */
    public string $username = '@car_market_hope_bot';


    /**
     * @throws TelegramException
     */
    public function actionIndex()
    {
        try {
            $telegram = new Telegram($this->api_key, $this->username);
            $request = file_get_contents('php://input');
            $request = json_decode($request, true);

            $chat_id = null;
            if (isset($request['message'])) {
                $chat_id = $request['message']['chat']['id'];
            }


            if (isset($chat_id)) {
                if(isset($request['message'])) {
                    $text = $request['message']['text'];
                    $username = $request["message"]["from"]["first_name"];
                    switch ($text) {
                        case "/start":
                            Request::sendMessage([
                                'chat_id' => $chat_id,
                                'text' => 'Ассалому алайкум Эълон ясаб берувчи ботга ҳуш келибсиз! Эълон ясащ учун Эълон Ясаш📝 тугмасини босинг'
                            ]);
                            break;
                    }
                }
            }

        } catch (TelegramLogException $e) {

        }

    }

}