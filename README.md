# Magento 2 Product Alerts GraphQL (Support PWA)
Mageplaza Product Alerts Extension supports getting and pushing data on the website with GraphQl.

## How to install
Run the following command in Magento 2 root folder:

```
composer require mageplaza/module-product-alerts-graphql
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```
To start working with **Product Alerts GraphQL** in Magento, you need to:

- Use Magento 2.3.x. Return your site to developer mode

- Install [chrome extension](https://chrome.google.com/webstore/detail/chromeiql/fkkiamalmpiidkljmicmjfbieiclmeij?hl=en) (currently does not support other browsers)

- Set **GraphQL endpoint** as `http://<magento2-3-server>/graphql` in url box, click **Set endpoint**. (e.g. http://develop.mageplaza.com/graphql/ce232/graphql)

- The queries Mageplaza supports can be viewed [here](https://documenter.getpostman.com/view/10589000/SzS4RT6V?version=latest).


![a](https://i.imgur.com/pcs5qdb.png)
