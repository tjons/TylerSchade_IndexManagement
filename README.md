# TylerSchade_IndexManagement

A module that adds the missing index management features to the Magento 2 admin panel.

## Installation

This module has been uploaded to Packagist: https://packagist.org/packages/tylerschade/magento-index-management. You can install this module through Composer (https://getcomposer.org/) with `composer require tylerschade/magento-index-management`. This will add the package to your project's `vendor` directory and will update your composer.json.

## What does it actually do?

I work as a Magento developer for a eCommerce agency. Recently, at work, we ran into a situation where the data contained in the indexes was invalid and causing layered navigation to break. However, due to changes in Magento 2, you cannot easily (or at all) refresh the indexes in the admin panel. As it happened, I didn't have SSH access to that server, and so I had to sit by, waiting for someone else with access to sign in. 

I decided that I never wanted to be in that situation again, so I build a module that allows one to refresh the indexes in the Magento 2 backend `System -> Index Management` screen. It adds several features: 

- A button to refresh all indexes
- A column in the indexer grid to refresh each index individually
- A new massaction to refresh specified indexes together, but not all the indexes at the same time.

Here's a screenshot:

![Module screenshot](http://imgur.com/IYO7g6P)
