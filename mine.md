php artisan crud:generate Tank --fields="name#string#required; status#string#required" --view-path=backend --controller-namespace="Backend"
php artisan crud:generate Stock --fields="product_id#string#required; tank_id#string#required; oil_amount#string#required; date#date#required" --view-path=backend --controller-namespace="Backend"
php artisan crud:generate Vehicle --fields="model#string#required; vehicle_number#string#required; supervisor_name#string#required; supervisor_mobile#string#required; supervisor_mobile#string#required; vehicle_type#string#required" --view-path=backend --controller-namespace="Backend"


php artisan crud:generate PrivacyPolicy --fields="description#file#required" --view-path=backend --controller-namespace="Backend"
php artisan crud:generate Registration --fields="name#text#required; mobile#text#required; email#text#required; department#text#required; batch#text#required" --view-path=backend --controller-namespace="Backend"