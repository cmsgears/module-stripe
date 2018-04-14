<?php
/**
 * This file is part of CMSGears Framework. Please view License file distributed
 * with the source code for license details.
 *
 * @link https://www.cmsgears.org/
 * @copyright Copyright (c) 2015 VulpineCode Technologies Pvt. Ltd.
 */

// CMG Imports
use cmsgears\core\common\config\CoreGlobal;

use cmsgears\core\common\base\Migration;

use cmsgears\core\common\models\entities\Site;
use cmsgears\core\common\models\entities\User;
use cmsgears\core\common\models\resources\Form;
use cmsgears\core\common\models\resources\FormField;

use cmsgears\core\common\utilities\DateUtil;

/**
 * The stripe data migration inserts the base data required to run the application.
 *
 * @since 1.0.0
 */
class m160623_103639_stripe_data extends Migration {

	// Public Variables

	// Private Variables

	private $prefix;

	private $site;

	private $master;

	public function init() {

		// Table prefix
		$this->prefix	= Yii::$app->migration->cmgPrefix;

		// Site config
		$this->site		= Site::findBySlug( CoreGlobal::SITE_MAIN );
		$this->master	= User::findByUsername( Yii::$app->migration->getSiteMaster() );

		Yii::$app->core->setSite( $this->site );
	}

    public function up() {

		// Create various config
		$this->insertStripeConfig();

		// Init default config
		$this->insertDefaultConfig();
    }

	private function insertStripeConfig() {

		$this->insert( $this->prefix . 'core_form', [
            'siteId' => $this->site->id,
            'createdBy' => $this->master->id, 'modifiedBy' => $this->master->id,
            'name' => 'Config Stripe', 'slug' => 'config-stripe',
            'type' => CoreGlobal::TYPE_SYSTEM,
            'description' => 'Stripe configuration form.',
            'success' => 'All configurations saved successfully.',
            'captcha' => false,
            'visibility' => Form::VISIBILITY_PROTECTED,
            'status' => Form::STATUS_ACTIVE, 'userMail' => false,'adminMail' => false,
            'createdAt' => DateUtil::getDateTime(),
            'modifiedAt' => DateUtil::getDateTime()
        ]);

		$config	= Form::findBySlugType( 'config-stripe', CoreGlobal::TYPE_SYSTEM );

		$columns = [ 'formId', 'name', 'label', 'type', 'compress', 'meta', 'active', 'validators', 'order', 'icon', 'htmlOptions' ];

		$fields	= [
			[ $config->id, 'status', 'Status', FormField::TYPE_SELECT, false, true, true, 'required', 0, NULL, '{"title":"Status","items":{"test":"Test","live":"Live"}}' ],
			[ $config->id, 'payments', 'Payments', FormField::TYPE_TOGGLE, false, true, true, 'required', 0, NULL, '{"title":"Payments Enabled"}' ],
			[ $config->id, 'currency', 'Currency', FormField::TYPE_SELECT, false, true, true, 'required', 0, NULL, '{"title":"Currency","items":{"USD":"USD","CAD":"CAD"}}' ],
			[ $config->id, 'test_secret_key', 'Test Secret Key', FormField::TYPE_PASSWORD, false, true, true, 'required', 0, NULL, '{"title":"Test Secret Key","placeholder":"Test Secret Key"}' ],
			[ $config->id, 'test_publishable_key', 'Test Publishable Key', FormField::TYPE_TEXT, false, true, true, 'required', 0, NULL, '{"title":"Test Publishable Key","placeholder":"Test Publishable Key"}' ],
			[ $config->id, 'live_secret_key', 'Live Secret Key', FormField::TYPE_PASSWORD, false, true, true, 'required', 0, NULL, '{"title":"Live Secret Key","placeholder":"Live Secret Key"}' ],
			[ $config->id, 'live_publishable_key', 'Live Publishable Key', FormField::TYPE_TEXT, false, true, true, 'required', 0, NULL, '{"title":"Live Publishable Key","placeholder":"Live Publishable Key"}' ]
		];

		$this->batchInsert( $this->prefix . 'core_form_field', $columns, $fields );
	}

	private function insertDefaultConfig() {

		$columns = [ 'modelId', 'name', 'label', 'type', 'active', 'valueType', 'value', 'data' ];

		$metas	= [
			[ $this->site->id, 'status', 'Status', 'stripe', 1, 'text', NULL, NULL ],
			[ $this->site->id, 'payments', 'Payments', 'stripe', 1, 'flag', '0', NULL ],
			[ $this->site->id, 'currency','Currency', 'stripe', 1, 'text', 'USD', NULL ],
			[ $this->site->id, 'test_secret_key', 'Test Secret Key', 'stripe', 1, 'text', NULL, NULL ],
			[ $this->site->id, 'test_publishable_key', 'Test Publishable Key', 'stripe', 1, 'text', NULL, NULL ],
			[ $this->site->id, 'live_secret_key', 'Live Secret Key', 'stripe', 1, 'text', NULL, NULL ],
			[ $this->site->id, 'live_publishable_key', 'Live Publishable Key', 'stripe', 1, 'text', NULL, NULL ]
		];

		$this->batchInsert( $this->prefix . 'core_site_meta', $columns, $metas );
	}

    public function down() {

        echo "m160623_103639_stripe_data will be deleted with m160621_014408_core.\n";

        return true;
    }

}
