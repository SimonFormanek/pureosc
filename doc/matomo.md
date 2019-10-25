# matomo PureOSC integration


OSC
=======
https://apps.oscommerce.com/hdHXJ&piwik-e-commerce-analytics-for-osc
other version is never but for osc2.2 (not tested): 
https://apps.oscommerce.com/Mj9Pz&piwik-addon-for-oscommerce-2-2



Google Adwords 
=================

https://matomo.org/blog/2017/12/track-google-adwords-campaigns-piwik/


settings
==============

### nastavení gooogle ads 2019
na [rpvni kl94ov0ho slolva s emus9 nejd59v vyplnit c9lov0 url reklamy a potom přípona

Url like: https://eshop.com/target-campaign-category
EXT. like: pk_campaign=1&pk_kwd=my_keyword&pk_source=google 


### track extesion

https://github.com/matomo-org/plugin-MarketingCampaignsReporting


### url builder

https://matomo.org/docs/tracking-campaigns-url-builder/

### tracking campaigns

https://matomo.org/docs/tracking-campaigns/

Adwords: the URL may look like: 

	landing.html?pk_campaign={campaignid}&pk_kwd={keyword}&pk_source=google&pk_medium=cpc&pk_content={creative}
	
### log tracking

apache log setup

cron script?

https://matomo.org/faq/log-analytics-tool/faq_16301/
https://github.com/matomo-org/matomo-log-analytics/blob/master/import_logs.py