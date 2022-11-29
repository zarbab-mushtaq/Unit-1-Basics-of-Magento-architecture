
# Unit: Basics of Magento Architecture
Objectives:
- Modes
- Areas
- Routing
- Modules (structure, load order)
- \Psr\Log\LoggerInterface
- Email templates
- Sending email
## Study materials:
 ### Prep Course for Adobe Expert Commerce Developer (AD0-E716)
- Application modes https://experienceleague.adobe.com/docs/commerce-operations/configuration-guide/setup/application-modes.html
- Modules and areas https://developer.adobe.com/commerce/php/architecture/modules/areas/
- https://developer.adobe.com/commerce/php/development/build/component-file-structure/
- Routing https://developer.adobe.com/commerce/php/development/components/routing/
- Logger interface https://experienceleague.adobe.com/docs/commerce-operations/configuration-guide/logs/logger-interface.html
- Email templates https://developer.adobe.com/commerce/frontend-core/guide/templates/email/
- https://store.magenest.com/blog/how-to-send-email-in-magento-2/
## Delivery:
Create a simple module that adds its own router (e.g. rltsquare) and from within the router, it logs to a custom rltsquare.log file under standard Magento var/log/ location. Meaning, when I visit the page https://myshop.test/rltsquare I only see a string “test” in a browser, and I see “page visited” log entry in a custom rltsquare.log. Likewise, an email is sent, with its own email template, editable from Admin.
