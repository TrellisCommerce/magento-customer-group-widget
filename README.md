Brought to you and maintained by [Trellis Commerce](https://trellis.co/) - A full-service eCommerce agency based in Boston, MA.

## Trellis Customer Group Widget

Adds a new widget type that can be created to restrict content to selected customer groups.

## Installation Instructions
Follow the instructions below to install this extension using Composer.

```
composer config repositories.trellis/magento-customer-group-widget git git@github.
com:TrellisCommerce/magento-customer-group-widget
composer require trellis/magento-customer-group-widget
bin/magento module:enable --clear-static-content Trellis_CustomerGroupWidget
bin/magento setup:upgrade
bin/magento cache:flush
```

## Configuration

Adds a new Widget type called "Customer Group Restricted Block" that can be created in Admin under: Content > 
Widgets > Add Widget.

**New Widget Options:**

* Customer Groups - which customer group(s) for which to display the widget
* CMS Static Block - which static block to display