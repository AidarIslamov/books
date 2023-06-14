<?php
    
    use common\models\User;
    use yii\web\Request;
    
    
    if (!function_exists('app')) {
        /**
         * @return User|null
         */
        function app()
        {
            return Yii::$app;
        }
    }
    
    if (!function_exists('user')) {
        /**
         * @return User|null
         */
        function user()
        {
            return app()->user->identity;
        }
    }
    
    if (!function_exists('request')) {
        /**
         * @return Request
         */
        function request()
        {
            return app()->request;
        }
    }
    