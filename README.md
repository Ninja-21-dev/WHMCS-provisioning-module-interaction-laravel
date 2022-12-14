# WHMCS Instructing Provisioning Module #

## Summary ##

Instructing Provisioning Modules, also referred to as Product or Server Modules, allow you
to create modules that allow for the provisioning and management of products &
services in WHMCS.

The instructing files here demonstrates how a provisioning module for WHMCS should
be structured and exercises all supported functionality.

For more information, please refer to the documentation at:
https://developers.whmcs.com/provisioning-modules/

## Recommended Module Content ##

The recommended structure of a provisioning module is as follows.

```
 provisioningmodule/
  |- lib/
  |- templates/
  |- tests/
  |  hooks.php
  |  logo.png
  |  instructinginteraction.php
```

## Minimum Requirements ##

For the latest WHMCS minimum system requirements, please refer to
https://docs.whmcs.com/System_Requirements

We recommend your module follows the same minimum requirements wherever
possible.

## Third-Party APIs interaction ##

The lib directory contains third-party APIs interacting with https://onboardingdemo.stuffsleuth.com.
Register the WHMCS client user to the above site when service is created.
But it prevents registration of user with duplicate email.
Update the user status when service is suspended.

## Tests ##

We strongly encourage you to write unit tests for your work. Within this SDK we
provide a sample unit test based upon the widely used PHPUnit.

## Useful Resources
* [Developer Resources](https://developers.whmcs.com/)
* [Hook Documentation](https://developers.whmcs.com/hooks/)
* [API Documentation](https://developers.whmcs.com/api/)

[WHMCS Limited](https://www.whmcs.com)
