/* Google Analytics (gtag.js)
   Měřicí ID přichází z PHP přes wp_localize_script (d1g1RegisterStylesScripts).
   Výchozí stav souhlasu se nastavuje tady, tedy dřív než se odešle config —
   cookie lišta ho pak podle voleb návštěvníka aktualizuje (app.js).
========================================================*/

window.dataLayer = window.dataLayer || [];

// přiřazení na window, aby minifikace nepřejmenovala globální gtag()
window.gtag = function gtag() {
    dataLayer.push(arguments);
};

gtag('consent', 'default', {
    'functional_storage': 'granted',
    'security_storage': 'granted',
    'analytics_storage': 'denied',
    'personalization_storage': 'denied',
    'ad_storage': 'denied',
    'ad_user_data': 'denied',
    'ad_personalization': 'denied'
});

gtag('js', new Date());

gtag('config', d1g1Analytics.id);
