# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Co to je

WordPress šablona `josefantos` (fork Digihood/Whitehill starteru) uvnitř Docker WP stacku.
Git repozitář má kořen o čtyři úrovně výš — v `docker-josefantos/` (obsahuje `docker-compose.yml`,
`public_html/` a `data/` s MySQL daty). Commity se tedy dělají z kořene repa, ne z adresáře šablony.

Web je jednostránková prezentace poskládaná z ACF bloků (hero, focus, about, services, contact),
převedená z návrhu ve Figma Make. Texty v UI i komentářích jsou česky, textová doména je `digi`.

## Příkazy

Docker (z kořene repa `docker-josefantos/`):

```bash
docker-compose up -d          # WP na http://localhost:8080, phpMyAdmin na http://localhost:8000
docker-compose exec wordpress /bin/bash
```

WP-CLI v kontejneru není. Jednorázové zásahy do dat se dělají PHP skriptem, který si natáhne
`wp-load.php`, a **vždy pod uživatelem www-data**:
`docker-compose exec -u www-data wordpress php /tmp/skript.php`. Pod rootem vzniknou soubory,
které pak WordPress nedokáže přepsat, a spadne na FTP fallback (proto je v `wp-config.php`
hned na začátku `FS_METHOD` = `direct`).

Build assetů (z adresáře šablony):

```bash
npm install                   # nutné i na serveru, viz níže
npm run build                 # vite → assets-minified/
npm run dev                   # vite dev server na :3000
```

Přepínač zdroje assetů je `VITE_DEVELOPMENT` v `public_html/wp-config.php` (řádek 7):
`false` = načítá se z `assets-minified/`, `true` = z `assets/` + dev serveru.
**Po každé změně v `assets/` je potřeba spustit `npm run build`**, jinak se na frontendu nic neprojeví.

Šablona nemá testy, linter ani PHP build (composer.json je prázdný, `vendor/` obsahuje jen autoload).
Ověřování změn probíhá v prohlížeči proti `http://localhost:8080`.

## Architektura

### Načítání PHP
`functions.php` → `functions/include.php` → jmenovitý seznam includů. **Nový soubor ve `functions/`
se nenačte sám** — musí se přidat do `include.php`.
Třídy se jmenují `d1g1*` a instancují se hned na konci vlastního souboru (`new d1g1Xxx;`).

### ACF bloky — hlavní stavební prvek webu
Registrace je datová, ne ruční:

1. `functions/acf/{slug}.php` — `return` pole s `name`, `title`, `icon`, `preview_field`, `fields`
   (ACF pole bez `location`).
2. `functions/d1g1AcfBlocks.php` — přes `glob()` načte všechny soubory ve `functions/acf/`,
   zaregistruje blok (kategorie `josefantos`) i field group, `location` dopočítá ze slugu.
3. `parts/block/{slug}.php` — frontendová šablona, kterou render callback includuje.

V editoru se místo šablony vypisuje kompaktní náhled (název sekce + `preview_field`), po kliknutí
ACF vymění náhled za formulář polí — o to se stará `'mode' => 'auto'` a `autoInlineEditing` musí
zůstat vypnuté, jinak by se texty editovaly rovnou v náhledu. **Příznak náhledu chodí jako třetí
parametr render callbacku** (`render( $block, $content, $is_preview, $post_id )`), ne uvnitř
`$block` — náhled se totiž vykresluje přes REST, kde `is_admin()` neplatí. Vzhled karty náhledu
je v `assets/styles/specific-css/admin.css`.

**Nový blok = přidat dva soubory se stejným slugem, nic dalšího se nikde neregistruje.**
Soubor ve `functions/acf/` bez klíče `fields` se přeskočí a registruje se sám —
tak funguje `acf/options.php` (stránka „Nastavení webu“, pole se čtou přes `get_field( 'x', 'option' )`).

Sdílené části bloků patří do `parts/block/partials/` a volají se přes
`get_template_part( 'parts/block/partials/section-heading', null, [ 'label' => …, 'title' => … ] )`.
Kromě hlavičky sekce je tu `tag-list.php` (štítky s volitelným odkazem, varianty `chip` a `outline`),
který sdílí blok „Čemu se věnuji“ a „Klíčové oblasti“ v bloku o mně.

### Šablony stránek
Web je jednostránkový, blog ani přihlašování v šabloně nejsou — starterové části
(`single.php`, `sidebar.php`, builder `d1g1B`, widgety, ajaxové stránkování, login/registrace)
byly odstraněny.

- `front-page.php` a `page-templates/template-full-width.php` jen vypíší `the_content()` —
  bloky si container i odsazení řeší samy.
- `page.php` includuje `page-templates/template-narrow.php` (textové stránky typu GDPR).
- `index.php` (WordPress ho v šabloně vyžaduje) a `404.php` jsou jen záložní stránky se zprávou,
  obě staví na sdíleném `parts/theme/message.php`.

### Záhlaví, zápatí, menu
`header.php` → `parts/theme/header-content.php` + `parts/theme/mobile-menu.php`,
`footer.php` → `parts/theme/colophon.php`. Menu se vypisují přes akce
`do_action( 'd1g1_menu_top' | 'd1g1_menu_mobile' | 'd1g1_menu_footer' )`,
které obsluhuje `functions/d1g1NavigationMenus.php` (lokace `primary`, `mobile`, `footer`).

### Ikony
`d1g1Icons::get( 'name', 'tailwind třídy' )` — inline SVG (sada Lucide) definované jako pole
cest v `functions/d1g1Icons.php`. Nová ikona = nový záznam v `$paths`.

