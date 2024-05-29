# Crema Logo and Fonts CDN
The following cdn can be used for all websites managed by Crema. I don't want to use them on externally controlled sites until it's rock-stable.

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
<summary>How to Export Logos</summary>

## SVG Export Settings
<img src="docs/2018-svg-export-settings.png" width="500" alt="2018 SVG Export Settings">

## SVGZ Save as Copy Settings
<img src="docs/2018-svgz-save-settings.png" width="500" alt="2018 SVGZ Save Copy Settings">
</details>

<details>
<summary>How to Export Org Charts</summary>
	
1. Open the latest Website Organization Chart.

2. <details><summary>Show the "Placeholders" layer and hide the "Logos" and "Background" layers...</summary><img src="docs/2018-export-orgchart-1.png" width="400" alt="2018 MWG OrgChart Export Settings Screen 1"></details>

3. Click File > Export > Export for Screens

4. <details><summary>Choose the following export settings...</summary><img src="docs/2018-export-orgchart-2.png" width="100%" alt="2018 MWG OrgChart Export Settings Screen 2"><img src="docs/2018-export-orgchart-3.png" width="100%" alt="2018 MWG OrgChart Export Settings Screen 3"></details>

5. Click the "Export Artboard" button. This will save a SVG source file and minified PNG file on your desktop.

6. Run `yarn build` in this repo's root directory via the command line. This script will automatically build a linked svg file using a predefined list of cdn urls.

> Note: The "orgchart.svg" file I created in May 2024 has been manually optimized. In that process, I discovered Safari doesn't support using "calc" on the svg "x" attribute, but DOES support it with style overrides.
</details>
