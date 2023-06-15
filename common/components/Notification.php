<?php
    
    namespace common\components;
    
    use common\models\Book;
    use common\models\Subscribtion;
    use common\models\User;
    use Yii;
    
    class Notification
    {
        public static function sendSMS(Book $book, $debug = false)
        {
            /**
             * @var User $author
             */
            foreach ($book->author as $author) {
                /**
                 * @var Subscribtion $subscription
                 */
                foreach ($author->subscriptions as $subscription) {
                    $title = $book->title;
                    $authorName = $author->username;
                    $receiverName = $subscription->name;
                    $content = "Hello,{$receiverName}. We have new book {$title} from author {$authorName} (link)";
                    
                    $result = self::send($subscription->phone, $content);
                    if($debug) {
                        print_r($result);
                    }
                    
                }
                
            }
        }
        
        private static function send(string $phone, string $text)
        {
            $apikey = Yii::$app->params['sms_service']['apikey'];
            $sender = Yii::$app->params['sms_service']['sender'];
            
            $url = 'https://smspilot.ru/api.php'
                .'?send='.urlencode( $text )
                .'&to='.urlencode( $phone )
                .'&from='.$sender
                .'&apikey='.$apikey
                .'&format=json';

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, false);
            $result = curl_exec($ch);
            curl_close($ch);
            
            return $result;
        }
        
    }