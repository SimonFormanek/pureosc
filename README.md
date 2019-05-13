![Logo](https://raw.githubusercontent.com/SimonFormanek/pureosc/pure/catalog/images/store_logo.png "PureHtml's PureOSC")

[![Quality](https://scrutinizer-ci.com/g/SimonFormanek/pureosc/badges/quality-score.png?b=pure)](https://scrutinizer-ci.com/g/SimonFormanek/pureosc/)
[![GitHub release](https://img.shields.io/github/release/SimonFormanek/pureosc.svg)](https://GitHub.com/SimonFormanek/pureosc/releases/)
[![GitHub tag](https://img.shields.io/github/tag/SimonFormanek/pureosc.svg)](https://GitHub.com/SimonFormanek/pureosc/tags/)
[![GitHub commits](https://img.shields.io/github/commits-since/SimonFormanek/pureosc/v1.0.0.svg)](https://GitHub.com/SimonFormanek/pureosc/commit/)
[![GitHub forks](https://img.shields.io/github/forks/SimonFormanek/pureosc.svg)](https://github.com/SimonFormanek/pureosc/network)
[![Github all releases](https://img.shields.io/github/downloads/SimonFormanek/pureosc/total.svg)](https://GitHub.com/SimonFormanek/pureosc/releases/)
[![GitHub stars](https://img.shields.io/github/stars/SimonFormanek/pureosc.svg)](https://github.com/SimonFormanek/pureosc/stargazers)
[![GitHub watchers](https://img.shields.io/github/watchers/SimonFormanek/pureosc.svg?style=social&label=Watch&maxAge=2592000)](https://GitHub.com/SimonFormanek/pureosc/watchers/)
[![GitHub issues](https://img.shields.io/github/issues/SimonFormanek/pureosc.svg)](https://github.com/SimonFormanek/pureosc/issues)
[![Open Source Love png1](https://badges.frapsoft.com/os/v1/open-source.png?v=103)](https://github.com/ellerbrock/open-source-badges/)
[![GitHub license](https://img.shields.io/github/license/SimonFormanek/pureosc.svg)](https://github.com/SimonFormanek/pureosc/blob/pure/LICENSE)
[![Twitter](https://img.shields.io/twitter/url/https/github.com/SimonFormanek/pureosc.svg?style=social)](https://twitter.com/intent/tweet?text=Wow:&url=https%3A%2F%2Fgithub.com%2FSimonFormanek%2Fpureosc)

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
