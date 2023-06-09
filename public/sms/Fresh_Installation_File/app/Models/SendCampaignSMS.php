<?php

namespace App\Models;

use App\Library\SmsBuilder;

//use App\Library\SMPP;
use App\Library\SMSCounter;
use App\Library\Tool;
use Aws\Sns\Exception\SnsException;
use Aws\Sns\SnsClient;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Database\Eloquent\Model;
use Plivo\Exceptions\PlivoResponseException;
use Plivo\RestClient;
use Psr\Http\Client\ClientExceptionInterface;

use Sendpulse\RestApi\ApiClient;
use Sendpulse\RestApi\Storage\FileStorage;


//use SMSGatewayMe\Client\ApiException;
//use SMSGatewayMe\Client\ClientProvider;
//use SMSGatewayMe\Client\Model\SendMessageRequest;
use smpp\Smpp;
use stdClass;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;
use Twilio\TwiML\VoiceResponse;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;

class SendCampaignSMS extends Model
{

    /**
     * make normal message to unicode message
     *
     * @param $message
     *
     * @return string
     */
    private function sms_unicode($message): string
    {
        $hex1 = '';
        if (function_exists('iconv')) {
            $latin = @iconv('UTF−8', 'ISO−8859−1', $message);
            if (strcmp($latin, $message)) {
                $arr  = unpack('H*hex', @iconv('UTF-8', 'UCS-2BE', $message));
                $hex1 = strtoupper($arr['hex']);
            }
            if ($hex1 == '') {
                $hex2 = '';
                for ($i = 0; $i < strlen($message); $i++) {
                    $hex = dechex(ord($message[$i]));
                    $len = strlen($hex);
                    $add = 4 - $len;
                    if ($len < 4) {
                        for ($j = 0; $j < $add; $j++) {
                            $hex = "0".$hex;
                        }
                    }
                    $hex2 .= $hex;
                }

                return $hex2;
            } else {
                return $hex1;
            }
        } else {
            return 'failed';
        }
    }


    /**
     *
     * send plain message
     *
     * @param $data
     *
     * @return array|Application|Translator|string|null
     */
    public function sendPlainSMS($data)
    {
        $phone          = $data['phone'];
        $sending_server = $data['sending_server'];
        $gateway_name   = $data['sending_server']->settings;
        $message        = null;
        $sms_type       = $data['sms_type'];
        $get_sms_status = $data['status'];

        if (isset($data['message'])) {
            $message = $data['message'];
        }

        if ($get_sms_status == null) {
            if ($sending_server->custom && $sending_server->type == 'http') {
                $cg_info = $sending_server->customSendingServer;

                $send_custom_data = [];


                $username_param = $cg_info->username_param;
                $username_value = $cg_info->username_value;
                $password_value = null;

                if ($cg_info->authorization == 'no_auth') {
                    $send_custom_data[$username_param] = $username_value;
                }

                if ($cg_info->password_status) {
                    $password_param = $cg_info->password_param;
                    $password_value = $cg_info->password_value;

                    if ($cg_info->authorization == 'no_auth') {
                        $send_custom_data[$password_param] = $password_value;
                    }
                }

                if ($cg_info->action_status) {
                    $action_param = $cg_info->action_param;
                    $action_value = $cg_info->action_value;

                    $send_custom_data[$action_param] = $action_value;
                }

                if ($cg_info->source_status) {
                    $source_param = $cg_info->source_param;
                    $source_value = $cg_info->source_value;

                    if ($data['sender_id'] != '') {
                        $send_custom_data[$source_param] = $data['sender_id'];
                    } else {
                        $send_custom_data[$source_param] = $source_value;
                    }
                }

                $destination_param                    = $cg_info->destination_param;
                $send_custom_data[$destination_param] = $data['phone'];

                $message_param                    = $cg_info->message_param;
                $send_custom_data[$message_param] = $data['message'];

                if ($cg_info->unicode_status && $data['sms_type'] == 'unicode') {
                    $unicode_param                    = $cg_info->unicode_param;
                    $unicode_value                    = $cg_info->unicode_value;
                    $send_custom_data[$unicode_param] = $unicode_value;
                }

                if ($cg_info->route_status) {
                    $route_param = $cg_info->route_param;
                    $route_value = $cg_info->route_value;

                    $send_custom_data[$route_param] = $route_value;
                }

                if ($cg_info->language_status) {
                    $language_param = $cg_info->language_param;
                    $language_value = $cg_info->language_value;

                    $send_custom_data[$language_param] = $language_value;
                }

                if ($cg_info->custom_one_status) {
                    $custom_one_param = $cg_info->custom_one_param;
                    $custom_one_value = $cg_info->custom_one_value;

                    $send_custom_data[$custom_one_param] = $custom_one_value;
                }

                if ($cg_info->custom_two_status) {
                    $custom_two_param = $cg_info->custom_two_param;
                    $custom_two_value = $cg_info->custom_two_value;

                    $send_custom_data[$custom_two_param] = $custom_two_value;
                }

                if ($cg_info->custom_three_status) {
                    $custom_three_param = $cg_info->custom_three_param;
                    $custom_three_value = $cg_info->custom_three_value;

                    $send_custom_data[$custom_three_param] = $custom_three_value;
                }

                //if json encoded then encode custom data json_encode($send_custom_data) otherwise do http_build_query
                if ($cg_info->json_encoded_post) {
                    $parameters = json_encode($send_custom_data);
                } else {
                    $parameters = http_build_query($send_custom_data);
                }

                $ch = curl_init();

                //if http method get
                if ($cg_info->http_request_method == 'get') {
                    $gateway_url = $sending_server->api_link.'?'.$parameters;

                    curl_setopt($ch, CURLOPT_URL, $gateway_url);
                    curl_setopt($ch, CURLOPT_HTTPGET, 1);
                } else {

                    //if http method post
                    $gateway_url = $sending_server->api_link;

                    curl_setopt($ch, CURLOPT_URL, $gateway_url);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
                }

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                // if ssl verify ignore set yes then add these two values in curl  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                if ($cg_info->ssl_certificate_verification) {
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                }
                $headers = [];
                //if content type value not none then insert content type in curl headers. $headers[] = "Content-Type: application/x-www-form-urlencoded";
                if ($cg_info->content_type != 'none') {
                    $headers[] = "Content-Type: ".$cg_info->content_type;
                }

                //if content type accept value not none then insert content type accept in curl headers. $headers[] = "Accept: application/json";
                if ($cg_info->content_type_accept != 'none') {
                    $headers[] = "Accept: ".$cg_info->content_type_accept;
                }

                //if content encoding value not none then insert content type accept in curl headers. $headers[] = "charset=utf-8";
                if ($cg_info->character_encoding != 'none') {
                    $headers[] = "charset=".$cg_info->character_encoding;
                }
                // if authorization set Bearer then add this line on curl header $header[] = "Authorization: Bearer ".$gateway_user_name;

                if ($cg_info->authorization == 'bearer_token') {
                    $headers[] = "Authorization: Bearer ".$username_value;
                }

                // if authorization set basic auth then add this line on curl header $header[] = "Authorization: Basic ".base64_encode("$gateway_user_name:$gateway_password");

                if ($cg_info->authorization == 'basic_auth') {
                    $headers[] = "Authorization: Basic ".base64_encode("$username_value:$password_value");
                }

                if (count($headers)) {
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                }

                $get_sms_status = curl_exec($ch);

                if (curl_errno($ch)) {
                    $get_sms_status = curl_error($ch);
                } else {
                    if (substr_count(strtolower($get_sms_status), strtolower($sending_server->success_keyword)) == 1) {
                        $get_sms_status = 'Delivered';
                    }
                }
                curl_close($ch);
            } elseif ($sending_server->type == 'smpp') {

                $sender_id = $data['sender_id'];
                $message   = $data['message'];


//                try {
//                    $smpp        = new SMPP();
//                    $smpp->debug = 0;
//
//                    $smpp->open($sending_server->api_link, $sending_server->port, $sending_server->username, $sending_server->password);
//
//                    if ($sms_type == 'unicode') {
//                        $unicode_message = iconv('UTF-8', 'UTF-16BE', $message);
//                        $get_sms_status  = $smpp->send_long($sender_id, $phone, $unicode_message, 1);
//                    } else {
//                        $get_sms_status = $smpp->send_long($sender_id, $phone, $message);
//                    }
//
//                    if ($get_sms_status) {
//                        $get_sms_status = 'Delivered';
//                    }
//
//                } catch (Exception $ex) {
//                    $get_sms_status = $ex->getMessage();
//                }


                if ($sending_server->source_addr_ton != 5) {
                    $source_ton = $sending_server->source_addr_ton;
                } elseif (ctype_digit($sender_id) && strlen($sender_id) <= 8) {
                    $source_ton = Smpp::TON_NETWORKSPECIFIC;
                } elseif (ctype_digit($sender_id) && (strlen($sender_id) <= 15 && strlen($sender_id) >= 10)) {
                    $source_ton = Smpp::TON_INTERNATIONAL;
                } else {
                    $source_ton = Smpp::TON_ALPHANUMERIC;
                }

                if ($sending_server->dest_addr_ton != 1) {
                    $destination_ton = $sending_server->dest_addr_ton;
                } else {
                    $destination_ton = Smpp::TON_INTERNATIONAL;
                }

                try {

                    if ($sms_type == 'unicode') {
                        $output = (new SmsBuilder($sending_server->api_link, $sending_server->port, $sending_server->username, $sending_server->password, 10000))
                                ->setSender($data['sender_id'], $source_ton)
                                ->setRecipient($phone, $destination_ton)
                                ->sendMessage($message, true);
                    } else {
                        $output = (new SmsBuilder($sending_server->api_link, $sending_server->port, $sending_server->username, $sending_server->password, 10000))
                                ->setSender($data['sender_id'], $source_ton)
                                ->setRecipient($phone, $destination_ton)
                                ->sendMessage($message);
                    }

                    if ($output || str_contains($output, '0x6')) {
                        $get_sms_status = 'Delivered';
                    } else {
                        $get_sms_status = __('locale.labels.failed');
                    }
                } catch (Exception $e) {
                    $get_sms_status = $e->getMessage();
                }

            } else {

                $gateway_url = $sending_server->api_link;

                switch ($gateway_name) {

                    case SendingServer::TYPE_TWILIO:

                        $sender_id = str_replace(['(', ')', '+', '-', ' '], '', $data['sender_id']);
                        $phone     = '+'.str_replace(['(', ')', '+', '-', ' '], '', $phone);

                        if (is_numeric($sender_id)) {
                            $sender_id = '+'.$sender_id;
                        } else {
                            $sender_id = $data['sender_id'];
                        }

                        try {
                            $client       = new Client($sending_server->account_sid, $sending_server->auth_token);
                            $get_response = $client->messages->create($phone, [
                                    'from'           => $sender_id,
                                    'body'           => $message,
                                    'statusCallback' => route('dlr.twilio'),
                            ]);

                            if ($get_response->status == 'queued' || $get_response->status == 'accepted') {
                                $get_sms_status = 'Delivered|'.$get_response->sid;
                            } else {
                                $get_sms_status = $get_response->status.'|'.$get_response->sid;
                            }

                        } catch (ConfigurationException|TwilioException $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case SendingServer::TYPE_TWILIOCOPILOT:

                        $sender_id = str_replace(['(', ')', '+', '-', ' '], '', $data['sender_id']);
                        $phone     = '+'.str_replace(['(', ')', '+', '-', ' '], '', $phone);

                        if (is_numeric($sender_id)) {
                            $sender_id = '+'.$sender_id;
                        } else {
                            $sender_id = $data['sender_id'];
                        }


                        try {
                            $client       = new Client($sending_server->account_sid, $sending_server->auth_token);
                            $get_response = $client->messages->create($phone, [
                                    'messagingServiceSid' => $sender_id,
                                    'body'                => $message,
                            ]);

                            if ($get_response->status == 'queued' || $get_response->status == 'accepted') {
                                $get_sms_status = 'Delivered|'.$get_response->sid;
                            } else {
                                $get_sms_status = $get_response->status.'|'.$get_response->sid;
                            }

                        } catch (ConfigurationException|TwilioException $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'ClickatellTouch':
                        $send_message     = urlencode($message);
                        $sms_sent_to_user = $gateway_url."?apiKey=$sending_server->api_key"."&to=$phone"."&content=$send_message";

                        if ($data['sender_id']) {
                            $sender_id        = str_replace(['(', ')', '+', '-', ' '], '', $data['sender_id']);
                            $sms_sent_to_user .= "&from=".$sender_id;
                        }


                        try {

                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $sms_sent_to_user);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $response = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                $get_result = json_decode($response);

                                if (isset($get_result->messages[0]->accepted) && $get_result->messages[0]->accepted) {
                                    $get_sms_status = 'Delivered|'.$get_result->messages[0]->apiMessageId;
                                } elseif (isset($get_result->messages[0]->errorDescription) && $get_result->messages[0]->errorDescription != '') {
                                    $get_sms_status = $get_result->messages[0]->errorDescription;
                                } elseif (isset($get_result->errorDescription) && $get_result->errorDescription != '') {
                                    $get_sms_status = $get_result->errorDescription;
                                } else {
                                    $get_sms_status = 'Invalid request';
                                }
                            }

                            curl_close($ch);

                        } catch (Exception $exception) {
                            $get_sms_status = $exception->getMessage();
                        }
                        break;

                    case 'ClickatellCentral':

                        $parameters = [
                                'user'     => $sending_server->username,
                                'password' => $sending_server->password,
                                'api_id'   => $sending_server->api_key,
                                'to'       => $phone,
                                'text'     => $message,
                        ];

                        if ($sms_type == 'unicode') {
                            $parameters['unicode'] = 1;
                        } else {
                            $parameters['unicode'] = 0;
                        }

                        $sending_url = $gateway_url.'?'.http_build_query($parameters);

                        try {
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $sending_url);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $get_sms_status = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                if (substr_count($get_sms_status, 'ID:') == 1) {
                                    $get_sms_status = 'Delivered';
                                }
                            }
                            curl_close($ch);
                        } catch (Exception $exception) {
                            $get_sms_status = $exception->getMessage();
                        }
                        break;

                    case 'RouteMobile':
                        $parameters = [
                                'username'    => $sending_server->username,
                                'password'    => $sending_server->password,
                                'source'      => $data['sender_id'],
                                'destination' => $phone,
                                'dlr'         => 1,
                        ];

                        if ($sms_type == 'unicode') {
                            $parameters['type']    = 2;
                            $parameters['message'] = $this->sms_unicode($message);
                        } else {
                            $parameters['type']    = 0;
                            $parameters['message'] = $message;
                        }

                        $sending_url = $gateway_url.'?'.http_build_query($parameters);

                        try {
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $sending_url);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $get_sms_status = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {

                                $get_data = explode('|', $get_sms_status);

                                if (is_array($get_data) && array_key_exists('0', $get_data)) {
                                    $get_sms_status = match ($get_data[0]) {
                                        '1701' => 'Delivered|'.$get_data['2'],
                                        '1702' => 'Invalid URL',
                                        '1703' => 'Invalid User or Password',
                                        '1704' => 'Invalid Type',
                                        '1705' => 'Invalid SMS',
                                        '1706' => 'Invalid receiver',
                                        '1707' => 'Invalid sender',
                                        '1709' => 'User Validation Failed',
                                        '1710' => 'Internal Error',
                                        '1715' => 'Response Timeout',
                                        '1025' => 'Insufficient Credit',
                                        default => 'Invalid request',
                                    };
                                } else {
                                    $get_sms_status = 'Invalid request';
                                }
                            }
                            curl_close($ch);
                        } catch (Exception $exception) {
                            $get_sms_status = $exception->getMessage();
                        }
                        break;

                    case 'TextLocal':

                        $unique_id = time();

                        $parameters = [
                                'apikey'      => $sending_server->api_key,
                                'numbers'     => $phone,
                                'sender'      => $data['sender_id'],
                                'receipt_url' => route('dlr.textlocal'),
                                'custom'      => $unique_id,
                        ];

                        if ($sms_type == 'unicode') {
                            $parameters['unicode'] = true;
                            $message               = $this->sms_unicode($message);
                        }

                        $parameters['message'] = $message;

