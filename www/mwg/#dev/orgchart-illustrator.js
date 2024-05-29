#target illustrator
// Cycle between layervisibility A - B - None - around
// CC BY SA Janne Ojala 2014

layers = app.activeDocument.layers
placeholders = layers.getByName("Placeholders") // insert layer names here
logos = layers.getByName("Logos")

layers.getByName("Text & Lines").visible =  true;

alert("Exporting 8-Bit PNG File...");
logos.visible =  true;
placeholders.visible =  false;


//logos.visible =  false;
//placeholders.visible =  true;
//alert("Exporting SVG Source File...");
