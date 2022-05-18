# WooCommerce change order status after 48 hours if no action from seller : cron schedule

- Add cron job for every 3 minutes
- Create function to check order last date modified
- Automatically change order status if more than 48 hours last modified

Use: 
1. Open selected theme folder > functions.php
2. Add code add the end of the file
