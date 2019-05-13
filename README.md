![Logo](https://raw.githubusercontent.com/SimonFormanek/pureosc/pure/catalog/images/PURE-OCS.svg "PureHtml's PureOSC")

[![Quality](https://scrutinizer-ci.com/g/SimonFormanek/pureosc/badges/quality-score.png?b=pure)](https://scrutinizer-ci.com/g/SimonFormanek/pureosc/)
[![GitHub release](https://img.shields.io/github/release/SimonFormanek/pureosc.js.svg)](https://GitHub.com/SimonFormanek/pureosc.js/releases/)
[![GitHub tag](https://img.shields.io/github/tag/SimonFormanek/pureosc.js.svg)](https://GitHub.com/SimonFormanek/pureosc.js/tags/)
[![GitHub commits](https://img.shields.io/github/commits-since/SimonFormanek/pureosc.js/v1.0.0.svg)](https://GitHub.com/SimonFormanek/pureosc.js/commit/)
[![Github all releases](https://img.shields.io/github/downloads/SimonFormanek/pureosc.js/total.svg)](https://GitHub.com/SimonFormanek/pureosc.js/releases/)
[![GitHub stars](https://img.shields.io/github/stars/SimonFormanek/pureosc.js.svg?style=social&label=Star&maxAge=2592000)](https://GitHub.com/SimonFormanek/pureosc.js/stargazers/)
[![GitHub watchers](https://img.shields.io/github/watchers/SimonFormanek/pureosc.js.svg?style=social&label=Watch&maxAge=2592000)](https://GitHub.com/SimonFormanek/pureosc.js/watchers/)
[![GitHub issues](https://img.shields.io/github/issues/SimonFormanek/pureosc.js.svg)](https://GitHub.com/SimonFormanek/pureosc.js/issues/)
[![Open Source Love png1](https://badges.frapsoft.com/os/v1/open-source.png?v=103)](https://github.com/ellerbrock/open-source-badges/)

PureOSC
=======

PureHTML verson of OsCommerce 2.3

Features
--------

 * GDPR Newsletter Consent 
 * FlexiBee - accunting Software support
 * Static Catalog (no zero point of failure)
 * GDPR User actions and personal data views log

FlexiBee support
----------------

 * Bank Payment
 * CashDesk Paymet
 * Card Payment by GPWebPay
 * Post Money Order Payment
 * Shop to FlexiBee init tool

Whats new
---------

Composer Support
Gettext i18n support
No PHP3 code

/var/run/mysqld/mysqld.sock
Docker
------

Deploy:

    docker run -d -p 9998:9000 -v /var/run/mysqld/mysqld.sock:/var/run/mysqld/mysqld.sock 
    
    docker run -d -p 9998:9000 purehtml/pureosc
