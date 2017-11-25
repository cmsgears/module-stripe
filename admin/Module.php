<?php
namespace cmsgears\stripe\admin;

// Yii Imports
use \Yii;

// CMG Imports
use cmsgears\stripe\common\config\StripeGlobal;

class Module extends \cmsgears\core\common\base\Module {

    public $controllerNamespace = 'cmsgears\stripe\admin\controllers';

	public $config 				= [ StripeGlobal::CONFIG_STRIPE ];

    public function init() {

        parent::init();

        $this->setViewPath( '@cmsgears/module-stripe/admin/views' );
    }

	public function getSidebarHtml() {

		$path	= Yii::getAlias( "@cmsgears" ) . "/module-stripe/admin/views/sidebar.php";

		return $path;
	}
}

?>