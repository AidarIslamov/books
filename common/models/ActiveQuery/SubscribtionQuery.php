<?php

namespace common\models\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\common\models\Subscribtion]].
 *
 * @see \common\models\Subscribtion
 */
class SubscribtionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Subscribtion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Subscribtion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
