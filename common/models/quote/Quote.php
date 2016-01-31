<?php

namespace common\models\quote;

use common\helpers\DatabaseHelper;
use common\models\ActiveRecordTimestamp;
use common\models\index\Index;
use Yii;
use common\models\company\Company;
use common\models\exchange\Exchange;
use common\models\rate\Rate;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "quote".
 *
 * @property integer $qid
 * @property string $fullname
 * @property string $shortname
 * @property string $englishname
 * @property string $acronym
 * @property integer $exchid
 * @property integer $companyid
 * @property integer $privileged
 * @property integer $ActiveFlag
 * @property string $ChangeDate
 *
 * @property Exchange $exch
 * @property Company $company
 * @property Rates[] $rates
 */
class Quote extends ActiveRecordTimestamp
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quote';
    }

        /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fullname', 'shortname', 'englishname', 'acronym', 'exchid', 'companyid'], 'required'],
            ['exchid','in','range' => array_keys(DatabaseHelper::getExchangesList())],
            ['companyid','in','range' => array_keys(DatabaseHelper::getCompaniesList())],
            ['ActiveFlag', 'integer'],
            ['ChangeDate', 'safe'],
            [['fullname', 'shortname', 'englishname', 'acronym'], 'string', 'max' => 255],
            ['privileged', 'boolean']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'qid' => 'Qid',
            'fullname' => 'Fullname',
            'shortname' => 'Shortname',
            'englishname' => 'Englishname',
            'acronym' => 'Acronym',
            'exchid' => 'Exchange',
            'companyid' => 'Company',
            'privileged' => 'Privileged',
            'ActiveFlag' => 'Active Flag',
            'ChangeDate' => 'Change Date',
        ];
    }

    /////////////////////////////////Relations

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExch()
    {
        return $this->hasOne(Exchange::className(), ['exchid' => 'exchid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['companyid' => 'companyid']);
    }

//    public function getCountry(){
//        $query = $this->hasOne(Company::className(), ['companyid' => 'companyid']);
//        $query->
//    }

    public function getIndeces(){
        return $this->hasMany(Index::className(),['indexid' => 'indid'])->viaTable('indiceslinks',['quoteid' => 'qid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRates()
    {
        return $this->hasMany(Rate::className(), ['quoteid' => 'qid']);
    }

    //////////////////////////////////////////////

    /**
     * get input rate step
     */
    public function getRateStep(){
        $value = $this->getAttributeValue(1,$this->qid);
        return $value ? $value : '0000001';
    }

    /**
     * get lot size for the quote
     */

    public function getLotSize(){
        return $this->getAttributeValue(3,$this->qid);
    }

    /**
     * universal parameters retrieval function
     */
    private function getAttributeValue($attrid, $id){
        $params = [':attrid' => $attrid, ':id' => $id];
        $sql = 'SELECT objattr.attrvalueid
                FROM objectsattributes objattr
                INNER JOIN attributesvalues attrval ON objattr.attrvalueid = attrval.attrvalueid
                INNER JOIN attributes attr ON attr.attrid = attrval.attrid
                WHERE attr.attrid in (:attrid) and objattr.id in (:id) and objattr.activeflag = 1';
        $value = Yii::$app->db->createCommand($sql,$params)->queryScalar();
        return $value;
    }
}
