# Crema CDN
The following CDN can be used for all websites managed by Crema. I do not recommend using them on externally controlled sites, since the naming schema is still in flux.

## Fonts
This repo hosts several versions of Font Awesome 4 and 5, which we are using on a ton of our sites.

## Logos
<details>
<summary>Naming Scheme</summary>

**Carriers**<br>
http://cdn.cremadesignstudio.com/logos/carriers/ `CARRIER` - `SIZE` . `EXT`

**Corporate**<br>
http://cdn.cremadesignstudio.com/logos/corporate/ `COLOR` - `SIZE` . `EXT`

**Divisions**<br>
http://cdn.cremadesignstudio.com/logos/divisions/ `DIVISION` / `COLOR` - `SIZE` . `EXT`

**Partners**<br>
http://cdn.cremadesignstudio.com/logos/partners/ `PARTNER` / `STYLE` - `COLOR` - `SIZE` . `EXT`

**Products**<br>
http://cdn.cremadesignstudio.com/logos/products/ `PRODUCT` / `STYLE` - `COLOR` - `SIZE` . `EXT`

##### Notes
- The style tag is optional for the default logo
- The width tag is optional for 500px wide logos, since that is the largest size for raster logos.  However, I'm defaulting to svg and svgz files as much as possible.

#### Common Styles
- **Reversed** — color logo for dark backgrounds
- **White** — pure white logo for dark backgrounds
- **Black** — black or black and white logo
- **Color/4c** — haven't decided if the 4c abbreviation should be standard
- **Stacked/Square/Center** — besides the MWG division logos, this is the default
- **Horizontal** — duhh...used for wide logos.
</details>

<details>
<summary>How to Export</summary>

## SVG Export Settings
<img src="docs/2018-svg-export-settings.png" width="500" alt="2018 SVG Export Settings">

## SVGZ Save as Copy Settings
<img src="docs/2018-svgz-save-settings.png" width="500" alt="2018 SVGZ Save Copy Settings">
</details>

## Linked Org Charts
To avoid file duplication and optimize caching, we're using linked svg/svgz files. Unfortunately, this is a manual process, since Illustrator does not support it. However, our org chart scripts should make this process easier.

Clone this repo and run the following commands to install these scripts:
```
npm install -g svgo@2.3.0
yarn install
```

<details>
<summary>How to Export</summary>
	
1. Open the latest Website Organization Chart.

2. <details><summary>Show the "Placeholders" layer and hide the "Logos" and "Background" layers...</summary><img src="docs/2018-export-orgchart-1.png" width="400" alt="2018 MWG OrgChart Export Settings Screen 1"></details>

3. Click File > Export > Export for Screens

4. <details><summary>Choose the following export settings...</summary><img src="docs/2018-export-orgchart-2.png" width="100%" alt="2018 MWG OrgChart Export Settings Screen 2"><img src="docs/2018-export-orgchart-3.png" width="100%" alt="2018 MWG OrgChart Export Settings Screen 3"></details>

5. Click the "Export Artboard" button. This will save a SVG source file and minified PNG file on your desktop. Move this file into this repo's "www/mwg" directory.

6. Run `yarn build` in this repo's root directory via the command line. This script will automatically build a linked svg file using a predefined list of cdn urls.

> Note: The "orgchart.svg" file I created in May 2024 has been manually optimized. In that process, I discovered Safari doesn't support using "calc" on the svg "x" attribute, but DOES support it within inline style tags.
</details>





