<?php

namespace app\models\products;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string|null $name
 * @property float|null $price
 * @property int|null $category_id
 *
 * @property ProductsCategory $category
 * @property UserOrders[] $userOrders
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['category_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductsCategory::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ProductsCategory::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[UserOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserOrders()
    {
        return $this->hasMany(UserOrders::class, ['product_id' => 'id']);
    }
}
