<?php
define('DO_HEADING', '<div style="text-align:center;  font-size:14px; font-weight:bold; padding-bottom:10px; ">
 <div>Database Optimizer</div>
 <div>by Jack York (aka Jack_mcs) of </div>
 <div>oscommerce-solution.com</div>
</div>');

define('DO_TEXT_MAIN', '
<div class="section" style="padding-top:10px;">
The Database Optimizer provides an way to keep your database free of wasted space and old entries.  
</div>

<div class="section" style="padding-top:10px;"><span class="subHeading">Options: </span>
<ul>

<li>
<b>Analyze</b> - Cleans up internal keys in the tables and improves the speed of the database. This is the same 
function available in phpmyadmin and is safe to run as often as you like. Though more than once a day is 
probably overkill.
</li><br>

<li>
<b>Optimize</b> - Defragments the database and reduces query times, in some cases. A database can be fragmented and not load
any slower. It depends on which parts are fragmented. This is the same function available
in phpmyadmin and is safe to run. Though more than once a day is probably overkill.
</li><br>

<li>
<b>Customers</b> - When a customer adds something to their cart but never completes the order, the product stays in the customers basket
and customers basket attributes tables. These are never removed so over time all they are doing is bloating the 
database. If you have the Recover Cart Sales addon installed (recommended), then be sure to set the days for this
for a long enough time for you to see the abandoned carts.
</li><br>

<li>
<b>Customers Old</b> - Many times a customer, hacker or just some person curious about how your site works will create an account
and never use it. These accounts are never removed and just bloat the database and should be removed. The default value is
set to 300 days. If a person hasn\'t used an account in almost a year, they probably won\'t. But you can change that 
value in the settings.
</li><br>

<li>
<b>Truncate Customers Orders</b> - This option is used by the Remove Customers Old code to determine how to handle
old customers with orders. 
<ul>
<li>Opt A: Delete customer but leave orders.</li>
<li>Opt B: Delete customer and orders.</li>
<li>Opt C: Skip customers with orders.</li>
</ul>
</li><br>

<li>
<b>Product Notifications</b> - The products notification table contains customer and product ID\'s. This option
verifies that both of those exist for each entry. If not, the entry is deleted. Since one or both no longer
exist, having such an entry is meaningless since there is no way to use it.
</li><br>

<li>
<b>Orders CC</b> - If you store credit card numbers, this option will remove them from the orders table. Be sure to set the number of 
days in the settings high enough so that credit card numbers you may need are not deleted.
</li><br>

<li>
<b>Orphan Address Book</b> - This option will remove entries in the address book table that are no longer associated with a customer.
</li><br>

<li>
<b>Orphan Orders</b> - This option will remove any order where the customer of the order no longer exists. 
<span style="font-weight:bold;color:#ff0000">WARNING:</span> This option does 
not check if the order was placed with the use of an addon like Purchase Without Account. So if such an addon is installed 
in the shop and you do not want such orders deleted, do not use this option.
</li><br>

<li>
<b>Orphan Products</b> - This option will remove entries in the product tables that do not have an entry in the products_to_categories table.
</li><br>

<li>
<b>Sessions</b> - Session numbers are stored for every visitor, sometimes more than one per visitor. They never get deleted so the
sessions table can become quite large. It is the most likely table to have failures so keeping it trimmed will help reduce
that as well as speed up access times.
</li><br>

<li>
<b>SueprTracker</b> - This option only shows up if the SuperTracker addon is installed. That addon stores a large 
amount of data, some of which may not be helpful after a while. While the addon can be useful to a site, it can swell a 
database to many times its normal size so the supertracker table should be cleared occasionally.
</li>
<br>

<li>
<b>User Tracking</b> - This option only shows up if the User Tracking addon is installed. That addon stores a large 
amount of data, most of which is useless after a few days. While the addon can be useful to a site, it can swell a 
database to many times its normal size so the user tracking table should be cleared fairly regularly.
</li>
</ul>
</div> 
');