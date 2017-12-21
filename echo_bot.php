<?php

/**
 * Copyright 2016 LINE Corporation
 *
 * LINE Corporation licenses this file to you under the Apache License,
 * version 2.0 (the "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at:
 *
 *   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

require_once('./LINEBotTiny.php');

$channelAccessToken = 'tkOA9U3b7H4QSlKWSBhsz++LyxyHwpLlaOzPp35CImqrS8jFAALvx2pLoRSplT8b8utaUa8mTTs+NFvNQBlIrFW8PlihS2HmvYQXD7IJQMMZ1Y70wUcrdbhc1d4IVLTJkfUknwZFrnfBaU4jynfv6wdB04t89/1O/w1cDnyilFU=';
$channelSecret = '455fdc0c7d84adf60d06d4d09d5906fc';

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            switch ($message['type']) {
                case 'text':
                    $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'text',
                                'text' => '歡迎來到熊大寶殿'
                            )
                        )
                    ));
                    break;
                case 'sticker':
                    $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'text',
                                'text' => '歡迎來到熊大寶殿'
                            ),
                            array(
                                'type' => 'sticker',
                                'packageId' => $message['packageId'],
                                'stickerId' => $message['stickerId']
                            )
                        )
                    ));
                    break;
                default:
                    error_log("Unsupporeted message type: " . $message['type']);
                    break;
            }
            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
