<?php
/**
 * This file is part of CMSGears Framework. Please view License file distributed
 * with the source code for license details.
 *
 * @link https://www.cmsgears.org/
 * @copyright Copyright (c) 2015 VulpineCode Technologies Pvt. Ltd.
 */

namespace cmsgears\paypal\rest\admin;

// Yii Imports
use Yii;

// CMG Imports
use cmsgears\stripe\common\config\StripeGlobal;

use cmsgears\core\common\base\Module as BaseModule;

/**
 * The admin module configures controller namespace, views path and sidebar.
 *
 * @since 1.0.0
 */
class Module extends BaseModule {

	// Variables ---------------------------------------------------

	// Globals ----------------

	// Public -----------------

    public $controllerNamespace = 'cmsgears\stripe\admin\controllers';

	public $config 	= [ StripeGlobal::CONFIG_STRIPE ];

	// Protected --------------

	// Private ----------------

	// Traits ------------------------------------------------------

	// Constructor and Initialisation ------------------------------

	/**
	 * @inheritdoc
	 */
    public function init() {

        parent::init();

        $this->setViewPath( '@cmsgears/module-stripe/admin/views' );
    }

	// Instance methods --------------------------------------------

	// Yii interfaces ------------------------

	// Yii parent classes --------------------

	// CMG interfaces ------------------------

	// CMG parent classes --------------------

	// Module --------------------------------

	/**
	 * Returns the path of sidebar view.
	 *
	 * @return string
	 */
	public function getSidebarHtml() {

		$path	= Yii::getAlias( "@cmsgears" ) . "/module-stripe/admin/views/sidebar.php";

		return $path;
	}

}
