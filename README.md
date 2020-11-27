# Magento 2 Product Alerts GraphQL (Support PWA)

[Mageplaza Product Alerts for Magento 2](https://www.mageplaza.com/magento-2-product-alerts/) is a useful tool to inform customers about any changes in products, promotion programs, or simply a way to maintain the relationship with customers. 

The first outstanding feature of this extension is the “Out of stock” notification. When a product is out of stock, customers will see a pop-up with a message to inform them that the product is no longer available. After that, customers interested in the product can immediately hit the “Notify me” button to get the notification via email when the product is back in stock.

Another pop-up will display for customers to subscribe if they want to get notification about the changes of a specific product’s price. The store owner can take advantage of these customers’ concerns to notify them about the discounts on products they’re already interested in. This can encourage them to purchase at a better price. 

The notifications on restocked products or price changes can be sent to customers manually or automatically. Customers don’t have to track the update themselves on the store; instead, they can totally get all the accurate information via Product Alerts notifications. The extension supports all product types, including simple product, configurable product, group product, virtual product, bundle product, and downloadable product. 

With the support of the Mageplaza Report for Magento 2, the store admin can view all the product requests from customers in a clear data report. The report includes the most and recent requests about back-in-stock products and price changes. These valuable statistics help you understand customers’ interests and behaviors so that it’ll be easier to know which products are the most potential. 
The extension supports non-login customers to request price change and get notifications about the result. New visitors will have no burden to create an account for the first time they browse your website. Only a simple configuration from the admin backend will get everything done well. 

What’s more, **Magento 2 Product Alerts GraphQL is now a part of Mageplaza Product Alerts extension that adds GraphQL features.** This upgrade supports PWA compatibility. Now, with Mageplaza Product Alerts, you and get and push data on the website with GraphQl in a breeze.

## 1. How to install
Run the following command in Magento 2 root folder:

```
composer require mageplaza/module-product-alerts-graphql
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

**Note:** 
Magento 2 Product Alerts GraphQL requires installing [Mageplaza Product Alerts](https://www.mageplaza.com/magento-2-product-alerts/) in your Magento installation.

## 2. How to use
To start working with **Product Alerts GraphQL** in Magento, you need to:

- Use Magento 2.3.x or higher. Return your site to developer mode

- Set **GraphQL endpoint** as `http://<magento2-3-server>/graphql` in url box, click **Set endpoint**. (e.g. `http://develop.mageplaza.com/graphql/ce232/graphql`)

- The queries Mageplaza supports can be viewed [here](https://documenter.getpostman.com/view/10589000/SzS4RT6V?version=latest). 


![a](https://i.imgur.com/pcs5qdb.png)

## 3. Devdocs
- [Magento 2 Product Alerts API & examples](https://documenter.getpostman.com/view/10589000/SzRuXBU4?version=latest) 
- [Magento 2 Product Alerts GraphQL & examples](https://documenter.getpostman.com/view/10589000/SzS4RT6V?version=latest)

Click on Run in Postman to add these collections to your workspace quickly.

![Magento 2 blog graphql pwa](https://i.imgur.com/lhsXlUR.gif)

## 4. Contribute to this module 
Feel free to **Fork** and contribute to this module.

You can create a pull request, and we will consider to merge your proposed changes in the main branch. 

## 5. Get support 
- Don't hesitate to contact us if you have any question. We're excited to hear from you, and our support team will try best to solve your problems as soon as possible. 
- If you find this post helpful, please give it a **Star** ![star](https://i.imgur.com/S8e0ctO.png)