                        try {
                            $ch = curl_init($gateway_url);
                            curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $response = curl_exec($ch);
                            $err      = curl_error($ch);
                            curl_close($ch);

                            if ($err) {
                                $get_sms_status = $err;
                            } else {
                                $get_data = json_decode($response, true);

                                if (isset($get_data) && is_array($get_data) && array_key_exists('status', $get_data)) {
                                    if ($get_data['status'] == 'failure') {
                                        foreach ($get_data['errors'] as $err) {
                                            $get_sms_status = $err['message'];
                                        }
                                    } elseif ($get_data['status'] == 'success') {
                                        $get_sms_status = 'Delivered|'.$unique_id;
                                    } else {
                                        $get_sms_status = $response;
                                    }
                                } else {
                                    $get_sms_status = $response;
                                }
                            }
                        } catch (Exception $exception) {
                            $get_sms_status = $exception->getMessage();
                        }
                        break;

                    case 'Plivo':

                        $client = new RestClient($sending_server->auth_id, $sending_server->auth_token);
                        try {
                            $response = $client->messages->create(
                                    $data['sender_id'],
                                    [$phone],
                                    $message,
                                    ['url' => route('dlr.plivo')],
                            );

                            $get_sms_status = 'Delivered|'.$response->getmessageUuid(0)[0];

                        } catch (PlivoResponseException $e) {
                            $get_sms_status = $e->getMessage();
                        }

                        break;

                    case 'PlivoPowerpack':

                        $client = new RestClient($sending_server->auth_id, $sending_server->auth_token);
                        try {
                            $response = $client->messages->create(
                                    null,
                                    [$phone],
                                    $message,
                                    ['url' => route('dlr.plivo')],
                                    $data['sender_id']
                            );

                            $get_sms_status = 'Delivered|'.$response->getmessageUuid(0)[0];

                        } catch (PlivoResponseException $e) {
                            $get_sms_status = $e->getMessage();
                        }

                        break;

                    case 'SMSGlobal':

                        $parameters = [
                                'action'   => 'sendsms',
                                'user'     => $sending_server->username,
                                'password' => $sending_server->password,
                                'from'     => $data['sender_id'],
                                'to'       => $phone,
                                'text'     => $message,
                        ];

                        if (strlen($message) > 160) {
                            $parameters['maxsplit'] = 9;
                        }

                        $sending_url = $gateway_url.'?'.http_build_query($parameters);

                        try {

                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $sending_url);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $get_sms_status = curl_exec($ch);
                            curl_close($ch);

