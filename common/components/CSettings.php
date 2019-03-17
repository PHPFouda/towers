<?php

namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
 
class CSettings extends Component
{
	protected $_settings = array();
	
	public function init(){
		$this->_settings = array();
		
		/*$db = Yii::$app->db;// or Category::getDb()
		$dep = new DbDependency();
		$dep->sql = 'SELECT count(*) FROM category';
		$result = $db->cache(function ($db) use ($id) {
		    return Category::find()->where(['id' => $id])->all();
		}, CACHE_TIMEOUT, $dep);*/

		//\Yii::$app->cache->flush();//to clear cache
		$db = \Yii::$app->db;// or Category::getDb()
		$settings = $db->cache(function ($db) /*use ($id)*/ {
			return \common\models\Settings::find()->all();
		}, 600);//CACHE_TIMEOUT
		
		foreach($settings as $setting){
			$this->_settings[strtolower($setting->setting_key)] = $setting->setting_value;
		}

	}
	
	public function __get($property) {
		$property = strtolower($property);
		if(isset($this->_settings[$property])) return $this->_settings[$property];
		user_error("Undefined setting $property");
	}
	
	public function __set($property, $value) {
		$property = strtolower($property);
		
		$setting = \common\models\Settings::findOne(["key"=>$property]);
		if (!$setting){
			$setting = new \common\models\Settings();
			$setting->setting_key = $property;
		}
		$setting->setting_value = $value;
		$setting->save(null, false);
		
		$this->_settings[$property] = $value;
	}
	
}
