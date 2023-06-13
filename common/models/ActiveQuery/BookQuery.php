<?php

namespace common\models\ActiveQuery;

use yii\db\ActiveQuery;
use common\models\Book;

/**
 * This is the ActiveQuery class for [[\common\models\Book]].
 *
 * @see Book
 */
class BookQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Book[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Book|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