                            if (substr_count($get_sms_status, 'OK') == 1) {
                                $get_sms_status = explode(':', $get_sms_status);
                                if (isset($get_sms_status) && is_array($get_sms_status) && array_key_exists('3', $get_sms_status)) {
                                    $get_sms_status = 'Delivered|'.trim($get_sms_status['3']);
                                } else {
                                    $get_sms_status = 'Delivered';
                                }
                            } else {
                                $get_sms_status = str_replace('ERROR:', '', $get_sms_status);
                            }
                        } catch (Exception $exception) {
                            $get_sms_status = $exception->getMessage();
                        }
                        break;

                    case 'BulkSMS':

                        $parameters = [
                                'longMessageMaxParts' => 6,
                                'to'                  => $phone,
                                'body'                => $message,
                        ];

                        if (isset($data['sender_id'])) {
                            $parameters['from'] = $data['sender_id'];
                        }

                        try {
                            $ch      = curl_init();
                            $headers = [
                                    'Content-Type:application/json',
                                    'Authorization:Basic '.base64_encode("$sending_server->username:$sending_server->password"),
                            ];
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt($ch, CURLOPT_URL, $gateway_url."?auto-unicode=true");
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                            $response = curl_exec($ch);
                            curl_close($ch);

                            $get_data = json_decode($response, true);

                            if (isset($get_data) && is_array($get_data) && array_key_exists('0', $get_data)) {
                                if (array_key_exists('id', $get_data[0])) {
                                    $get_sms_status = 'Delivered|'.$get_data[0]['id'];
                                } elseif (array_key_exists('detail', $get_data)) {
                                    $get_sms_status = $get_data['detail'];
                                }
                            } else {
                                $get_sms_status = $response;
                            }
                        } catch (Exception $exception) {
                            $get_sms_status = $exception->getMessage();
                        }
                        break;

                    case 'Vonage':
                        $client = new \Vonage\Client(new Basic($sending_server->api_key, $sending_server->api_secret));
                        $text   = new SMS($phone, $data['sender_id'], $message);

                        try {
                            $response = $client->sms()->send($text);
                            $output   = $response->current();

                            if ($output->getStatus() == 0 || $output->getStatus() == 'sent') {
                                $get_sms_status = 'Delivered|'.$output->getMessageId();
                            } else {
                                $get_sms_status = $output->getStatus();
                            }

                        } catch (ClientExceptionInterface|\Vonage\Client\Exception\Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'Infobip':
                        $destination = [
                                'messageId' => time(),
                                'to'        => $phone,
                        ];

                        $parameters = [
                                'messages' => [
                                        "from"              => $data['sender_id'],
                                        "destinations"      => [$destination],
                                        'text'              => $message,
                                        'notifyUrl'         => route('dlr.infobip'),
                                        'notifyContentType' => 'application/json',
                                ],
                        ];

                        try {

                            $ch     = curl_init();
                            $header = [
                                    "Authorization: App $sending_server->api_key",
                                    "Content-Type: application/json",
                                    "Accept: application/json",
                            ];

                            // setting options
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                            curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));

                            // response of the POST request
                            $response = curl_exec($ch);
                            $get_data = json_decode($response, true);
                            curl_close($ch);

                            if (is_array($get_data)) {
                                if (array_key_exists('messages', $get_data)) {
                                    foreach ($get_data['messages'] as $msg) {
                                        $get_sms_status = 'Delivered|'.$msg['messageId'];
                                    }
                                } elseif (array_key_exists('requestError', $get_data)) {
                                    foreach ($get_data['requestError'] as $msg) {
                                        $get_sms_status = $msg['messageId'];
                                    }
                                } else {
                                    $get_sms_status = 'Unknown error';
                                }
                            } else {
                                $get_sms_status = 'Unknown error';
                            }

                        } catch (Exception $exception) {
                            $get_sms_status = $exception->getMessage();
                        }
                        break;

                    case '1s2u':

                        if ($sms_type == 'unicode') {
                            $mt      = 1;
                            $message = bin2hex(mb_convert_encoding($message, "UTF-16", "UTF-8"));
                        } else {
                            $mt = 0;
                        }

                        $parameters = [
                                "username" => $sending_server->username,
                                "password" => $sending_server->password,
                                "mno"      => $phone,
                                "msg"      => $message,
                                "sid"      => $data['sender_id'],
                                "mt"       => $mt,
                                "fl"       => 0,
                        ];

                        $sending_url = $gateway_url.'?'.http_build_query($parameters);

                        try {

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $sending_url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);

                            $get_sms_status = curl_exec($ch);

                            curl_close($ch);

                            if (str_contains($get_sms_status, 'OK')) {
                                $get_sms_status = 'Delivered|'.trim(str_replace('OK: ', '', $get_sms_status));
                            } else {
                                $get_sms_status = match ($get_sms_status) {
                                    '0005' => 'Invalid Sender',
                                    '0010' => 'Username not provided',
                                    '0011' => 'Password not provided',
                                    '00' => 'Invalid username/password',
                                    '0020' => 'Insufficient Credits',
                                    '0030' => 'Invalid Sender ID',
                                    '0040' => 'Mobile number not provided',
                                    '0041' => 'Invalid mobile number',
                                    '0066', '0042' => 'Network not supported',
                                    '0050' => 'Invalid message',
                                    '0060' => 'Invalid quantity specified',
                                    '0000' => 'Message not sent',
                                    default => 'Unknown Error',
                                };

                            }
                        } catch (Exception $ex) {
                            $get_sms_status = $ex->getMessage();
                        }
                        break;

                    case 'MessageBird':
                        $parameters = [
                                'recipients' => $phone,
                                'originator' => $data['sender_id'],
                                'body'       => $message,
                                'datacoding' => 'auto',
                        ];

                        $ch = curl_init();

                        curl_setopt($ch, CURLOPT_URL, $gateway_url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
                        curl_setopt($ch, CURLOPT_POST, 1);

                        $headers   = [];
                        $headers[] = "Authorization: AccessKey $sending_server->api_key";
                        $headers[] = "Content-Type: application/x-www-form-urlencoded";
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                        $result = curl_exec($ch);
                        if (curl_errno($ch)) {
                            $get_sms_status = curl_error($ch);
                        } else {
                            $response = json_decode($result, true);

                            if (is_array($response) && array_key_exists('id', $response)) {
                                $get_sms_status = 'Delivered|'.$response['id'];
                            } elseif (is_array($response) && array_key_exists('errors', $response)) {
                                $get_sms_status = $response['errors'][0]['description'];
                            } else {
                                $get_sms_status = 'Unknown Error';
                            }
                        }
                        curl_close($ch);
                        break;

                    case 'AmazonSNS':
                        $credentials = [
                                'credentials' => [
                                        'key'    => $sending_server->access_key,
                                        'secret' => $sending_server->secret_access,
                                ],
                                'region'      => $sending_server->region, // < your aws from SNS Topic region
                                'version'     => 'latest',
                        ];

                        $sns = new SnsClient($credentials);

                        $parameters = [
                                'MessageAttributes' => [
                                        'AWS.SNS.SMS.SenderID' => [
                                                'DataType'    => 'String',
                                                'StringValue' => $data['sender_id'],
                                        ],
                                ],
                                "SMSType"           => $sending_server->route,
                                "PhoneNumber"       => '+'.$phone,
                                "Message"           => $message,
                        ];

                        try {
                            $result = $sns->publish($parameters)->toArray();
                            if (is_array($result) && array_key_exists('MessageId', $result)) {
                                $get_sms_status = 'Delivered|'.$result['MessageId'];
                            } else {
                                $get_sms_status = 'Unknown error';
                            }
                        } catch (SnsException $exception) {
                            $get_sms_status = $exception->getAwsErrorMessage();
                        }

                        break;

                    case 'Tyntec':
                        $parameters = [
                                'from'    => $data['sender_id'],
                                'to'      => $phone,
                                'message' => $message,
                        ];

                        try {
                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_USERPWD, "$sending_server->username".":"."$sending_server->password");

                            $headers   = [];
                            $headers[] = "Content-Type: application/json";
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                            $result = curl_exec($ch);
                            curl_close($ch);
                            $result = json_decode($result, true);

                            if (is_array($result) && array_key_exists('requestId', $result)) {
                                $get_sms_status = 'Delivered';
                            } elseif (is_array($result) && array_key_exists('status', $result)) {
                                $get_sms_status = $result['message'];
                            } else {
                                $get_sms_status = 'Invalid request';
                            }

                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'KarixIO':

//                        $find_c_code = substr($phone, 2);
//                        if($find_c_code != '91'){
//                            $phone = '91'.$phone;
//                        }

                        $parameters = [
                                'channel'     => 'sms',
                                'source'      => $data['sender_id'],
                                'destination' => ['+'.$phone],
                                'content'     => [
                                        'text' => $message,
                                ],
                        ];

                        try {

                            $headers = [
                                    'Content-Type:application/json',
                            ];

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt($ch, CURLOPT_USERPWD, "$sending_server->auth_id".":"."$sending_server->auth_token");
                            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $response = curl_exec($ch);
                            curl_close($ch);

                            $get_response = json_decode($response, true);

                            if (isset($get_response) && is_array($get_response)) {
                                if (array_key_exists('objects', $get_response)) {
                                    if ($get_response['objects']['0']['status'] == 'queued') {
                                        $get_sms_status = 'Delivered|'.$get_response['objects']['0']['account_uid'];
                                    } else {
                                        $get_sms_status = $get_response['objects']['0']['status'];
                                    }
                                } elseif (array_key_exists('error', $get_response)) {
                                    $get_sms_status = $get_response['error']['message'];
                                } else {
                                    $get_sms_status = 'Unknown error';
                                }
                            } else {
                                $get_sms_status = 'Unknown error';
                            }

                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'SignalWire':

                        $parameters = [
                                'From' => '+'.$data['sender_id'],
                                'Body' => $message,
                                'To'   => '+'.$phone,
                        ];

                        $sending_url = $gateway_url."/api/laml/2010-04-01/Accounts/$sending_server->project_id/Messages.json";

                        $ch = curl_init();

                        curl_setopt($ch, CURLOPT_URL, $sending_url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
                        curl_setopt($ch, CURLOPT_USERPWD, "$sending_server->project_id".":"."$sending_server->api_token");

                        $get_response = curl_exec($ch);

                        if (curl_errno($ch)) {
                            $get_sms_status = curl_error($ch);
                        } else {

                            $result = json_decode($get_response, true);

                            if (isset($result) && is_array($result) && array_key_exists('status', $result) && array_key_exists('error_code', $result)) {
                                if ($result['status'] == 'queued' && $result['error_code'] === null) {
                                    $get_sms_status = 'Delivered|'.$result['sid'];
                                } else {
                                    $get_sms_status = $result['error_message'];
                                }
                            } elseif (isset($result) && is_array($result) && array_key_exists('status', $result) && array_key_exists('message', $result)) {
                                $get_sms_status = $result['message'];
                            } else {
                                $get_sms_status = $get_response;
                            }

                            if ($get_sms_status === null) {
                                $get_sms_status = 'Check your settings';
                            }
                        }
                        curl_close($ch);

                        break;

                    case 'Telnyx':

                        $phone     = str_replace(['+', '(', ')', '-', " "], '', $phone);
                        $sender_id = str_replace(['+', '(', ')', '-', " "], '', $data['sender_id']);

                        $parameters = [
                                "to"   => '+'.$phone,
                                "text" => $message,
                        ];

                        if (is_numeric($data['sender_id'])) {
                            $parameters['from'] = '+'.$sender_id;
                        } else {
                            $parameters['from']                 = $data['sender_id'];
                            $parameters['messaging_profile_id'] = $sending_server->c1;
                        }


                        try {

                            $headers = [
                                    'Content-Type:application/json',
                                    'Authorization: Bearer '.$sending_server->api_key,
                            ];

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $response = curl_exec($ch);
                            curl_close($ch);

                            $get_response = json_decode($response, true);

                            if (isset($get_response) && is_array($get_response)) {
                                if (array_key_exists('data', $get_response) && array_key_exists('to', $get_response['data']) && $get_response['data']['to'][0]['status'] == 'queued') {
                                    $get_sms_status = 'Delivered';
                                } elseif (array_key_exists('errors', $get_response)) {
                                    $get_sms_status = $get_response['errors'][0]['detail'];
                                } else {
                                    $get_sms_status = (string) $response;
                                }
                            } else {
                                $get_sms_status = 'Unknown error';
                            }

                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'TelnyxNumberPool':

                        $parameters = [
                                "to"                   => '+'.$phone,
                                "text"                 => $message,
                                "messaging_profile_id" => $sending_server->c1,
                        ];

                        try {

                            $headers = [
                                    'Content-Type:application/json',
                                    'Authorization: Bearer '.$sending_server->api_key,
                            ];

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $response = curl_exec($ch);
                            curl_close($ch);

                            $get_response = json_decode($response, true);

                            if (isset($get_response) && is_array($get_response)) {
                                if (array_key_exists('data', $get_response) && array_key_exists('to', $get_response['data']) && $get_response['data']['to'][0]['status'] == 'queued') {
                                    $get_sms_status = 'Delivered';
                                } elseif (array_key_exists('errors', $get_response)) {
                                    $get_sms_status = $get_response['errors'][0]['detail'];
                                } else {
                                    $get_sms_status = (string) $response;
                                }
                            } else {
                                $get_sms_status = 'Unknown error';
                            }

                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'Bandwidth':

                        $parameters = [
                                'from'          => '+'.$data['sender_id'],
                                'to'            => ['+'.$phone],
                                'text'          => $message,
                                'applicationId' => $sending_server->application_id,
                        ];

                        try {

                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_USERPWD, $sending_server->api_token.':'.$sending_server->api_secret);

                            $headers   = [];
                            $headers[] = 'Content-Type: application/json';
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                            $result = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {

                                $result = json_decode($result, true);

                                if (isset($result) && is_array($result)) {
                                    if (array_key_exists('id', $result)) {
                                        $get_sms_status = 'Delivered|'.$result['id'];
                                    } elseif (array_key_exists('error', $result)) {
                                        $get_sms_status = $result['error'];
                                    } elseif (array_key_exists('fieldErrors', $result)) {
                                        $get_sms_status = $result['fieldErrors'][0]['fieldName'].' '.$result['fieldErrors'][0]['description'];
                                    } else {
                                        $get_sms_status = implode(" ", $result);
                                    }
                                } else {
                                    $get_sms_status = $result;
                                }
                            }
                            curl_close($ch);
                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'RouteeNet':

                        $curl = curl_init();

                        curl_setopt_array($curl, [
                                CURLOPT_URL            => "https://auth.routee.net/oauth/token",
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING       => "",
                                CURLOPT_MAXREDIRS      => 10,
                                CURLOPT_TIMEOUT        => 30,
                                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST  => "POST",
                                CURLOPT_POSTFIELDS     => "grant_type=client_credentials",
                                CURLOPT_HTTPHEADER     => [
                                        "authorization: Basic ".base64_encode($sending_server->application_id.":".$sending_server->api_secret),
                                        "content-type: application/x-www-form-urlencoded",
                                ],
                        ]);

                        $response = curl_exec($curl);
                        $err      = curl_error($curl);

                        curl_close($curl);

                        if ($err) {
                            $get_sms_status = $err;
                        } else {
                            $response = json_decode($response, true);

                            if (isset($response) && is_array($response) && array_key_exists('access_token', $response)) {
                                $access_token = $response['access_token'];

                                $parameters = [
                                        'body' => $message,
                                        'to'   => '+'.$phone,
                                        'from' => $data['sender_id'],
                                ];

                                $sendSMS = json_encode($parameters);
                                $curl    = curl_init();

                                curl_setopt_array($curl, [
                                        CURLOPT_URL            => $gateway_url,
                                        CURLOPT_RETURNTRANSFER => true,
                                        CURLOPT_ENCODING       => "",
                                        CURLOPT_MAXREDIRS      => 10,
                                        CURLOPT_TIMEOUT        => 30,
                                        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                                        CURLOPT_CUSTOMREQUEST  => "POST",
                                        CURLOPT_POSTFIELDS     => $sendSMS,
                                        CURLOPT_HTTPHEADER     => [
                                                "authorization: Bearer ".$access_token,
                                                "content-type: application/json",
                                        ],
                                ]);

                                $response = curl_exec($curl);
                                $err      = curl_error($curl);

                                curl_close($curl);

                                if ($err) {
                                    $get_sms_status = $err;
                                } else {
                                    $response = json_decode($response, true);
                                    if (isset($response) && is_array($response) && array_key_exists('status', $response)) {
                                        if ($response['status'] == 'Queued') {
                                            $get_sms_status = 'Delivered';
                                        } else {
                                            $get_sms_status = $response['status'];
                                        }
                                    } else {
                                        $get_sms_status = 'Invalid Request';
                                    }
                                }

                            } else {
                                $get_sms_status = 'Access token not found';
                            }
                        }
                        break;

                    case 'HutchLk':

                        $auth_data = [
                                "username" => $sending_server->username,
                                "password" => $sending_server->password,
                        ];


                        $headers = [
                                'Content-Type: application/json',
                                'Accept: */*',
                                'X-API-VERSION: v1',
                        ];

                        $login_url = rtrim($gateway_url, '/').'/api/login';

                        try {

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $login_url);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($auth_data));
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $get_sms_status = curl_exec($ch);
                            curl_close($ch);

                            $get_response = json_decode($get_sms_status, true);

                            if (isset($get_response) && is_array($get_response) && array_key_exists('accessToken', $get_response)) {
                                $parameters = [
                                        'campaignName' => str_random(10),
                                        'mask'         => $data['sender_id'],
                                        'numbers'      => $phone,
                                        'content'      => $message,
                                ];

                                $sending_url = rtrim($gateway_url, '/').'/api/sendsms';
                                $headers[]   = "Authorization: Bearer ".$get_response['accessToken'];

                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, $sending_url);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                curl_setopt($ch, CURLOPT_POST, 1);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                $get_sms_status = curl_exec($ch);
                                curl_close($ch);

                                $get_response = json_decode($get_sms_status, true);

                                if (isset($get_response) && is_array($get_response)) {
                                    if (array_key_exists('serverRef', $get_response)) {
                                        $get_sms_status = 'Delivered|'.$get_response['serverRef'];
                                    }
                                    if (array_key_exists('message', $get_response)) {
                                        $get_sms_status = $get_response['message'];
                                    }
                                    if (array_key_exists('error', $get_response)) {
                                        $get_sms_status = $get_response['error'];
                                    }
                                }
                            } else {
                                if (array_key_exists('error', $get_response)) {
                                    $get_sms_status = $get_response['error'];
                                }
                            }
                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }

                        break;

                    case 'Teletopiasms':

                        $parameters = [
                                'username'  => $sending_server->username,
                                'password'  => $sending_server->password,
                                'recipient' => $phone,
                                'text'      => $message,
                        ];

                        if ($data['sender_id'] != '') {
                            $parameters['sender'] = $data['sender_id'];
                        }

                        $parameters  = http_build_query($parameters);
                        $gateway_url = $gateway_url.'?'.$parameters;

                        $ch = curl_init();

                        curl_setopt($ch, CURLOPT_URL, $gateway_url);
                        curl_setopt($ch, CURLOPT_HTTPGET, 1);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $headers   = [];
                        $headers[] = "Content-Type: application/x-www-form-urlencoded";
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);


                        $get_sms_status = curl_exec($ch);

                        if (curl_errno($ch)) {
                            $get_sms_status = curl_error($ch);
                        } else {
                            if (substr_count($get_sms_status, 'accepted')) {
                                $get_sms_status = 'Delivered';
                            }
                        }

                        curl_close($ch);
                        break;

                    case 'BroadcasterMobile':

                        $dataFields = [
                                'apiKey'  => (int) $sending_server->api_key,
                                'country' => $sending_server->c1,
                                'dial'    => (int) $data['sender_id'],
                                'tag'     => 'Prueba',
                                'message' => $message,
                                'msisdns' => [$phone],
                        ];

                        try {

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dataFields));
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36");
                            $headers = [
                                    'Content-Type: application/json',
                                    'Authorization: '.$sending_server->api_token,
                            ];

                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            $get_sms_status = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {

                                $output = json_decode($get_sms_status, true);

                                if (isset($output) && is_array($output) && array_key_exists('code', $output)) {
                                    if ($output['code'] == 0) {
                                        $get_sms_status = 'Delivered';
                                    } else {
                                        $get_sms_status = $output['message'];
                                    }
                                }
                            }

                            curl_close($ch);
                        } catch (Exception $ex) {
                            $get_sms_status = $ex->getMessage();
                        }
                        break;

                    case 'Solutions4mobiles':

                        $host         = 'sms.solutions4mobiles.com';
                        $authEndpoint = "https://$host/apis/auth";
                        $sendEndpoint = "https://$host/apis/sms/mt/v2/send";

                        $auth_body = (object) [
                                "type"     => "access_token",
                                "username" => $sending_server->username,
                                "password" => $sending_server->password,
                        ];

                        $auth_curl_params = [
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_POST           => true,
                                CURLOPT_URL            => $authEndpoint,
                                CURLOPT_CONNECTTIMEOUT => 10,
                                CURLOPT_TIMEOUT        => 10,
                                CURLOPT_HTTPHEADER     => ["cache-control: no-cache", "content-type: application/json"],
                                CURLOPT_POSTFIELDS     => json_encode($auth_body),
                        ];

                        //Setup request and execute
                        $auth_curl = curl_init();
                        curl_setopt_array($auth_curl, ($auth_curl_params));
                        $result = curl_exec($auth_curl);


                        $info = curl_getinfo($auth_curl);

                        //If server returned HTTP Status 200 the request was successful
                        if ($info['http_code'] == 200) {
                            //Store access token - Valid for 30 minutes - We must log in every 30 minutes
                            $arr_res      = json_decode($result);
                            $access_token = $arr_res->payload->access_token;
                            //Send SMS
                            //Setup body
                            $send_body = [
                                    (object) [
                                            'to'      => [$phone],
                                            'from'    => $data['sender_id'],
                                            'message' => $message,
                                    ],
                            ];

                            $send_curl_params = [
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_POST           => true,
                                    CURLOPT_URL            => $sendEndpoint,
                                    CURLOPT_CONNECTTIMEOUT => 10,
                                    CURLOPT_TIMEOUT        => 10,
                                    CURLOPT_HTTPHEADER     => ["cache-control: no-cache", "content-type: application/json", "Authorization: Bearer $access_token"],
                                    CURLOPT_POSTFIELDS     => json_encode($send_body),
                            ];

                            //Setup request and execute
                            $send_curl = curl_init();
                            curl_setopt_array($send_curl, ($send_curl_params));
                            $result = curl_exec($send_curl);


                            $send_info = curl_getinfo($send_curl);

                            $output = json_decode($result, true);

                            //If server returned HTTP Status 200 the request was successful
                            if ($send_info['http_code'] == 200) {
                                if (isset($output) && is_array($output) && array_key_exists('payload', $output)) {
                                    $get_sms_status = 'Delivered|'.$output['payload'][0]['id'];
                                } else {
                                    $get_sms_status = json_decode($result);
                                }
                            } else {
                                if (isset($output) && is_array($output) && array_key_exists('errors', $output)) {
                                    $get_sms_status = $output['errors'][0]['message'];
                                } else {
                                    $get_sms_status = json_decode($result);
                                }
                            }
                            curl_close($send_curl);
                        } else {
                            $get_sms_status = json_decode($result);
                        }

                        curl_close($auth_curl);
                        break;

                    case 'BeemAfrica':

                        $parameters = [
                                'source_addr'   => $data['sender_id'],
                                'encoding'      => 0,
                                'schedule_time' => '',
                                'message'       => $message,
                                'recipients'    => [['recipient_id' => rand(1000, 99999), 'dest_addr' => (string) $phone]],
                        ];

                        $ch = curl_init($gateway_url);

                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        curl_setopt_array($ch, [
                                CURLOPT_POST           => true,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_HTTPHEADER     => [
                                        'Authorization:Basic '.base64_encode("$sending_server->api_key:$sending_server->api_secret"),
                                        'Content-Type: application/json',
                                ],
                                CURLOPT_POSTFIELDS     => json_encode($parameters),
                        ]);
                        $response = curl_exec($ch);

                        if ($response === false) {
                            $get_sms_status = curl_error($ch);
                        } else {
                            $output = json_decode($response, true);

                            if (isset($output) && is_array($output) && array_key_exists('code', $output)) {
                                if ($output['code'] == 100) {
                                    $get_sms_status = 'Delivered|'.$output['request_id'];
                                } else {
                                    $get_sms_status = $output['message'];
                                }
                            } else {
                                $get_sms_status = (string) $response;
                            }
                        }
                        break;

                    case 'BulkSMSOnline':

                        $parameters = [
                                'username' => $sending_server->username,
                                'password' => $sending_server->password,
                                'to'       => $phone,
                                'message'  => $message,
                        ];

                        if ($sms_type == 'unicode' || $sms_type == 'arabic') {
                            $parameters['type'] = 'u';
                        } else {
                            $parameters['type'] = 't';
                        }

                        $gateway_url = $gateway_url.'?'.http_build_query($parameters).'&source='.$data['sender_id'];


                        try {

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

                            $get_sms_status = curl_exec($ch);
                            $get_sms_status = trim($get_sms_status);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                if (str_contains($get_sms_status, 'OK')) {
                                    $get_sms_status = 'Delivered|'.str_replace('OK: ', '', $get_sms_status);
                                } else {

                                    switch ($get_sms_status) {

                                        case 'E0002':
                                            $get_sms_status = 'Invalid URL. This means that one of the parameters was not provided or left blank.';
                                            break;

                                        case 'E0003':
                                            $get_sms_status = 'Invalid username or password parameter.';
                                            break;

                                        case 'E0004':
                                            $get_sms_status = 'Invalid type parameter.';
                                            break;

                                        case 'E0005':
                                            $get_sms_status = 'Invalid message.';
                                            break;

                                        case 'E0006':
                                            $get_sms_status = 'Invalid TO number.';
                                            break;

                                        case 'E0007':
                                            $get_sms_status = 'Invalid source (Sender name).';
                                            break;

                                        case 'E0008':
                                            $get_sms_status = 'Authentication failed.';
                                            break;

                                        case 'E0010':
                                            $get_sms_status = 'Internal server error.';
                                            break;

                                        case 'E0022':
                                            $get_sms_status = 'Insufficient credit.';
                                            break;

                                        case 'E0033':
                                            $get_sms_status = 'If more than 30 API request per second throughput restriction by default';
                                            break;

                                        case 'E0044':
                                            $get_sms_status = 'mobile network not supported';
                                            break;
                                    }
                                }
                            }

                            curl_close($ch);
                        } catch (Exception $ex) {
                            $get_sms_status = $ex->getMessage();
                        }
                        break;

                    case 'FlowRoute':
                        $phone     = str_replace(['+', '(', ')', '-', " "], '', $phone);
                        $sender_id = str_replace(['+', '(', ')', '-', " "], '', $data['sender_id']);

                        $sms = [
                                "from" => $sender_id,
                                "to"   => $phone,
                                "body" => $message,
                        ];

                        try {

                            $headers   = [];
                            $headers[] = 'Content-Type: application/vnd.api+json';

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($sms));
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_USERPWD, $sending_server->access_key.':'.$sending_server->api_secret);

                            $response = curl_exec($ch);
                            curl_close($ch);

                            $get_response = json_decode($response, true);

                            if (isset($get_response) && is_array($get_response)) {
                                if (array_key_exists('data', $get_response)) {
                                    $get_sms_status = 'Delivered';
                                } elseif (array_key_exists('errors', $get_response)) {
                                    $get_sms_status = $get_response['errors'][0]['detail'];
                                } else {
                                    $get_sms_status = (string) $response;
                                }
                            } else {
                                $get_sms_status = (string) $response;
                            }

                        } catch (Exception $ex) {
                            $get_sms_status = $ex->getMessage();
                        }
                        break;

                    case SendingServer::TYPE_CHEAPGLOBALSMS:

                        $parameters = [
                                'sub_account'      => $sending_server->username,
                                'sub_account_pass' => $sending_server->password,
                                'action'           => 'send_sms',
                                'sender_id'        => $data['sender_id'],
                                'recipients'       => $phone,
                                'message'          => $message,
                        ];

                        if ($sms_type == 'unicode') {
                            $parameters['unicode'] = 1;
                        }

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $gateway_url);
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        $response      = curl_exec($ch);
                        $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                        if ($response_code != 200) {
                            $get_sms_status = curl_error($ch);
                        } else {
                            if ($response_code != 200) {
                                $get_sms_status = "HTTP ERROR $response_code: $response";
                            } else {
                                $json = @json_decode($response, true);

                                if ($json === null) {
                                    $get_sms_status = "INVALID RESPONSE: $response";
                                } elseif ( ! empty($json['error'])) {
                                    $get_sms_status = $json['error'];
                                } else {
                                    $get_sms_status = 'Delivered|'.$json['batch_id'];
                                }
                            }
                        }
                        curl_close($ch);
                        break;

                    case 'ElitBuzzBD':
                        $parameters = [
                                'api_key'  => $sending_server->api_key,
                                'contacts' => $phone,
                                'senderid' => $data['sender_id'],
                                'msg'      => $message,
                        ];

                        if ($sms_type == 'unicode' || $sms_type == 'arabic') {
                            $parameters['type'] = 'unicode';
                        } else {
                            $parameters['type'] = 'text';
                        }

                        $gateway_url = $gateway_url.'?'.http_build_query($parameters);


                        try {

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

                            $get_sms_status = curl_exec($ch);

                            $get_sms_status = trim($get_sms_status);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                if (str_contains($get_sms_status, 'SMS SUBMITTED')) {
                                    $get_sms_status = 'Delivered';
                                } else {

                                    switch ($get_sms_status) {

                                        case '1002':
                                            $get_sms_status = 'Sender Id/Masking Not Found';
                                            break;

                                        case '1003':
                                            $get_sms_status = 'API Not found';
                                            break;

                                        case '1004':
                                            $get_sms_status = 'SPAM Detected';
                                            break;

                                        case '1005':
                                        case '1006':
                                            $get_sms_status = 'Internal Error';
                                            break;

                                        case '1007':
                                            $get_sms_status = 'Balance Insufficient';
                                            break;

                                        case '1008':
                                            $get_sms_status = 'Message is empty';
                                            break;

                                        case '1009':
                                            $get_sms_status = 'Message Type Not Set (text/unicode)';
                                            break;

                                        case '1010':
                                            $get_sms_status = 'Invalid User & Password';
                                            break;

                                        case '1011':
                                            $get_sms_status = 'Invalid User Id';
                                            break;

                                        case '1012':
                                            $get_sms_status = 'Invalid Number';
                                            break;

                                        case '1013':
                                            $get_sms_status = 'API limit error';
                                            break;

                                        case '1014':
                                            $get_sms_status = 'No matching template';
                                            break;
                                    }
                                }
                            }

                            curl_close($ch);
                        } catch (Exception $ex) {
                            $get_sms_status = $ex->getMessage();
                        }
                        break;

                    case 'GreenWebBD':

                        $parameters = [
                                'to'      => $phone,
                                'message' => $message,
                                'token'   => $sending_server->api_token,
                        ];

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $gateway_url);
                        curl_setopt($ch, CURLOPT_ENCODING, '');
                        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $response = curl_exec($ch);

                        if ($response === false) {
                            $get_sms_status = curl_error($ch);
                        } else {
                            $output = json_decode($response, true);

                            if (isset($output) && is_array($output) && array_key_exists('status', $output[0])) {
                                if ($output[0]['status'] == 'SENT') {
                                    $get_sms_status = 'Delivered';
                                } else {
                                    $get_sms_status = $output[0]['statusmsg'];
                                }
                            } else {
                                $get_sms_status = (string) $response;
                            }
                        }

                        curl_close($ch);

                        break;

                    case 'HablameV2':
                        $parameters = [
                                'account'           => $sending_server->c1,
                                'apiKey'            => $sending_server->api_key,
                                'token'             => $sending_server->api_token,
                                'toNumber'          => $phone,
                                'sms'               => $message,
                                'isPriority'        => 1,
                                'flash'             => 0,
                                'request_dlvr_rcpt' => 0,
                        ];

                        if (isset($data['sender_id'])) {
                            $parameters['sc'] = $data['sender_id'];
                        }

                        $ch = curl_init();

                        curl_setopt($ch, CURLOPT_URL, $gateway_url);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
                        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
                        $response = curl_exec($ch);
                        curl_close($ch);

                        $response = json_decode($response, true);

                        if (isset($response) && is_array($response) && array_key_exists('status', $response)) {
                            if ($response["status"] == '1x000') {
                                $get_sms_status = 'Delivered';
                            } else {
                                $get_sms_status = $response["error_description"];
                            }
                        } else {
                            $get_sms_status = 'Invalid Request';
                        }
                        break;

                    case SendingServer::TYPE_EASYSENDSMS:

                        if (is_numeric($data['sender_id'])) {
                            $sender_id = str_replace(['(', ')', '+', '-', ' '], '', $data['sender_id']);
                        } else {
                            $sender_id = $data['sender_id'];
                        }

                        if ($sms_type == 'unicode') {
                            $data_encoding = 1;
                        } else {
                            $data_encoding = 0;
                        }

                        $parameters = http_build_query([
                                'username' => $sending_server->username,
                                'password' => $sending_server->password,
                                'to'       => $phone,
                                'text'     => $message,
                                'type'     => $data_encoding,
                                'from'     => $sender_id,
                        ]);

                        try {

                            $sms_sent_to_user = $gateway_url."?".$parameters;

                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $sms_sent_to_user);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $get_response = curl_exec($ch);
                            curl_close($ch);

                            $get_response = trim($get_response);

                            $result = explode(":", $get_response);
                            if (isset($result) && is_array($result) && count($result) > 0 && $result['0'] == 'OK') {
                                $get_sms_status = 'Delivered|'.trim($result['1']);
                            } else {

                                $data_code = filter_var($get_response, FILTER_SANITIZE_NUMBER_INT);

                                $get_sms_status = match ($data_code) {
                                    '1001' => 'Invalid URL. This means that one of the parameters was not provided or left blank',
                                    '1002' => 'Invalid username or password parameter',
                                    '1003' => 'Invalid type parameter',
                                    '1004' => 'Invalid message',
                                    '1005' => 'Invalid mobile number',
                                    '1006' => 'Invalid Sender name',
                                    '1007' => 'Insufficient credit',
                                    '1008' => 'Internal error',
                                    '1009' => 'Service not available',
                                    default => 'Unknown error',
                                };

                            }

                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'ZamtelCoZm':

                        $parameters = [
                                'key'      => $sending_server->api_key,
                                'senderid' => $data['sender_id'],
                                'contacts' => $phone,
                                'message'  => $message,
                        ];

                        $parameters = http_build_query($parameters);

                        try {
                            $gateway_url = $gateway_url.'?'.$parameters;


                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

                            $get_sms_status = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {

                                $get_data = json_decode($get_sms_status, true);

                                if (isset($get_data) && is_array($get_data) && array_key_exists('success', $get_data)) {
                                    if ($get_data['success']) {
                                        $get_sms_status = 'Delivered';
                                    } else {
                                        $get_sms_status = $get_data['responseText'];
                                    }
                                }
                            }

                            curl_close($ch);

                        } catch (Exception $ex) {
                            $get_sms_status = $ex->getMessage();
                        }

                        break;

                    case 'CellCast':

                        $parameters = [
                                'sms_text' => $message,
                                'numbers'  => [$phone],
                        ];

                        if (isset($data['sender_id'])) {
                            $parameters['from'] = $data['sender_id'];
                        }

                        try {

                            $headers = [
                                    'APPKEY:'.$sending_server->api_key,
                                    'Accept: application/json',
                                    'Content-Type: application/json',
                            ];

                            $ch = curl_init(); //open connection
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt($ch, CURLOPT_HEADER, false);
                            curl_setopt($ch, CURLOPT_POST, count($parameters));
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            if ( ! $result = curl_exec($ch)) {
                                $get_sms_status = json_decode(curl_error($ch));
                            } else {
                                $output = json_decode($result, true);
                                if (isset($output) && is_array($output) && array_key_exists('msg', $output)) {
                                    if ($output['msg'] == 'Queued') {
                                        $get_sms_status = 'Delivered';
                                    } else {
                                        $get_sms_status = $output['msg'];
                                    }
                                }
                            }
                            curl_close($ch);

                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'AfricasTalking':

                        $parameters = [
                                'username' => $sending_server->username,
                                'message'  => $message,
                                'to'       => $phone,
                                'from'     => $data['sender_id'],
                        ];

                        try {

                            $headers = [
                                    'apiKey:'.$sending_server->api_key,
                                    'Accept: application/json',
                                    'Content-Type: application/x-www-form-urlencoded',
                            ];

                            $ch = curl_init(); //open connection
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt($ch, CURLOPT_HEADER, false);
                            curl_setopt($ch, CURLOPT_POST, count($parameters));
                            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                            if ( ! $result = curl_exec($ch)) {
                                $get_sms_status = json_decode(curl_error($ch));
                            } else {
                                $output = json_decode($result, true);

                                if (isset($output) && is_array($output) && array_key_exists('SMSMessageData', $output)) {
                                    if (str_contains($output['SMSMessageData']['Message'], 'Sent')) {
                                        $get_sms_status = 'Delivered|'.$output['SMSMessageData']['Recipients']['0']['messageId'];
                                    } else {
                                        $get_sms_status = $output['SMSMessageData']['Message'];
                                    }
                                }
                            }
                            curl_close($ch);

                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'CaihCom':

                        $parameters = [
                                'toNumber'  => $phone,
                                'message'   => $message,
                                'requestId' => time(),
                                'sendType'  => 'S0001',
                                'token'     => $sending_server->api_token,
                        ];

                        if (isset($data['sender_id'])) {
                            $parameters['from'] = $data['sender_id'];
                        }
                        $parameters = json_encode($parameters);

                        $md5Sum = md5($parameters.$sending_server->c1);

                        try {

                            $headers = [
                                    'Content-Type:application/json;charset=UTF-8',
                                    'md5Sum: '.$md5Sum,
                            ];

                            $ch = curl_init(); //open connection
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt($ch, CURLOPT_HEADER, false);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                            if ( ! $result = curl_exec($ch)) {
                                $get_sms_status = json_decode(curl_error($ch));
                            } else {
                                $output = json_decode($result, true);

                                if (isset($output) && is_array($output) && array_key_exists('success', $output) && array_key_exists('desc', $output)) {
                                    if ($output['success']) {
                                        $get_sms_status = 'Delivered|'.$output['messageId'];
                                    } else {
                                        $get_sms_status = $output['desc'];
                                    }
                                }
                            }
                            curl_close($ch);

                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'KeccelSMS':

                        $parameters = [
                                'pass'   => $sending_server->password,
                                'id'     => $sending_server->application_id,
                                'from'   => $data['sender_id'],
                                'to'     => $phone,
                                'text'   => $message,
                                'dlrreq' => 1,
                        ];

                        $parameters = http_build_query($parameters);

                        try {
                            $gateway_url = $gateway_url.'?user=&'.$parameters;

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

                            $get_sms_status = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                if (is_numeric($get_sms_status)) {
                                    $get_sms_status = 'Delivered|'.$get_sms_status;
                                } else {
                                    $get_sms_status = 'Invalid gateway information';
                                }
                            }

                            curl_close($ch);

                        } catch (Exception $ex) {
                            $get_sms_status = $ex->getMessage();
                        }
                        break;

                    case 'JohnsonConnect':

                        $parameters = [
                                'appkey'    => $sending_server->api_key,
                                'secretkey' => $sending_server->api_secret,
                                'phone'     => $phone,
                                'content'   => $message,
                        ];

                        if (isset($data['sender_id'])) {
                            $parameters['source_address'] = $data['sender_id'];
                        }

                        $parameters = http_build_query($parameters);

                        try {
                            $gateway_url = $gateway_url.'?'.$parameters;

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

                            $result = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {

                                $output = json_decode($result, true);

                                if (isset($output) && is_array($output) && array_key_exists('code', $output) && array_key_exists('result', $output)) {
                                    if ($output['code'] == 0) {
                                        $get_sms_status = 'Delivered|'.$output['messageid'];
                                    } else {
                                        $get_sms_status = $output['result'];
                                    }
                                } else {
                                    $get_sms_status = (string) $result;
                                }
                            }

                            curl_close($ch);

                        } catch (Exception $ex) {
                            $get_sms_status = $ex->getMessage();
                        }
                        break;

                    case 'SMSala':
                    case 'SpeedaMobile':

                        $parameters = [
                                'api_id'       => $sending_server->auth_id,
                                'api_password' => $sending_server->password,
                                'sms_type'     => 'P',
                                'phonenumber'  => $phone,
                                'sender_id'    => $data['sender_id'],
                                'textmessage'  => $message,
                        ];

                        if ($sms_type == 'unicode' || $sms_type == 'arabic') {
                            $parameters['encoding'] = 'U';
                        } else {
                            $parameters['encoding'] = 'T';
                        }

                        $gateway_url = $gateway_url.'?'.http_build_query($parameters);

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $gateway_url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_HTTPGET, 1);

                        $get_sms_status = curl_exec($ch);

                        if (curl_errno($ch)) {
                            $get_sms_status = curl_error($ch);
                        } else {

                            $get_data = json_decode($get_sms_status, true);

                            if (is_array($get_data) && array_key_exists('status', $get_data)) {
                                if ($get_data['status'] == 'S') {
                                    $get_sms_status = 'Delivered|'.$get_data['message_id'];
                                } else {
                                    $get_sms_status = $get_data['remarks'];
                                }
                            }
                        }
                        curl_close($ch);
                        break;

                    case 'Text2World':

                        $parameters = http_build_query([
                                'username' => $sending_server->username,
                                'password' => $sending_server->password,
                                'type'     => 'TEXT',
                                'mobile'   => $phone,
                                'message'  => $message,
                                'sender'   => $data['sender_id'],
                        ]);

                        try {

                            $sms_sent_to_user = $gateway_url."?".$parameters;

                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $sms_sent_to_user);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                            $get_sms_status = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } elseif (substr_count(strtolower($get_sms_status), 'success') == 1) {
                                $get_sms_status = 'Delivered';
                            }
                            curl_close($ch);
                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }

                        break;

                    case 'EnableX':

                        $headers   = [];
                        $headers[] = "Content-Type: application/json";
                        $headers[] = "Authorization: Basic ".base64_encode("$sending_server->application_id:$sending_server->api_key");

                        $parameters = [
                                'body'        => $message,
                                'type'        => 'sms',
                                'campaign_id' => $sending_server->c1,
                                'to'          => [
                                        $phone,
                                ],
                        ];

                        if (isset($data['sender_id'])) {
                            $parameters['from'] = $data['sender_id'];
                        }

                        if ($sms_type == 'unicode') {
                            $parameters['data_coding'] = 'unicode';
                        } else {
                            $parameters['data_coding'] = 'auto';
                        }

                        try {
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $response = curl_exec($ch);
                            curl_close($ch);

                            $get_response = json_decode($response, true);

                            if (isset($get_response) && is_array($get_response) && array_key_exists('result', $get_response)) {
                                if ($get_response['result'] == '0') {
                                    $get_sms_status = 'Delivered|'.$get_response['job_id'];
                                } else {
                                    $get_sms_status = $get_response['desc'];
                                }
                            } else {
                                $get_sms_status = (string) $response;
                            }

                        } catch (Exception $ex) {
                            $get_sms_status = $ex->getMessage();
                        }
                        break;

                    case 'SpoofSend':
                    case 'AlhajSms':
                    case 'SendroidUltimate':
                    case 'RealSMS':

                        $parameters = [
                                'apikey'   => $sending_server->api_key,
                                'apitoken' => $sending_server->api_token,
                                'to'       => $phone,
                                'from'     => $data['sender_id'],
                                'text'     => $message,
                        ];


                        if ($sms_type == 'unicode' || $sms_type == 'arabic') {
                            $parameters['type'] = 'unicode';
                        } else {
                            $parameters['type'] = 'sms';
                        }

                        $parameters  = http_build_query($parameters);
                        $gateway_url = $gateway_url.'?sendsms&'.$parameters;

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $gateway_url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_HTTPGET, 1);

                        $get_sms_status = curl_exec($ch);

                        if (curl_errno($ch)) {
                            $get_sms_status = curl_error($ch);
                        } else {

                            $get_data = json_decode($get_sms_status, true);

                            if (is_array($get_data) && array_key_exists('status', $get_data)) {
                                if ($get_data['status'] == 'error') {
                                    $get_sms_status = $get_data['message'];
                                } else {
                                    $get_sms_status = 'Delivered';
                                }
                            }
                        }
                        curl_close($ch);
                        break;

                    case 'Callr':

                        $random_data        = str_random(10);
                        $options            = new stdClass();
                        $options->user_data = $random_data;

                        $phone = str_replace(['+', '(', ')', '-', " "], '', $phone);

                        $parameters = [
                                'to'      => '+'.$phone,
                                'body'    => $message,
                                'options' => $options,
                        ];

                        if (isset($data['sender_id'])) {
                            $parameters['from'] = $data['sender_id'];
                        }

                        try {
                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

                            $headers   = [];
                            $headers[] = "Authorization: Basic ".base64_encode("$sending_server->username:$sending_server->password");
                            $headers[] = "Content-Type: application/json";
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                            $result = curl_exec($ch);
                            curl_close($ch);

                            $result = json_decode($result, true);

                            if (is_array($result) && array_key_exists('status', $result)) {

                                if ($result['status'] == 'error') {
                                    $get_sms_status = $result['data']['message'];
                                } else {
                                    $get_sms_status = 'Delivered|'.$random_data;
                                }

                            } else {
                                $get_sms_status = 'Invalid request';
                            }

                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;


                    case 'Skyetel':
                        $parameters = [
                                'to'   => $phone,
                                'text' => $message,
                        ];

                        if (isset($data['sender_id'])) {
                            $gateway_url .= "?from=".$data['sender_id'];
                        }

                        try {
                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

                            $headers   = [];
                            $headers[] = "Authorization: Basic ".base64_encode("$sending_server->account_sid:$sending_server->api_secret");
                            $headers[] = "Content-Type: application/json";
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                            $result = curl_exec($ch);
                            curl_close($ch);

                            $result = json_decode($result, true);

                            if (is_array($result)) {
                                if (array_key_exists('direction', $result)) {
                                    $get_sms_status = 'Delivered';
                                } elseif (array_key_exists('message', $result)) {
                                    $get_sms_status = $result['message'];
                                } else {
                                    $get_sms_status = implode(' ', $result);
                                }
                            } else {
                                $get_sms_status = 'Invalid request';
                            }

                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'LTR':

                        $parameters = [
                                'username' => $sending_server->username,
                                'password' => $sending_server->password,
                                'api_key'  => $sending_server->api_key,
                                'phone'    => $phone,
                                'message'  => $message,
                                'sender'   => $data['sender_id'],
                        ];

                        if ($sms_type == 'unicode') {
                            $parameters['type'] = 'Urdu';
                        } else {
                            $parameters['type'] = 'English';
                        }

                        try {

                            $sms_sent_to_user = $gateway_url."?".http_build_query($parameters);

                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $sms_sent_to_user);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                            $get_sms_status = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                if (str_contains($get_sms_status, 'sent')) {
                                    $get_sms_status = 'Delivered';
                                }
                            }
                            curl_close($ch);
                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }

                        break;


                    case 'Bulksmsplans':

                        $parameters = [
                                'api_id'       => $sending_server->auth_id,
                                'api_password' => $sending_server->password,
                                'sms_type'     => $sending_server->route,
                                'number'       => $phone,
                                'message'      => $message,
                                'sender'       => $data['sender_id'],
                        ];

                        if ($sms_type == 'unicode') {
                            $parameters['sms_encoding'] = 'unicode';
                        } else {
                            $parameters['sms_encoding'] = 'text';
                        }

                        try {

                            $sms_sent_to_user = $gateway_url."?".http_build_query($parameters);

                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $sms_sent_to_user);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                            $output = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                $result = json_decode($output, true);

                                if (is_array($result) && array_key_exists('code', $result)) {
                                    if ($result['code'] == '200') {
                                        $get_sms_status = 'Delivered';
                                    } else {
                                        $get_sms_status = $result['message'];
                                    }
                                } else {
                                    $get_sms_status = implode(' ', $result);
                                }
                            }
                            curl_close($ch);
                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'Sinch':
                        $parameters = [
                                'from' => urlencode($data['sender_id']),
                                'to'   => [
                                        $phone,
                                ],
                                'body' => $message,
                        ];

                        try {

                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                            curl_setopt($ch, CURLOPT_POST, 1);

                            $headers   = [];
                            $headers[] = "Authorization: Bearer $sending_server->api_token";
                            $headers[] = "Content-Type: application/json";
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                            $result = curl_exec($ch);
                            curl_close($ch);

                            $result = json_decode($result, true);

                            if (is_array($result) && array_key_exists('id', $result)) {
                                $batch_id  = $result['id'];
                                $recipient = $result['to'][0];

                                $curl = curl_init();

                                curl_setopt($curl, CURLOPT_URL, $gateway_url."/".$batch_id."/delivery_report/".$recipient);
                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");


                                $headers   = [];
                                $headers[] = "Authorization: Bearer $sending_server->api_token";
                                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

                                $result = curl_exec($curl);
                                curl_close($curl);

                                $get_data = json_decode($result, true);

                                if (is_array($get_data) && array_key_exists('status', $get_data)) {
                                    if ($get_data['status'] == 'Delivered' || $get_data['status'] == 'Queued' || $get_data['status'] == 'Dispatched') {
                                        $get_sms_status = 'Delivered';
                                    } else {
                                        $get_sms_status = $get_data['status'];
                                    }
                                } else {
                                    $get_sms_status = 'Invalid request';
                                }
                            } else {
                                $get_sms_status = 'Invalid request';
                            }
                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'D7Networks':

                        $parameters = [
                                "to"      => $phone,
                                "from"    => $data['sender_id'],
                                "content" => $message,
                        ];

                        $headers = [
                                'Content-Type: application/x-www-form-urlencoded',
                                'Authorization: Basic '.base64_encode($sending_server->username.":".$sending_server->password),
                        ];

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        curl_setopt($ch, CURLOPT_URL, $gateway_url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                        $get_data = curl_exec($ch);

                        if (curl_error($ch)) {
                            $get_sms_status = curl_error($ch);
                        } else {

                            $get_response = json_decode($get_data, true);

                            if (isset($get_response) && is_array($get_response)) {
                                if (array_key_exists('data', $get_response)) {
                                    $get_sms_status = 'Delivered';
                                } else {
                                    $get_sms_status = $get_response['message'];
                                }
                            } else {
                                $get_sms_status = implode(' ', $get_response);
                            }
                        }
                        curl_close($ch);

                        break;

                    case 'CMCOM':

                        $random_data = str_random(10);

                        $parameters = [
                                'messages' => [
                                        'authentication' => [
                                                'productToken' => $sending_server->api_token,
                                        ],
                                        'msg'            => [
                                                [
                                                        'from'                        => $data['sender_id'],
                                                        'body'                        => [
                                                                'content' => $message,
                                                                'type'    => 'auto',
                                                        ],
                                                        'minimumNumberOfMessageParts' => 1,
                                                        'maximumNumberOfMessageParts' => 8,
                                                        'to'                          => [
                                                                [
                                                                        'number' => '+'.$phone,
                                                                ],
                                                        ],
                                                        'allowedChannels'             => [
                                                                'SMS',
                                                        ],
                                                        'reference'                   => $random_data,
                                                ],
                                        ],
                                ],
                        ];

                        $headers = [
                                'Content-Type:application/json;charset=UTF-8',
                        ];

                        $ch = curl_init(); //open connection
                        curl_setopt($ch, CURLOPT_URL, $gateway_url);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        curl_setopt($ch, CURLOPT_HEADER, false);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        if ( ! $result = curl_exec($ch)) {
                            $get_sms_status = json_decode(curl_error($ch));
                        } else {
                            $output = json_decode($result, true);

                            if (isset($output) && is_array($output) && array_key_exists('errorCode', $output) && array_key_exists('details', $output)) {
                                if ($output['errorCode'] == 0) {
                                    $get_sms_status = 'Delivered|'.$random_data;
                                } else {
                                    $get_sms_status = $output['details'];
                                }
                            } else {
                                $get_sms_status = (string) $output;
                            }
                        }
                        curl_close($ch);
                        break;

                    case 'PitchWink':
                        $parameters = [
                                'version'        => '4.00',
                                'credential'     => $sending_server->c1,
                                'token'          => $sending_server->api_token,
                                'function'       => 'SEND_MESSAGE',
                                'principal_user' => "",
                                'messages'       => [
                                        [
                                                'id_extern'    => $data['sender_id'],
                                                'aux_user'     => uniqid(),
                                                'mobile'       => $phone,
                                                'send_project' => 'N',
                                                'message'      => $message,
                                        ],
                                ],
                        ];

                        try {

                            $ch = curl_init(); //open connection
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_HEADER, false);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                            if ( ! $result = curl_exec($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                $output = json_decode($result, true);

                                if (isset($output) && is_array($output) && array_key_exists('returncode', $output)) {
                                    switch ($output['returncode']) {
                                        case '000':
                                            $get_sms_status = 'Delivered';
                                            break;

                                        case '001':
                                            $get_sms_status = 'Credential and/or Token invalids';
                                            break;

                                        case '002':
                                            $get_sms_status = 'API not available for Test Accounts';
                                            break;

                                        case '003':
                                            $get_sms_status = 'Account Inactive';
                                            break;

                                        case '004':
                                            $get_sms_status = 'Exceeded the limit of 20.000 messages';
                                            break;

                                        case '005':
                                            $get_sms_status = 'Wrong Version';
                                            break;

                                        case '006':
                                            $get_sms_status = 'Version is invalid';
                                            break;

                                        case '007':
                                            $get_sms_status = 'Function does not exist';
                                            break;

                                        case '008':
                                            $get_sms_status = 'Attribute invalid';
                                            break;

                                        case '009':
                                            $get_sms_status = 'Account blocked';
                                            break;

                                        case '600':
                                        case '601':
                                        case '602':
                                        case '603':
                                            $get_sms_status = 'Json is invalid';
                                            break;

                                        case '900':
                                        case '901':
                                        case '902':
                                            $get_sms_status = 'Internal Error';
                                            break;

                                        case '905':
                                            $get_sms_status = 'POST not accepted. Send again';
                                            break;
                                    }

                                } else {
                                    $get_sms_status = (string) $output;
                                }
                            }
                            curl_close($ch);

                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'Wavy':
                        $parameters = [
                                "destination" => $phone,
                                "messageText" => $message,
                        ];

                        $headers = [
                                "authenticationtoken: $sending_server->auth_token",
                                "username: $sending_server->username",
                                "content-type: application/json",
                        ];

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        curl_setopt($ch, CURLOPT_URL, $gateway_url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                        $get_data = curl_exec($ch);

                        if (curl_error($ch)) {
                            $get_sms_status = curl_error($ch);
                        } else {

                            $get_response = json_decode($get_data, true);

                            if (isset($get_response) && is_array($get_response)) {
                                if (array_key_exists('id', $get_response)) {
                                    $get_sms_status = 'Delivered';
                                } elseif (array_key_exists('errorMessage', $get_response)) {
                                    $get_sms_status = $get_response['errorMessage'];
                                }
                            } else {
                                $get_sms_status = implode(' ', $get_response);
                            }
                        }
                        curl_close($ch);
                        break;

                    case 'Solucoesdigitais':
                        $parameters = [
                                'usuario'              => $sending_server->username,
                                'senha'                => $sending_server->password,
                                'centro_custo_interno' => $sending_server->c1,
                                'id_campanha'          => str_random(10),
                                'numero'               => $phone,
                                'mensagem'             => $message,
                        ];

                        try {

                            $sms_sent_to_user = $gateway_url."?".http_build_query($parameters);

                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $sms_sent_to_user);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                            $get_data = curl_exec($ch);

                            if (curl_error($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                $get_response = json_decode($get_data, true);

                                if (isset($get_response) && is_array($get_response) && array_key_exists('status', $get_response)) {
                                    if ($get_response['status']) {
                                        $get_sms_status = 'Delivered';
                                    } else {
                                        $get_sms_status = $get_response['infomacoes'][0];
                                    }
                                } else {
                                    $get_sms_status = implode(' ', $get_response);
                                }
                            }
                            curl_close($ch);
                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;


                    case 'SmartVision':
                        $parameters = [
                                'key'      => $sending_server->api_key,
                                'senderid' => $data['sender_id'],
                                'contacts' => $phone,
                                'campaign' => '6940',
                                'routeid'  => '39',
                                'msg'      => $message,
                        ];

                        if ($sms_type == 'unicode') {
                            $parameters['type'] = 'unicode';
                        } else {
                            $parameters['type'] = 'text';
                        }

                        try {

                            $sms_sent_to_user = $gateway_url."?".http_build_query($parameters);

                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $sms_sent_to_user);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                            $get_response = curl_exec($ch);

                            if (curl_error($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                if (substr_count($get_response, 'SMS SUBMITTED') !== 0) {
                                    $get_sms_status = 'Delivered';
                                } else {
                                    switch (trim($get_response)) {
                                        case '1002':
                                            $get_sms_status = 'Sender Id/Masking Not Found';
                                            break;
                                        case '1003':
                                            $get_sms_status = 'API Key Not Found';
                                            break;
                                        case '1004':
                                            $get_sms_status = 'SPAM Detected';
                                            break;
                                        case '1005':
                                        case '1006':
                                            $get_sms_status = 'Internal Error';
                                            break;
                                        case '1007':
                                            $get_sms_status = 'Balance Insufficient';
                                            break;
                                        case '1008':
                                            $get_sms_status = 'Message is empty';
                                            break;
                                        case '1009':
                                            $get_sms_status = 'Message Type Not Set (text/unicode)';
                                            break;
                                        case '1010':
                                            $get_sms_status = 'Invalid User & Password';
                                            break;
                                        case '1011':
                                            $get_sms_status = 'Invalid User Id';
                                            break;
                                    }
                                }
                            }
                            curl_close($ch);
                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;


                    case 'ZipComIo':

                        $parameters = [
                                'to'        => $phone,
                                'from'      => $data['sender_id'],
                                'content'   => $message,
                                'type'      => 'sms',
                                'simulated' => true,
                        ];

                        try {

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                            curl_setopt($ch, CURLOPT_POST, 1);


                            $headers   = [];
                            $headers[] = "x-api-key: $sending_server->api_key";
                            $headers[] = "Content-Type: application/json";
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                            $get_sms_status = curl_exec($ch);
                            curl_close($ch);

                            $get_data = json_decode($get_sms_status, true);

                            if (is_array($get_data) && array_key_exists('status', $get_data)) {
                                if ($get_data['status'] == 'Message Submitted') {
                                    $get_sms_status = 'Delivered';
                                } else {
                                    $get_sms_status = $get_data['status'];
                                }
                            }

                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'GlobalSMSCN':

                        $time = time();
                        $sign = md5($sending_server->api_key.$sending_server->api_secret.$time);

                        $parameters = [
                                'appId'   => $sending_server->application_id,
                                'numbers' => $phone,
                                'content' => $message,
                        ];

                        if ($data['sender_id']) {
                            $parameters['senderID'] = $data['sender_id'];
                        }

                        $gateway_url = $gateway_url.'?'.http_build_query($parameters);

                        $headers   = [];
                        $headers[] = "Sign: $sign";
                        $headers[] = "Timestamp: $time";
                        $headers[] = "Api-Key: $sending_server->api_key";
                        $headers[] = "Content-Type: application/json;charset=UTF-8";

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $gateway_url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_HTTPGET, 1);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

                        $get_sms_status = curl_exec($ch);

                        if (curl_errno($ch)) {
                            $get_sms_status = curl_error($ch);
                        } else {

                            $get_data = json_decode($get_sms_status, true);

                            if (is_array($get_data) && array_key_exists('status', $get_data)) {
                                $code = $get_data['status'];
                                switch ($code) {

                                    case '0':
                                        $get_sms_status = 'Delivered';
                                        break;

                                    case '-1':
                                        $get_sms_status = 'Authentication error';
                                        break;

                                    case '-2':
                                        $get_sms_status = 'IP access is limited';
                                        break;

                                    case '-3':
                                        $get_sms_status = 'Sensitive words';
                                        break;

                                    case '-4':
                                        $get_sms_status = 'SMS message is empty';
                                        break;

                                    case '-5':
                                        $get_sms_status = 'SMS message is over length';
                                        break;

                                    case '-6':
                                        $get_sms_status = 'Do not match template';
                                        break;

                                    case '-7':
                                        $get_sms_status = 'Receiver numbers over limit';
                                        break;

                                    case '-8':
                                        $get_sms_status = 'Receiver number empty';
                                        break;

                                    case '-9':
                                        $get_sms_status = 'Receiver number abnormal';
                                        break;

                                    case '-10':
                                        $get_sms_status = 'Balance is low';
                                        break;

                                    case '-11':
                                        $get_sms_status = 'Incorrect timing format';
                                        break;

                                    case '-12':
                                        $get_sms_status = 'Due to platform issue,bulk submit is fail,pls contact admin';
                                        break;

                                    case '-13':
                                        $get_sms_status = 'User locked';
                                        break;

                                    case '-16':
                                        $get_sms_status = 'Timestamp expires';
                                        break;
                                }
                            }

                        }
                        curl_close($ch);
                        break;

                    case 'Web2SMS237':


                        $curl = curl_init();

                        curl_setopt_array($curl, [
                                CURLOPT_URL            => 'https://api.web2sms237.com/token',
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING       => '',
                                CURLOPT_MAXREDIRS      => 10,
                                CURLOPT_TIMEOUT        => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST  => 'POST',
                                CURLOPT_HTTPHEADER     => [
                                        'Authorization: Basic '.base64_encode($sending_server->api_key.':'.$sending_server->api_secret),
                                ],
                        ]);

                        $response = curl_exec($curl);

                        curl_close($curl);


                        $response = json_decode($response, true);

                        if (isset($response) && is_array($response) && array_key_exists('access_token', $response)) {
                            $access_token = $response['access_token'];

                            $parameters = [
                                    'text'      => $message,
                                    'phone'     => '+'.$phone,
                                    'sender_id' => $data['sender_id'],
                                    'flash'     => false,
                            ];

                            $sendSMS = json_encode($parameters);
                            $curl    = curl_init();

                            curl_setopt_array($curl, [
                                    CURLOPT_URL            => $gateway_url,
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_ENCODING       => "",
                                    CURLOPT_MAXREDIRS      => 10,
                                    CURLOPT_TIMEOUT        => 30,
                                    CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                                    CURLOPT_CUSTOMREQUEST  => "POST",
                                    CURLOPT_POSTFIELDS     => $sendSMS,
                                    CURLOPT_HTTPHEADER     => [
                                            "authorization: Bearer ".$access_token,
                                            "content-type: application/json",
                                    ],
                            ]);

                            $response = curl_exec($curl);
                            $err      = curl_error($curl);

                            curl_close($curl);

                            if ($err) {
                                $get_sms_status = $err;
                            } else {
                                $response = json_decode($response, true);

                                if (isset($response) && is_array($response)) {

                                    if (array_key_exists('id', $response)) {
                                        $get_sms_status = 'Delivered';
                                    } elseif (array_key_exists('message', $response)) {
                                        $get_sms_status = $response['message'];
                                    } else {
                                        $get_sms_status = 'Failed';
                                    }
                                } else {
                                    $get_sms_status = 'Invalid Request';
                                }
                            }

                        } else {
                            $get_sms_status = 'Access token not found';
                        }

                        break;

                    case 'BongaTech':
                        $parameters = [
                                'username' => $sending_server->username,
                                'password' => $sending_server->password,
                                'phone'    => $phone,
                                'message'  => $message,
                                'sender'   => $data['sender_id'],
                        ];

                        try {

                            $sms_sent_to_user = $gateway_url."?".http_build_query($parameters);

                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $sms_sent_to_user);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                            $get_sms_status = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                $get_data = json_decode($get_sms_status, true);

                                if (is_array($get_data) && array_key_exists('status', $get_data)) {
                                    if ( ! $get_data['status']) {
                                        $get_sms_status = $get_data['message'];
                                    } else {
                                        $get_sms_status = 'Delivered';
                                    }
                                }
                            }
                            curl_close($ch);
                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;


                    case 'FloatSMS':
                        $parameters = [
                                'key'     => $sending_server->api_key,
                                'phone'   => $phone,
                                'message' => $message,
                        ];

                        try {

                            $sms_sent_to_user = $gateway_url."?".http_build_query($parameters);

                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $sms_sent_to_user);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                            $get_sms_status = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                $get_data = json_decode($get_sms_status, true);
                                if (is_array($get_data) && array_key_exists('status', $get_data)) {
                                    if ($get_data['status'] == 200) {
                                        $get_sms_status = 'Delivered';
                                    } else {
                                        $get_sms_status = $get_data['message'];
                                    }
                                }
                            }
                            curl_close($ch);
                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'MaisSMS':

                        $parameters = [
                                [
                                        "numero"      => $phone,
                                        "mensagem"    => $message,
                                        "servico"     => 'short',
                                        "parceiro_id" => $sending_server->c1,
                                        "codificacao" => "0",
                                ],
                        ];

                        try {

                            $headers = [
                                    'Content-Type:application/json',
                                    'Authorization: Bearer '.$sending_server->api_token,
                            ];

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $response = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                $get_response = json_decode($response, true);
                                if (isset($get_response) && is_array($get_response) && array_key_exists('status', $get_response)) {
                                    if ($get_response['status'] == '200') {
                                        $get_sms_status = 'Delivered';
                                    } else {
                                        $get_sms_status = 'Status Code: '.$get_response['status'];
                                    }
                                } else {
                                    $get_sms_status = 'Authentication failed';
                                }
                            }

                            curl_close($ch);

                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'EasySmsXyz':

                        $parameters = [
                                "number"   => $phone,
                                "message"  => $message,
                                "schedule" => null,
                                "key"      => $sending_server->api_key,
                                "devices"  => "0",
                                "type"     => "sms",
                        ];

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $gateway_url);
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
                        $response = curl_exec($ch);
                        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                        if (curl_errno($ch)) {
                            $get_sms_status = curl_error($ch);
                        } else {
                            if ($httpCode == 200) {
                                $json = json_decode($response, true);

                                if ( ! $json) {
                                    if (empty($response)) {
                                        $get_sms_status = 'Missing data in request. Please provide all the required information to send messages.';
                                    } else {
                                        $get_sms_status = $response;
                                    }
                                } else {
                                    if ($json["success"]) {
                                        $get_sms_status = 'Delivered';
                                    } else {
                                        $get_sms_status = $json["error"]["message"];
                                    }
                                }
                            } else {
                                $get_sms_status = 'Error Code: '.$httpCode;
                            }
                        }
                        curl_close($ch);
                        break;

                    case 'Sozuri':
                        $parameters = [
                                'project' => $sending_server->project_id,
                                'from'    => $data['sender_id'],
                                'to'      => $phone,
                                'channel' => 'sms',
                                'message' => $message,
                                'type'    => 'promotional',
                        ];

                        $headers = [
                                "authorization: Bearer $sending_server->api_key",
                                "Content-Type: application/json",
                                "Accept: application/json",
                        ];


                        $ch = curl_init();

                        curl_setopt($ch, CURLOPT_URL, $gateway_url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                        curl_setopt($ch, CURLOPT_POST, 1);

                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                        $result = curl_exec($ch);
                        if (curl_errno($ch)) {
                            $get_sms_status = curl_error($ch);
                        } else {
                            $response = json_decode($result, true);

                            if (is_array($response) && array_key_exists('messageData', $response) && array_key_exists('messages', $response['messageData'])) {
                                if ($response['messageData']['messages']) {
                                    $get_sms_status = 'Delivered';
                                } else {
                                    $get_sms_status = 'Unknown error';
                                }
                            } else {
                                $get_sms_status = 'Unknown Error';
                            }
                        }
                        curl_close($ch);

                        break;

                    case 'ExpertTexting':

                        $parameters = [
                                'username'   => $sending_server->username,
                                'api_key'    => $sending_server->api_key,
                                'api_secret' => $sending_server->api_secret,
                                'from'       => $data['sender_id'],
                                'to'         => $phone,
                                'text'       => $message,
                        ];

                        if ($sms_type == 'unicode') {
                            $parameters['type'] = 'unicode';
                        } else {
                            $parameters['type'] = 'text';
                        }

                        try {

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            $response = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                $result = json_decode($response, true);

                                if (is_array($result) && array_key_exists('Status', $result)) {
                                    if ($result['Status'] == 0) {
                                        $get_sms_status = 'Delivered';
                                    } else {
                                        $get_sms_status = $result['ErrorMessage'];
                                    }
                                } else {
                                    $get_sms_status = (string) $response;
                                }
                            }
                            curl_close($ch);

                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }

                        break;

                    case 'Ejoin':

                        $parameters = [
                                "type"     => "send-sms",
                                "task_num" => 1,
                                "tasks"    => [
                                        [
                                                'tid'  => str_random(),
                                                "from" => $data['sender_id'],
                                                "to"   => $phone,
                                                "sms"  => $message,
                                        ],
                                ],
                        ];

                        $headers = [
                                'Content-Type: text/plain',
                                'Authorization: Basic '.base64_encode($sending_server->username.":".$sending_server->password),
                        ];


                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        curl_setopt($ch, CURLOPT_URL, $gateway_url."?username=".$sending_server->username."&password=".$sending_server->password);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                        $get_data = curl_exec($ch);

                        if (curl_error($ch)) {
                            $get_sms_status = curl_error($ch);
                        } else {

                            $get_response = json_decode($get_data, true);

                            if (isset($get_response) && is_array($get_response) && array_key_exists('code', $get_response) && array_key_exists('reason', $get_response)) {
                                if ($get_response['code'] == 0 || $get_response['code'] == 200) {
                                    $get_sms_status = 'Delivered';
                                } else {
                                    $get_sms_status = $get_response['reason'];
                                }
                            } else {
                                $get_sms_status = $get_response['desc'];
                            }
                        }
                        curl_close($ch);
                        break;


                    case 'BulkSMSNigeria':
                        $parameters = [
                                'api_token' => $sending_server->api_token,
                                'dnd'       => $sending_server->c1,
                                'from'      => $data['sender_id'],
                                'to'        => $phone,
                                'body'      => $message,
                        ];

                        try {

                            $sms_sent_to_user = $gateway_url."?".http_build_query($parameters);

                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $sms_sent_to_user);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                            $get_sms_status = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                $get_data = json_decode($get_sms_status, true);
                                if (is_array($get_data) && array_key_exists('data', $get_data) && array_key_exists('status', $get_data['data'])) {
                                    if ($get_data['data']['status'] == 'success') {
                                        $get_sms_status = 'Delivered';
                                    } else {
                                        $get_sms_status = 'Failed';
                                    }
                                } else {
                                    $get_sms_status = 'Failed';
                                }
                            }
                            curl_close($ch);
                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;


                    case 'SendSMSGate':

                        $parameters = http_build_query([
                                'user' => $sending_server->username,
                                'pwd'  => $sending_server->password,
                                'dadr' => $phone,
                                'text' => $message,
                                'sadr' => $data['sender_id'],
                        ]);

                        try {

                            $sms_sent_to_user = $gateway_url."?".$parameters;

                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $sms_sent_to_user);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $get_sms_status = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                if (is_numeric($get_sms_status)) {
                                    $get_sms_status = 'Delivered';
                                }
                            }
                            curl_close($ch);
                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'Gateway360':
                        $parameters = [
                                'api_key'  => $sending_server->api_key,
                                'concat'   => 1,
                                'messages' => [
                                        [
                                                'from' => $data['sender_id'],
                                                'to'   => $phone,
                                                'text' => $message,
                                        ],
                                ],
                        ];

                        try {

                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                            curl_setopt($ch, CURLOPT_POST, 1);

                            $headers   = [];
                            $headers[] = 'Content-Type: application/json';
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                            $result = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {

                                $result = json_decode($result, true);

                                if (isset($result) && is_array($result) && array_key_exists('status', $result)) {
                                    if ($result['status'] == 'ok') {
                                        $get_sms_status = 'Delivered';
                                    } else {
                                        $get_sms_status = $result['error_msg'];
                                    }

                                } else {
                                    $get_sms_status = $result;
                                }
                            }
                            curl_close($ch);
                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'AjuraTech':

                        $parameters = [
                                'apikey'         => $sending_server->api_key,
                                'secretkey'      => $sending_server->api_secret,
                                'callerID'       => $data['sender_id'],
                                'toUser'         => $phone,
                                'messageContent' => $message,
                        ];

                        try {

                            $sms_sent_to_user = $gateway_url."?".http_build_query($parameters);

                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $sms_sent_to_user);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                            $result = curl_exec($ch);

                            if (curl_error($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {

                                $result = json_decode($result, true);

                                if (isset($result) && is_array($result) && array_key_exists('Status', $result)) {
                                    if ($result['Status'] == '0') {
                                        $get_sms_status = 'Delivered';
                                    } else {
                                        $get_sms_status = $result['Text'];
                                    }

                                } else {
                                    $get_sms_status = $result;
                                }
                            }
                            curl_close($ch);
                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }

                        break;


                    case 'SMSCloudCI':

                        $parameters = [
                                'sender'     => $data['sender_id'],
                                'content'    => $message,
                                'recipients' => [$phone],
                        ];


                        try {

                            $headers = [
                                    'Content-Type: application/json',
                                    'cache-control: no-cache',
                                    'Authorization: Bearer '.$sending_server->api_token,
                            ];

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $response = curl_exec($ch);
                            curl_close($ch);

                            $get_response = json_decode($response, true);

                            if (isset($get_response) && is_array($get_response)) {
                                if (array_key_exists('status', $get_response)) {
                                    if ($get_response['status'] == 200) {
                                        $get_sms_status = 'Delivered';
                                    } else {
                                        $get_sms_status = $get_response['statusMessage'];
                                    }
                                } elseif (array_key_exists('id', $get_response)) {
                                    $get_sms_status = 'Delivered|'.$get_response['id'];
                                } else {
                                    $get_sms_status = (string) $response;
                                }
                            } else {
                                $get_sms_status = (string) $response;
                            }

                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;


                    case 'LifetimeSMS':

                        $parameters = [
                                'api_token'  => $sending_server->api_token,
                                'api_secret' => $sending_server->api_secret,
                                'from'       => $data['sender_id'],
                                'message'    => $message,
                                'to'         => $phone,
                        ];


                        try {

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_HEADER, 0);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
                            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                            $get_sms_status = curl_exec($ch);
                            curl_close($ch);

                            if (substr_count($get_sms_status, 'OK') == 1) {
                                $get_sms_status = explode(':', $get_sms_status);
                                if (isset($get_sms_status) && is_array($get_sms_status) && array_key_exists('3', $get_sms_status)) {
                                    $get_sms_status = 'Delivered|'.trim($get_sms_status['3']);
                                } else {
                                    $get_sms_status = 'Delivered';
                                }
                            } else {
                                $get_sms_status = str_replace('ERROR:', '', $get_sms_status);
                            }

                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'PARATUS':

                        $parameters = [
                                'app' => 'ws',
                                'u'   => $sending_server->username,
                                'h'   => $sending_server->api_token,
                                'to'  => $phone,
                                'op'  => 'pv',
                                'msg' => $message,
                        ];

                        if (isset($data['sender_id'])) {
                            $parameters['from'] = $data['sender_id'];
                        }

                        try {
                            $sms_sent_to_user = $gateway_url."?".http_build_query($parameters);

                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $sms_sent_to_user);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                            $result = curl_exec($ch);

                            if (curl_error($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {

                                $response = json_decode($result, true);

                                if (is_array($response) && array_key_exists('data', $response)) {
                                    $get_sms_status = 'Delivered|'.$response['data'][0]['smslog_id'];
                                } elseif (is_array($response) && array_key_exists('error', $response)) {
                                    $get_sms_status = $response['error_string'];
                                } else {
                                    $get_sms_status = (string) $result;
                                }
                            }
                            curl_close($ch);
                        } catch (Exception $exception) {
                            $get_sms_status = $exception->getMessage();
                        }
                        break;

                    case 'MOOVCI':

                        $timestamp = date('Y-m-d H:i:s');
                        $token     = md5("$sending_server->c1"."$sending_server->api_key".$timestamp);

                        $parameters = [
                                'recipients' => $phone,
                                'sendmode'   => 0,
                                'message'    => utf8_decode($message),
                                'smstype'    => 'normal',
                                'sendername' => $data['sender_id'],
                        ];

                        $headers = [
                                'apiKey: '.$sending_server->api_key,
                                'login: '.$sending_server->c1,
                                'timeStamp: '.$timestamp,
                                'token: '.$token,
                        ];

                        try {

                            $ch = curl_init($gateway_url);
                            curl_setopt($ch, CURLOPT_FAILONERROR, false);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            $result = curl_exec($ch);
                            curl_close($ch);

                            $response = json_decode($result, true);

                            if (is_array($response) && array_key_exists('smsResponse', $response)) {
                                $get_sms_status = 'Delivered';
                            } else {
                                $get_sms_status = array_key_first($response);
                            }

                        } catch (Exception $exception) {
                            $get_sms_status = $exception->getMessage();
                        }
                        break;

                    case 'LeTexto':

                        $parameters = [
                                'campaignType' => 'SIMPLE',
                                'sender'       => $data['sender_id'],
                                'message'      => $message,
                                'recipients'   => [['phone' => $phone]],
                        ];


                        try {

                            $headers = [
                                    'Content-Type: application/json',
                                    'Authorization: Bearer '.$sending_server->api_token,
                            ];

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $response = curl_exec($ch);
                            curl_close($ch);

                            $get_response = json_decode($response, true);

                            if (isset($get_response) && is_array($get_response)) {
                                if (array_key_exists('status', $get_response)) {
                                    if ($get_response['status'] == 200) {
                                        $get_sms_status = 'Delivered';
                                    } else {
                                        $get_sms_status = $get_response['message'];
                                    }
                                } elseif (array_key_exists('id', $get_response)) {
                                    $get_sms_status = 'Delivered|'.$get_response['id'];
                                } else {
                                    $get_sms_status = (string) $response;
                                }
                            } else {
                                $get_sms_status = (string) $response;
                            }

                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;


                    case 'SMSCarrierEU':
                        $parameters = [
                                'user'       => $sending_server->username,
                                'password'   => $sending_server->password,
                                'sender'     => $data['sender_id'],
                                'recipients' => $phone,
                                'dlr'        => 0,
                        ];

                        if ($sms_type == 'unicode') {
                            $parameters['message'] = $this->sms_unicode($message);
                            $gateway_url           = 'https://smsc.i-digital-m.com/smsgw/sendunicode.php';
                        } else {
                            $parameters['message'] = $message;
                        }

                        $sending_url = $gateway_url.'?'.http_build_query($parameters);

                        try {
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $sending_url);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $get_sms_status = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                $get_sms_status = preg_replace("/\r|\n/", "", $get_sms_status);

                                if (substr_count($get_sms_status, 'OK') == 1) {
                                    $get_sms_status = 'Delivered';
                                } else {
                                    $get_sms_status = str_replace('ERROR:', '', $get_sms_status);
                                }
                            }
                            curl_close($ch);
                        } catch (Exception $exception) {
                            $get_sms_status = $exception->getMessage();
                        }
                        break;


                    case 'MSMPusher':
                        $parameters = [
                                'api_private_key' => $sending_server->c1,
                                'api_public_key'  => $sending_server->c2,
                                'sender'          => $data['sender_id'],
                                'numbers'         => $phone,
                                'message'         => $message,
                        ];


                        $sending_url = $gateway_url.'?'.http_build_query($parameters);

                        try {
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $sending_url);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                            $get_sms_status = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                $get_response = json_decode($get_sms_status, true);

                                if (isset($get_response) && is_array($get_response) && array_key_exists('status', $get_response)) {

                                    switch ($get_response['status']) {
                                        case '1000':
                                            $get_sms_status = 'Delivered';
                                            break;

                                        case '1001':
                                            $get_sms_status = 'Not All Messages were sent successfully due to insufficient balance';
                                            break;

                                        case '1002':
                                            $get_sms_status = 'Missing API Parameters';
                                            break;

                                        case '1003':
                                            $get_sms_status = 'Insufficient balance';
                                            break;

                                        case '1004':
                                            $get_sms_status = 'Mismatched API key';
                                            break;

                                        case '1005':
                                            $get_sms_status = 'Invalid Phone Number';
                                            break;

                                        case '1006':
                                            $get_sms_status = 'invalid Sender ID. Sender ID must not be more than 11 Characters. Characters include white space.';
                                            break;

                                        case '1007':
                                            $get_sms_status = 'Message scheduled for later delivery';
                                            break;

                                        case '1008':
                                            $get_sms_status = 'Empty Message';
                                            break;

                                        case '1009':
                                            $get_sms_status = 'SMS sending failed';
                                            break;

                                        case '1010':
                                            $get_sms_status = 'No messages has been sent on the specified dates using the specified api key';
                                            break;

                                    }
                                } else {
                                    $get_sms_status = 'Failed';
                                }
                            }
                            curl_close($ch);
                        } catch (Exception $exception) {
                            $get_sms_status = $exception->getMessage();
                        }
                        break;

                    case 'TxTria':
                        $parameters = [
                                'sys_id'     => $sending_server->c1,
                                'auth_token' => $sending_server->auth_token,
                                'From'       => $data['sender_id'],
                                'To'         => $phone,
                                'Body'       => urlencode($message),
                        ];

                        try {
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);

                            $response = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                $get_response = json_decode($response, true);

                                if (isset($get_response) && is_array($get_response)) {
                                    if (array_key_exists('success', $get_response) && $get_response['success'] == 1) {
                                        $get_sms_status = 'Delivered';
                                    } elseif (array_key_exists('error', $get_response) && $get_response['error'] == 1) {
                                        $get_sms_status = $get_response['message'];
                                    } else {
                                        $get_sms_status = (string) $response;
                                    }
                                } else {
                                    $get_sms_status = (string) $response;
                                }
                            }
                            curl_close($ch);
                        } catch (Exception $exception) {
                            $get_sms_status = $exception->getMessage();
                        }
                        break;

                    case 'Gatewayapi':

                        $sms_counter  = new SMSCounter();
                        $message_data = $sms_counter->count($message);

                        $parameters = [
                                'message'      => $message,
                                'sender'       => $data['sender_id'],
                                'callback_url' => route('dlr.gatewayapi'),
                                'max_parts'    => 9,
                                'recipients'   => [
                                        [
                                                'msisdn' => $phone,
                                        ],
                                ],
                        ];

                        if ($message_data->encoding == 'UTF16') {
                            $parameters['encoding'] = 'UCS2';
                        }


                        $headers = [
                                'Accept: application/json',
                                'Content-Type: application/json',
                        ];

                        try {
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                            curl_setopt($ch, CURLOPT_USERPWD, $sending_server->api_token.":");
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            $response = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                $get_response = json_decode($response, true);

                                if (isset($get_response) && is_array($get_response)) {
                                    if (array_key_exists('ids', $get_response)) {
                                        $get_sms_status = 'Delivered|'.$get_response['ids'][0];
                                    } else {
                                        $get_sms_status = $get_response['message'];
                                    }
                                } else {
                                    $get_sms_status = (string) $response;
                                }
                            }
                            curl_close($ch);
                        } catch (Exception $exception) {
                            $get_sms_status = $exception->getMessage();
                        }
                        break;

                    case 'CamooCM':

                        $parameters = [
                                'api_key'    => $sending_server->api_key,
                                'api_secret' => $sending_server->api_secret,
                                'from'       => $data['sender_id'],
                                'to'         => $phone,
                                'message'    => $message,
                        ];

                        $parameters  = http_build_query($parameters);
                        $gateway_url = $gateway_url.'?'.$parameters;

                        $ch = curl_init();

                        curl_setopt($ch, CURLOPT_URL, $gateway_url);
                        curl_setopt($ch, CURLOPT_HTTPGET, 1);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        $get_data = curl_exec($ch);

                        if (curl_errno($ch)) {
                            $get_sms_status = curl_error($ch);
                        } else {
                            $get_response = json_decode($get_data, true);
                            if (is_array($get_response) && array_key_exists('_message', $get_response)) {
                                if ($get_response['_message'] == 'succes') {
                                    $get_sms_status = 'Delivered';
                                } else {
                                    $get_sms_status = $get_response['_message'];
                                }
                            } else {
                                $get_sms_status = (string) $get_data;
                            }
                        }

                        curl_close($ch);
                        break;

                    case 'SemySMS':

                        $parameters = [
                                "phone"  => $phone,
                                "msg"    => $message,
                                "device" => $sending_server->device_id,
                                "token"  => $sending_server->api_token,
                        ];

                        try {
                            $ch = curl_init($gateway_url);
                            curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                            $response = curl_exec($ch);
                            curl_close($ch);

                            $response = json_decode($response, true);

                            if (is_array($response) && array_key_exists('code', $response)) {
                                if ($response['code'] == 0) {
                                    $get_sms_status = 'Delivered';
                                } else {
                                    $get_sms_status = $response['error'];
                                }
                            } else {
                                $get_sms_status = 'SMS Gateway provides empty response';
                            }
                        } catch (Exception $ex) {
                            $get_sms_status = $ex->getMessage();
                        }
                        break;

                    case 'BurstSMS':
                        $parameters = [
                                'to'      => $phone,
                                'message' => $message,
                        ];

                        if (isset($data['sender_id'])) {
                            $parameters['from'] = $data['sender_id'];
                        }

                        $parameters  = http_build_query($parameters);
                        $gateway_url = $gateway_url.'?'.$parameters;

                        try {
                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

                            $headers   = [];
                            $headers[] = "Authorization: Basic ".base64_encode("$sending_server->api_key:$sending_server->api_secret");
                            $headers[] = "Content-Type: application/json";
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                            $result = curl_exec($ch);
                            curl_close($ch);

                            $result = json_decode($result, true);

                            if (is_array($result) && array_key_exists('error', $result) && array_key_exists('code', $result['error'])) {
                                if ($result['error']['code'] == 'SUCCESS') {
                                    $get_sms_status = 'Delivered|'.$result['message_id'];
                                } else {
                                    $get_sms_status = $result['error']['description'];
                                }
                            } else {
                                $get_sms_status = (string) $result;
                            }

                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }

                        break;

                    case 'Inteliquent':

                        $parameters = [
                                'from' => $data['sender_id'],
                                'text' => $message,
                                'to'   => [$phone],
                        ];

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $gateway_url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                                'Authorization: Bearer '.$sending_server->api_token,
                                'Content-Type: application/json',
                        ]);
                        $result = curl_exec($ch);
                        curl_close($ch);

                        $result = json_decode($result, true);

                        if (is_array($result) && array_key_exists('success', $result) && array_key_exists('detail', $result)) {
                            if ($result['success'] == 1) {
                                $get_sms_status = 'Delivered';
                            } else {
                                $get_sms_status = $result['detail'];
                            }
                        } else {
                            $get_sms_status = (string) $result;
                        }
                        break;

                    case 'VisionUp':

                        $parameters = [
                                'message' => $message,
                                'phone'   => $phone,
                        ];

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $gateway_url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                                'Authorization: Basic '.base64_encode("$sending_server->username:$sending_server->password"),
                                'Content-Type: application/json',
                        ]);
                        $result = curl_exec($ch);
                        curl_close($ch);

                        $get_result = json_decode($result, true);

                        if (is_array($get_result)) {
                            if (array_key_exists('id', $get_result)) {
                                $get_sms_status = 'Delivered|'.$get_result['id'];
                            } elseif (array_key_exists('message', $get_result)) {
                                $get_sms_status = $get_result['message'];
                            } else {
                                $get_sms_status = (string) $result;
                            }
                        } else {
                            $get_sms_status = (string) $result;
                        }
                        break;

                    case 'FHMCloud':

                        $parameters = [
                                'message'   => $message,
                                'recipient' => $phone,
                                'type'      => 'plain',
                        ];

                        if (isset($data['sender_id'])) {
                            $parameters['sender_id'] = $data['sender_id'];
                        }

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $gateway_url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                                'Authorization: Bearer '.$sending_server->api_key,
                                'Content-Type: application/json',
                        ]);
                        $result = curl_exec($ch);
                        if (curl_errno($ch)) {
                            $get_sms_status = curl_error($ch);
                        } else {
                            $get_result = json_decode($result, true);

                            if (is_array($get_result) && array_key_exists('status', $get_result)) {
                                if ($get_result['status'] == 'success') {
                                    $get_sms_status = 'Delivered';
                                } elseif ($get_result['status'] == 'error') {
                                    $get_sms_status = $get_result['message'];
                                } else {
                                    $get_sms_status = $get_result['status'];
                                }
                            } else {
                                $get_sms_status = (string) $result;
                            }
                        }

                        curl_close($ch);
                        break;

                    case 'SMSTO':

                        $parameters = [
                                'message' => $message,
                                'to'      => $phone,
                        ];

                        if (isset($data['sender_id'])) {
                            $parameters['sender_id'] = $data['sender_id'];
                        }

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $gateway_url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                                'Authorization: Bearer '.$sending_server->api_key,
                                'Content-Type: application/json',
                                'Accept: application/json',
                        ]);
                        $result = curl_exec($ch);
                        curl_close($ch);

                        $get_result = json_decode($result, true);

                        if (is_array($get_result) && array_key_exists('success', $get_result)) {
                            if ($get_result['success']) {
                                $get_sms_status = 'Delivered|'.$get_result['message_id'];
                            } else {
                                $get_sms_status = $get_result['message'];
                            }
                        } else {
                            $get_sms_status = (string) $result;
                        }
                        break;

                    case 'TextBelt':

                        $parameters = [
                                'key'     => $sending_server->api_key,
                                'phone'   => $phone,
                                'message' => $message,
                        ];

                        try {
                            $curl = curl_init();
                            curl_setopt($curl, CURLOPT_URL, $gateway_url);
                            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($parameters));
                            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                            $result = curl_exec($curl);
                            curl_close($curl);

                            $response = json_decode($result, true);

                            if ($response && is_array($response) && array_key_exists('success', $response)) {
                                if ($response['success']) {
                                    $get_sms_status = 'Delivered|'.$response['textId'];
                                } else {
                                    $get_sms_status = $response['error'];
                                }
                            } else {
                                $get_sms_status = (string) $result;
                            }
                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'IntelTele':

                        $parameters = [
                                'username' => $sending_server->username,
                                'api_key'  => $sending_server->api_key,
                                'from'     => $data['sender_id'],
                                'to'       => $phone,
                                'message'  => $message,
                        ];

                        $gateway_url = $gateway_url.'?'.http_build_query($parameters);

                        try {
                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

                            $result = curl_exec($ch);
                            curl_close($ch);

                            $result = json_decode($result, true);

                            if (is_array($result) && array_key_exists('reply', $result) && array_key_exists('0', $result['reply']) && array_key_exists('status', $result['reply'][0])) {
                                if ($result['reply'][0]['status'] == 'OK') {
                                    $get_sms_status = 'Delivered';
                                } else {
                                    $get_sms_status = $result['reply'][0]['status'];
                                }
                            } elseif (is_array($result) && array_key_exists('message', $result)) {
                                $get_sms_status = $result['message'];
                            } else {
                                $get_sms_status = (string) $result;
                            }

                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'GatewaySa':
                        $parameters = [
                                'ApiKey'        => $sending_server->api_key,
                                'ClientId'      => $sending_server->c1,
                                'SenderId'      => $data['sender_id'],
                                'MobileNumbers' => $phone,
                                'Message'       => $message,
                        ];

                        if ($sms_type == 'unicode') {
                            $parameters['Is_Unicode'] = true;
                        }

                        $gateway_url = $gateway_url.'?'.http_build_query($parameters);

                        try {
                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

                            $headers   = [];
                            $headers[] = "Content-Type: application/json";
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                            $response = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                $result = json_decode($response, true);
                                if (is_array($result) && array_key_exists('ErrorCode', $result) && array_key_exists('ErrorDescription', $result)) {
                                    if ($result['ErrorCode'] == 0 && array_key_exists('Data', $result)) {
                                        if ($result['Data'][0]['MessageErrorCode'] == 0) {
                                            $get_sms_status = 'Delivered';
                                        } else {
                                            $get_sms_status = $result['Data'][0]['MessageErrorDescription'];
                                        }
                                    } else {
                                        $get_sms_status = $result['ErrorDescription'];
                                    }
                                } else {
                                    $get_sms_status = (string) $response;
                                }
                            }
                            curl_close($ch);
                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;


                    case 'OnBuka':

                        $time = time();
                        $sign = md5($sending_server->api_key.$sending_server->api_secret.$time);

                        $parameters = [
                                'appId'   => $sending_server->application_id,
                                'numbers' => $phone,
                                'content' => $message,
                        ];

                        if (isset($data['sender_id'])) {
                            $parameters['senderID'] = $data['sender_id'];
                        }

                        $gateway_url = $gateway_url.'?'.http_build_query($parameters);
                        $headers     = [];
                        $headers[]   = "Sign: $sign";
                        $headers[]   = "Timestamp: $time";
                        $headers[]   = "Api-Key: $sending_server->api_key";
                        $headers[]   = "Content-Type: application/json;charset=UTF-8";

                        try {

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

                            $get_sms_status = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {

                                $get_data = json_decode($get_sms_status, true);

                                if (is_array($get_data) && array_key_exists('status', $get_data)) {
                                    switch ($get_data['status']) {
                                        case '0':
                                            $get_sms_status = 'Delivered';
                                            break;

                                        case '-1':
                                            $get_sms_status = 'authentication error';
                                            break;

                                        case '-2':
                                            $get_sms_status = 'IP access limited';
                                            break;

                                        case '-3':
                                            $get_sms_status = 'SMS contents with sensitive characters';
                                            break;

                                        case '-4':
                                            $get_sms_status = 'SMS content is empty';
                                            break;

                                        case '-5':
                                            $get_sms_status = 'SMS content is over the length';
                                            break;

                                        case '-6':
                                            $get_sms_status = 'SMS contents are out of template';
                                            break;

                                        case '-7':
                                            $get_sms_status = 'numbers are over the limitation';
                                            break;

                                        case '-8':
                                            $get_sms_status = 'number is empty';
                                            break;

                                        case '-9':
                                            $get_sms_status = 'numbers are abnormal';
                                            break;

                                        case '-10':
                                            $get_sms_status = 'insufficient balance which unable to support the task';
                                            break;

                                        case '-11':
                                            $get_sms_status = 'incorrect timing format';
                                            break;

                                        case '-12':
                                            $get_sms_status = 'due to platform issue，bulk submission has been failed,please contact Admin';
                                            break;

                                        case '-13':
                                            $get_sms_status = 'users has been locked';
                                            break;

                                        case '-14':
                                            $get_sms_status = 'Field is empty or inquiry id is abnormal';
                                            break;

                                        case '-15':
                                            $get_sms_status = 'query too frequently';
                                            break;

                                        case '-16':
                                            $get_sms_status = 'timestamp expires';
                                            break;

                                        case '-17':
                                            $get_sms_status = 'SMS template can not be empty';
                                            break;

                                        case '-18':
                                            $get_sms_status = 'port program unusual';
                                            break;

                                        case '-19':
                                            $get_sms_status = 'Please contact the sales people to bind the route';
                                            break;
                                    }
                                }

                            }
                            curl_close($ch);
                        } catch (Exception $exception) {
                            $get_sms_status = $exception->getMessage();
                        }
                        break;

                    case 'BulkGate':

                        $parameters = [
                                'application_id'    => $sending_server->application_id,
                                'application_token' => $sending_server->api_token,
                                'number'            => $phone,
                                'text'              => $message,
                        ];

                        if (isset($data['sender_id'])) {
                            $parameters['sender_id']       = 'gText';
                            $parameters['sender_id_value'] = $data['sender_id'];
                        }

                        if ($sms_type == 'unicode') {
                            $parameters['unicode'] = true;
                        } else {
                            $parameters['unicode'] = false;
                        }

                        try {

                            $curl = curl_init();

                            curl_setopt_array($curl, [
                                    CURLOPT_URL            => $gateway_url,
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_SSL_VERIFYPEER => false,
                                    CURLOPT_TIMEOUT        => 30,
                                    CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                                    CURLOPT_CUSTOMREQUEST  => 'POST',
                                    CURLOPT_POSTFIELDS     => json_encode($parameters),
                                    CURLOPT_HTTPHEADER     => [
                                            'Content-Type: application/json',
                                            'Cache-Control: no-cache',
                                    ],
                            ]);

                            $response = curl_exec($curl);

                            if ($error = curl_error($curl)) {
                                $get_sms_status = $error;
                            } else {
                                $response = json_decode($response, true);

                                if (isset($response) && is_array($response)) {
                                    if (array_key_exists('data', $response)) {
                                        $get_sms_status = 'Delivered';
                                    } elseif (array_key_exists('error', $response)) {
                                        $get_sms_status = $response['error'];
                                    } else {
                                        $get_sms_status = implode(" ", $response);
                                    }
                                } else {
                                    $get_sms_status = $response;
                                }
                            }
                            curl_close($curl);
                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'SMSVas':

                        $parameters = [
                                'Username'    => $sending_server->username,
                                'Password'    => $sending_server->password,
                                'SMSText'     => $message,
                                'SMSSender'   => $data['sender_id'],
                                'SMSReceiver' => $phone,
                                'SMSID'       => Tool::GUID(),
                                'CampaignID'  => Tool::GUID(),
                                'DLRURL'      => route('dlr.smsvas'),
                        ];

                        if ($sms_type == 'unicode') {
                            $parameters['SMSLang'] = 'A';
                        } else {
                            $parameters['SMSLang'] = 'E';
                        }

                        try {
                            $ch = curl_init();

                            $headers   = [];
                            $headers[] = "Content-Type: application/json";

                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                            $result = curl_exec($ch);


                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                $get_sms_status = match ($result) {
                                    '0' => 'Delivered',
                                    '-1' => 'Invalid Credentials',
                                    '-2' => 'Invalid Account IP',
                                    '-3' => 'Invalid ANI Black List',
                                    '-5' => 'Out Of Credit',
                                    '-6' => 'Database Down',
                                    '-7' => 'Inactive Account',
                                    '-11' => 'Account Is Expired',
                                    '-12' => 'SMS is Empty',
                                    '-13' => 'Invalid Sender With Connection',
                                    '-14' => 'SMS Sending Failed Try Again',
                                    '-100' => 'Other Error',
                                    '-16' => 'User Can Not Send With DLR',
                                    '-18' => 'Invalid ANI',
                                    '-19' => 'SMS ID is Exist',
                                    default => 'Failed',
                                };
                            }

                            curl_close($ch);

                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'IconGlobalCoUK':
                        $parameters = [
                                'username'    => $sending_server->username,
                                'apiId'       => $sending_server->application_id,
                                'source'      => $data['sender_id'],
                                'destination' => $phone,
                                'text'        => $message,
                                'json'        => 'true',
                        ];

                        $gateway_url = $gateway_url.'?'.http_build_query($parameters);

                        try {
                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                            $response = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                $result = json_decode($response, true);
                                if (is_array($result) && array_key_exists('ErrorCode', $result) && array_key_exists('Description', $result)) {
                                    if ($result['ErrorCode'] == 0) {
                                        $get_sms_status = 'Delivered';
                                    } else {
                                        $get_sms_status = $result['Description'];
                                    }
                                } else {
                                    $get_sms_status = (string) $response;
                                }
                            }
                            curl_close($ch);
                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'SendPulse':
                        try {

                            $upload_path = storage_path('SendPulse/');

                            if ( ! file_exists($upload_path)) {
                                mkdir($upload_path, 0777, true);
                            }

                            $SPApiClient = new ApiClient($sending_server->c1, $sending_server->api_secret, new FileStorage($upload_path));

                            $parameters = [
                                    'sender'        => $data['sender_id'],
                                    'body'          => $message,
                                    'transliterate' => 0,
                            ];

                            $get_data = $SPApiClient->sendSmsByList([$phone], $parameters, []);

                            if (isset($get_data->result) && $get_data->result == 1) {
                                $get_sms_status = 'Delivered';
                            } elseif (isset($get_data->is_error) && $get_data->is_error) {
                                $get_sms_status = $get_data->message;
                            } else {
                                $get_sms_status = $get_data;
                            }

                        } catch (Exception $exception) {
                            $get_sms_status = $exception->getMessage();
                        }
                        break;

                    case 'SpewHub':
                        $parameters = [
                                'text'    => $message,
                                'numbers' => [$phone],
                        ];

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $gateway_url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                                'X-RGM-KEY:'.$sending_server->c1,
                                'Content-Type: application/json',
                                'Accept: application/json',
                        ]);
                        $result = curl_exec($ch);
                        curl_close($ch);

                        $get_result = json_decode($result, true);

                        if (is_array($get_result) && array_key_exists('success', $get_result)) {
                            if ($get_result['success']) {
                                $get_sms_status = 'Delivered';
                            } else {
                                $get_sms_status = $get_result['message'];
                            }
                        } elseif (is_array($get_result) && array_key_exists('errors', $get_result)) {
                            $get_sms_status = $get_result['message'];
                        } else {
                            $get_sms_status = $result;
                        }
                        break;

                    case 'CCSSMS':
                        $parameters = [
                                'username'        => $sending_server->username,
                                'password'        => $sending_server->password,
                                'dnis'            => $phone,
                                'ani'             => $data['sender_id'],
                                'message'         => $message,
                                'command'         => 'submit',
                                'longMessageMode' => 'split',
                        ];

                        if ($sms_type == 'unicode') {
                            $parameters['dataCoding'] = 1;
                        } else {
                            $parameters['dataCoding'] = 0;
                        }

                        $gateway_url = $gateway_url.'?'.http_build_query($parameters);

                        try {
                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                            $response = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                $get_data = json_decode($response, true);

                                if (isset($get_data) && is_array($get_data)) {
                                    if (array_key_exists('message_id', $get_data)) {
                                        $get_sms_status = 'Delivered';
                                    } else {
                                        $get_sms_status = implode(' ', $get_data);
                                    }
                                } else {
                                    $get_sms_status = 'Enable your port number for outgoing and incoming from your firewall';
                                }
                            }
                            curl_close($ch);
                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;


                    case 'TeleSign':
                        $parameters = [
                                "phone_number" => $phone,
                                "message"      => $message,
                                "message_type" => 'ARN',
                        ];

                        $headers = [
                                'Content-Type: application/x-www-form-urlencoded',
                                'Authorization: Basic '.base64_encode("$sending_server->c1:$sending_server->api_key"),
                        ];

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        curl_setopt($ch, CURLOPT_URL, $gateway_url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
                        $get_data = curl_exec($ch);

                        if (curl_error($ch)) {
                            $get_sms_status = curl_error($ch);
                        } else {

                            $get_status = json_decode($get_data, true);

                            if (is_array($get_status) && array_key_exists('status', $get_status)) {
                                if (is_array($get_status['status']) && array_key_exists('description', $get_status['status']) && array_key_exists('code', $get_status['status'])) {
                                    if ($get_status['status']['code'] == '290') {
                                        $get_sms_status = 'Delivered';
                                    } else {
                                        $get_sms_status = $get_status['status']['description'];
                                    }
                                } else {
                                    $get_sms_status = 'Invalid request';
                                }
                            } else {
                                $get_sms_status = 'Unknown error';
                            }

                        }
                        curl_close($ch);
                        break;


                    case 'ClearComMX':
                        $parameters = [
                                "auth"  => $sending_server->api_token,
                                "phone" => substr($phone, -10),
                                "msg"   => $message,
                        ];

                        if (isset($data['sender_id'])) {
                            $parameters['sender'] = $data['sender_id'];
                        }

                        $gateway_url = $gateway_url.'?'.http_build_query($parameters);

                        try {
                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                            $response = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                $get_data = json_decode($response, true);

                                if (isset($get_data) && is_array($get_data) && array_key_exists('status', $get_data)) {
                                    if ($get_data['status']) {
                                        $get_sms_status = 'Delivered';
                                    } else {
                                        $get_sms_status = $get_data['description'];
                                    }
                                } else {
                                    $get_sms_status = implode(' ', $get_data);
                                }
                            }
                            curl_close($ch);
                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'CyberGateLK':

                        $parameters = [
                                'from_number'   => $data['sender_id'],
                                'to_number'     => '+'.$phone,
                                'message'       => $message,
                                'delivery'      => 1,
                                'user_auth_key' => $sending_server->auth_key,
                        ];

                        $headers = [
                                'Content-Type:application/json',
                                'Authorization: Bearer '.$sending_server->api_token,
                        ];

                        try {

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $response = curl_exec($ch);
                            curl_close($ch);

                            $get_response = json_decode($response, true);

                            if (is_array($get_response) && array_key_exists('status', $get_response)) {
                                if ($get_response['status'] == 'error') {
                                    $get_sms_status = $get_response['message'];
                                } else {
                                    $get_sms_status = 'Delivered';
                                }
                            } else {
                                $get_sms_status = implode(' ', $get_response);
                            }
                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case 'LuxSMS':
                        $parameters = [
                                "api_id"       => $sending_server->c1,
                                "api_password" => $sending_server->password,
                                "sms_type"     => $sending_server->sms_type,
                                "sender_id"    => $data['sender_id'],
                                "phonenumber"  => $phone,
                                "textmessage " => $message,
                        ];


                        if ($sms_type == 'unicode') {
                            $parameters['encoding'] = 'U';
                        } else {
                            $parameters['encoding'] = 'T';
                        }

                        $gateway_url = $gateway_url.'?'.http_build_query($parameters);

                        try {
                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                            $response = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                $get_data = json_decode($response, true);

                                if (isset($get_data) && is_array($get_data) && array_key_exists('status', $get_data)) {
                                    if ($get_data['status'] == 'S') {
                                        $get_sms_status = 'Delivered';
                                    } else {
                                        $get_sms_status = $get_data['remarks'];
                                    }
                                } else {
                                    $get_sms_status = implode(' ', $get_data);
                                }
                            }
                            curl_close($ch);
                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case SendingServer::TYPE_SAFARICOM:

                        $auth_url = rtrim($gateway_url, '/').'/auth/login';

                        $login_data = [
                                "username" => $sending_server->username,
                                "password" => $sending_server->password,
                        ];

                        $ch = curl_init();

                        curl_setopt_array($ch, [
                                CURLOPT_URL            => $auth_url,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING       => "",
                                CURLOPT_MAXREDIRS      => 10,
                                CURLOPT_TIMEOUT        => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_SSL_VERIFYHOST => false,
                                CURLOPT_SSL_VERIFYPEER => false,
                                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST  => "POST",
                                CURLOPT_POSTFIELDS     => json_encode($login_data),
                                CURLOPT_HTTPHEADER     => [
                                        "Content-Type: application/json",
                                        "X-Requested-With: XMLHttpRequest",
                                ],
                        ]);

                        $response = curl_exec($ch);
                        $err      = curl_error($ch);

                        curl_close($ch);

                        if ($err) {
                            $get_sms_status = $err;
                        } else {
                            $response = json_decode($response, true);

                            if (isset($response) && is_array($response) && array_key_exists('token', $response)) {
                                $access_token = $response['token'];
                                $send_sms_url = rtrim($gateway_url, '/').'/public/CMS/bulksms';

                                $headers   = [];
                                $headers[] = "X-Authorization: Bearer $access_token";
                                $headers[] = "Content-Type: application/json";
                                $headers[] = "X-Requested-With: XMLHttpRequest";
                                $headers[] = "Accept: application/json";

                                $parameters = [
                                        'timeStamp' => date('Ymd'),
                                        'dataSet'   => [
                                                'userName'  => $sending_server->c1,
                                                'channel'   => 'sms',
                                                'packageId' => $sending_server->project_id,
                                                'oa'        => $data['sender_id'],
                                                'msisdn'    => $phone,
                                                'message'   => $message,
                                                'uniqueId'  => date('YmdHms'),
                                        ],
                                ];

                                $ch = curl_init($send_sms_url);
                                curl_setopt($ch, CURLOPT_POST, 1);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                $result = curl_exec($ch);
                                $err    = curl_error($ch);

                                curl_close($ch);

                                if ($err) {
                                    $get_sms_status = $err;
                                } else {

                                    $get_data = json_decode($result, true);

                                    if (isset($get_data) && is_array($get_data) && array_key_exists('status', $get_data)) {
                                        if ($get_data['status'] == 'SUCCESS' || $get_data['status'] == '200') {
                                            $get_sms_status = 'Delivered';
                                        } else {
                                            $get_sms_status = $get_data['message'];
                                        }
                                    } else {
                                        $get_sms_status = (string) $result;
                                    }
                                }
                            } else {
                                $get_sms_status = $response['msg'];
                            }
                        }
                        break;

                    case 'SMSCrab':

                        $parameters = [
                                'sender_id' => $data['sender_id'],
                                'recipient' => $phone,
                                'type'      => 'plain',
                                'message'   => $message,
                        ];


                        $headers = [
                                'Content-Type:application/json',
                                'Accept: application/json',
                                'Authorization: Bearer '.$sending_server->api_token,
                        ];

                        try {

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $response = curl_exec($ch);
                            curl_close($ch);

                            $get_response = json_decode($response, true);

                            if (is_array($get_response) && array_key_exists('status', $get_response)) {
                                if ($get_response['status'] == 'success') {
                                    $get_sms_status = 'Delivered';
                                } else {
                                    $get_sms_status = $get_response['message'];
                                }
                            } else {
                                $get_sms_status = implode(' ', $get_response);
                            }
                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case SendingServer::TYPE_FACILITAMOVEL:

                        $parameters = [
                                "user"         => $sending_server->username,
                                "password"     => $sending_server->password,
                                "destinatario" => $phone,
                                "msg"          => $message,
                        ];

                        if (isset($data['sender_id'])) {
                            $parameters['externalkey'] = $data['sender_id'];
                        }

                        $gateway_url = $gateway_url.'?'.http_build_query($parameters);

                        try {
                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                            $response = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                $get_data = explode(";", trim($response));

                                if (isset($get_data) && is_array($get_data) && array_key_exists('1', $get_data)) {
                                    if (is_numeric($get_data['1'])) {
                                        $get_sms_status = 'Delivered';
                                    } else {
                                        $get_sms_status = $get_data['1'];
                                    }
                                } else {
                                    $get_sms_status = $response;
                                }
                            }
                            curl_close($ch);
                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case SendingServer::TYPE_SMSDELIVERER:

                        $parameters = [
                                "username" => $sending_server->username,
                                "password" => $sending_server->password,
                                "to"       => $phone,
                                "message"  => $message,
                        ];


                        $gateway_url = $gateway_url.'?'.http_build_query($parameters);

                        try {
                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $gateway_url);
                            curl_setopt($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                            $get_sms_status = curl_exec($ch);

                            if (curl_errno($ch)) {
                                $get_sms_status = curl_error($ch);
                            } else {
                                if (str_contains('-', $get_sms_status)) {
                                    $get_sms_status = 'Delivered';
                                }
                            }
                            curl_close($ch);
                        } catch (Exception $e) {
                            $get_sms_status = $e->getMessage();
                        }
                        break;

                    case SendingServer::TYPE_ROUNDSMS:

                        $parameters = [
                                "authkey" => $sending_server->auth_key,
                                "route"   => $s