### JS a formuláře
Veškerý frontend JS je v `assets/scripts/js/app.js` (jQuery IIFE), specifické skripty
v `assets/scripts/specific-scripts/`. Interakce se váží přes `data-*` atributy
(`data-menu-toggle`, `data-service-toggle`, `data-contact-form`), ne přes utility třídy.
### Kontaktní formulář
Formulář obsluhuje **Contact Form 7** (pole, příjemce i hlášky se nastavují v administraci pluginu),
blok `parts/block/contact.php` jen vykreslí shortcode formuláře vybraného v ACF poli `contact_form`.

Tři věci, které to drží pohromadě:
- `functions/d1g1ContactForm.php` — filtr `wpcf7_form_elements` nahrazuje v šabloně formuláře tokeny
  `{{icon:send}}` (ikona z `d1g1Icons`) a `{{privacy_url}}`; zároveň vypíná `wpcf7_autop`.
- Vzhled polí je v `assets/styles/style.css` pod `.contact-form` (`@layer components`).
  **Tailwind třídy nejde psát do šablony formuláře** — ta je v databázi a `content` glob ji neskenuje,
  takže by se odpovídající CSS nevygenerovalo.
- Po úspěšném odeslání `app.js` poslouchá událost `wpcf7mailsent`, skryje formulář
  a odkryje potvrzení `[data-contact-success]` (nadpis a text jsou v ACF).

Odesílatel e-mailů je `d1g1Settings::email_from_d1g1()` (musí sedět s účtem nastaveným v Post SMTP),
samotné odesílání jde přes plugin Post SMTP na `mail.digihood.cz`.

### Analytics a cookie lišta
Google Analytics je v `assets/scripts/specific-scripts/analytics.js`, měřicí ID drží konstanta
`d1g1RegisterStylesScripts::GA_ID` a do JS jde přes `wp_localize_script` jako `d1g1Analytics.id`
(žádné inline `<script>`). Výchozí stav Consent Mode se posílá právě odsud — musí odejít **dřív**
než `gtag('config', …)`, jinak by se změřil pageview bez souhlasu. Aktualizace podle voleb
návštěvníka pak řeší cookie lišta v `app.js` (`onAccept` / `onChange`).

Vzhled lišty je v `assets/styles/specific-css/cookiebanner.css` — vendorové CSS knihovny
a pod ním vlastní sekce, která přebíjí proměnné `--cc-*` a barvy funkcí `theme()`
z `tailwind.config.js`. Soubor **si načítá sama knihovna**, ne `wp_enqueue_style`, takže cesta
chodí z PHP přes `globaldata.cookiecss` — musí mířit na zbuildovaný soubor, jinak se `theme()`
nikdy nepřeloží.

### Assety a enqueue
`functions/d1g1RegisterStylesScripts.php` je jediné místo, kde se registrují styly a skripty.
Přidání nového vstupního souboru vyžaduje **dva zápisy**: `rollupOptions.input` ve `vite.config.js`
a odpovídající `wp_enqueue_*` v této třídě.

Pozor na dvě věci:
- Enqueue používá `filemtime()` — chybějící soubor v `assets-minified/` shodí web fatální chybou.
- Runtime závislosti (`tailwindcss-intersect`, `lightgallery`, `slick-carousel`)
  se načítají **přímo z `node_modules/`**, které není v gitu. Bez `npm install` na cílovém
  prostředí web nefunguje.

`assets-minified/` je naopak commitované — buildy patří do repa.

## Tailwind

`tailwind.config.js` používá **uzavřené** `theme` (ne `extend`) pro `colors`, `fontFamily`,
`fontSize`, `letterSpacing`, `borderRadius` a `screens`. Výchozí paleta Tailwindu tedy neexistuje —
`text-gray-500`, `rounded-lg`, `text-4xl` apod. se nevygenerují. K dispozici jsou jen tokeny
z návrhu: `background`, `foreground`, `primary(-foreground)`, `muted(-foreground)`, `border`.

Nadpisy `h1`–`h5` mají globální styl v `assets/styles/style.css` (`@layer base`, velikosti přes
`theme(fontSize.hN.*)`) — v šablonách se nadpisy neobalují typografickými třídami, případný
vizuální downgrade se dělá třídou `.h2` apod.

Animace na scroll používají plugin `tailwindcss-intersect`: vždy dvojice
`intersect:animate-fade-up intersect-once`. Bez `intersect-once` se animace přehraje pokaždé, když
prvek znovu vjede do viewportu — obsah pod rozbaleným akordeonem pak viditelně poskakuje
(návrh ve Figmě používá `useInView({ once: true })`).

Při zakládání nového adresáře se šablonami je nutné rozšířit `content` glob v `tailwind.config.js`.

## Známé pasti

- Obsah domácí stránky **není v postmeta** — ACF bloky si data ukládají do atributů bloku
  v `post_content`. Úpravy skriptem se dělají přes `parse_blocks()` / `serialize_blocks()` a musí
  projít `wp_slash()` (jinak se rozbije `\u` escapování) a `kses_remove_filters()`
  (jinak se `&` přepíše na `&amp;`).
- `data/` v kořeni repa je živý MySQL datadir, takže `git status` je trvale „špinavý“ —
  do commitů se tyto změny nepřidávají, pokud to není záměr (snapshot DB).
- `is_production_d1g1()` v `d1g1ThemeFunctions.php` porovnává doménu proti `custom.cz`,
  což je zbytek ze starteru a pro tento web nikdy nevrátí `true`.
