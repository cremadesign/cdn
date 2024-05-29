import {readFileSync,writeFileSync} from "fs";
import {JSDOM} from "jsdom";

var sourceFile = "www/mwg/#dev/orgchart-source.svg",
	destFile = "www/mwg/orgchart-linked.svg";

var remapping = {
	"amf-holdings": {
		"logo_path": "partners/holdings/amf-holdings-black.svgz"
	},
	"amfirst": {
		"logo_path": "partners/amfirst/color.svgz",
		"website": "https://www.amfirstinsco.com"
	},
	"new-providence-life": {
		"logo_path": "partners/npl/color.svgz",
		"website": "https://newprovidencelife.com"
	},
	"oic-holdings": {
		"logo_path": "partners/holdings/oic-holdings-black.svgz"
	},
	"amfirst-ltd": {
		"logo_path": "partners/amfirst-ltd/color.svgz"
	},
	"info-lockbox": {
		"logo_path": "partners/lockbox/info-black.svgz",
		"website": "https://insurancelockbox.com"
	},
	"amf-services": {
		"logo_path": "partners/holdings/amf-services-black.svgz"
	},
	"amfirst-life": {
		"logo_path": "partners/amfirst-life/center-color.svgz",
		"website": "https://amfirstlife.com"
	},
	"monitor-life": {
		"logo_path": "partners/monitor-life/color.svgz",
		"website": "https://monitorlife.com"
	},
	"london-america": {
		"logo_path": "partners/london-america/color.svgz"
	},
	"tpm-life": {
		"logo_path": "partners/tpm/color.svgz",
		"website": "https://tpmins.com"
	},
	"amfirst-specialty": {
		"logo_path": "partners/amfirst-specialty/color.svgz"
	},
	"afic-administrators": {
		"logo_path": "partners/holdings/afic-administrators-black.svgz"
	},
	"amfirst-capital": {
		"logo_path": "partners/amfirst-capital/color.svgz"
	},
	"amfirst-holdings": {
		"logo_path": "partners/amfirst-holdings/black.svgz"
	},
	"ps112-capital": {
		"logo_path": "partners/ps112-capital/square-color.svg"
	}
}

var xml = readFileSync(sourceFile, 'utf8'),
	dom = new JSDOM(xml, { contentType: "text/xml"}),
	document = dom.window.document,
	svg = document.querySelector("svg"),
	defs = `
	<defs>
		<style>
			.fill-black path {fill:#333;}
			line,polyline {stroke:#333; fill:none;}
			text, foreignObject {
				font-family:'Roboto-Regular','Helvetica Neue', Arial, sans-serif;
				font-size: 7.75px;
				text-align: center;
			}
			foreignObject p {margin:0;}
			a:hover {cursor: pointer;}
		</style>
	</defs>`;

svg.setAttribute("version", "1.1");
svg.setAttribute("xml_space", "preserve");
svg.setAttribute("xmlns_xlink", "http://www.w3.org/1999/xlink");

document.querySelector("defs").remove();
svg.insertAdjacentHTML('afterbegin', defs);

document.querySelectorAll("rect").forEach(rect => {
	var properties = remapping[rect.id],
		image_url = `https://cdn.cremadesignstudio.com/mwg/${properties.logo_path}`;
	
	rect.removeAttribute("class");
	rect.removeAttribute("opacity");
	rect.setAttribute("xlink_href", image_url);
});

document.querySelectorAll("line, polyline").forEach(line => {
	line.removeAttribute("class");
	line.removeAttribute("fill");
	line.removeAttribute("stroke");
});

document.querySelectorAll("text").forEach(text => {
	text.removeAttribute("class");
	text.removeAttribute("font-family");
	text.removeAttribute("font-size");
});

var xmlString = dom.window.document.querySelector("svg").outerHTML;

xmlString = xmlString.replaceAll("rect", "image");
xmlString = xmlString.replaceAll("xml_space", "xml:space");
xmlString = xmlString.replaceAll("xmlns_xlink", "xmlns:xlink");
xmlString = xmlString.replaceAll("xlink_href", "xlink:href");
xmlString = xmlString.replaceAll("  ", "\t");

writeFileSync(destFile, xmlString);

console.log(xmlString);



/*/
	Possible other actions...
	
	1. In Illustrator file, move text and lines to different layers?
	2. Remove id and data-name from text
	3. Move all lines and polylines together
	4. Move all text together
	5. Pretty print xml code
/*/




/*/
	LINE BY LINE REPLACEMENTS
	
	REPLACEMENT A
	<line x1="278.33" y1="165.74" x2="278.33" y2="67.6" fill="none" stroke="#000" stroke-width=".83"/>
	becomes
	<line x1="278.33" y1="165.74" x2="278.33" y2="67.6" stroke-width=".83"/>
	
	REPLACEMENT B
	<polyline points="189.98 275.93 189.98 252.79 64.79 252.79 64.79 263.53" fill="none" stroke="#000" stroke-width=".83"/>
	becomes
	<polyline points="189.98 275.93 189.98 252.79 64.79 252.79 64.79 263.53" stroke-width=".83"/>
	
	REPLACEMENT C
	<text transform="translate(138.79 342.55)" font-family="SFProText-Regular, &apos;SFProText Regular&apos;" font-size="7.44"><tspan x="0" y="0">Puerto Rico Domiciled Company</tspan><tspan x="24.77" y="8.92">Owned 100% by</tspan><tspan x="21.47" y="17.85">AMF Holdings, Inc.</tspan></text>
	becomes
	<text transform="translate(138.79 342.55)"><tspan x="0" y="0">Puerto Rico Domiciled Company</tspan><tspan x="24.77" y="8.92">Owned 100% by</tspan><tspan x="21.47" y="17.85">AMF Holdings, Inc.</tspan></text>
/*/