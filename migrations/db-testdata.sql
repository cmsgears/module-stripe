/* ========================== CMSGears Stripe ========================================== */

SELECT @site := `id` FROM cmg_core_site WHERE slug = 'main';

--
-- REST Config Form
--

INSERT INTO `cmg_core_form` (`siteId`,`templateId`,`createdBy`,`modifiedBy`,`name`,`slug`,`type`,`description`,`successMessage`,`captcha`,`visibility`,`active`,`userMail`,`adminMail`,`createdAt`,`modifiedAt`,`htmlOptions`,`data`) VALUES
	(@site,NULL,1,1,'Config Stripe','config-stripe','system','Stripe configuration form.','All configurations saved successfully.',0,10,1,0,0,'2014-10-11 14:22:54','2014-10-11 14:22:54',NULL,NULL);

SELECT @form := `id` FROM cmg_core_form WHERE slug = 'config-stripe';	
	
INSERT INTO `cmg_core_form_field` (`formId`,`name`,`label`,`type`,`compress`,`validators`,`order`,`icon`,`htmlOptions`,`data`) VALUES	
	(@form,'status','Status',80,0,'required',0,'icon','{\"title\":\"Status\",\"items\":[\"test\",\"live\"]}',NULL),
	(@form,'currency','Currency',80,0,'required',0,'icon','{\"title\":\"Currency\",\"items\":[\"USD\"]}',NULL),	
	(@form,'test secret key','Test Secret Key',0,0,'required',0,NULL,'{\"title\":\"Test Secret Key\",\"placeholder\":\"Test Secret Key\"}',NULL),
	(@form,'test publishable key','Test Publishable Key',10,0,'required',0,NULL,'{\"title\":\"Test Publishable Key\",\"placeholder\":\"Test Publishable Key\"}',NULL),
	(@form,'live secret key','Live Secret Key',0,0,'required',0,NULL,'{\"title\":\"Live Secret Key\",\"placeholder\":\"Live Secret Key\"}',NULL),
	(@form,'live publishable key','Live Publishable Key',10,0,'required',0,NULL,'{\"title\":\"Live Publishable Key\",\"placeholder\":\"Live Publishable Key\"}',NULL);
	
	 
--
-- Dumping data for table `cmg_core_model_attribute`
--

INSERT INTO `cmg_core_model_attribute` (`parentId`,`parentType`,`name`,`label`,`type`,`valueType`,`value`) VALUES
	(@site,'site','status','Status','stripe','text',NULL),	
	(@site,'site','currency','Currency','stripe','text','USD'),	
	(@site,'site','test secret key','Test Secret Key','stripe','text',NULL),
	(@site,'site','test publishable key','Test Publishable Key','stripe','text',NULL),
	(@site,'site','live secret key','Live Secret Key','stripe','text',NULL),
	(@site,'site','live publishable key','Live Publishable Key','stripe','text',NULL);