PrecioLuz-WebService
====================

This is a php PHP gateway required for PrecioLuz Android APP

- api.php: This file must be placed in your server. Program a cron job for running it every hour, or so. It will
generate the data.txt file, containing the prices of electricity of the day. That file is read by PrecioLuz app.

- listado.php: This file shows a list with the prices of electricity of the day. PrecioLuz APP use it, but
it can be used seperately as well

Have fun
