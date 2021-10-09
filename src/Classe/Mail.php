<?php
namespace App\Classe;
 
use Mailjet\Client;
use Mailjet\Resources;
 
class Mail
{
    private $api_key = '05f33be261ae14ea674158e38f1c9b90';
    private $api_key_secret = 'e5c022c458b83fe49da7490bfbd6f688';
 
    public function send($to_email, $to_name, $subject, $content)
    {
        $mj = new Client($this->api_key, $this->api_key_secret,true,['version' => 'v3.1']);
        $body = [
                'Messages' => [
                [
                    'From' => [
                        'Email' => "echry.tunisie@gmail.com",
                        'Name' => "E_chry"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name
                        ]
                    ],
                    'TemplateID' => 2156360,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'Variables' => [
                        'content' => $content,
                        
                    ]
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success();
    
    }
}
